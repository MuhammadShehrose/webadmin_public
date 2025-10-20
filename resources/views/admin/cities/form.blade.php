<div class="row">
    <div class="col-12 mb-1">
        <div class="form-group">
            <label class="custom-switch">
                <span class="custom-switch-description me-3">Status</span>
                <input type="hidden" name="is_active" value="0">
                <input type="checkbox" name="is_active" class="custom-switch-input" value="1"
                    {{ old('is_active', $city->is_active) ? 'checked' : '' }}>
                <span class="custom-switch-indicator custom-radius"></span>
            </label>
        </div>
    </div>
    <div class="col-lg-6 mb-3">
        <label for="country">Country</label>
        <select name="country_id" id="country_id" class="form-control select2" required>
            <option value="">-Select Country-</option>
            @foreach ($countries as $country)
                <option value="{{ $country->id }}"
                    {{ old('country_id', $city->state?->country_id) == $country->id ? 'selected' : '' }}>
                    {{ $country->title }}
                </option>
            @endforeach
        </select>
        @error('country_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-lg-6 mb-3">
        <label for="state">State</label>
        <select name="state_id" id="state_id" class="form-control select2" required>
            <option value="">-Select State-</option>
            @foreach ($states as $state)
                <option value="{{ $state->id }}"
                    {{ old('state_id', $city->state_id) == $state->id ? 'selected' : '' }}>
                    {{ $state->title }}
                </option>
            @endforeach
        </select>
        @error('state_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-12 mb-3">
        <label for="title">Title</label>
        <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title"
            value="{{ old('title', $city->title) }}" placeholder="Enter city title here" required>
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

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#country_id').on('change', function() {
                let countryId = $(this).val();
                let stateSelect = $('#state_id');

                stateSelect.empty().append('<option value="">-Select State-</option>');

                if (countryId) {
                    $.ajax({
                        url: "{{ route('admin.states.byCountry', ':id') }}".replace(':id', countryId),
                        type: "GET",
                        success: function(states) {
                            $.each(states, function(key, state) {
                                stateSelect.append('<option value="' + state.id + '">' +
                                    state.title + '</option>');
                            });
                        }
                    });
                }
            });
        });
    </script>
    @if ($city->exists && $city->state?->country_id)
        <script>
            $(document).ready(function() {
                $('#country_id').trigger('change');

                // Wait a bit for AJAX to load then select the correct state
                setTimeout(() => {
                    $('#state_id').val('{{ $city->state_id }}').trigger('change');
                }, 500);
            });
        </script>
    @endif
@endsection
