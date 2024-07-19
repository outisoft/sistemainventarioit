<!--Modal create-->
<div class="modal fade" id="modalCreate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">PC/Laptop</h4>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true"></span></button>
            </div>

            <div class="modal-body">
                <form method="POST" action="{{ route('pc.store') }}">
                    @csrf
                    <!-- Tipo -->
                    <div class="mb-3">
                        <label for="exampleFormControlSelect1" class="form-label">Tipo de equipo</label>
                        <div class="input-group input-group-merge">
                            <span id="basic-icon-default-fullname2" class="input-group-text">
                                <i class='bx bx-building-house'></i>
                            </span>
                            <select name="tipo" class="form-control" id="tipo"
                                aria-label="Default select example">
                                    <option value="Pc">PC</option>
                                    <option value="Laptop">Laptop</option>
                            </select>
                        </div>
                    </div>

                    <!-- Marca -->
                    <div class="mb-3">
                        <x-input-label class="form-label" for="marca" :value="__('Marca de equipo')" />
                        <div class="input-group input-group-merge">
                            <x-text-input id="marca" class="form-control" type="text"
                                name="marca" placeholder="HP" :value="old('marca')" required
                                autocomplete="marca" />
                        </div>
                        <x-input-error :messages="$errors->get('marca')" class="mt-2" />
                    </div>

                    <!-- Model -->
                    <div class="mb-3">
                        <x-input-label class="form-label" for="modelo" :value="__('Modelo de equipo')" />
                        <div class="input-group input-group-merge">
                            <x-text-input id="modelo" class="form-control" type="text"
                                name="modelo" placeholder="SmartBook" :value="old('modelo')" required
                                autocomplete="modelo" />
                        </div>
                        <x-input-error :messages="$errors->get('modelo')" class="mt-2" />
                    </div>

                    <!-- Numero de serie -->
                    <div class="mb-3">
                        <x-input-label class="form-label" for="numero_serie" :value="__('Numero de serie')" />
                        <div class="input-group input-group-merge">
                            <x-text-input id="numero_serie" class="form-control" type="text"
                                name="numero_serie" placeholder="R5BDI87D80" :value="old('numero_serie')" required
                                autocomplete="numero_serie" />
                        </div>
                        <x-input-error :messages="$errors->get('numero_serie')" class="mt-2" />
                    </div>
                    
                    <!-- Empleado -->
                    <div class="mb-3">
                        <label for="exampleFormControlSelect1" class="form-label">Empleado</label>
                        <div class="input-group input-group-merge">
                            <span id="basic-icon-default-fullname2" class="input-group-text">
                                <i class='bx bx-building-house'></i>
                            </span>
                            <select name="empleado_id" class="form-control" id="empleado_id"
                                aria-label="Default select example">
                                <option value="">Sin asignar</option>
                                @foreach ($empleados as $empleado)
                                    <option value="{{ $empleado->id }}">{{ $empleado->name }} - ({{ $empleado->hotel->nombre }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <br>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>
