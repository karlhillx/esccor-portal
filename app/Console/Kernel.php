<?php

namespace App\Console;

use App\Console\Commands\ListSchedule;
use App\Console\Commands\LoadDataFromAPI;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        ListSchedule::class,
        LoadDataFromAPI::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        /*if (app()->environment(['production'])) {
             $schedule->exec('/var/www/html/interpreter/storage/scripts/routine.sh')
                 ->dailyAt('22:00')
                 ->evenInMaintenanceMode()
                 ->timezone('America/New_York')
                 ->emailOutputTo('karl.hill@nasa.gov');

             //$schedule->job(new LoadDataFromAPI())->daily();
             //ProcessPodcast::dispatch($podcast);
             //$schedule->job(new SendVerificationEmail($user))->everyFiveMinutes();
             //$schedule->command('emails:send --force')->daily();
         }*/
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
