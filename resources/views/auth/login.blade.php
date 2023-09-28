<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventario</title>
    <!-- Favicon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"> <!-- Agrega Font Awesome -->
    
    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/boxicons.css') }}" />
    
    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css')}}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/theme-default.css')}}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css')}}" />

    <link rel="stylesheet" href="{{ asset('css/login.css')}}" />

</head>
<body>
    <div class="container">
        <h2>
            <img src="{{ asset('images/gp-Logo.png')}}" alt="Iniciar Sesión" width="90"> Inventario
        </h2>
        <form method="POST" action="{{ route('login') }}">
            @csrf
        
            <!-- Email Address -->
            <div class="mt-4">
                <x-input-label class="form-label" for="email" :value="__('Email')" />
                <div class="input-group input-group-merge">
                    <span id="basic-icon-default-fullname2" class="input-group-text">
                        <i class='bx bx-envelope' ></i>
                    </span>
                    <x-text-input id="email" class="form-control" type="email" name="email" placeholder="correo@ejemplo.com" :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
            </div>
        
            <!-- Password -->
            <div class="mt-4">
                <x-input-label class="form-label" for="password" :value="__('Password')" />
                <div class="input-group input-group-merge">
                    <span id="basic-icon-default-fullname2" class="input-group-text">
                        <i class='bx bx-lock-alt'></i>
                    </span>
                    <x-text-input id="password" class="form-control"
                                    type="password"
                                    name="password"
                                    required autocomplete="current-password" />
            
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
            </div>
        
            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                    <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                </label>
            </div>
        
            <div class="flex items-center justify-end mt-4">        
                <x-primary-button class="btn-login ml-3 btn btn-primary">
                    {{ __('Log in') }}
                </x-primary-button>
            </div>

            <br>

            @if (Route::has('password.request'))
                <a class="btn-login text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif
        </form>
    </div>
</body>
</html>
