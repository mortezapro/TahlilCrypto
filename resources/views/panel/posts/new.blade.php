@include("panel.partials.errors")
@include("panel.partials.notifications")
<form action="{{ route("admin.posts.store",["post"=>"a1"]) }}" method="post">
    @csrf
    <input type="text" value="" name="title">
    <input type="text" value="" name="content">
    <input type="text" value="" name="slug">
    <input type="submit" value="submit">
</form>
