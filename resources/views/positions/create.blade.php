<!--Modal create-->
<div class="col-lg-4 col-md-6">
    <form method="POST" action="{{ route('positions.store') }}">
        @csrf
        <div class="mt-3">
            <div class="modal fade" id="modalCreate" aria-labelledby="modalCreate" tabindex="-1" style="display: none"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="modalCreate">New position</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true"></span></button>
                        </div>

                        <div class="modal-body">
                            <!-- Region -->
                            {{-- Región (solo visible para administradores) --}}
                            @role('Administrator')
                                <div class="mb-3">
                                    <x-input-label class="form-label" for="region_id" :value="__('REGION')" />
                                    <select class="form-control" id="region_id" name="region_id" required>
                                        <option value="">Choose a region</option>
                                        @foreach ($regions as $region)
                                            <option value="{{ $region->id }}"
                                                {{ old('region_id') == $region->id ? 'selected' : '' }}>
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
                                        <select name="region_id" id="region_id" class="form-control" required>
                                            @foreach ($userRegions as $region)
                                                <option value="{{ $region->id }}">{{ $region->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @else
                                    <!-- Si el usuario tiene solo una región, asigna automáticamente esa región -->
                                    <input type="hidden" name="region_id" value="{{ $userRegions->first()->id }}">
                                @endif
                                @endif

                                <!-- Company -->
                                @if ($userRegions->first()->id == 1)
                                    <div class="mb-3">
                                        <x-input-label class="form-label" for="company_id" :value="__('Company')" />
                                        <select class="form-control" id="company_id" name="company_id">
                                            <option value="">Choose a company</option>
                                            @foreach ($companies as $company)
                                                <option value="{{ $company->id }}"
                                                    {{ old('company_id') == $company->id ? 'selected' : '' }}>
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
                                            placeholder="correo@ejemplo.com" :value="old('email')" required
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
                                            placeholder="Ama de llaves" :value="old('position')" required
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
                                                {{ old('hotel_id') == $hotel->id ? 'selected' : '' }}>
                                                {{ $hotel->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('hotel_id')" class="mt-2" />
                                </div>

                                <!-- department -->
                                <div class="mb-3">
                                    <x-input-label class="form-label" for="department_id" :value="__('DEPARTMENTS')" />
                                    <select class="form-control" id="department_id" name="department_id" disabled>
                                        <option value="">First select a hotel</option>
                                    </select>
                                    <x-input-error :messages="$errors->get('departamento_id')" class="mt-2" />
                                </div>

                                <!-- AD -->
                                <div class="mb-3">
                                    <x-input-label class="form-label" for="ad" :value="__('AD')" />
                                    <div class="input-group input-group-merge">
                                        <span id="basic-icon-default-fullname2" class="input-group-text">
                                            <i class='bx bx-at'></i>
                                        </span>
                                        <x-text-input id="ad" class="form-control" type="text" name="ad"
                                            placeholder="jkatrina" :value="old('ad')" required autocomplete="ad" />
                                    </div>
                                    <x-input-error :messages="$errors->get('ad')" class="mt-2" />
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#hotels_id').change(function() {
                var hotelId = $(this).val();
                var departamentoSelect = $('#department_id');

                if (hotelId) {
                    // Habilitar el select de departamentos
                    departamentoSelect.prop('disabled', false);

                    // Realizar la petición AJAX
                    $.ajax({
                        url: '/get-departamentos',
                        type: 'GET',
                        data: {
                            hotel_id: hotelId
                        },
                        success: function(data) {
                            departamentoSelect.empty();
                            departamentoSelect.append(
                                '<option value="">Choose a department</option>');

                            $.each(data, function(index, departamento) {
                                departamentoSelect.append('<option value="' +
                                    departamento.id + '">' + departamento.name +
                                    '</option>');
                            });
                        }
                    });
                } else {
                    // Si no hay hotel seleccionado, deshabilitar y limpiar el select de departamentos
                    departamentoSelect.prop('disabled', true);
                    departamentoSelect.empty();
                    departamentoSelect.append('<option value="">First select a hotel</option>');
                }
            });
        });
    </script>
