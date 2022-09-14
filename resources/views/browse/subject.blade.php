@extends('layouts.app')
@section('content')
    <h3 class="mt-2">Browse by Subject</h3>
    <div class="card card-ext col-12">
        <div class="card-body">
            <!--<form id="s">
                <label for="q"></label><input type="search" id="q"/>
                <button type="submit">Search</button>
            </form>-->
            <div class="mb-4 mt-4">
                <button name="collapse" class="btn btn-small btn-outline-primary"><i
                        class="fas fa-chevron-circle-up"></i> Collapse
                    All
                </button>
            </div>
            <div id="jsTree" class="jsTree mb-4"></div>
        </div>
    </div>
@endsection
@section('scripts')

    <script type="text/javascript">
        $(function () {
            let component = $("#jsTree");
            let parentId = "";
            let childId = "";
            component.jstree({
                core: {
                    data: {
                        url: function (node) {
                            // Remove string, leave only numbers.
                            childId = childId.replace('itm:n#_', '');
                            parentId = parentId.replace('itm:n#_', '');
                            console.log("Child: " + encodeURI(childId));
                            console.log("Parent: " + encodeURI(parentId));

                            return node.id === '#' ?
                                "/getParents" :
                                "/getChildren/" + childId + '/' + parentId;
                        },
                    },
                    dataType: "json",
                    multiple: false,
                    plugins: ["sort", "types", "state", "unique"],
                    themes: {
                        dots: false,
                    },
                },
           /*.bind("select_node.jstree", function (e, data) {
                if (childId) {
                    document.location.href = 'detail/' + encodeURI(childId);
                }*/
            });

            // Single click to open children instead of double-clicking.
            component.on('click', '.jstree-anchor', function () {
                component.jstree(true).open_node(this);
            });

            // Fires when selection on the tree changes.
            component.on('activate_node.jstree', function (e, data) {
                childId = data.node.id;
                parentId = data.instance.get_node(data.node.parent).id;
            });

            // When collapse button is selected, collapse all nodes and refresh tree.
            $("button").on("click", function () {
                component.jstree("close_all");
                component.jstree(true).refresh();
            });

            // Customize icons for closed and open states.
            /*(component.on('open_node.jstree', function (e, data) {
                data.instance.set_icon(data.node, "far fa-folder-open");*/
        });
    </script>
@endsection
