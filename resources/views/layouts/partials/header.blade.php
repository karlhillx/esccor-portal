<!-- navbar -->
<nav class="navbar-top navbar navbar-expand-lg navbar-light bg-white border-bottom pb-2 pt-2">

    <a href="#">
        <i class="fas fa-align-left" id="menu-toggle"></i>
    </a>

    <div class="float-lg-right col-md-10 mt-1 mb-1">
        {!! Form::open(['route' => 'search', 'method' => 'get', 'class' => 'form-inline my-2 my-lg-0']) !!}
        <input class="form-control mr-sm-2 col-4" type="text" name="q" value="{{ request('q') }}" placeholder="Search"
               aria-label="Search" minlength="3" required>
        <button class="btn btn-outline-primary my-2 my-sm-0 mr-5" type="submit">Search</button>

        <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" id="mode1" name="mode" value="begin"
                   class="custom-control-input"{{ (request('mode')==='begin') ? 'checked' : '' }}>
            <label class="custom-control-label" for="mode1">Begin</label>
        </div>
        <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" id="mode2" name="mode" value="exact"
                   class="custom-control-input"{{ (request('mode')==='exact') ? 'checked' : '' }}>
            <label class="custom-control-label" for="mode2">Exact</label>
        </div>
        <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" id="mode3" name="mode" value="full"
                   class="custom-control-input"{{ (request('mode')==='full' || empty(request('mode'))) ? 'checked' : '' }}>
            <label class="custom-control-label" for="mode3">Full</label>
        </div>
        {!! Form::close() !!}
    </div>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            <li class="nav-item dropdown">
            </li>
        </ul>
    </div>
</nav>

