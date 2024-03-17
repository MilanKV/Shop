<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite('resources/sass/frontend/app.scss')
</head>

<body>
    <div id="app">
        <div class="container">
            <div class="row">
                <div class="left-side mx-auto col-xl-4 col-lg-5 col-md-7">
                    <div class="card">
                        <div class="card-header pb-0 text-start">
                            <h4 class="text-in">Sign In</h4>
                            <p class="mb-0 sign-in-par">Fill in the required fields below to access your account.</p>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
    
                                <div class="input">
                                    <input id="email" type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email"
                                        placeholder="Email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                </div>
                                <div class="input">
                                    <input id="password" type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password"
                                        placeholder="Password" required autocomplete="current-password">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                </div>
                                <div class="form-check form-switch">
                                    <div class="remember-me">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="remember">{{ __('Remember Me') }}</label>
                                    </div>
                                    <div class="forgot-password">
                                        @if (Route::has('password.request'))
                                            <a class="forgot-link" href="{{ route('password.request') }}">
                                                {{ __('Forgot Your Password?') }}
                                            </a>
                                        @endif
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button class="btn mb-0 bg-gradient btn-lg w-100 null mt-4">
                                        {{ __('Login') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="card-footer text-center px-1 pt-0 px-lg-2">
                            <p class="mx-auto mb-4 text-sm">
                                Don't have an account?
                                <a class="text-sign-in" href="{{ route('register') }}">Sign up</a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="right-side top-0 my-auto text-center col-6 d-lg-flex d-none h-100 pe-0 end-0 justify-content-center flex-column">
                    <div class="bg-gradient m-3 position-relative h-100 d-flex flex-column justify-content-center">
                        <img class="start-0" src="{{ asset('img/path-pattern.svg')}}" alt="path-pattern">
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- @vite('resources/js/app.js') --}}
</body>

</html>