@extends('layouts.app')

@section('content')
    <h3 class="mt-2">
        @php
            if(!empty($data))
               echo $title;
        @endphp
    </h3>

    <div id="content">
        <div class="card card-ext col-12">
            <div class="card-body">
                <div class="row">
                    <table class="table table-light table-striped table-bordered">
                        <tbody>
                        @php
                            foreach ($data as $property)
                            {
                                if(ucwords($property['propName']) !== 'Source Site') {
                                    echo '<tr>';
                                    echo('<td width="200"><strong>'.ucwords($property['propName']).'</strong></td>');
                                    echo '<td>';
                                    foreach($property['propValues'] as $value)
                                    {
                                        $type =  basename($property['propID']);

                                        if (filter_var($value['display'], FILTER_VALIDATE_URL) && (($type === 'model#originalURL') || ($type === 'model#originalURLTitle')) ) {
                                            echo('<a href="'.$value['display'].'" target="_blank"><i class="fas fa-external-link-alt"></i> '.$value['display'].'</a>');
                                        } elseif (!empty($value['uri'])) {
                                            echo('<a href="/display?label='.urlencode($value['display']).'&type='.urlencode($type).'&uri='.urlencode($value['uri']).'"><i class="far fa-caret-square-right"></i> '.ucfirst($value['display']).'</a>');
                                        } else {
                                            echo(htmlspecialchars_decode($value['display']));
                                        }
                                        echo '<br>';
                                    }
                                    echo '</tr>';
                                }
                            }
                        @endphp
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
@endsection
