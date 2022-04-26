@extends("layouts.panel")
@section("header")
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
@endsection
@section("page-title")
    @include("panel.partials.page-title",["pageTitle"=>"roles"])
@endsection
@section("content")
    <div class="container">
        <div class="row">
            @include("panel.partials.errors")
            @include("panel.partials.notifications")
        </div>
        <div class="row">
            <div class="col pt-3">
                <table class="table table-responsive mt-3 text-center" id="example">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">role</th>
                            <th scope="col">display name</th>
                            <th scope="col">actions</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section("footer")
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <script>
        $('#example').DataTable( {
            "processing": true,
            "serverSide": true,
            "ajax": "{{ route("admin.roles.index") }}",
            "columns":[
                {"data":"id"},
                {"data":"name"},
                {"data":"display_name"},
            ]
        } );
    </script>
@endsection
