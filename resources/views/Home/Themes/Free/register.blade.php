
<header class="rt-site-header default-header rt-fixed-top bg-dark">
    <div class="main-header rt-sticky">
        <nav class="navbar">
            <div class="rt-container">
                <a href="{{route('home')}}" class="brand-logo"><img
                        src={{asset($account_info !=NULL ? $account_info->application_logo:'themes/default_home/images/logo/logo.png')}} alt="" width="175px"></a>
                <a href="{{route('home')}}" class="sticky-logo"><img
                        src={{asset($account_info !=NULL ? $account_info->application_logo:'themes/default_home/images/logo/logo.png')}} alt="" width="175px"></a>
                <div class="ml-auto d-flex align-items-center">
                    <div class="main-menu">
                        <ul>
                            <li><a href="{{route('home')}}">{{$selected_language->data['home'] ?? 'Home'}}</a>

                            </li>
                            <li>
                                <a href="#how">
                                    {{$selected_language->data['how_it_works_1'] ?? 'How It Works'}}
                                </a>
                            </li>
                            <li>
                                <a href="#service">
                                    {{$selected_language->data['service'] ?? 'Service'}}
                                </a>
                            </li>
                            <li>
                                <a href="{{route('store_pricing')}}">
                                    {{$selected_language->data['pricing'] ?? 'Pricing'}}
                                </a>
                            </li>

                            <li class="menu-item-has-children active"><a href="#">{{$selected_language->data['website_pages'] ?? 'Pages'}}</a>
                                <ul class="sub-menu" style="display: none;">
                                    <li><a href="{{route('about')}}">{{$selected_language->data['about_us'] ?? 'About Us'}}</a></li>
                                    <li><a href="{{route('termsandcondition')}}">{{$selected_language->data['termsandcondition'] ?? 'Terms and Condition'}}</a></li>
                                    <li><a href="{{route('privacy')}}">{{$selected_language->data['privacy_policy'] ?? 'Privacy Policy'}}</a></li>
                                    <li><a href="{{route('refund')}}">{{$selected_language->data['refundandcancellation'] ?? 'Refund & Cancellation'}}</a></li>

                                </ul>
                            </li>


                            <li>
                                <a href="{{route('store.login')}}">
                                    {{$selected_language->data['login'] ?? 'Login'}}
                                </a>
                            </li>

                            <li class="current-menu-item">
                                <a href="{{route('store_register')}}">

                                    {{$selected_language->data['register'] ?? 'Register'}}
                                </a>
                            </li>
                            <li class="current-menu-item">
                                <form method="post" action="{{route("change_language")}}">
                                    @csrf
                                    <select class="form-control" name="selected_language" data-width="fit"
                                            onchange="this.form.submit()">
                                        @foreach($languages as $data)
                                            @if(Session::get('selected_language')!=NULL)
                                                <option
                                                    {{Session::get('selected_language') == $data->id ?"selected": null}} value="{{$data->id}}">{{$data->language_name}}</option>

                                            @endif
                                            @if(Session::get('selected_language')==NULL)
                                                <option
                                                    {{$data->is_default == 1 ?"selected": null}} value="{{$data->id}}">{{$data->language_name}}</option>
                                            @endif

                                        @endforeach
                                    </select>
                                </form>
                            </li>
                        </ul>
                    </div><!-- end main menu -->


                    <div class="rt-nav-tolls d-flex align-items-center">


                        <div class="mobile-menu">
                            <div class="menu-click">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </nav>
    </div><!-- /.bootom-header -->
</header>

<br>
<br>
<br>
<br>
<br>
<br>
<br>


<div class="rt-overlay"></div><!-- ./ rt overlay -->








<div class="price-area">
    <div class="rt-container">

        <div class="row">

            <div class="col-lg-12 rt-mb-md-30">
                <form role="form" method="POST" action="{{route('register_new_store')}}" enctype="multipart/form-data" class="rt-form">
                    @if(session()->has("MSG"))
                        <div class="alert alert-{{session()->get("TYPE")}}">
                            <strong> <a>{{session()->get("MSG")}}</a></strong>
                        </div>
                    @endif
                    @if($errors->any()) @include('admin.admin_layout.form_error') @endif
                    {{csrf_field()}}

                    <div class="row">
                        <div class="col-md-6">
                            <label for="storename">Store Name</label>
                            <input class="rt-mb-30 form-control rt-mb-30" type="text" required value="{{old('store_name')}}" name="store_name">
                            <label for="number">Contact Number</label>
                            <input type="text" required value="{{old('phone')}}" name="phone" class="rt-mb-30 form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="email">Email</label>
                            <input type="email" required  name="email" value="{{old('email')}}" class="rt-mb-30 form-control">
                            <label for="pass">Password</label>
                            <input type="text" required name="password" value="{{old('password')}}" class="rt-mb-30 form-control">
                        </div>
                    </div>
                    <!-- end row -->
                    <label>Choose Plan</label>
                        <select name="plan" required>
                            @foreach($subscription as $data)
                                <option value="{{$data->id}}">{{$data->name}} - {{$data->days}} - Days</option>
                            @endforeach
                        </select>



                        <br>
                        <br>
                        <br>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="custom-control custom-control-alternative custom-checkbox">
                                    <input class="custom-control-input" id="customCheckRegister" type="checkbox" required>
                                    <label class="custom-control-label" for="customCheckRegister">
                                        <span class="text-muted">I agree with the <a href="{{route('privacy')}}">Privacy Policy</a></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn-lg btn-primary">Create account</button>
                        </div>
                </form>
            </div>







        </div><!-- /.row -->
    </div><!-- /.rt-container -->
</div>
<div class="rt-spacer-93 rt-spacer-xs-50"></div><!-- /.rt-spacer-93 -->












<section class="rt-site-footer bg_footer2 home-five title_bar_footer rtbgprefix-cover" style="background-image: url(assets/images/all-img/footer-bg4.png);">
    <div class="footer-inner-content">
        <div class="footer-callto">
            <div class="rt-container">
                <div class="row">
                    <div class="col-lg-4 rt-mb-md-20">
                        <div class="media">
                            <img src="{{asset('themes/default/images/all-icon/footer-icon-1.png')}}" class="rt-mr-20" alt="post_image">
                            <div class="media-body text-white">
                                <span class="d-block rt-mb-8 rt-light3 ">{{$selected_language->data['give_us_call'] ?? 'Give us a Call'}}</span>
                                <p class="rt-mb-0 f-size-18 rt-strong">
                                    {{$account_info !=NULL ? $account_info->contact_no:'987654321'}}
                                </p>
                            </div>
                        </div>
                    </div><!-- /.col-lg-4 -->
                    <div class="col-lg-4 rt-mb-md-20">
                        <div class="media">
                            <img src="{{asset('themes/default/images/all-icon/footer-icon-2.png')}}" class="rt-mr-20" alt="post_image">
                            <div class="media-body text-white">
                                <span class="d-block rt-mb-8 rt-light3 ">{{$selected_language->data['send_us_message'] ?? 'Send us a Message'}}</span>
                                <p class="rt-mb-0 f-size-18 rt-strong">
                                    {{$account_info !=NULL ? $account_info->application_email:'a@b.com'}}
                                </p>

                            </div>
                        </div>
                    </div><!-- /.col-lg-4 -->
                    <div class="col-lg-4">
                        <div class="media">
                            <img src="{{asset('themes/default/images/all-icon/footer-icon-3.png')}}" class="rt-mr-20" alt="post_image">
                            <div class="media-body text-white">
                                <span class="d-block rt-mb-8 rt-light3 ">{{$selected_language->data['visit_our_location'] ?? 'Visit our Location'}}</span>
                                <p class="rt-mb-0 f-size-18 rt-strong">
                                    {{$account_info !=NULL ? $account_info->Address:'AAA BBBB CCCC'}}
                                </p>
                            </div>


                        </div>
                    </div><!-- /.col-lg-4 -->
                </div><!-- /.row -->
            </div><!-- /.container -->
        </div><!-- /.footer-callto -->

        <div class="footer-bottom" style="height: 10px;">
            <div class="rt-container">
                <div class="row align-items-center">
                    <div class="col-xl-12text-center text-xl-left">
                        {!! $selected_language->data['crafted_with_love'] ?? 'Crafted with <i class="fa fa-heart text-danger"></i> by' !!}
                        {{$account_info !=NULL ? $account_info->application_name:'CHEF MENU'}}.
                    </div><!-- /.col-lg-4 -->

                </div><!-- /.row -->
            </div><!-- /.container -->
        </div><!-- /.footer-bottom -->
    </div><!-- /.footer-inner-content -->
</section>


