@extends('layouts.app')

@section('content')
    <h3 class="mt-2">Browse by Domain</h3>

    <div id="content">
        <div class="card card-ext col-4">
            <div class="card-body">
                {!! Form::open(['route' => 'browse.domain', 'method' => 'post']) !!}
                <div class="form-group row">
                    <label for="domainq">Domain</label>
                    <select id="domainq" name="domainq" class="custom-select">
                        <option>Please make a selection</option>
                        @foreach($domains as $index => $item)
                            <option value="{{ $index }}"
                                    @if ($index === request('domainq'))
                                    selected="selected"
                                @endif
                            >{{ $index }}</option>
                        @endforeach
                    </select>
                    <small id="emailHelp" class="form-text text-muted">Please choose a domain name.</small>
                </div>
                <div class="row">
                    <button class="btn btn-small btn-outline-primary">Submit</button>
                </div>
                <input type="hidden" id="daterange" name="daterange" value="01/01/2018 - 01/15/2018"/>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <div class="card card-ext col-12 mt-4">
        <div class="card-body">

            <div class="table-responsive">
                <table id="datatable-eo" class="table table-bordered table-hover table-striped table-sm"
                       style="width:100%">
                    <thead>
                    <tr>
                        <th>Title</th>
                        <th>URL</th>
                        <th class="text-right">Published</th>
                        <th class="text-center">&nbsp;</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach ($domain as $d)
                        <tr>
                            <td><div href="{{ $d['url'] }}" data-toggle="tooltip" data-html="true"
                                   title="{{ $d['abstract'] }}">{{ formatTitle($d['title']) }}</div></td>
                            <td><a href="{{ $d['url'] }}" target="_blank">{{ $d['url'] }}</a></td>
                            <td class="text-right">{{ $d['published']->formatLocalized('%Y-%m-%d') }}</td>
                            <td style="width:60px;" class="text-md-center">
                                <div class="btn-group ml-auto">
                                    @php
                                        $uri = urlencode($d['id']);
                                    @endphp
                                    <a href="{{ url('detail', ['uri' => $uri]) }}" data-toggle="tooltip"
                                       data-placement="top"
                                       title="View Detail" class="btn btn-sm btn-light"><i class="far fa-eye"></i></a>
                                    <a href="{{ $d['url'] }}" data-toggle="tooltip" data-placement="top"
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
@endsection
@section('scripts')
    @include('layouts.partials.datatables-js')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#datatable-eo').DataTable({
                dom: '<"top"f>lt<"bottom"B>pir,<"Export Options:">',
                buttons: [
                    {
                        extend: 'copyHtml5',
                        text: 'Copy to clipboard'
                    },
                    {
                        extend: 'csvHtml5',
                        text: 'Export to CSV',
                        exportOptions: {
                            columns: [0, 1, 2]
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        text: 'Export to Excel',
                        exportOptions: {
                            columns: [0, 1, 2]
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        text: 'Export to PDF'
                    },
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: [0, 1, 2]
                        }
                    }
                ],
                order: [[2, "desc"]],
                pageLength: 50,
                autoWidth: false,
                columns: [
                    {width: '50%'},
                    {width: '50%'},
                    {type: "date", width: '70px'},
                    {orderable: false, width: '55px'}
                ],
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@endsection
