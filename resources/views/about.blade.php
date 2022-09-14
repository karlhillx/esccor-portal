@extends('layouts.app')

@section('content')
    <h3 class="mt-2">About</h3>

    <div id="content">

        <div class="card card-ext col-8">
            <div class="card-body">
                <h4><strong>ESCCOR</strong></h4>
                <p>ESCCOR (Earth Science Communications Content Registry) is a project that comprises:</p>

                <ul>
                    <li>A taxonomy of Earth Science terms based on GCMD and adapted for communications content</li>
                    <li>A set of ontological relationships that allow the cross-referencing of content across the Earth
                        Science Division
                    </li>
                    <li>An automatic indexing tool that pulls in new content based on the ESCCOR collection policy and
                        applies metadata from the taxonomy
                    </li>
                    <li>A searchable and browsable catalog of indexed content</li>
                    <li>A user-facing portal and dashboard that offer access to ESCCOR data in several convenient ways
                    </li>
                </ul>
                <hr class="mt-2 mb-4">
                <h4><strong>Mission Statement</strong></h4>
                <p>ESCCOR's primary mission is to curate, register, and associate web content across the agency for
                    internal use by NASA and NASA-affiliated employees. It provides a centralized catalog that
                    applies and
                    leverages controlled metadata to enable robust federated searching, cross-departmental browsing,
                    and
                    in-depth reporting for all Earth science communications content published by NASA.</p>
                <div class="mt-4">
                    <p>ESCCOR empowers the Earth Sciences Division (ESD) communications and outreach community to better
                        report
                        its work to upper management, better identify and access the breadth of products it creates, and
                        better
                        communicate across teams for more effective collaboration. It is also available to other groups
                        outside
                        the ESD at NASA who may benefit from the services it provides.</p>
                </div>
                <hr class="mt-2 mb-2">
                <div class="mt-4">
                    <h4><strong>Meet Your Librarian</strong></h4>
                    <img src="{{ asset('img/mfitzgerald.jpg') }}" width="25%" alt="" class="mb-4 img-person">
                    <h3>Meghan Fitzgerald</h3>
                    <address>
                        <strong>Librarian/Taxonomist | Earth Science Division</strong><br>
                        SSAI @ NASA Goddard Space Flight Center<br>
                        Office: 301-614-5894 | Cell: 678-613-8072<br>
                        <strong><a
                                href="mailto:meghan.fitzgerald@nasa.gov">meghan.fitzgerald@nasa.gov</a></strong>
                    </address>
                </div>
            </div>
        </div>
    </div>
@endsection
