@if(session('save'))
    <div class="alert alert-success mt-3">
        operation successfully!
    </div>
@endif
@if(session('delete'))
    <div class="alert alert-danger mt-3">
        operation successfully!
    </div>
@endif
