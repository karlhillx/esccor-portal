<footer class="bd-footer text-muted">
    <hr>
    <div class="container-fluid pt-3 pb-5 pr-5 pl-5">
        <p class="float-right"><a href="#">Back to top</a></p>
        <ul class="bd-footer-links">
            <li><a class="mr-3" href="{{ route('about') }}">About</a></li>
            <li><a class="mr-3" href="{{ route('contact') }}#other">Contact</a></li>
            <li><a class="mr-3" href="{{ route('help') }}">Help</a></li>
        </ul>
        <p class="mb-0">ESCCOR is supported by NASA's Earth Science Data Systems (<a href="https://earthdata.nasa.gov/"
                                                                                     target="_blank">ESDS</a>) Program.
        </p>
        <p class="mb-0"><a href="https://nasa.gov" target="_blank">National Aeronautics and Space
                Administration.</a>
            <span
                class="esccor-version">Version @php echo \Tremby\LaravelGitVersion\GitVersionHelper::getVersion() @endphp</span>
        </p>
    </div>
</footer>

