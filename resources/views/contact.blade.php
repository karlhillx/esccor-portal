@extends('layouts.app')

@section('content')
    <h3 class="mt-2">Contact Us</h3>

    <div id="content">

        <p>Please feel free to send us your questions and comments.</p>
        @include('layouts.partials.errors')
        <div class="row">
            <div class="col-8">
                <div class="card card-ext">
                    <div class="card-body p-xl-5">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a href="#indexing" class="nav-link active" id="indexing-tab" data-toggle="tab"
                                   role="tab"
                                   aria-controls="indexing" aria-selected="false">Content Indexing Request</a>
                            </li>
                            <li class="nav-item">
                                <a href="#other" class="nav-link" id="profile-tab" data-toggle="tab" role="tab"
                                   aria-controls="profile" aria-selected="false">Other Comments/Questions</a>
                            </li>
                        </ul>

                        <div class="tab-content my-5 mx-5" id="myTabContent">
                            <div class="tab-pane fade show active" id="indexing" role="tabpanel"
                                 aria-labelledby="indexing-tab">
                                {!! Form::open(['route' => 'contact']) !!}
                                <div class="form-group">
                                    {!! Form::label('name', 'Full Name (required)') !!}
                                    {!! Form::text('name', old('name'), ['class' => 'form-control col-6', 'required']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('email', 'Email Address (required)') !!}
                                    {!! Form::email('email', old('email'), ['class' => 'form-control col-6', 'required']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('url', 'Content URL (required)') !!}
                                    {!! Form::url('url', old('url'), ['class' => 'form-control', 'required']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('title', 'Content Title (optional)') !!}
                                    {!! Form::text('title', old('title'), ['class' => 'form-control']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('comments', 'Comments/Questions (optional)') !!}
                                    {!! Form::textarea('comments', old('comments'), ['class' => 'form-control']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::submit('Submit', array('class' => 'btn btn-primary')) !!}
                                    <a href="" class="btn btn-secondary">Cancel</a>
                                </div>
                                {!! Form::close() !!}
                            </div>
                            <div class="tab-pane fade" id="other" role="tabpanel" aria-labelledby="other-tab">
                                {!! Form::open(['route' => 'contact']) !!}
                                <div class="form-group">
                                    {!! Form::label('name', 'Full Name (required)') !!}
                                    {!! Form::text('name', old('name'), ['class' => 'form-control col-6', 'required']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('email', 'Email Address (required)') !!}
                                    {!! Form::email('email', old('email'), ['class' => 'form-control col-6', 'required']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('comments', 'Comments/Questions (required)') !!}
                                    {!! Form::textarea('comments', old('comments'), ['class' => 'form-control', 'required']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::submit('Submit', array('class' => 'btn btn-primary')) !!}
                                    <a href="" class="btn btn-secondary">Cancel</a>
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
@section('scripts')
    <script>
        // LINK TO TABS
        $(document).ready(() => {
            var url = window.location.href;
            if (url.indexOf("#") > 0) {
                var activeTab = url.substring(url.indexOf("#") + 1);
                $('.nav[role="tablist"] a[href="#' + activeTab + '"]').tab('show');
            }

            $('a[role="tab"]').on("click", function () {
                var newUrl;
                const hash = $(this).attr("href");
                newUrl = url.split("#")[0] + hash;
                history.replaceState(null, null, newUrl);
            });
        });
    </script>
@endsection
