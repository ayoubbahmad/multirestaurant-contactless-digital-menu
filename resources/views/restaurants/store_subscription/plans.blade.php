@extends("restaurants.layouts.restaurants_layout")

@section("restaurant_content")
    <style>
        .razorpay-payment-button {
            background-color: #10c469;
            border-color: #10c469;
            padding: 0.4375rem 1.25rem;
            text-shadow: none;
            font-weight: normal;
            white-space: normal;
            word-wrap: break-word;
            touch-action: manipulation;
            will-change: opacity, transform;
            color: white;
            border-style: none;
            border-radius: 3px;
        }
    </style>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box page-title-box-alt">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <button onclick="event.preventDefault(); document.getElementById('add_new').submit();"
                            class="btn btn-sm btn-primary btn-round btn-icon" data-toggle="tooltip"
                            data-original-title="History">
                        <span
                            class="btn-inner--text">{{$selected_language->data['store_panel_plan_history'] ?? 'History'}}</span>
                    </button>
                    <form action="{{route('store_admin.subscription_history')}}" method="get"
                          id="add_new">

                    </form>
                        </ol>
                    </div>
                    <h4 class="page-title">{{$selected_language->data['store_sidebar_subscription_plans'] ?? 'Subscription Plans'}}</h4>
                </div>
            </div>
        </div>

        <div class="row layout-top-spacing layout-spacing">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <h4>{{$selected_language->data['store_panel_plan_available'] ?? 'Available Plans'}}
                                    - {{$subscription_count}}</h4>
                            </div>
                            <div class="col-6 text-right mt-2">

                            </div>
                        </div>
                        <div class="table-responsive">
                            @if(session()->has("MSG"))
                                <div class="alert alert-{{session()->get("TYPE")}}">
                                    <strong> <a>{{session()->get("MSG")}}</a></strong>
                                </div>
                            @endif
                            @php
                                Session::forget('MSG')
                            @endphp
                            <table id="datatable" class="table table-hover" style="width:100%">
                                <thead>
                                <tr>
                                    <th>{{$selected_language->data['store_panel_common_no'] ?? 'No'}}</th>
                                    <th>{{$selected_language->data['store_panel_common_name'] ?? 'Name'}}</th>
                                    <th>{{$selected_language->data['store_panel_common_price'] ?? 'Price'}}</th>
                                    <th>{{$selected_language->data['store_panel_plan_no_of_days'] ?? 'No of Days'}}</th>
                                    <th class="no-content">{{$selected_language->data['store_panel_plan_complete_payment'] ?? 'Compete Payment'}}</th>
                                </tr>
                                </thead>
                                <tbody>

                                @php $i=1 @endphp
                                @foreach($subscription as $data)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{$data->name}}</td>
                                        <td>@include('layouts.render.currency', ['amount' => $data->price]) </td>
                                        <td>
                                            <span
                                                class="badge badge-danger">{{$data->days}} {{$selected_language->data['store_panel_plan_days'] ?? 'Days'}}</span>
                                        </td>
                                        <td>

                                            <button
                                                {{$isPaypalEnabled!=1 ?"disabled":NULL}} onclick="triggerPaypalPayment({{$data->id}},'{{$data->name}}','{{ for_payment_round($data->price)}}','{{strtoupper($currency)}}')"
                                                class="btn btn-success btn-sm text-white">Paypal
                                            </button>
                                            <button
                                                {{$isStripeEnabled!=1 ?"disabled":NULL}} onclick="triggerStripePayment({{$data->id}})"
                                                class="btn btn-success btn-sm text-white">Stripe
                                            </button>
                                            @if($razorpayEnabled == 1)
                                                <button class="btn btn-success text-white"
                                                        style="border: none;background: none;color: inherit;border: none;padding: 0;font: inherit;cursor: pointer;outline: inherit;">
                                                    <form
                                                        action="{{ route('store_admin.subscription_razorpay_complete_payment') }}"
                                                        method="POST" id="razorpay-payment">
                                                        @csrf
                                                        <input type="hidden" name="selected_plan" value="{{$data->id}}">
                                                        <script src="https://checkout.razorpay.com/v1/checkout.js"

                                                                data-key={{$razorpay_key_id}}
                                                                    data-amount={{(explode('.', for_payment_round($data->price))[0]).(explode('.', for_payment_round($data->price))[1])}}
                                                                    data-currency={{strtoupper($currency)}}
                                                                    data-buttontext="Razorpay"

                                                                data-name={{$data->name}}
                                                                    data-description="Razorpay"
                                                                data-button_theme="btn btn-success"
                                                                data-image="{{ asset($logo) }}"
                                                                data-prefill.name="{{ auth()->user()->store_name}}"
                                                                data-prefill.email={{auth()->user()->email}}
                                                        >
                                                        </script>
                                                    </form>
                                                </button>


                                            @else
                                                {{--                                    <button disabled class="btn btn-success btn-sm text-white">Razorpay</button>--}}
                                            @endif
                                            {{--                                onclick="document.getElementById('form-subscription-{{$data->id}}').submit();"--}}
                                        </td>
                                        <form method="post" id="form-subscription-{{$data->id}}"
                                              action="{{route('store_admin.subscription_complete_payment')}}">
                                            <input name="plan_id" value="{{$data->id}}" style="visibility:hidden"
                                                   type="hidden"/>
                                            @csrf
                                        </form>
                                    </tr>

                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        @include('restaurants.store_subscription.render.paypal_plans', ['data'=>$subscription])
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script src={{asset("assets/js/lib/jquery.min.js")}}></script>
    <script src="https://www.paypalobjects.com/api/checkout.js"></script>
    <script>
        function triggerPaypalPayment(id, name, price, currency) {
            $("#modal-payment-" + id).modal("show")
            renderPaypalPayment(id, name, price, currency)
        }

        function renderPaypalPayment(id, name, price, currency) {
            if (!document.getElementById("paypal-button-container-" + id).getElementsByTagName("div")[0]) {
                paypal.Button.render({
                    // Configure environment
                    env: '{{$paypalMode}}',
                    client: {
                        sandbox: '{{$paypalKeyId}}',
                        production: '{{$paypalKeyId}}'
                    },
                    // Customize button (optional)
                    locale: 'en_US',
                    style: {
                        fundingicons: 'true',
                        size: 'responsive'
                    },
                    funding: {
                        allowed: [paypal.FUNDING.CARD],
                        disallowed: [paypal.FUNDING.CREDIT]
                    },
                    commit: true,
                    payment: function (data, actions) {
                        return actions.payment.create({
                            transactions: [{
                                amount: {
                                    total: price,
                                    currency: currency
                                }
                            }]
                        });
                    },
                    onAuthorize: function (data, actions) {
                        return actions.payment.execute().then(function () {
                            console.log(data)
                            let form = document.createElement("form")
                            form.method = "post"
                            form.action = '{{route('store_admin.subscription_paypal_complete_payment')}}'
                            let csrf = document.createElement("input")
                            let plan_id = document.createElement("input")
                            let payment = document.createElement("input")
                            csrf.name = "_token"
                            csrf.value = "{{csrf_token()}}"
                            csrf.type = "hidden"
                            form.append(csrf)
                            plan_id.name = "plan_id"
                            plan_id.value = id
                            plan_id.type = "hidden"
                            form.append(plan_id)
                            payment.name = "payment"
                            payment.value = JSON.stringify(data)
                            payment.type = "hidden"
                            form.append(payment)
                            document.body.appendChild(form);
                            form.submit();
                            // route('subscription_paypal_complete_payment')
                        });
                    }
                }, "#paypal-button-container-" + id);
            }
        }
    </script>


@endsection
