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
    <div class="row justify-content-center">
        <div class="left-side col-md-8">
            <div class="card">
                <div class="card-header pb-0 text-left">
                    <h3 class="title">{{ __('Verify Your Email Address') }}</h3>
                    <p class="mb-0 sign-in-par">Before proceeding, please check your email for a verification link. If you did not receive the email</p>
                </div>
                <div class="card-body pb-3">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn mb-0 bg-gradient btn-lg w-100 null">{{ __('click here to request another') }}</button>.
                    </form>
                </div>         
            </div>
        </div>
    </div>
</div>
</body>
</html>