<div class="row">
    <div class="col-12 mb-1">
        <div class="form-group">
            <label class="custom-switch">
                <span class="custom-switch-description me-3">Status</span>
                <input type="hidden" name="is_active" value="0">
                <input type="checkbox" name="is_active" class="custom-switch-input" value="1" {{ old('is_active', $user->is_active) ? 'checked' : '' }}>
                <span class="custom-switch-indicator custom-radius"></span>
            </label>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="mb-3">
            <label for="name">Name</label>
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                value="{{ old('name', $user->name) }}" placeholder="Enter user name here" required>
            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email">Email</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                value="{{ old('email', $user->email) }}" placeholder="Enter user email here" required>
            @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="row">
            <div class="col-lg-6 mb-3">
                <label for="password">Password</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                    value="{{ old('password') }}" placeholder="Enter user password here">
                @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="col-lg-6 mb-3">
                <label for="password_confirmation">Confirm Password</label>
                <input id="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation"
                    value="{{ old('password_confirmation') }}" placeholder="Enter confirm password here">
            </div>
        </div>

        <div class="mb-4">
            <label class="mb-2">Role</label>
            <select name="role" class="form-select @error('role') is-invalid @enderror" required>
                <option value="">-Select-</option>
                @foreach ($roles as $role)
                    @php
                        $selectedRole = old('role', $user->roles->first()?->name ?? '');
                    @endphp
                    <option value="{{ $role->name }}"
                        {{ $selectedRole === $role->name ? 'selected' : '' }}>
                        {{ ucwords(str_replace('_', ' ', $role->name)) }}
                    </option>
                @endforeach
            </select>

            @error('role')
                <span class="text-danger d-block mt-1">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

    </div>

    <div class="col-lg-4">
        @if ($user->image)
        <div class="mb-3">
            <label for="">Image</label>
            <img src="{{ $user->image ? asset('storage/' . $user->image) : '' }}" class="avatar-xxl ms-2" alt="">
        </div>
        @endif

        <div>
            <input
                type="file"
                name="image"
                id="image"
                class="dropify"
                data-height="180"
                data-default-file="{{ $user->image ? asset('storage/' . $user->image) : '' }}"
            />
            @error('image')
                <div class="invalid-feedback d-block mt-1">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>

    <div class="col-12">
        <button class="btn btn-success" type="submit">Submit</button>
    </div>
</div>
