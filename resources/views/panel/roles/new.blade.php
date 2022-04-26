@extends("layouts.panel")
@section("page-title")
    @include("panel.partials.page-title",["pageTitle"=>"Permissions"])
@endsection
@section("content")
    <div class="container">
        <div class="row">
            <div class="col">
                @include("panel.partials.errors")
                @include("panel.partials.notifications")
                <form action="{{ route("admin.roles.store") }}" method="post">
                    @csrf
                    <div class="card mt-3">
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="permission_name" class="form-label">role name</label>
                                <input type="text" class="form-control" name="name" id="permission_name" placeholder="permission name">
                            </div>
                            <div class="mb-3">
                                <label for="display_name" class="form-label">display name</label>
                                <input type="text" class="form-control" name="display_name" id="display_name" placeholder="display name">
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-outline-primary">save</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
