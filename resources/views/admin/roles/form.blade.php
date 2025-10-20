<div class="row">
    <div class="col-lg-6 mb-5">
        <label for="group" class="form-label fw-semibold">Group</label>
        <select name="group" id="group" class="form-select @error('group') is-invalid @enderror">
            <option value="">-Select-</option>
            @foreach ($roleGroups as $key => $roleGroup)
                <option value="{{$key}}" {{ old('group', $role->group) == $key ? 'selected' : '' }}>{{ ucfirst($roleGroup) }}</option>
            @endforeach
        </select>
        @error('group')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div class="col-lg-6 mb-5">
        <label for="name" class="form-label fw-semibold">Name</label>
        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
            value="{{ old('name', $role->name) }}" placeholder="Enter role name here" required>
        @error('name')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div class="col-12 mb-3">
        <h4 class="mb-0">Permissions</h4>
        <small class="text-muted">Select permissions for this role</small>
    </div>

    @foreach ($groupedPermissions as $group => $permissions)
        <div class="col-12 mb-3">
            <div class="border rounded-3 p-3 bg-light">
                <div class="form-check mb-3 pb-2 border-bottom">
                    <input type="checkbox" class="form-check-input select-all-group" data-group="{{ $group }}"
                        id="selectAll{{ $group }}">
                    <label class="form-check-label" for="selectAll{{ $group }}">
                        <strong class="text-capitalize fs-6">{{ $group }}</strong>
                        <small class="text-muted ms-2">(Select All)</small>
                    </label>
                </div>
                <div class="row g-3">
                    @foreach ($permissions as $permission)
                        <div class="col-md-6 col-lg-4 col-xl-3">
                            <div class="form-check">
                                <input type="checkbox" name="permissions[]" class="form-check-input perm-{{ $group }}"
                                    id="perm-{{ $permission->id }}" value="{{ $permission->name }}"
                                    {{ isset($role) && $role->permissions->pluck('name')->contains($permission->name) ? 'checked' : '' }}>
                                <label class="form-check-label" for="perm-{{ $permission->id }}">
                                    {{ ucwords(str_replace('_', ' ', explode('.', $permission->name)[1] ?? $permission->name)) }}
                                </label>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endforeach

    <div class="col-12 mt-3">
        <button class="btn btn-success px-4" type="submit">
            <i class="bi bi-check-circle me-1"></i> Submit
        </button>
    </div>
</div>

@section('scripts')
    <script>
        document.querySelectorAll('.select-all-group').forEach(selectAll => {
            selectAll.addEventListener('change', function () {
                const group = this.getAttribute('data-group');
                const checkboxes = document.querySelectorAll('.perm-' + group);
                checkboxes.forEach(cb => cb.checked = this.checked);
            });
        });

        // Update "Select All" checkbox state when individual permissions change
        document.querySelectorAll('[name="permissions[]"]').forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const group = this.className.match(/perm-(\S+)/)[1];
                const groupCheckboxes = document.querySelectorAll('.perm-' + group);
                const selectAllCheckbox = document.querySelector('[data-group="' + group + '"]');

                const allChecked = Array.from(groupCheckboxes).every(cb => cb.checked);
                const someChecked = Array.from(groupCheckboxes).some(cb => cb.checked);

                selectAllCheckbox.checked = allChecked;
                selectAllCheckbox.indeterminate = someChecked && !allChecked;
            });
        });

        // Initialize indeterminate state on page load
        document.querySelectorAll('.select-all-group').forEach(selectAll => {
            const group = selectAll.getAttribute('data-group');
            const groupCheckboxes = document.querySelectorAll('.perm-' + group);
            const allChecked = Array.from(groupCheckboxes).every(cb => cb.checked);
            const someChecked = Array.from(groupCheckboxes).some(cb => cb.checked);

            selectAll.checked = allChecked;
            selectAll.indeterminate = someChecked && !allChecked;
        });
    </script>
@endsection
