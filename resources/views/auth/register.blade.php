<x-guest-layout>
    
    <div class="login">
        <div class="container g-0">
            <div class="row g-0">
                <div class="col-12">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger mt-3">
                            <strong>Sorry !</strong> There were some problems with your input.<br><br>
                            <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
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
