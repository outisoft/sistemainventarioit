<!-- Toggle Between Modals -->
<div class="col-lg-4 col-md-6">
    <form method="POST" action="{{ route('maintenances.store') }}">
        @csrf
        <div class="mt-3">
            <!-- Modal 1-->
            <div class="modal fade" id="modalToggle" aria-labelledby="modalToggleLabel" tabindex="-1" style="display: none" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalToggleLabel">Nuevo mantenimiento</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <!-- Equipos -->
                            <div class="mb-3">
                                <x-input-label class="form-label" for="equipment_id" :value="__('No. serie de equipo')" />
                                <div class="input-group input-group-merge">
                                    <select name="equipment_id" class="form-control" id="equipment_id"
                                        aria-label="Default select example">
                                        @foreach ($equipos as $equipo)
                                            <option value="{{ $equipo->id }}">{{ $equipo->serie }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Users -->
                            <div class="mb-3">
                                <x-input-label class="form-label" for="user_id" :value="__('Usuario')" />
                                <div class="input-group input-group-merge">
                                    <select name="user_id" class="form-control" id="user_id"
                                        aria-label="Default select example">
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Tipo de mantenimiento -->
                            <div class="mb-3">
                                <x-input-label class="form-label" for="maintenance_type" :value="__('Tipo de mantenimiento')" />
                                <div class="col-md">
                                    <div class="form-check form-check-inline mt-3">
                                        <input class="form-check-input" type="radio" name="maintenance_type" id="maintenance_type" value="Preventivo"/>
                                        <label class="form-check-label" for="maintenance_type">Preventivo</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="maintenance_type" id="maintenance_type" value="Correctivo" checked/>
                                        <label class="form-check-label" for="maintenance_type">Correctivo</label>
                                    </div>
                                </div>
                            </div>

                            <!-- Fecha -->
                            <div class="mb-3 row">
                                <x-input-label class="form-label" for="date" :value="__('Fecha')" />
                                <div class="input-group input-group-merge">
                                    <x-text-input class="form-control" type="date" value="2021-06-18" id="date" name="date" />
                                </div>
                            </div>

                            <!-- Descripcion -->
                            <div class="mb-3">
                                <x-input-label class="form-label" for="description" :value="__('Descripcion')" />
                                <div class="input-group input-group-merge">
                                    <textarea id="description" class="form-control" type="textarea"
                                        name="description" placeholder="Descripcion detallada..." :value="old('Descripcion')" required
                                        autocomplete="description" rows="3"></textarea>
                                </div>
                                <x-input-error :messages="$errors->get('observacion')" class="mt-2" />
                            </div>

                            <!-- Partes usadas -->
                            <div class="mb-3">
                                <x-input-label class="form-label" for="parts_used" :value="__('Partes usadas')" />
                                <div class="input-group input-group-merge">
                                    <x-text-input id="parts_used" class="form-control" type="text"
                                        name="parts_used" placeholder="Ram; SSD; etc..." :value="old('parts_used')"
                                        autocomplete="parts_used" />
                                </div>
                                <x-input-error :messages="$errors->get('parts_used')" class="mt-2" />
                            </div>

                            <!-- Estado -->
                            <div class="mb-3">
                                <x-input-label class="form-label" for="status" :value="__('Estado de equipo')" />
                                <div class="col-md">
                                    <div class="form-check form-check-inline mt-3">
                                        <input class="form-check-input" type="radio" name="status" id="status" value="Completado"/>
                                        <label class="form-check-label" for="status">Completado</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status" id="status" value="Pendiente" checked/>
                                        <label class="form-check-label" for="status">Pendiente</label>
                                    </div>
                                </div>
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
