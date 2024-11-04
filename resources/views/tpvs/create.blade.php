<!-- Toggle Between Modals -->
<div class="col-lg-4 col-md-6">
    <form method="POST" action="{{ route('tpvs.store') }}">
        @csrf
        <div class="mt-3">
            <!-- Modal 1-->
            <div class="modal fade" id="modalToggle" aria-labelledby="modalToggleLabel" tabindex="-1" style="display: none" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalToggleLabel">Registro de Nuevo Tpv</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Area -->
                            <div class="mb-3">
                                <x-input-label class="form-label" for="area" :value="__('Area')" />
                                <div class="input-group input-group-merge">
                                    <x-text-input id="area" class="form-control" type="text"
                                        name="area" placeholder="Cocina caliente" :value="old('area')" required
                                        autocomplete="area" />
                                </div>
                                <x-input-error :messages="$errors->get('area')" class="mt-2" />
                            </div>

                            <div class="mb-3">
                                <label for="hotels_id" class="form-label">Hotel</label>
                                <select class="form-control" id="hotels_id" name="hotel_id">
                                    <option value="">Seleccione un hotel</option>
                                    @foreach($hotels as $hotel)
                                        <option value="{{ $hotel->id }}">{{ $hotel->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="departamentos_id" class="form-label">Departamento</label>
                                <select class="form-control" id="departamentos_id" name="departamento_id" disabled>
                                    <option value="">Primero seleccione un hotel</option>
                                </select>
                            </div>

                            <!-- Equipo -->
                            <div class="mb-3">
                                <x-input-label class="form-label" for="equipment" :value="__('Equipo')" />
                                <div class="input-group input-group-merge">
                                    <x-text-input id="equipment" class="form-control" type="text"
                                        name="equipment" placeholder="AIO" :value="old('equipment')" required
                                        autocomplete="equipment" />
                                </div>
                                <x-input-error :messages="$errors->get('equipment')" class="mt-2" />
                            </div>

                            <!-- Marca -->
                            <div class="mb-3">
                                <x-input-label class="form-label" for="brand" :value="__('Marca')" />
                                <div class="input-group input-group-merge">
                                    <x-text-input id="brand" class="form-control" type="text"
                                        name="brand" placeholder="ELO TOUCH" :value="old('brand')" required
                                        autocomplete="brand" />
                                </div>
                                <x-input-error :messages="$errors->get('brand')" class="mt-2" />
                            </div>

                            <!-- Modelo -->
                            <div class="mb-3">
                                <x-input-label class="form-label" for="model" :value="__('Modelo')" />
                                <div class="input-group input-group-merge"> 
                                    <x-text-input id="model" class="form-control" type="text"
                                        name="model" placeholder="15E2-E" :value="old('model')" required
                                        autocomplete="model" />
                                </div>
                                <x-input-error :messages="$errors->get('model')" class="mt-2" />
                            </div>

                            <!-- Numero de serie -->
                            <div class="mb-3">
                                <x-input-label class="form-label" for="no_serial" :value="__('Numero de serie')" />
                                <div class="input-group input-group-merge">
                                    <x-text-input id="no_serial" class="form-control" type="text"
                                        name="no_serial" placeholder="L45EFGFF783" :value="old('no_serial')" required
                                        autocomplete="no_serial" />
                                </div>
                                <x-input-error :messages="$errors->get('no_serial')" class="mt-2" />
                            </div>

                            <!-- Nombre -->
                            <div class="mb-3">
                                <x-input-label class="form-label" for="name" :value="__('Nombre')" />
                                <div class="input-group input-group-merge">
                                    <x-text-input id="name" class="form-control" type="text"
                                        name="name" placeholder="RESTPV001" :value="old('name')" required
                                        autocomplete="name" />
                                </div>
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>

                            <!-- IP -->
                            <div class="mb-3">
                                <x-input-label class="form-label" for="ip" :value="__('IP')" />
                                <div class="input-group input-group-merge">
                                    <x-text-input id="ip" class="form-control" type="text"
                                        name="ip" placeholder="10.1.22.34" :value="old('ip')" required
                                        autocomplete="ip" />
                                </div>
                                <x-input-error :messages="$errors->get('ip')" class="mt-2" />
                            </div>

                            <!-- Link -->
                            <div class="mb-3">
                                <x-input-label class="form-label" for="link" :value="__('Link')" />
                                <div class="input-group input-group-merge">
                                    <x-text-input id="link" class="form-control" type="text"
                                        name="link" placeholder="https://tpvbp.grupo-pinero.com/" :value="old('link')" required
                                        autocomplete="link" />
                                </div>
                                <x-input-error :messages="$errors->get('link')" class="mt-2" />
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Guardar</button>
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
            var departamentoSelect = $('#departamentos_id');
            
            if (hotelId) {
                // Habilitar el select de departamentos
                departamentoSelect.prop('disabled', false);
                
                // Realizar la petición AJAX
                $.ajax({
                    url: '/get-departamentos',
                    type: 'GET',
                    data: { hotel_id: hotelId },
                    success: function(data) {
                        departamentoSelect.empty();
                        departamentoSelect.append('<option value="">Seleccione un departamento</option>');
                        
                        $.each(data, function(index, departamento) {
                            departamentoSelect.append('<option value="' + departamento.id + '">' + departamento.name + '</option>');
                        });
                    }
                });
            } else {
                // Si no hay hotel seleccionado, deshabilitar y limpiar el select de departamentos
                departamentoSelect.prop('disabled', true);
                departamentoSelect.empty();
                departamentoSelect.append('<option value="">Primero seleccione un hotel</option>');
            }
        });
    });
</script>
