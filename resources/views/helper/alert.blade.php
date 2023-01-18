@if (\Session::has('error'))
    <div class="alert alert-danger alert-dismissible" role="alert">
        <p class="mb-0">
            {!! \Session::get('error') !!}
        </p>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (\Session::has('success'))
    <div class="alert alert-success alert-dismissible" role="alert">
        <p class="mb-0">
            {!! \Session::get('success') !!}
        </p>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
