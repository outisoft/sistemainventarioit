<x-guest-layout>
    <div class="container">
        <x-input-label class="form-label" for="current_password" :value="__('Es su primer ingreso al sistema. Por seguridad, debe cambiar su contraseña.')" />

        <div class="card-body">
            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                @method('PUT')
                <!-- current_password -->
                <div class="mt-4">
                    <x-input-label class="form-label" for="current_password" :value="__('CONTRASEÑA ACTUAL')" />
                    <div class="input-group input-group-merge">
                        <x-text-input id="current_password" class="form-control" type="password" name="current_password"
                            placeholder="••••••••" required autocomplete="current-password" />
                    </div>
                    <x-input-error :messages="$errors->get('current_password')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label class="form-label" for="password" :value="__('NUEVA CONTRASEÑA')" />
                    <div class="input-group input-group-merge">
                        <x-text-input id="password" class="form-control" type="password" name="password"
                            placeholder="••••••••" required autocomplete="current-password" />
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- password_confirmation -->
                <div class="mt-4">
                    <x-input-label class="form-label" for="password_confirmation" :value="__('CONFIRMAR CONTRASEÑA')" />
                    <div class="input-group input-group-merge">
                        <x-text-input id="password_confirmation" class="form-control" type="password"
                            name="password_confirmation" placeholder="••••••••" required
                            autocomplete="current-password" />
                    </div>
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>
                <br>

                <div style="text-align: center;" class="mt-4">

                    <x-primary-button class="btn btn-primary">
                        {{ __('Cambiar contraseña') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
