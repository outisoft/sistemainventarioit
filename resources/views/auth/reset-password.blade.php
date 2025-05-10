<x-guest-layout>
    <div class="authentication-wrapper authentication-cover">
        <!-- Logo -->
        <a href="#" class="app-brand auth-cover-brand gap-2">
            <span class="app-brand-logo demo">
                <span class="text-primary">
                    <img src="{{ asset('images/gp-Logo.png')}}" alt="" width="35" >
                </span>
            </span>
        </a>
        <!-- /Logo -->


        <div class="authentication-inner row m-0">
            <!-- /Left Text -->
            <div class="d-none d-lg-flex col-lg-7 col-xl-8 align-items-center p-5">
                <div class="w-100 d-flex justify-content-center">
                    <img src="{{ asset('images/reset-password.png')}}" class="img-fluid scaleX-n1-rtl" alt="Login image" width="700" data-app-dark-img="illustrations/boy-with-laptop-dark.png" data-app-light-img="illustrations/boy-with-laptop-light.png" style="visibility: visible;">
                </div>
            </div>
            <!-- /Left Text -->

            <!-- Reset Password -->
            <div class="d-flex col-12 col-lg-5 col-xl-4 align-items-center authentication-bg p-sm-12 p-6">
                <div class="w-px-400 mx-auto mt-sm-12 mt-8">
                    <h4 class="mb-1">Reset Password 🔒</h4>
                    <p class="mb-6"><span class="fw-medium">Enter the new password for your requested email to recover your account.</span></p>

                    <form method="POST" action="{{ route('password.store') }}" class="mb-6 fv-plugins-bootstrap5 fv-plugins-framework" novalidate="novalidate">
                        @csrf

                        <!-- Password Reset Token -->
                        <input type="hidden" name="token" value="{{ $request->route('token') }}">

                        <!-- Email Address -->
                        <div>
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" class="form-control" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Password -->
                        <div class="mt-4">
                            <x-input-label for="password" :value="__('Password')" />
                            <x-text-input id="password" class="form-control" type="password" name="password" required autocomplete="new-password" />
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <!-- Confirm Password -->
                        <div class="mt-4">
                            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                            <x-text-input id="password_confirmation" class="form-control"
                                                type="password"
                                                name="password_confirmation" required autocomplete="new-password" />

                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>
                        <br>

                        <button class="btn btn-primary d-grid w-100 mb-6">Reset password</button>
                        
                        <input type="hidden">
                    </form>
                </div>
            </div>
            <!-- /Reset Password -->
        </div>
    </div>
</x-guest-layout>
