<x-guest-layout>
    <div class="container">
        <h2>
            <img src="{{ asset('images/logo_gp_50.png') }}" alt="Iniciar Sesión" width="200">
        </h2>
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div class="mt-4">
                <x-input-label class="form-label" for="email" :value="__('Email')" />
                <div class="input-group input-group-merge">
                    <span id="basic-icon-default-fullname2" class="input-group-text">
                        <i class='bx bx-envelope'></i>
                    </span>
                    <x-text-input id="email" class="form-control" type="email" name="email"
                        placeholder="correo@ejemplo.com" :value="old('email')" required autofocus autocomplete="username" />
                </div>
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label class="form-label" for="password" :value="__('Password')" />
                <div class="input-group input-group-merge">
                    <span id="basic-icon-default-fullname2" class="input-group-text">
                        <i class='bx bx-lock-alt'></i>
                    </span>
                    <x-text-input id="password" class="form-control" type="password" name="password"
                        placeholder="••••••••" required autocomplete="current-password" />
                    <span class="input-group-text" onclick="togglePasswordVisibility()">
                        <i class='bx bx-show' id="togglePasswordIcon"></i>
                    </span>
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox"
                        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div style="text-align: center;" class="mt-4">
                <x-primary-button class="btn btn-primary">
                    {{ __('Log in') }}
                </x-primary-button>
                <br>
                <br>
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
            </div>
        </form>
    </div>
</x-guest-layout>
<script>
    function togglePasswordVisibility() {
        const passwordInput = document.getElementById('password');
        const togglePasswordIcon = document.getElementById('togglePasswordIcon');
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            togglePasswordIcon.classList.remove('bx-show');
            togglePasswordIcon.classList.add('bx-hide');
        } else {
            passwordInput.type = 'password';
            togglePasswordIcon.classList.remove('bx-hide');
            togglePasswordIcon.classList.add('bx-show');
        }
    }
</script>
