@include('./vendor/autoload.php');

@setup
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    try {
        $dotenv->load();
        $dotenv->required(['DEPLOY_PATH'])->notEmpty();
    } catch ( Exception $e )  {
        echo $e->getMessage();
    }

    $date = (new DateTime)->format('Y/m/d - H:i');
    $env = isset($env) ? $env : "testing";
    $on = 'web';
    $path = getenv('DEPLOY_PATH');
    $app_env = getenv('APP_ENV');
    $slack = getenv('DEPLOY_SLACK_WEBHOOK');
    $chmods = ['storage', 'bootstrap/cache'];
@endsetup

@servers(['web' => '127.0.0.1'])


{{-- Run all deployment tasks --}}
@story('deploy')
    git
    {{-- migrate --}}
    composer
    dump
    laravel-mix
    chmod
    done
@endmacro

@task('git', ['on' => 'web', 'confirm' => true])
    echo "Get the latest from Git repo.";
    php artisan down
    git pull
    git describe --tags >version
@endtask

{{-- Updates composer, then runs a fresh installation --}}
@task('composer')
    chmod g+w storage/logs/laravel-*
    chgrp apache storage/logs/laravel-*
    composer self-update
    composer global update
    composer install --no-interaction --ansi --no-dev --prefer-dist --no-scripts -q -o
    echo "Composer dependencies have been installed"
@endtask

@task('dump')
    composer dump-autoload
    php artisan config:clear
    php artisan view:clear
    php artisan cache:clear
    php artisan clear-compiled
@endtask

{{-- Migrate all databases --}}
@task('migrate', ['on' => 'web'])
    echo "Migrating database..."
    php artisan migrate --force
    echo "Migration complete."
@endtask

{{-- Set permissions for various files and directories --}}
@task('chmod')
    sudo -u apache rm -rf storage/framework/sessions/*
    @foreach ($chmods as $dir)
        find {{ $path }}/{{ $dir }} -type d -exec chmod 2775 {} \;
        chmod -R g+w {{ $path }}/{{ $dir }}
        chgrp -R apache {{ $path }}/{{ $dir }}
        echo "Permissions have been set for {{ $path }}/{{ $dir }}"
    @endforeach
@endtask

@task('laravel-mix', ['on' => 'web', 'confirm' => false])
    echo "Compiling Assets (Laravel Mix)."
    npm install --scripts-prepend-node-path=auto --no-optional --loglevel=error
    npm install -g
    npm run production
@endtask

{{-- Just a done message :) --}}
@task('done')
    php artisan up
    echo "✓ Your deployment is now complete.";
    php artisan route:clear {{-- See: https://github.com/facade/ignition/issues/202 --}}
@endtask

@error
    echo "An error has occurred in this deployment.";
@enderror
