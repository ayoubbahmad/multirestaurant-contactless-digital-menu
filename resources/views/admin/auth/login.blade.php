@extends('layouts.app_layout')
@section('content')

    <div class="form-container">
        <div class="form-form">
            <div class="form-form-wrap">
                <div class="form-container">
                    <div class="form-content">

                        <h2 class=""> @include('layouts.render.translation',["key" => "login", "default"=> "website_landing_page"])
                            @include('layouts.render.translation',["key" => "in_into", "default"=> "website_landing_page"])
                            <a href=""> <span class="text-primary">
                             @include('layouts.render.translation',["key" => "admin", "default"=> "website_landing_page"]) </span></a> </h2>

                        <p class="signup-link">   </p>
                        <form class="text-left"  method="POST" action="{{ route('login') }}">
                            @csrf
                            @if(session()->has("MSG"))
                                <div class="alert alert-{{session()->get("TYPE")}}">
                                    <strong> <a>{{session()->get("MSG")}}</a></strong>
                                </div>
                            @endif
                                                            @if($errors->any()) @include('admin.admin_layout.form_error') @endif
                            <div class="form">

                                <div id="username-field" class="field-wrapper input">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                    <input id="email" type="email" placeholder=" @include('layouts.render.translation',["key" => "email_address", "default"=> "website_landing_page"])" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div id="password-field" class="field-wrapper input mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                                    <input id="password"  placeholder="@include('layouts.render.translation',["key" => "password", "default"=> "website_landing_page"])" type="password" class="form-control"  name="password" required autocomplete="current-password">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="d-sm-flex justify-content-between">
                                    <div class="field-wrapper toggle-pass">
                                        <p class="d-inline-block">@include('layouts.render.translation',["key" => "show_password", "default"=> "website_landing_page"])</p>
                                        <label class="switch s-primary">
                                            <input type="checkbox" id="toggle-password" class="d-none">
                                            <span class="slider round"></span>
                                        </label>
                                    </div>
                                    <div class="field-wrapper">
                                        <button type="submit" class="btn btn-primary" value="">@include('layouts.render.translation',["key" => "login", "default"=> "website_landing_page"])</button>
                                    </div>

                                </div>



                                <div class="field-wrapper pt-4">
                                    <a href="{{route('password.request') }}" class="forgot-pass-link">@include('layouts.render.translation',["key" => "forgot_password", "default"=> "website_landing_page"])</a>
                                </div>

                            </div>
                        </form>
                        <p class="terms-conditions">@include('layouts.render.translation',["key" => "copy_right_text", "default"=> "website_landing_page"]) <a href="#">{{$account_info ?? '' != NULL ?$account_info->application_name:"Chef Digital Menu"}}</a> @include('layouts.render.translation',["key" => "is_a_product_of", "default"=> "website_landing_page"]) {{$account_info ?? '' != NULL ?$account_info->application_name:"Chef Digital Menu"}}.</p>

                    </div>
                </div>
            </div>
        </div>
        <div class="form-image">
            <div class="l-image">
                <img src="{{asset('img/Key_perspective_matte.png')}}" width="80%;" style="position: absolute; left: 50%; top: 50%;transform: translate(-50%, -50%);">
            </div>
        </div>
    </div>
@endsection







{{--@extends('layouts.app_layout')--}}
{{--@section('content')--}}

{{--    <div class="form-container outer">--}}
{{--        <div class="form-form">--}}
{{--            <div class="form-form-wrap">--}}
{{--                <div class="form-container">--}}
{{--                    <div class="form-content">--}}

{{--                        <h1 class="">Admin {{ __('chef.login') }}</h1>--}}

{{--                        <form class="text-left" method="POST" action="{{ route('login') }}">--}}
{{--                            @csrf--}}
{{--                            @if($errors->any()) @include('admin.admin_layout.form_error') @endif--}}
{{--                            <div class="form">--}}

{{--                                <div id="username-field" class="field-wrapper input">--}}
{{--                                    <label for="email">EMAIL</label>--}}
{{--                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>--}}
{{--                                    <input id="email" type="email" placeholder="{{ __('chef.email') }}" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>--}}
{{--                                    @error('email')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                    @enderror--}}
{{--                                </div>--}}

{{--                                <div id="password-field" class="field-wrapper input mb-2">--}}
{{--                                    <div class="d-flex justify-content-between">--}}
{{--                                        <label for="password">PASSWORD</label>--}}
{{--                                        <a href="{{route('password.request') }}" class="forgot-pass-link">Forgot Password?</a>--}}
{{--                                    </div>--}}
{{--                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>--}}
{{--                                    <input id="password" placeholder="{{ __('Password') }}" type="password" class="form-control"  name="password" required autocomplete="current-password">--}}
{{--                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" id="toggle-password" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>--}}
{{--                                    @error('password')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                    @enderror--}}
{{--                                </div>--}}
{{--                                <div class="custom-control d-flex justify-content-between mb-3">--}}
{{--                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>  {{ __('chef.remember') }}--}}
{{--                                </div>--}}
{{--                                <div class="d-sm-flex justify-content-between">--}}
{{--                                    <div class="field-wrapper">--}}
{{--                                        @csrf--}}
{{--                                        <button type="submit" class="btn btn-primary" value="">Log In</button>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                                <div class="division">--}}
{{--                                    <span>OR</span>--}}
{{--                                </div>--}}

{{--                                <div class="social">--}}
{{--                                    <a href="javascript:void(0);" class="btn social-fb">--}}
{{--                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-facebook"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg>--}}
{{--                                        <span class="brand-name">Facebook</span>--}}
{{--                                    </a>--}}
{{--                                    <a href="javascript:void(0);" class="btn social-github">--}}
{{--                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-github"><path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22"></path></svg>--}}
{{--                                        <span class="brand-name">Github</span>--}}
{{--                                    </a>--}}
{{--                                </div>--}}

{{--                                <p class="signup-link">Not registered ? <a href="auth_register_boxed.html">Create an account</a></p>--}}

{{--                            </div>--}}
{{--                        </form>--}}

{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}


{{--@endsection--}}




