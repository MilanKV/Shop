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
    <div class="container">
        <div class="recovery-card px-5 col-xl-5 col-lg-6 col-md-8 col-12 d-flex flex-column">
            <div class="card mt-8">
                <div class="card-header pb-0 text-left">
                    <h3 class="title">{{ __('Reset Password') }}</h3>
                    <p class="mb-0"> You will receive an e-mail in maximum 60 seconds </p>
                </div>
                <div class="card-body pb-3">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <form method="POST" action="{{ route('password.email') }}" class="text-start">
                        @csrf

                        <label class="title" for="email">{{ __('Email Address') }}</label>
                        <div class="form-group mb-0">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            <br>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="text-center">
                            <button class="btn mb-0 bg-gradient btn-lg w-100 null mt-4" type="submit">
                                {{ __('Send Password Reset Link') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
