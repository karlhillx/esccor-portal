@extends('layouts.app')

@section('content')

    <h3 class="mt-2">Related Entries <span class="text-muted">({{ ucfirst(request('label')) }})</span></h3>

    <p class="text-90 leading-tight mb-8"></p>

    <!-- Content -->
    <div id="content">
        <div class="card card-ext col-12">
            <div class="card-body">

                <div class="table-responsive">
                    <table id="datatable-eo" class="table table-bordered table-hover table-striped table-sm"
                           style="width:100%">
                        <thead>
                        <tr>
                            <th>Title</th>
                            <th>URI</th>
                            <th class="text-right">Published</th>
                            <th class="text-center">&nbsp;</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($data as $d)
                            <tr>
                                <td><div href="{{ $d['url'] }}" data-toggle="tooltip" data-html="true"
                                       title="{{ $d['abstract'] }}">{{ formatTitle($d['title']) }}</div></td>
                                <td><a href="{{ $d['url'] }}" target="_blank">{{ $d['url'] }}</a>
                                </td>
                                <td class="text-right">{{ $d['published']->formatLocalized('%Y-%m-%d') }}</td>
                                <td width="60" class="text-md-center">
                                    <div class="btn-group ml-auto">
                                        @php
                                            $uri = urlencode($d['id']);
                                        @endphp
                                        <a href="{{ url('detail', ['uri' => $uri]) }}" data-toggle="tooltip"
                                           data-placement="top"
                                           title="View Detail" class="btn btn-sm btn-light"><i
                                                class="far fa-eye"></i></a>
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
