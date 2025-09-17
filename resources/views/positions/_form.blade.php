<!-- Form de creacion y edicion -->
{{-- Región (solo visible para administradores) --}}
@role('Administrator')
    <div class="mb-3">
        <x-input-label class="form-label" for="region_id" :value="__('REGION')" />
        <select class="form-control" id="region_id" name="region_id">
            <option value="">Choose a region</option>
            @foreach ($regions as $region)
                <option value="{{ $region->id }}"
                    {{ old('region_id', $position->region_id ?? '') == $region->id ? 'selected' : '' }}>
                    {{ $region->name }}
                </option>
            @endforeach
        </select>
        <x-input-error :messages="$errors->get('region_id')" class="mt-2" />
    </div>
@else
    @if ($userRegions->count() > 1)
        <!-- Si el usuario tiene múltiples regiones, muestra un campo de selección -->
        <div class="mb-3">

            <x-input-label class="form-label" for="region_id" :value="__('REGION')" />
            <select name="region_id" id="region_id" class="form-control">
                @foreach ($userRegions as $region)
                    <option value="{{ $region->id }}"
                        {{ old('region_id', $position->region_id ?? '') == $region->id ? 'selected' : '' }}>
                        {{ $region->name }}
                    </option>
                @endforeach
            </select>
        </div>
    @else
        <!-- Si el usuario tiene solo una región, asigna automáticamente esa región -->
        <input type="hidden" name="region_id" value="{{ $userRegions->first()->id }}">
    @endif
@endrole

<!-- Company -->
@if ($userRegions->first()->id == 1)
    <div class="mb-3">
        <x-input-label class="form-label" for="company_id" :value="__('Company')" />
        <select class="form-control" id="company_id" name="company_id">
            <option value="">Choose a company</option>
            @foreach ($companies as $company)
                <option value="{{ $company->id }}"
                    {{ old('company_id', $position->company_id ?? '') == $company->id ? 'selected' : '' }}>
                    {{ $company->name }}
                </option>
            @endforeach
        </select>
        <x-input-error :messages="$errors->get('company_id')" class="mt-2" />
    </div>
@endif

<!-- Email Address -->
<div class="mb-3">
    <x-input-label class="form-label" for="email" :value="__('Email')" />
    <div class="input-group input-group-merge">
        <span id="basic-icon-default-fullname2" class="input-group-text">
            <i class='bx bx-envelope'></i>
        </span>
        <x-text-input id="email" class="form-control" type="email" name="email"
            placeholder="correo@ejemplo.com" :value="old('email', $position->email ?? '')" required
            autocomplete="email" />
    </div>
    <x-input-error :messages="$errors->get('email')" class="mt-2" />
</div>

<!-- Puesto -->
<div class="mb-3">
    <x-input-label class="form-label" for="position" :value="__('JOB POSITION')" />
    <div class="input-group input-group-merge">
        <span id="basic-icon-default-fullname2" class="input-group-text">
            <i class='bx bxs-id-card'></i>
        </span>
        <x-text-input id="position" class="form-control" type="text" name="position"
            placeholder="Ama de llaves" :value="old('position', $position->position ?? '')" required
            autocomplete="position" />
    </div>
    <x-input-error :messages="$errors->get('position')" class="mt-2" />
</div>

<!-- Hotel -->
<div class="mb-3">
    <x-input-label class="form-label" for="hotel_id" :value="__('HOTEL')" />
    <select class="form-control" id="hotels_id" name="hotel_id">
        <option value="">Choose a hotel</option>
        @foreach ($hoteles as $hotel)
            <option value="{{ $hotel->id }}"
                {{ old('hotel_id', $position->hotel_id ?? '') == $hotel->id ? 'selected' : '' }}>
                {{ $hotel->name }}
            </option>
        @endforeach
    </select>
    <x-input-error :messages="$errors->get('hotel_id')" class="mt-2" />
</div>

<!-- department -->
<div class="mb-3">
    <x-input-label class="form-label" for="department_id" :value="__('DEPARTMENTS')" />
    <select class="form-control" id="department_id" name="department_id"
        data-selected="{{ old('department_id', $position->department_id ?? '') }}"
        @if(!old('hotel_id', $position->hotel_id ?? null)) disabled @endif>
        <option value="">First select a hotel</option>
    </select>
    <x-input-error :messages="$errors->get('department_id')" class="mt-2" />
</div>

<!-- AD -->
<div class="mb-3">
    <x-input-label class="form-label" for="ad" :value="__('AD')" />
    <div class="input-group input-group-merge">
        <span id="basic-icon-default-fullname2" class="input-group-text">
            <i class='bx bx-at'></i>
        </span>
        <x-text-input id="ad" class="form-control" type="text" name="ad"
            placeholder="jkatrina" :value="old('ad', $position->ad ?? '')" required />
    </div>
    <x-input-error :messages="$errors->get('ad')" class="mt-2" />
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(function() {
        var $hotelSelect = $('#hotels_id');
        var $departmentSelect = $('#department_id');
        var preselectedDepartmentId = String($departmentSelect.data('selected') || '');

        function normalizeList(data) {
            if (Array.isArray(data)) return data;
            if (data && Array.isArray(data.departments)) return data.departments;
            if (data && Array.isArray(data.data)) return data.data;
            return [];
        }

        function loadDepartments(hotelId, selectedId) {
            if (!hotelId) return;

            var preserved = String($departmentSelect.val() || '');
            $departmentSelect.prop('disabled', true)
                .empty()
                .append('<option value="">Loading...</option>');

            $.ajax({
                url: '/get-departamentos',
                type: 'GET',
                dataType: 'json',
                data: { hotel_id: hotelId }
            })
            .done(function(data) {
                var list = normalizeList(data);
                $departmentSelect.empty()
                    .append('<option value="">Choose a department</option>');

                $.each(list, function(_, d) {
                    $departmentSelect.append('<option value="' + d.id + '">' + d.name + '</option>');
                });

                var toSelect = selectedId ? String(selectedId) : (preserved ? String(preserved) : '');
                if (toSelect && $departmentSelect.find('option[value="' + toSelect + '"]').length) {
                    $departmentSelect.val(toSelect);
                }

                $departmentSelect.prop('disabled', false);
            })
            .fail(function() {
                $departmentSelect.empty()
                    .append('<option value="">Error loading departments</option>')
                    .prop('disabled', false);
            });
        }

        var initialHotelId = $hotelSelect.val();
        if (initialHotelId) {
            loadDepartments(initialHotelId, preselectedDepartmentId);
        } else {
            $departmentSelect.prop('disabled', true)
                .empty()
                .append('<option value="">First select a hotel</option>');
        }

        $hotelSelect.on('change', function() {
            var hotelId = $(this).val();
            if (hotelId) {
                loadDepartments(hotelId, '');
            } else {
                $departmentSelect.prop('disabled', true)
                    .empty()
                    .append('<option value="">First select a hotel</option>');
            }
        });
    });
</script>