@extends('layouts.master')

@section('content')
    <main>
        <!-- Breadcrumbs S t a r t -->
        <section class="breadcrumbs-area breadcrumb-bg">
            <div class="container">
                <h1 class="title wow fadeInUp" data-wow-delay="0.0s"
                    style="visibility: visible; animation-delay: 0s; animation-name: fadeInUp;">Login</h1>
                <div class="breadcrumb-text">
                    <nav aria-label="breadcrumb" class="breadcrumb-nav wow fadeInUp" data-wow-delay="0.1s"
                        style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInUp;">
                        <ul class="breadcrumb listing">
                            <li class="breadcrumb-item single-list"><a href="{{ url('/') }}" class="single">Home</a></li>
                            <li class="breadcrumb-item single-list" aria-current="page">
                                <a href="javascript:void(0)" class="single active">Login</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </section>
        <!--/ End-of Breadcrumbs-->

        <!-- Login area S t a r t  -->
        <div class="login-area section-padding">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-5 col-lg-6 col-md-8 col-sm-10">
                        <div class="login-card">
                            <!-- Logo -->
                            <div class="logo mb-40">
                                <a href="{{ url('/') }}" class="mb-30 d-block">
                                    <img src="{{ static_asset('assets/images/logo/logo.png')}}" alt="logo" class="changeLogo">
                                </a>
                            </div>
                            <!-- Form -->
                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <div class="position-relative contact-form mb-24">
                                    <label class="contact-label">{{ __('Email Address') }} </label>
                                    <input id="email" type="email"
                                        class="form-control contact-input @error('email') is-invalid @enderror"
                                        name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                                        placeholder="Enter Your Email">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="contact-form mb-24">
                                    <div class="position-relative ">
                                        <div class="d-flex justify-content-between aligin-items-center">
                                            <label class="contact-label">Password</label>
                                            @if (Route::has('password.request'))
                                                <a href="{{ route('password.request') }}">
                                                    <span
                                                        class="text-primary text-15">{{ __('Forgot Your Password?') }}</span>
                                                </a>
                                            @endif

                                        </div>
                                        <input type="password"
                                            class="form-control contact-input password-input contact-input @error('password') is-invalid @enderror"
                                            id="txtPasswordLogin" name="password" required autocomplete="current-password"
                                            placeholder="Enter Password">
                                        <i class="toggle-password ri-eye-line"></i>
                                    </div>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6 ">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                                {{ old('remember') ? 'checked' : '' }}>

                                            <label class="form-check-label" for="remember">
                                                {{ __('Remember Me') }}
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn-primary btn justify-content-center w-100 p-2">

                                    <span class="d-flex justify-content-center gap-6">
                                        <span class="text-white">Login</span>
                                    </span>
                                </button>
                            </form>

                            <div class="login-footer">
                                <div class="create-account">
                                    <p>
                                        Don’t have an account?
                                        <a href="{{ route('register') }}">
                                            <span class="text-primary">Register</span>
                                        </a>
                                    </p>
                                </div>
                                <a href="javascript:void(0)"
                                    class="login-btn d-flex align-items-center justify-content-center gap-10">
                                    <img src="{{ static_asset('assets/images/icon/google-icon.png') }} " alt="img"
                                        class="m-0">
                                    <span> login with Google</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ End-of Login -->
    </main>
@endsection
