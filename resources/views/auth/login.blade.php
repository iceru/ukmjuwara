<x-guest-layout>
    <div class="login">
        <div class="container g-0">
            <div class="row g-0">
                <div class="col-12 col-md-6 login-content">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger mb-3">
                            <strong>Sorry !</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <h3 class="login-text">UKMJuWAra</h3>
                    <div class="login-card">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="form-group mb-4">
                                <label class="form-label" for="email">Email</label>
                                <input type="text" class="form-control" id="email" required autofocus type="email"
                                    name="email" :value="old('email')">
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="password">Password</label>
                                <input class="form-control" id="password" type="password" name="password" required
                                    autocomplete="current-password">
                            </div>

                            <!-- Remember Me -->
                            <div class="block mt-4">
                                <label for="remember_me" class="inline-flex items-center">
                                    <input id="remember_me" type="checkbox"
                                        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                        name="remember">
                                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                                </label>
                            </div>

                            <div class="flex items-center justify-end mb-3 mt-3">
                                @if (Route::has('password.request'))
                                    <a class="underline text-sm text-gray-600 hover:text-gray-900"
                                        href="{{ route('password.request') }}">
                                        {{ __('Forgot your password?') }}
                                    </a>
                                @endif

                            </div>

                            <button class="btn btn-primary" type="submit">Login</button>
                        </form>
                    </div>
                </div>
                <div class="col-md-6 d-sm-none d-md-flex image">
                    <img src="/images/login.svg" alt="Login">
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
