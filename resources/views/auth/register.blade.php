<x-guest-layout>
    {{-- <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
    @csrf

    <!-- Name -->
    <div>
        <x-label for="name" :value="__('Name')" />

        <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
    </div>

    <!-- Email Address -->
    <div class="mt-4">
        <x-label for="email" :value="__('Email')" />

        <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
    </div>

    <!-- Password -->
    <div class="mt-4">
        <x-label for="password" :value="__('Password')" />

        <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
            autocomplete="new-password" />
    </div>

    <!-- Confirm Password -->
    <div class="mt-4">
        <x-label for="password_confirmation" :value="__('Confirm Password')" />

        <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation"
            required />
    </div>

    <div class="flex items-center justify-end mt-4">
        <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
            {{ __('Already registered?') }}
        </a>

        <x-button class="ml-4">
            {{ __('Register') }}
        </x-button>
    </div>
    </form>
    </x-auth-card> --}}

    <div class="login">
        <div class="container g-0">
            <div class="row g-0">
                <div class="col-12 col-md-6 login-content">
                    <h3 class="login-text">#UKMJUWARA</h3>
                    <div class="login-card">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="mb-4">
                                <label class="form-label" for="name" class="form-label" >Name</label>
                                <input type="text" class="form-control" id="name" required autofocus name="name"
                                    :value="old('email')">
                            </div>
                            <div class="form-group mb-4">
                                <label class="form-label" for="email">Email</label>
                                <input type="email" class="form-control" id="email" required autofocus name="email"
                                    :value="old('email')">
                            </div>
    
                            <div class="form-group mb-4">
                                <label class="form-label" for="password">Password</label>
                                <input class="form-control" id="password" type="password" name="password" required
                                    autocomplete="current-password">
                            </div>
    
                            <div class="form-group">
                                <label class="form-label" for="password_confirmation">Confirm Password</label>
                                <input class="form-control" id="password_confirmation" type="password" name="password_confirmation" required
                                    autocomplete="current-password">
                            </div>
    
                            <div class="flex items-center justify-end mt-3 mb-3">
                                <a href="{{ route('login') }}">
                                    Already Registered?
                                </a>
                            </div>
    
                            <button class="btn btn-primary" type="submit">Register</button>
                        </form>
                    </div>
                </div>
                <div class="col-md-6 d-none d-md-flex image">
                    <img src="/images/register.svg" alt="Register">
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
