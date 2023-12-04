<x-guest-layout>
    <div class="form-container">
        <div class="mb-2 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div class="mt-4">
                <x-input-label class="form-label" for="email" :value="__('Email')" />
                <div class="input-group input-group-merge">
                    <span id="basic-icon-default-fullname2" class="input-group-text">
                        <i class='bx bx-envelope' ></i>
                    </span>
                    <x-text-input id="email" class="form-control" type="email" name="email" placeholder="correo@ejemplo.com" :value="old('email')" required autofocus/>
                </div>
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-primary-button class="btn btn-primary">
                    {{ __('Email Password Reset Link') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>