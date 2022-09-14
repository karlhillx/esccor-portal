@extends('layouts.app')

@section('content')
    <h3 class="mt-2">Help</h3>

    <div id="content">
        <div class=" card card-ext col-8">
            <div class="card-body">

                <h4><strong>Search</strong></h4>
                <p>At the top of each page, you will find a search bar with three radio buttons:</p>
                <ul>
                    <li>A "begin" search will only find content that contains a term that begins with your search
                        criteria
                    </li>
                    <li>An "exact" search will only find content that contains exactly what you type and nothing else
                    </li>
                    <li> A "full" search will find content that contains any term with your search criteria anywhere in
                        the text
                    </li>
                </ul>
                <p>
                    The search results can be sorted by title or publication date. Clicking the URL or the link symbol
                    on the right takes you to the content page itself. Clicking the eye symbol takes you to the detailed
                    cataloging record in ESCCOR for that piece of content. From there, you can click a term that appears
                    as a hyperlink to get a list of all the other pieces of content registered in ESCCOR that also
                    contain that term.
                </p>
                <hr class="mt-2 mb-4">
                <h4><strong>Indexing Requests</strong></h4>
                <p>If you would like the ESCCOR team to register a piece of communications web content that isn't
                    currently in the database, you can submit the "Indexing Request" form, reachable via the button on
                    the left of each page, to request that we add it. Please note that we only index content created and
                    distributed for consumption by the public on NASA domain websites, related to the Earth Sciences and
                    serving an educational or informative purpose.
                </p>

            </div>
        </div>
    </div>
@endsection
