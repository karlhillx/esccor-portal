@extends('layouts.app')

@section('content')

    <div id="content">
        <div class="row">
            <div class="col-lg-6">
                <h3 class="mt-2">Dashboard</h3>
            </div>

            <div class="col-lg-6">
                <a class="btn btn-secondary btn-mini mb-5 mb-lg-2 disabled float-lg-right" href="#"><strong>Last
                        Updated:</strong>
                    <?php echo $updated ?> <i class="fas fa-calendar-alt"></i></a>
            </div>
        </div>

        <p class="text-90 leading-tight mb-8"></p>

        @include('layouts.partials.errors')

        <div id="content">
            <div class="row">
                <div class="col-lg-6">
                    <div class="widget-flat card card-ext">
                        <div class="card-body text-center">
                            <h4 class="mb-0 mt-1 text-dark section-title" title="Metrics">Entries by Publication
                                Date</h4>
                            <div class="" style="width:100%;height:150px;">
                                {!! $lineChart->container() !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="widget-flat card card-ext">
                        <div class="card-body text-center">
                            <h4 class="mb-0 mt-1 text-dark section-title" title="Metrics">TOTAL REGISTRY ENTRIES</h4>
                            <div class="mt-2" style="width:100%;height:90px;font-size:.8rem;">
                                {!! $doughnutChart->container() !!}
                            </div>
                            <h4 class="mt-3 mb-3"><span class="count font-weight-bold">{{ $count }}</span>
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div
                        class="widget-flat card card-ext alert alert-warning alert-dismissible fade show pt-0 pb-0 mt-4 mb-4"
                        role="alert">
                        <div class="card-body">

                            <p class="text-sm-left mt-0 mb-0" style="font-size:13px;"><span
                                    class="fas fa-exclamation-triangle mr-2 text-primary"></span> Please note that this
                                is a
                                beta version of the ESCCOR portal. System response times may be sub-standard.
                            </p>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-7">
                    <div class="widget-flat card card-ext">
                        <div class="d-flex">
                            <div class="flex-fill w-100 card">
                                <div class="card-header">
                                    <div class="align-items-center row">
                                        <div class="col"><h4 class="mb-0 mt-1 header-text">Recent Entries</h4></div>
                                        <div class="text-right col-auto">
                                            <a href="{{ route('rss') }}" class="btn btn-sm btn-outline-warning">
                                                <i class="fas fa-rss"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <table class="my-0 table table-striped">
                                    <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th class="text-right">Published</th>
                                        <th class="text-center">&nbsp;</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($storedContentUnits as $entry)
                                        <tr>
                                            <td class="text-left">
                                                <a data-placement="right"
                                                   data-toggle="tooltip"
                                                   title="{{ $entry['abstract'] }}" class="btn btn-sm btn-light"
                                                   href="{{ url('detail', ['uri' => urlencode($entry['id'])]) }}"
                                                   title="{{ $entry['abstract'] }}">{{ formatTitle($entry['title'], true) }}</a>
                                            </td>
                                            <td class="text-right">{{ $entry['published']->formatLocalized('%Y-%m-%d') }}</td>
                                            <td style="width:60px;" class="text-md-center">
                                                <div class="btn-group ml-auto">
                                                    @php
                                                        $uri = urlencode($entry['id']);
                                                    @endphp
                                                    <a href="{{ url('detail', ['uri' => $uri]) }}" data-toggle="tooltip"
                                                       data-placement="top"
                                                       title="View Detail" class="btn btn-sm btn-light"><i
                                                            class="far fa-eye"></i></a>
                                                    <a href="{{ $entry['url'] }}" data-toggle="tooltip"
                                                       data-placement="top"
                                                       title="Link" class="btn btn-sm btn-light" target="_blank">
                                                        <i class="fas fa-link"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="widget-flat card card-ext">
                        <div class="d-flex">
                            <div class="flex-fill w-100 card">
                                <div class="card-header">
                                    <div class="align-items-center row">
                                        <div class="col"><h4 class="mb-0 mt-1 header-text">Total Entries by Domain</h4>
                                        </div>
                                        <div class="text-right col-auto">
                                            <!--
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input"  id="customSwitch2">
                                                <label class="custom-control-label" for="customSwitch2"></label>
                                            </div>
                                            -->
                                        </div>
                                    </div>
                                </div>

                                <table class="my-0 table table-striped">
                                    <thead>
                                    <tr>
                                        <th>Domain</th>
                                        <th class="text-right">Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($domains as $index => $item)
                                        <tr>
                                            <td><a href="{{ url('browse/domain?domainq='.$index) }}"
                                                   data-toggle="tooltip" class="btn btn-sm btn-light"
                                                   data-placement="right"
                                                   title="{{ $index }}">{{ $index }}</a></td>
                                            <td class="text-right"><span
                                                    class="badge badge-secondary badge-dashboard">{{ $item }}</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    {!! $lineChart->script(); !!}
    {!! $doughnutChart->script(); !!}
    <script>
        $(document).ready(function () {
            // Tooltips
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@endsection
