<form action="{{ route('admin.cities.index') }}" method="GET" class="mb-2" id="filtersForm">
    <div class="d-flex align-items-center justify-content-end" style="gap: 5px">

        <select name="is_active" class="form-select filterSelect" style="width:150px;">
            <option value="">-Status-</option>
            <option value="1" {{ request('is_active') === '1' ? 'selected' : '' }}>Active</option>
            <option value="0" {{ request('is_active') === '0' ? 'selected' : '' }}>Inactive</option>
        </select>

        <select name="trashed" class="form-select filterSelect" style="width:150px;">
            <option value="">-Records-</option>
            <option value="0" {{ request('trashed') === '0' ? 'selected' : '' }}>With Trashed</option>
            <option value="1" {{ request('trashed') === '1' ? 'selected' : '' }}>Only Trashed</option>
        </select>

        <input type="search" name="search" class="form-control auto-submit" style="width: 260px;"
            placeholder="Search by city, state or country" value="{{ request('search') }}">

        <button class="btn btn-outline-info" type="submit">Filter</button>
        @if (request('type') || request('search') || request('is_active') !== null || request('trashed') !== null)
            <a class="btn btn-outline-danger" href="{{ route('admin.cities.index') }}">Clear</a>
        @endif

    </div>
</form>
