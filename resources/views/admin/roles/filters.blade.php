<form action="{{ route('admin.roles.index') }}" method="GET" class="mb-2" id="filtersForm">
    <div class="d-flex align-items-center justify-content-end" style="gap: 5px">

        <input type="search" name="search" class="form-control auto-submit" style="width: 260px;"
            placeholder="Search by title" value="{{ request('search') }}">

        <button class="btn btn-outline-info" type="submit">Filter</button>
        @if (request('type') || request('search') || request('is_active') !== null || request('trashed') !== null)
            <a class="btn btn-outline-danger" href="{{ route('admin.roles.index') }}">Clear</a>
        @endif

    </div>
</form>
