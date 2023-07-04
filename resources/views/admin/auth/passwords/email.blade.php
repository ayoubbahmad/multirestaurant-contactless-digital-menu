



@extends('layouts.app_layout')
@section('content')

    <div class="form-container">
        <div class="form-form">
            <div class="form-form-wrap">
                <div class="form-container">
                    <div class="form-content">

                        <h2 class=""> <a href=""> <span class="text-primary">  @include('layouts.render.translation',["key" => "admin", "default"=> "website_landing_page"])</span></a> @include('layouts.render.translation',["key" => "password_recovery", "default"=> "website_landing_page"])</h2>
                        <p class="signup-link">@include('layouts.render.translation',["key" => "enter_your_email_and_instructions_will_sent_to_you", "default"=> "website_landing_page"]) </p>
                        <form class="text-left" method="POST" action="{{ route('password.email') }}">

                            @csrf

                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <div class="form">

                                <div id="email-field" class="field-wrapper input">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-at-sign"><circle cx="12" cy="12" r="4"></circle><path d="M16 8v5a3 3 0 0 0 6 0v-1a10 10 0 1 0-3.92 7.94"></path></svg>
                                    <input id="email" type="email" placeholder=" @include('layouts.render.translation',["key" => "email_address", "default"=> "website_landing_page"])" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus >
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror


                                </div>
                                <div class="d-sm-flex justify-content-between">
                                    <div class="field-wrapper">
                                        <button type="submit" class="btn btn-primary" value=""> @include('layouts.render.translation',["key" => "reset", "default"=> "website_landing_page"])  </button>
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







