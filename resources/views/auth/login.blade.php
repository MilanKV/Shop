@extends('frontend.app')

@section('content')
    <div class="container min-vh-100">
        <div class="row">
            <div class="left-side mx-auto col-xl-4 col-lg-5 col-md-7">
                <div class="card">
                    <div class="card-header pb-0 text-start">
                        <h4 class="text-in">Sign In</h4>
                        <p class="mb-0 sign-in-par">Fill in the required fields below to access your account.</p>
                    </div>
                    <div class="card-body">
                        <form method="" action="">
                            @csrf

                            <div class="input">
                                <input type="email" class="form-control form-control-lg" name="email"
                                    placeholder="Email">
                            </div>
                            <div class="input">
                                <input type="password" class="form-control form-control-lg" name="password"
                                    placeholder="Password">
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="rememberMe" id="rememberMe">
                                <label class="form-check-label" for="rememberMe">Remember me</label>
                            </div>
                            <div class="text-center">
                                <button class="btn mb-0 bg-gradient btn-lg w-100 null mt-4">
                                    Sign In
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-center px-1 pt-0 px-lg-2">
                        <p class="mx-auto mb-4 text-sm">
                            Don't have an account?
                            <a class="text-sign-in" href="#">Sign up</a>
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
@endsection
