<!--Modal create-->
<div class="modal fade" id="modalCreate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Agregar nuevo usuario</h4>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true"></span></button>
            </div>

            <div class="modal-body">
                <form method="POST" action="{{ route('users.store') }}">
                    @csrf
                    <!-- Name -->
                    <div class="mb-3">
                        <x-input-label class="form-label" for="name" :value="__('Name')" />
                        <div class="input-group input-group-merge">
                            <span id="basic-icon-default-fullname2" class="input-group-text">
                                <i class='bx bx-user'></i>
                            </span>
                            <x-text-input id="name" class="form-control" type="text"
                                name="name" placeholder="Juan Cerez" :value="old('name')" required
                                autofocus autocomplete="name" />
                        </div>
                    </div>
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />

                    <!-- Email Address -->
                    <div class="mt-4">
                        <x-input-label class="form-label" for="email" :value="__('Email')" />
                        <div class="input-group input-group-merge">
                            <span id="basic-icon-default-fullname2" class="input-group-text">
                                <i class='bx bx-envelope'></i>
                            </span>
                            <x-text-input id="email" class="form-control" type="email"
                                name="email" placeholder="correo@ejemplo.com" :value="old('email')"
                                required autocomplete="username" />
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
                            <x-text-input id="password" class="form-control" type="password"
                                name="password" required autocomplete="new-password" />
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Confirm Password -->
                    <div class="mt-4">
                        <x-input-label class="form-label" for="password_confirmation"
                            :value="__('Confirm Password')" />
                        <div class="input-group input-group-merge">
                            <span id="basic-icon-default-fullname2" class="input-group-text">
                                <i class='bx bx-barcode'></i>
                            </span>
                            <x-text-input id="password_confirmation" class="form-control"
                                type="password" name="password_confirmation" required
                                autocomplete="new-password" />
                        </div>
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>