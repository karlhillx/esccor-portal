<div class="bg-grad-sidebar" id="sidebar-wrapperx">
    <a href="/">
        <div class="sidebar-heading text-white">
            <img class="mr-1" src="{{ asset('/img/nasa-logo.png') }}" width="40px" alt="NASA Logo">
            <strong>ESCCOR Portal</strong>
        </div>
    </a>

    <div class="list-group list-group-flush pt-4">
        <a class="list-group-item list-group-item-action text-white sidebar-label"
           href="{{ route('dashboard') }}">
            <i class="fas fa-tachometer-alt pr-2"></i>Dashboard
        </a>
        <a class="list-group-item list-group-item-action text-white sidebar-label"
           href="{{ route('browse.date') }}">
            <i class="fas fa-calendar-alt pr-2"></i>Browse by Date
        </a>
        <a class="list-group-item list-group-item-action text-white sidebar-label"
           href="{{ route('browse.domain') }}">
            <i class="fas fa-globe pr-2"></i>Browse by Domain
        </a>
        <a class="list-group-item list-group-item-action text-white sidebar-label"
           href="{{ route('browse.subject') }}">
            <i class="fas fa-tags pr-2"></i>Browse by Subject
        </a>
        <a class="list-group-item list-group-item-action text-white sidebar-label"
           href="{{ route('contact') }}">
            <i class="fas fa-folder-plus pr-2"></i>Indexing Request
        </a>
        <a class="list-group-item list-group-item-action text-white sidebar-label"
           href="{{ route('rss') }}">
            <i class="fas fa-rss pr-2"></i>RSS Feed
        </a>
    </div>
</div>

