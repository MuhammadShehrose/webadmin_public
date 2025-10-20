{{-- Folder Filter --}}
<form method="GET" action="{{ route('admin.media.index') }}">
    <div class="d-flex gap-1 align-items-center">
        <div class="me-2">
            <label for="folder" class="form-label fw-bold mb-0">Filter by Folder:</label>
        </div>
        <div class="">
            <select name="folder" id="folder" class="form-select">
                <option value="">All Folders</option>
                @foreach ($folders as $folder)
                    <option value="{{ $folder }}" {{ request('folder') == $folder ? 'selected' : '' }}>
                        {{ ucfirst($folder) }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="">
            <button class="btn btn-outline-info" type="submit">Filter</button>
            @if (request('folder'))
                <a class="btn btn-outline-danger" href="{{ route('admin.media.index') }}">Clear</a>
            @endif
        </div>
    </div>
</form>
