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
    @vite('resources/sass/backend/app.scss')
</head>

<body>
    <div id="app">
        <div class="container min-vh-100">
            <div class="row">
                <div class="left-side mx-auto col-xl-4 col-lg-5 col-md-7">
                    <div class="card">
                        <div class="card-header pb-0 text-start">
                            <h4 class="text-in">Sign Up</h4>
                            <p class="mb-0 sign-in-par">Fill in the required information below to create your account.</p>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('register') }}">
                                @csrf
    
                                <div class="input">
                                    <input id="name" type="name" class="form-control form-control-lg @error('name') is-invalid @enderror" name="name"
                                        placeholder="Name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                </div>
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
                                        placeholder="Password" required autocomplete="new-password">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                </div>
                                <div class="input">
                                    <input id="password-confirm" type="password" class="form-control form-control-lg" name="password_confirmation"
                                        placeholder="Password" required autocomplete="new-password">
                                </div>
                                <div class="form-check terms">
                                    <input class="form-check-input" type="checkbox" name="terms" id="CheckDefault">
                                    <label class="custom-control-label" for="CheckDefault">I agree the
                                        <a class="terms" href="#"><strong>Terms and Conditions</strong></a>
                                    </label>
                                </div>
                                <div class="text-center">
                                    <button class="btn mb-0 bg-gradient btn-lg w-100 null mt-4">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="card-footer text-center px-1 pt-0 px-lg-2">
                            <p class="mx-auto mb-4 text-sm">
                                Already have an account?
                                <a class="text-sign-in" href="{{ route('login') }}">Sign in</a>
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