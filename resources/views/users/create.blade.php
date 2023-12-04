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
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">
                    <a href="{{ route('users.index') }}" class="btn-ico" data-toggle="tooltip" data-placement="top"
                        title="Regresar">
                        <span>
                            <i class='bx bx-arrow-back'></i>
                        </span>
                    </a>
                    .. / Usuario /</span> Nuevo </h4>

            <!-- Basic Bootstrap Table -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-header">Nuevo Registro</h5>
                </div>
                <div class="table-responsive text-nowrap">
                    <div class="card-body">
                        <form method="POST" action="{{ route('users.store') }}">
                            @csrf

                            <!-- Name -->
                            <div class="mb-3">
                                <x-input-label class="form-label" for="name" :value="__('Name')" />
                                <div class="input-group input-group-merge">
                                    <span id="basic-icon-default-fullname2" class="input-group-text">
                                        <i class='bx bx-user'></i>
                                    </span>
                                    <x-text-input id="name" class="form-control" type="text" name="name"
                                        placeholder="Juan Cerez" :value="old('name')" required autofocus
                                        autocomplete="name" />
                                </div>
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>

                            <!-- Email Address -->
                            <div class="mt-4">
                                <x-input-label class="form-label" for="email" :value="__('Email')" />
                                <div class="input-group input-group-merge">
                                    <span id="basic-icon-default-fullname2" class="input-group-text">
                                        <i class='bx bx-envelope'></i>
                                    </span>
                                    <x-text-input id="email" class="form-control" type="email" name="email"
                                        placeholder="correo@ejemplo.com" :value="old('email')" required
                                        autocomplete="username" />
                                </div>
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>

                            <!-- Rol -->
                            <div class="mt-4">
                                <label for="exampleFormControlSelect1" class="form-label">Rol</label>
                                <div class="input-group input-group-merge">
                                    <span id="basic-icon-default-fullname2" class="input-group-text">
                                        <i class='bx bxs-user-detail'></i>
                                    </span>
                                    <select name="rol" class="form-control" id="rol"
                                        aria-label="Default select example">
                                        @foreach ($roles as $rol)
                                            <option value="{{ $rol->name }}">{{ $rol->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Password -->
                            <div class="mt-4">
                                <x-input-label class="form-label" for="password" :value="__('Password')" />
                                <div class="input-group input-group-merge">
                                    <span id="basic-icon-default-fullname2" class="input-group-text">
                                        <i class='bx bx-barcode'></i>
                                    </span>
                                    <x-text-input id="password" class="form-control" type="password" name="password"
                                        required autocomplete="new-password" />
                                </div>
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>

                            <!-- Confirm Password -->
                            <div class="mt-4">
                                <x-input-label class="form-label" for="password_confirmation" :value="__('Confirm Password')" />
                                <div class="input-group input-group-merge">
                                    <span id="basic-icon-default-fullname2" class="input-group-text">
                                        <i class='bx bx-barcode'></i>
                                    </span>
                                    <x-text-input id="password_confirmation" class="form-control" type="password"
                                        name="password_confirmation" required autocomplete="new-password" />
                                </div>
                                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <x-primary-button class="btn btn-primary">
                                    {{ __('Register') }}
                                </x-primary-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!--/ Basic Bootstrap Table -->

            <hr class="my-5" />

        </div>
        <!-- / Content -->
    </div>
</x-app-layout>
