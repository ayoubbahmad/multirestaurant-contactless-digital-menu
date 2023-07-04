<h4>{{$selected_language->data['store_panel_settings_payment'] ?? 'Payment Settings'}}</h4>
<form method="post" id="payment-settings"
      action="{{route('store_admin.update_store_payment_settings')}}">
    {{csrf_field()}}

    <table class="table align-items-left table-flush table-hover">

        <tbody>
        <tr>
            <td class="table-user">
                <b>Cash</b>
            </td>

            <td>
                <label class="switch s-info">
                          <div class="form-check form-switch">
                                <input type="checkbox" class="form-check-input" id="iscod"  {{$store_settings->IsCodEnabled ?? '' == 1 ? "checked":false}} name="IsCodEnabled">

                            </div>
                </label>
            </td>
        </tr>
        <tr>
            <td class="table-user">
                <b>Paypal</b>
            </td>
            <td>
                <label class="switch s-info">
                          <div class="form-check form-switch">
                                <input type="checkbox" class="form-check-input" id="IsPaypalEnabled"  {{$store_settings->IsPaypalEnabled ?? '' == 1 ? "checked":false}} name="IsPaypalEnabled">

                            </div>
                </label>
            </td>
        </tr>

        <tr>
            <td class="table-user">
                <b>Stripe</b>
            </td>
            <td>
                <label class="switch s-info">
                           <div class="form-check form-switch">
                                <input type="checkbox" class="form-check-input" id="IsStripeEnabled"  {{$store_settings->IsStripeEnabled ?? '' == 1 ? "checked":false}} name="IsStripeEnabled">

                            </div>
                </label>
            </td>
        </tr>
        <tr>
            <td class="table-user">
                <b>Razorpay</b>
            </td>
            <td>
                <label class="switch s-info">
                           <div class="form-check form-switch">
                                <input type="checkbox" class="form-check-input" id="customSwitch2" {{$store_settings['IsRazorpayEnabled'] ?? '' == 1  ? "checked":false}} name="IsRazorpayEnabled">

                            </div>
                </label>
            </td>
        </tr>


        <tr>
            <td class="table-user">
                <b>PayStack</b>
            </td>
            <td>
                <label class="switch s-info">
                            <div class="form-check form-switch">
                                <input type="checkbox" class="form-check-input" id="customSwitch1" {{$store_settings['IsPayStackEnabled'] ?? '' == 1  ? "checked":false}} name="IsPayStackEnabled">

                            </div>
                </label>
            </td>
        </tr>

{{-- 
        <tr>
            <td class="table-user">
                <b>MercadoPago</b>
            </td>
            <td>
                <label class="switch s-info">
                        <div class="form-check form-switch">
                                <input type="checkbox" class="form-check-input" id="custo3" {{$store_settings['IsMercadoPagoEnabled'] ?? '' == 1  ? "checked":false}} name="IsMercadoPagoEnabled">

                            </div>
                </label>
            </td>
        </tr> --}}


        </tbody>
    </table>


    <hr>
    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <label class="form-control-label" for="input-username">Currency:</label>
                <select name="StoreCurrency" value="{{$store_settings['StoreCurrency'] ?? ''}}"
                        class="form-control">
                    <option value="">Select Currency</option>
                    @foreach(config('global.currency') as $key => $currency)
                        <option {{($store_settings['StoreCurrency'] ?? '') == $currency ? "selected":null}} {{(($store_settings['StoreCurrency'] ?? '') == "" && $currency == "USD") ? "selected":null }}  value="{{$currency}}">
                            {{$key}}
                        </option>
                    @endforeach

                </select>
            </div>
        </div>

        <div class="col-lg-12">
            <hr>
            <h2 class="text-indigo"> Paypal:</h2>

            <div class="form-group">
                <label class="form-control-label" for="input-email">Paypal Environment :</label>
                <select class="form-control" value="{{$store_settings['PaypalMode'] ?? ''}}"
                        name="PaypalMode">
                    <option
                        value="sandbox" {{($store_settings['PaypalMode'] ?? '') == 'sandbox' ? "selected":NULL}}>
                        Test mode
                    </option>
                    <option
                        value="production" {{($store_settings['PaypalMode'] ?? '') == 'production' ? "selected":NULL}}>
                        Live mode
                    </option>

                </select>

            </div>
        </div>

        <div class="col-lg-12 mt-2 mb-2">
            <div class="form-group">
                <label class="form-control-label" for="input-username">Paypal Client ID:</label>
                <input type="text" name="PaypalKeyId"
                       value="{{$store_settings->PaypalKeyId ?? ''}}" class="form-control"
                       placeholder="Paypal Client ID">
            </div>
        </div>
        <div class="col-lg-12 mb-2">
            <div class="form-group">
                <label class="form-control-label" for="input-email">Paypal Secret Key:</label>
                <input type="text" name="PaypalKeySecret"
                       value="{{$store_settings->PaypalKeySecret ?? ''}}" class="form-control"
                       placeholder="Paypal Secret Key">
            </div>
        </div>


        <div class="col-lg-12">
            <hr>
            <h2 class="text-indigo"> Stripe:</h2>



            <div class="form-group">
                <label class="form-control-label" for="input-username">Stripe Public
                    Key:</label>
                <input type="text" value="{{$store_settings->StripePublishableKey ?? ''}}"
                       name="StripePublishableKey" class="form-control"
                       placeholder="Stripe Public Key">
            </div>
        </div>
        <div class="col-lg-12 mt-2 mb-2">
            <div class="form-group">
                <label class="form-control-label" for="input-email">Stripe Secret Key:</label>
                <input type="text" name="StripeSecretKey"
                       value="{{$store_settings->StripeSecretKey ?? ''}}" class="form-control"
                       placeholder="Stripe Secret Key">
            </div>
        </div>
        <div class="col-lg-12 mb-2">
            <div class="form-group">

                <label class="form-control-label">Show Stripe Postal Code: </label><br>
                <label class="switch s-info">
                          <div class="form-check form-switch">
                                <input type="checkbox" class="form-check-input" id="isstripezip" {{$store_settings->IsStripeZipEnabled ?? '' ? "checked":null}} name="IsStripeZipEnabled">

                            </div>
                </label>
            </div>
        </div>


        <div class="col-lg-12">
            <hr>
            <h2 class="text-indigo">Razorpay:</h2>

            <div class="form-group">
                <label class="form-control-label" for="input-username">Razorpay Key Id</label>
                <input type="text" name="RazorpayKeyId"
                       value="{{$store_settings->RazorpayKeyId ?? ''}}" class="form-control"
                       placeholder="Razorpay Key Id">
            </div>
        </div>
        <div class="col-lg-12 mb-3 mt-2">
            <div class="form-group">
                <label class="form-control-label" for="input-email">Razorpay Key Secret</label>
                <input type="text" name="RazorpayKeySecret"
                       value="{{$store_settings->RazorpayKeySecret ?? ''}}" class="form-control"
                       placeholder="Razorpay Key Secret">
            </div>
        </div>
        <hr>
        {{-----------------------------}}

        <div class="col-lg-12">
            <h2 class="text-indigo">PayStack:</h2>
            <hr>
            <div class="form-group">
                <label class="form-control-label" for="input-username">PayStack Key Id</label>
                <input type="text" name="PayStackPublishableKey"
                       value="{{$store_settings->PayStackPublishableKey ?? ''}}"
                       class="form-control" placeholder="PayStack Key Id">
            </div>
        </div>
        <div class="col-lg-12 mt-2 ">
            <div class="form-group">
                <label class="form-control-label" for="input-email">PayStack Key Secret</label>
                <input type="text" name="PayStackSecretKey"
                       value="{{$store_settings->PayStackSecretKey ?? ''}}" class="form-control"
                       placeholder="PayStack Key Secret">
            </div>
        </div>


{{-- 
        <div class="col-lg-12">
            <hr>
            <h2 class="text-indigo">MercadoPago:</h2>

            <div class="form-group">
                <label class="form-control-label" for="input-username">MercadoPago Secret</label>
                <input type="text" name="MercadoPagoKeySecret"
                       value="{{$store_settings->MercadoPagoKeySecret ?? ''}}"
                       class="form-control" placeholder="MercadoPago Secret">
            </div>
        </div> --}}


        <div class="col-lg-12">
            <div class="form-group" style="margin-top: 15px; padding: 10px;">
                <div class="col-sm-offset-2 col-sm-12">
                    <button type="submit"

                            class="btn btn-default btn-flat m-b-30 m-l-5 bg-primary border-none text-white m-r-5 -btn"
                            style="float: right">Update
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>

