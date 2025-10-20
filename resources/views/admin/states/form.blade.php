<div class="row">
    <div class="col-12 mb-1">
        <div class="form-group">
            <label class="custom-switch">
                <span class="custom-switch-description me-3">Status</span>
                <input type="hidden" name="is_active" value="0">
                <input type="checkbox" name="is_active" class="custom-switch-input" value="1" {{ old('is_active', $state->is_active) ? 'checked' : '' }}>
                <span class="custom-switch-indicator custom-radius"></span>
            </label>
        </div>
    </div>
    <div class="col-12 mb-3">
        <label for="country">Country</label>
        <select name="country_id" class="form-control select2-show-search select2-hidden-accessible" required>
            <option value="">-Select-</option>
            @foreach ($countries as $country)
                <option value="{{ $country->id }}" {{ old('country_id', $state->country_id) == $country->id ? 'selected' : '' }}>{{ $country->title }}</option>
            @endforeach
        </select>
        @error('country_id')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="col-12 mb-3">
        <label for="title">Title</label>
        <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title"
            value="{{ old('title', $state->title) }}" placeholder="Enter state title here" required>
        @error('title')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="col-12">
        <button class="btn btn-success" type="submit">Submit</button>
    </div>
</div>
