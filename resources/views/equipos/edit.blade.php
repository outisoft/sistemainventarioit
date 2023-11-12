<x-app-layout>
    <div class="container-xxl navbar-expand-xl align-items-center">
        <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
            <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="bx bx-menu bx-sm"></i>
            </a>
        </div>
    </div>
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Empleados /</span> Editar </h4>

            <!-- Basic Bootstrap Table -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-header">Editar Registro</h5>
                </div>
                <div class="table-responsive text-nowrap">
                    <div class="card-body">


                        @if ($equipos->tipo_id == '1')
                            <form action="{{ route('equipo.update', $equipos->id) }}" method="POST" id="miFormulario">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="tipo_id">Tipo de equipo</label>
                                    <select class="form-control" id="tipo_id" name="tipo_id"
                                        aria-label="Default select example" onlyshow>
                                        @foreach ($tipos as $tipo)
                                            <option value="{{ $tipo->id }}"
                                                {{ $equipos->tipo_id == $tipo->id ? 'selected' : '' }}>
                                                {{ $tipo->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="nombre_app">NOMBRE DE APLICACION</label>
                                    <x-text-input type="text" id="nombre_app" name="nombre_app" class="form-control"
                                        value="{{ $equipos->nombre_app }}" required />
                                </div>
                                <div class="form-group">
                                    <label for="clave">Clave de activacion</label>
                                    <x-text-input type="text" id="clave" name="clave" class="form-control"
                                        value="{{ $equipos->clave }}" required />
                                </div>

                                <br>

                                <button type="submit" class="btn btn-primary"><i class='bx bx-refresh'></i>
                                    Actualizar</button>
                            </form>
                        @elseif ($equipos->tipo_id == '2')
                            <form action="{{ route('equipo.update', $equipos->id) }}" method="POST" id="miFormulario">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="tipo_id">Tipo de equipo</label>
                                    <select class="form-control" id="tipo_id" name="tipo_id"
                                        aria-label="Default select example" onlyshow>
                                        @foreach ($tipos as $tipo)
                                            <option value="{{ $tipo->id }}"
                                                {{ $equipos->tipo_id == $tipo->id ? 'selected' : '' }}>
                                                {{ $tipo->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="marca">Marca</label>
                                    <x-text-input type="text" id="marca" name="marca" class="form-control"
                                        value="{{ $equipos->marca }}" required />
                                </div>
                                <div class="form-group">
                                    <label for="modelo">Modelo</label>
                                    <x-text-input type="text" id="modelo" name="modelo" class="form-control"
                                        value="{{ $equipos->modelo }}" required />
                                </div>
                                <div class="form-group">
                                    <label for="serie">NUmero de serie</label>
                                    <x-text-input type="text" id="derie" name="serie" class="form-control"
                                        value="{{ $equipos->serie }}" required />
                                </div>

                                <br>

                                <button type="submit" class="btn btn-primary"><i class='bx bx-refresh'></i>
                                    Actualizar</button>
                            </form>
                        @elseif ($equipos->tipo_id == '3')
                            <form action="{{ route('equipo.update', $equipos->id) }}" method="POST" id="miFormulario">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="tipo_id">Tipo de equipo</label>
                                    <select class="form-control" id="tipo_id" name="tipo_id"
                                        aria-label="Default select example" onlyshow>
                                        @foreach ($tipos as $tipo)
                                            <option value="{{ $tipo->id }}"
                                                {{ $equipos->tipo_id == $tipo->id ? 'selected' : '' }}>
                                                {{ $tipo->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="orden">Orden de compra</label>
                                    <x-text-input type="text" id="orden" name="orden" class="form-control"
                                        value="{{ $equipos->orden }}" />
                                </div>
                                <div class="form-group">
                                    <label for="marca">Marca</label>
                                    <x-text-input type="text" id="marca" name="marca" class="form-control"
                                        value="{{ $equipos->marca }}" />
                                </div>
                                <div class="form-group">
                                    <label for="modelo">Modelo</label>
                                    <x-text-input type="text" id="modelo" name="modelo" class="form-control"
                                        value="{{ $equipos->modelo }}" />
                                </div>
                                <div class="form-group">
                                    <label for="serie">Serie</label>
                                    <x-text-input type="text" id="serie" name="serie" class="form-control"
                                        value="{{ $equipos->serie }}" />
                                </div>
                                <div class="form-group">
                                    <label for="nombre_equipo">Nombre de equipo</label>
                                    <x-text-input type="text" id="nombre_equipo" name="nombre_equipo"
                                        class="form-control" value="{{ $equipos->nombre_equipo }}" />
                                </div>
                                <div class="form-group">
                                    <label for="ip">IP</label>
                                    <x-text-input type="text" id="ip" name="ip" class="form-control"
                                        value="{{ $equipos->ip }}" />
                                </div>
                                <div class="form-group">
                                    <label for="no_contrato">Contrato</label>
                                    <x-text-input type="text" id="no_contrato" name="no_contrato"
                                        class="form-control" value="{{ $equipos->no_contrato }}" />
                                </div>

                                <br>

                                <button type="submit" class="btn btn-primary"><i class='bx bx-refresh'></i>
                                    Actualizar</button>
                            </form>
                        @elseif ($equipos->tipo_id == '4')
                            <form action="{{ route('equipo.update', $equipos->id) }}" method="POST"
                                id="miFormulario">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="tipo_id">Tipo de equipo</label>
                                    <select class="form-control" id="tipo_id" name="tipo_id"
                                        aria-label="Default select example" onlyshow>
                                        @foreach ($tipos as $tipo)
                                            <option value="{{ $tipo->id }}"
                                                {{ $equipos->tipo_id == $tipo->id ? 'selected' : '' }}>
                                                {{ $tipo->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="marca">Marca</label>
                                    <x-text-input type="text" id="marca" name="marca" class="form-control"
                                        value="{{ $equipos->marca }}" required />
                                </div>
                                <div class="form-group">
                                    <label for="modelo">Modelo</label>
                                    <x-text-input type="text" id="modelo" name="modelo" class="form-control"
                                        value="{{ $equipos->modelo }}" required />
                                </div>
                                <div class="form-group">
                                    <label for="serie">NUmero de serie</label>
                                    <x-text-input type="text" id="derie" name="serie" class="form-control"
                                        value="{{ $equipos->serie }}" required />
                                </div>

                                <br>

                                <button type="submit" class="btn btn-primary"><i class='bx bx-refresh'></i>
                                    Actualizar</button>
                            </form>
                        @elseif ($equipos->tipo_id == '5')
                            <form action="{{ route('equipo.update', $equipos->id) }}" method="POST"
                                id="miFormulario">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="tipo_id">Tipo de equipo</label>
                                    <select class="form-control" id="tipo_id" name="tipo_id"
                                        aria-label="Default select example" onlyshow>
                                        @foreach ($tipos as $tipo)
                                            <option value="{{ $tipo->id }}"
                                                {{ $equipos->tipo_id == $tipo->id ? 'selected' : '' }}>
                                                {{ $tipo->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="orden">Orden de compra</label>
                                    <x-text-input type="text" id="orden" name="orden" class="form-control"
                                        value="{{ $equipos->orden }}" />
                                </div>
                                <div class="form-group">
                                    <label for="marca">Marca</label>
                                    <x-text-input type="text" id="marca" name="marca" class="form-control"
                                        value="{{ $equipos->marca }}" />
                                </div>
                                <div class="form-group">
                                    <label for="modelo">Modelo</label>
                                    <x-text-input type="text" id="modelo" name="modelo" class="form-control"
                                        value="{{ $equipos->modelo }}" />
                                </div>
                                <div class="form-group">
                                    <label for="serie">Serie</label>
                                    <x-text-input type="text" id="serie" name="serie" class="form-control"
                                        value="{{ $equipos->serie }}" />
                                </div>
                                <div class="form-group">
                                    <label for="nombre_equipo">Nombre de equipo</label>
                                    <x-text-input type="text" id="nombre_equipo" name="nombre_equipo"
                                        class="form-control" value="{{ $equipos->nombre_equipo }}" />
                                </div>
                                <div class="form-group">
                                    <label for="ip">IP</label>
                                    <x-text-input type="text" id="ip" name="ip" class="form-control"
                                        value="{{ $equipos->ip }}" />
                                </div>
                                <div class="form-group">
                                    <label for="no_contrato">Contrato</label>
                                    <x-text-input type="text" id="no_contrato" name="no_contrato"
                                        class="form-control" value="{{ $equipos->no_contrato }}" />
                                </div>

                                <br>

                                <button type="submit" class="btn btn-primary"><i class='bx bx-refresh'></i>
                                    Actualizar</button>
                            </form>
                        @elseif ($equipos->tipo_id == '6')
                            <form action="{{ route('equipo.update', $equipos->id) }}" method="POST"
                                id="miFormulario">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="tipo_id">Tipo de equipo</label>
                                    <select class="form-control" id="tipo_id" name="tipo_id"
                                        aria-label="Default select example" onlyshow>
                                        @foreach ($tipos as $tipo)
                                            <option value="{{ $tipo->id }}"
                                                {{ $equipos->tipo_id == $tipo->id ? 'selected' : '' }}>
                                                {{ $tipo->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="marca">Marca</label>
                                    <x-text-input type="text" id="marca" name="marca" class="form-control"
                                        value="{{ $equipos->marca }}" required />
                                </div>
                                <div class="form-group">
                                    <label for="modelo">Modelo</label>
                                    <x-text-input type="text" id="modelo" name="modelo" class="form-control"
                                        value="{{ $equipos->modelo }}" required />
                                </div>
                                <div class="form-group">
                                    <label for="serie">NUmero de serie</label>
                                    <x-text-input type="text" id="derie" name="serie" class="form-control"
                                        value="{{ $equipos->serie }}" required />
                                </div>

                                <br>

                                <button type="submit" class="btn btn-primary"><i class='bx bx-refresh'></i>
                                    Actualizar</button>
                            </form>
                        @elseif ($equipos->tipo_id == '7')
                            <form action="{{ route('equipo.update', $equipos->id) }}" method="POST"
                                id="miFormulario">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="tipo_id">Tipo de equipo</label>
                                    <select class="form-control" id="tipo_id" name="tipo_id"
                                        aria-label="Default select example" onlyshow>
                                        @foreach ($tipos as $tipo)
                                            <option value="{{ $tipo->id }}"
                                                {{ $equipos->tipo_id == $tipo->id ? 'selected' : '' }}>
                                                {{ $tipo->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="marca">Marca</label>
                                    <x-text-input type="text" id="marca" name="marca" class="form-control"
                                        value="{{ $equipos->marca }}" required />
                                </div>
                                <div class="form-group">
                                    <label for="modelo">Modelo</label>
                                    <x-text-input type="text" id="modelo" name="modelo" class="form-control"
                                        value="{{ $equipos->modelo }}" required />
                                </div>
                                <div class="form-group">
                                    <label for="serie">Numero de serie</label>
                                    <x-text-input type="text" id="derie" name="serie" class="form-control"
                                        value="{{ $equipos->serie }}" required />
                                </div>
                                <div class="form-group">
                                    <label for="no_contrato">Numero de contrato</label>
                                    <x-text-input type="text" id="no_contrato" name="no_contrato"
                                        class="form-control" value="{{ $equipos->no_contrato }}" required />
                                </div>

                                <br>

                                <button type="submit" class="btn btn-primary"><i class='bx bx-refresh'></i>
                                    Actualizar</button>
                            </form>
                        @elseif ($equipos->tipo_id == '8')
                            <form action="{{ route('equipo.update', $equipos->id) }}" method="POST"
                                id="miFormulario">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="tipo_id">Tipo de equipo</label>
                                    <select class="form-control" id="tipo_id" name="tipo_id"
                                        aria-label="Default select example" onlyshow>
                                        @foreach ($tipos as $tipo)
                                            <option value="{{ $tipo->id }}"
                                                {{ $equipos->tipo_id == $tipo->id ? 'selected' : '' }}>
                                                {{ $tipo->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="marca">Marca</label>
                                    <x-text-input type="text" id="marca" name="marca" class="form-control"
                                        value="{{ $equipos->marca }}" required />
                                </div>
                                <div class="form-group">
                                    <label for="serie">Numero de serie</label>
                                    <x-text-input type="text" id="derie" name="serie" class="form-control"
                                        value="{{ $equipos->serie }}" required />
                                </div>
                                <br>

                                <button type="submit" class="btn btn-primary"><i class='bx bx-refresh'></i>
                                    Actualizar</button>
                            </form>
                        @elseif ($equipos->tipo_id == '9')
                            <form action="{{ route('equipo.update', $equipos->id) }}" method="POST"
                                id="miFormulario">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="tipo_id">Tipo de equipo</label>
                                    <select class="form-control" id="tipo_id" name="tipo_id"
                                        aria-label="Default select example" onlyshow>
                                        @foreach ($tipos as $tipo)
                                            <option value="{{ $tipo->id }}"
                                                {{ $equipos->tipo_id == $tipo->id ? 'selected' : '' }}>
                                                {{ $tipo->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="marca">Marca</label>
                                    <x-text-input type="text" id="marca" name="marca" class="form-control"
                                        value="{{ $equipos->marca }}" required />
                                </div>
                                <div class="form-group">
                                    <label for="modelo">Modelo</label>
                                    <x-text-input type="text" id="modelo" name="modelo" class="form-control"
                                        value="{{ $equipos->modelo }}" required />
                                </div>
                                <div class="form-group">
                                    <label for="serie">Numero de serie</label>
                                    <x-text-input type="text" id="derie" name="serie" class="form-control"
                                        value="{{ $equipos->serie }}" required />
                                </div>

                                <br>

                                <button type="submit" class="btn btn-primary"><i class='bx bx-refresh'></i>
                                    Actualizar</button>
                            </form>
                        @elseif ($equipos->tipo_id == '10')
                            <form action="{{ route('equipo.update', $equipos->id) }}" method="POST"
                                id="miFormulario">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="tipo_id">Tipo de equipo</label>
                                    <select class="form-control" id="tipo_id" name="tipo_id"
                                        aria-label="Default select example" onlyshow>
                                        @foreach ($tipos as $tipo)
                                            <option value="{{ $tipo->id }}"
                                                {{ $equipos->tipo_id == $tipo->id ? 'selected' : '' }}>
                                                {{ $tipo->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="office">PAQUETERIA OFFICE</label>
                                    <x-text-input type="text" id="office" name="office" class="form-control"
                                        value="{{ $equipos->office }}" required />
                                </div>
                                <div class="form-group">
                                    <label for="clave">CLAVE DE ACTIVACION</label>
                                    <x-text-input type="text" id="clave" name="clave" class="form-control"
                                        value="{{ $equipos->clave }}" required />
                                </div>

                                <br>

                                <button type="submit" class="btn btn-primary"><i class='bx bx-refresh'></i>
                                    Actualizar</button>
                            </form>
                        @elseif ($equipos->tipo_id == '11')
                            <form action="{{ route('equipo.update', $equipos->id) }}" method="POST"
                                id="miFormulario">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="tipo_id">Tipo de equipo</label>
                                    <select class="form-control" id="tipo_id" name="tipo_id"
                                        aria-label="Default select example" onlyshow>
                                        @foreach ($tipos as $tipo)
                                            <option value="{{ $tipo->id }}"
                                                {{ $equipos->tipo_id == $tipo->id ? 'selected' : '' }}>
                                                {{ $tipo->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="marca">Marca</label>
                                    <x-text-input type="text" id="marca" name="marca" class="form-control"
                                        value="{{ $equipos->marca }}" required />
                                </div>
                                <div class="form-group">
                                    <label for="modelo">Modelo</label>
                                    <x-text-input type="text" id="modelo" name="modelo" class="form-control"
                                        value="{{ $equipos->modelo }}" required />
                                </div>
                                <div class="form-group">
                                    <label for="serie">Numero de serie</label>
                                    <x-text-input type="text" id="derie" name="serie" class="form-control"
                                        value="{{ $equipos->serie }}" required />
                                </div>

                                <br>

                                <button type="submit" class="btn btn-primary"><i class='bx bx-refresh'></i>
                                    Actualizar</button>
                            </form>
                        @elseif ($equipos->tipo_id == '12')
                            <form action="{{ route('equipo.update', $equipos->id) }}" method="POST"
                                id="miFormulario">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="tipo_id">Tipo de equipo</label>
                                    <select class="form-control" id="tipo_id" name="tipo_id"
                                        aria-label="Default select example" onlyshow>
                                        @foreach ($tipos as $tipo)
                                            <option value="{{ $tipo->id }}"
                                                {{ $equipos->tipo_id == $tipo->id ? 'selected' : '' }}>
                                                {{ $tipo->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="so">SISTEMA OPERATIVO</label>
                                    <x-text-input type="text" id="so" name="so" class="form-control"
                                        value="{{ $equipos->so }}" required />
                                </div>
                                <div class="form-group">
                                    <label for="clave">CLAVE DE ACTIVACION</label>
                                    <x-text-input type="text" id="clave" name="clave" class="form-control"
                                        value="{{ $equipos->clave }}" required />
                                </div>

                                <br>

                                <button type="submit" class="btn btn-primary"><i class='bx bx-refresh'></i>
                                    Actualizar</button>
                            </form>
                        @elseif ($equipos->tipo_id == '13')
                            <form action="{{ route('equipo.update', $equipos->id) }}" method="POST"
                                id="miFormulario">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="tipo_id">Tipo de equipo</label>
                                    <select class="form-control" id="tipo_id" name="tipo_id"
                                        aria-label="Default select example" onlyshow>
                                        @foreach ($tipos as $tipo)
                                            <option value="{{ $tipo->id }}"
                                                {{ $equipos->tipo_id == $tipo->id ? 'selected' : '' }}>
                                                {{ $tipo->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="marca">Marca</label>
                                    <x-text-input type="text" id="marca" name="marca" class="form-control"
                                        value="{{ $equipos->marca }}" required />
                                </div>
                                <div class="form-group">
                                    <label for="serie">Numero de serie</label>
                                    <x-text-input type="text" id="derie" name="serie" class="form-control"
                                        value="{{ $equipos->serie }}" required />
                                </div>

                                <br>

                                <button type="submit" class="btn btn-primary"><i class='bx bx-refresh'></i>
                                    Actualizar</button>
                            </form>
                        @else
                            <label for="404">Tipo de equipo no registrado</label>
                        @endif

                    </div>
                </div>
            </div>
            <!--/ Basic Bootstrap Table -->

            <hr class="my-5" />

        </div>
        <!-- / Content -->
    </div>
</x-app-layout>
