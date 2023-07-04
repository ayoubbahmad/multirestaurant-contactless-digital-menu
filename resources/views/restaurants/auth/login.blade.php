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
                             @include('layouts.render.translation',["key" => "restaurant", "default"=> "website_landing_page"]) </span></a> </h2>

                        <p class="signup-link">    @include('layouts.render.translation',["key" => "new_here", "default"=> "website_landing_page"])<a href="{{route('store_register')}}">@include('layouts.render.translation',["key" => "create_a_account", "default"=> "website_landing_page"])</a></p>
                            <form class="text-left" method="POST" action="{{ route('store.login') }}">
                                @csrf
                                @if(session()->has("MSG"))
                                    <div class="alert alert-{{session()->get("TYPE")}}">
                                        <strong> <a>{{session()->get("MSG")}}</a></strong>
                                    </div>
                                @endif
{{--                                @if($errors->any()) @include('admin.admin_layout.form_error') @endif--}}
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
                                    <a href="{{route('store.password.request') }}" class="forgot-pass-link">@include('layouts.render.translation',["key" => "forgot_password", "default"=> "website_landing_page"])</a>
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
