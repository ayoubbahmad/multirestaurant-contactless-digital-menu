


@extends('layouts.app_layout')
@section('content')

    <div class="form-container">
        <div class="form-form">
            <div class="form-form-wrap">
                <div class="form-container">
                    <div class="form-content">

                        <h2 class=""> <a href=""> <span class="text-primary">  @include('layouts.render.translation',["key" => "restaurant", "default"=> "website_landing_page"])</span></a> @include('layouts.render.translation',["key" => "password_recovery", "default"=> "website_landing_page"])</h2>
                        <p class="signup-link">@include('layouts.render.translation',["key" => "enter_your_new_credentials", "default"=> "website_landing_page"]) </p>
                        <form class="text-left" method="POST" action="{{ route('store.password.update') }}">

                            @csrf

                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <div class="form">


{{--                                 --}}

                                    <input  id="email" type="hidden" placeholder="@include('layouts.render.translation',["key" => "email_address", "default"=> "website_landing_page"])"
                                           value="{{ $email ?? old('email') }}"
                                           class="form-control @error('email') is-invalid @enderror" name="email"
                                           required autocomplete="email" autofocus>







                                <div id="password-field" class="field-wrapper input mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                                    <input type="hidden" name="token" value="{{ $token }}">
                                    <input id="password" placeholder="@include('layouts.render.translation',["key" => "password", "default"=> "website_landing_page"])" type="password" class="form-control @error('password') is-invalid @enderror @error('email') is-invalid @enderror" name="password" required autocomplete="new-password">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                      @enderror

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div id="password-field" class="field-wrapper input mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                                    <input type="hidden" name="token" value="{{ $token }}">
                                    <input id="password-confirm" placeholder="@include('layouts.render.translation',["key" => "confirm_password", "default"=> "website_landing_page"])" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">


                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="d-sm-flex justify-content-between">
                                    <div class="field-wrapper">
                                        <button type="submit" class="btn btn-primary" value=""> @include('layouts.render.translation',["key" => "reset_password", "default"=> "website_landing_page"])  </button>
                                    </div>
                                </div>

                            </div>
                        </form>
                        <p class="terms-conditions">@include('layouts.render.translation',["key" => "copy_right_text", "default"=> "website_landing_page"]) <a href="#">{{$account_info ?? '' != NULL ?$account_info->application_name:"Chef Digital Menu"}}</a> @include('layouts.render.translation',["key" => "is_a_product_of", "default"=> "website_landing_page"]) {{$account_info ?? '' != NULL ?$account_info->application_name:"Chef Digital Menu"}}.</p>

                    </div>
                </div>
            </div>
        </div>
        <div class="form-image">
            <div class="l-auth">
                <img src="{{asset('img/shield.png')}}" width="80%;" style="position: absolute; left: 50%; top: 50%;transform: translate(-50%, -50%);">
            </div>
        </div>
    </div>

@endsection









