<!--Modal create-->
<div class="modal fade" id="modalCreate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Nuevo empleado</h4>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true"></span></button>
            </div>

            <div class="modal-body">
                <form method="POST" action="{{ route('empleados.store') }}">
                    @csrf
                    <!-- Numero de Colaborador -->
                    <div class="mb-3">
                        <label class="form-label" for="basic-icon-default-fullname">Numero de
                            Colaborador</label>
                        <div class="input-group input-group-merge">
                            <span id="basic-icon-default-fullname2" class="input-group-text">
                                <i class='bx bxl-slack-old'></i>
                            </span>

                            <x-text-input id="no_empleado" class="form-control" type="number"
                                name="no_empleado" placeholder="03001234" :value="old('no_empleado')" required
                                autocomplete="no_empleado" />
                        </div>
                        <x-input-error :messages="$errors->get('no_empleado')" class="mt-2" />
                    </div>

                    <!-- Nombre -->
                    <div class="mb-3">
                        <x-input-label class="form-label" for="name" :value="__('Nombre completo')" />
                        <div class="input-group input-group-merge">
                            <span id="basic-icon-default-fullname2" class="input-group-text">
                                <i class='bx bx-user'></i>
                            </span>
                            <x-text-input id="name" class="form-control" type="text"
                                name="name" placeholder="Katrina Jones" :value="old('name')" required
                                autocomplete="name" />
                        </div>
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Email Address -->
                    <div class="mb-3">
                        <x-input-label class="form-label" for="email" :value="__('Email')" />
                        <div class="input-group input-group-merge">
                            <span id="basic-icon-default-fullname2" class="input-group-text">
                                <i class='bx bx-envelope'></i>
                            </span>
                            <x-text-input id="email" class="form-control" type="email"
                                name="email" placeholder="correo@ejemplo.com" :value="old('email')"
                                required autocomplete="email" />
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Puesto -->
                    <div class="mb-3">
                        <label class="form-label" for="basic-icon-default-fullname">Puesto</label>
                        <div class="input-group input-group-merge">
                            <span id="basic-icon-default-fullname2" class="input-group-text">
                                <i class='bx bxs-id-card'></i>
                            </span>
                            <x-text-input id="puesto" class="form-control" type="text"
                                name="puesto" placeholder="Ama de llaves" :value="old('puesto')"
                                required autocomplete="puesto" />
                        </div>
                        <x-input-error :messages="$errors->get('puesto')" class="mt-2" />
                    </div>

                    <!-- Hotel -->
                    <!--div class="mb-3">
                        <label for="exampleFormControlSelect1" class="form-label">Hotel</label>
                        <div class="input-group input-group-merge">
                            <span id="basic-icon-default-fullname2" class="input-group-text">
                                <i class='bx bx-building-house'></i>
                            </span>
                            <select name="hotel_id" class="form-control" id="hotel_id"
                                aria-label="Default select example">
                                <option value="">Selecciona un hotel</option>
                                @foreach ($hoteles as $hotel)
                                    <option value="{{ $hotel->id }}">{{ $hotel->name }}
                                        ({{ $hotel->tipo }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </!--div-->

                    <!-- departamento -->
                    <!--div-- class="mb-3">
                        <label for="exampleFormControlSelect1" class="form-label">Departamento</label>
                        <div class="input-group input-group-merge">
                            <span id="basic-icon-default-fullname2" class="input-group-text">
                                <i class='bx bx-building'></i>
                            </span>
                            <select name="departamento_id" class="form-control" id="departamento_id"
                                aria-label="Default select example" disabled>
                                <option value="">Selecciona un departamento</option>
                            </select>
                        </div>
                    </!--div-->

                    <div class="mb-3">
                        <label for="hotels_id" class="form-label">Hotel</label>
                        <select class="form-control" id="hotels_id" name="hotel_id">
                            <option value="">Seleccione un hotel</option>
                            @foreach($hoteles as $hotel)
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

                    <!-- AD -->
                    <div class="mb-3">
                        <label class="form-label" for="basic-icon-default-fullname">AD</label>
                        <div class="input-group input-group-merge">
                            <span id="basic-icon-default-fullname2" class="input-group-text">
                                <i class='bx bx-at'></i>
                            </span>
                            <x-text-input id="ad" class="form-control" type="text"
                                name="ad" placeholder="jkatrina" :value="old('ad')"
                                required autocomplete="ad" />
                        </div>
                        <x-input-error :messages="$errors->get('ad')" class="mt-2" />
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
            </div>
        </div>
    </div>
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
