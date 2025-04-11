<x-app-layout>
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-style1">
                    <li class="breadcrumb-item">
                        <a href="{{ route('equipo.index') }}">EQUIPMENTS</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('desktops.index') }}">DESKTOP</a>
                    </li>
                    <li class="breadcrumb-item active fw-bold">TRASH</li>
                </ol>
            </nav>

            <!-- Basic Bootstrap Table -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-header">Trashes list</h5>
                </div>

                <div class="table-responsive text-nowrap" id="searchResults">
                    <table id="laptops" class="table">
                        <thead class="bg-primary">
                            <tr>
                                @role('Administrator')
                                    <th>Region</th>
                                @else
                                    @if ($userRegions->count() > 1)
                                        <th>Region</th>
                                    @else
                                    @endif
                                @endrole
                                <th>BRAND</th>
                                <th>MODEL</th>
                                <th>SERIAL</th>
                                <th>NAME</th>
                                <th>IP</th>
                                <th>SO</th>
                                <th>LEASE? OR AF CODE</th>
                                <th></th>
                                <!-- Otros encabezados de columnas según sea necesario -->
                            </tr>
                        </thead>
                        <tbody id="employeeList">
                            @foreach ($equipments as $equipment)
                                <tr>
                                    @role('Administrator')
                                        <td>{{ $equipment->region->name }} </td>
                                    @else
                                        @if ($userRegions->count() > 1)
                                            <td>{{ $equipment->region->name }} </td>
                                        @else
                                        @endif
                                    @endrole
                                    <td>{{ $equipment->marca }}</td>
                                    <td>{{ $equipment->model }}</td>
                                    <td>{{ $equipment->serial }}</td>
                                    <td>{{ $equipment->name }}</td>
                                    <td>{{ $equipment->ip }}</td>
                                    <td>{{ $equipment->so }}</td>
                                    <td>
                                        @if ($equipment->lease_id && $equipment->lease)
                                            <div>
                                                Lease Code: <span
                                                    class="badge bg-label-dark">{{ $equipment->leases->lease }}</span><br>
                                                End Date: <span
                                                    class="badge bg-label-info">{{ $equipment->leases->end_date }}</span>
                                            </div>
                                        @else
                                            <span class="badge bg-label-danger">No</span>
                                            <span class="badge bg-label-dark">{{ $equipment->af_code }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <!--a-- href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#hojaBajaModal" data-id="{{ $equipment->id }}">
                                                    <i class='bx bx-spreadsheet'></i> Hoja de baja
                                                </!--a-->
                                                <form action="{{ route('desktops.restore', $equipment->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="dropdown-item"><i class='bx bx-reset me-1'></i>Restaurar</button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!--/ Basic Bootstrap Table -->
        </div>
        <!-- / Content -->
    </div>

    <!-- Modal para Hoja de Baja -->
    <div class="modal fade" id="hojaBajaModal" tabindex="-1" aria-labelledby="hojaBajaModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="#" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="hojaBajaModalLabel">Generar Hoja de Baja</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="laptop_id" id="laptopId">
                        <!-- Hotel solicitante -->
                        <div class="mb-3">
                            <x-input-label class="form-label" for="area" :value="__('Hotel Solicitante')" />
                            <select class="form-control" name="area" id="area">
                                <option value="GLF">GLF</option>
                                <option value="SER">SER</option>
                            </select>
                            <x-input-error :messages="$errors->get('area')" class="mt-2" />
                        </div>

                        <!-- Empresa -->
                        <div class="mb-3">
                            <x-input-label class="form-label" for="area" :value="__('Empresa')" />
                            <select class="form-control" name="area" id="area">
                                <option value="BPI">BPI</option>
                                <option value="BPP">BPP</option>
                                <option value="RSE">RSE</option>
                                <option value="MCB">MCB</option>
                            </select>
                            <x-input-error :messages="$errors->get('area')" class="mt-2" />
                        </div>

                        <div class="mb-3">
                            <x-input-label class="form-label" for="area" :value="__('Tipo de baja')" />

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="checkDefault">
                                <label class="form-check-label" for="checkDefault">
                                    Definitiva
                                </label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="checkChecked">
                                <label class="form-check-label" for="checkChecked">
                                    Rotura y/o Daño Irreparable
                                </label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="checkDefault">
                                <label class="form-check-label" for="checkDefault">
                                    Reutilización en área de colaboradores
                                </label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="checkChecked">
                                <label class="form-check-label" for="checkChecked">
                                    Robo o extravío
                                </label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="checkChecked">
                                <label class="form-check-label" for="checkChecked">
                                    Donacion
                                </label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="checkChecked">
                                <label class="form-check-label" for="checkChecked">
                                    Referencial
                                </label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="checkChecked">
                                <label class="form-check-label" for="checkChecked">
                                    Cambio de estándar/remodelación
                                </label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="checkChecked">
                                <label class="form-check-label" for="checkChecked">
                                    Venta
                                </label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="checkChecked">
                                <label class="form-check-label" for="checkChecked">
                                    Entrega a Gestor de Residuos
                                </label>
                            </div>
                        </div>

                        <div class="mb-3">
                        </div>

                        <div class="mb-3">
                            <label for="motivo" class="form-label">Motivo de Baja</label>
                            <textarea class="form-control" id="motivo" name="motivo" rows="3" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="foto" class="form-label">Subir Foto</label>
                            <input type="file" class="form-control" id="foto" name="foto" accept="image/*" onchange="previewImage(event)">
                            <div class="mt-3">
                                <img id="preview" src="#" alt="Vista previa de la imagen" style="max-width: 100%; display: none;" />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Generar PDF</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Pasar el ID del laptop al modal
        document.querySelectorAll('[data-bs-target="#hojaBajaModal"]').forEach(button => {
            button.addEventListener('click', function () {
                const laptopId = this.getAttribute('data-id');
                document.getElementById('laptopId').value = laptopId;
            });
        });

        function previewImage(event) {
            const input = event.target;
            const preview = document.getElementById('preview');

            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };

                reader.readAsDataURL(input.files[0]);
            } else {
                preview.src = '#';
                preview.style.display = 'none';
            }
        }
    </script>
</x-app-layout>
