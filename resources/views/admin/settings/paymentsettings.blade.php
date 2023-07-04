
    <div class="widget-header">
        <div class="row">
            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                <h4>Payment Setting</h4>
            </div>
        </div>
    </div>

    @if(session()->has("MSG"))
        <div class="alert alert-{{session()->get("TYPE")}}">
            <strong> <a>{{session()->get("MSG")}}</a></strong>
        </div>
    @endif
    @if($errors->any()) @include('admin.admin_layout.form_error') @endif

    <form class="form-horizontal" method="post" action="{{route('update_payment_settings')}}" enctype="multipart/form-data">
        {{csrf_field()}}

        <div class="pl-lg-4">
          <table class="table align-items-left table-flush table-hover">

              <tbody>

              <tr>
                  <td class="table-user">
                      <b style="color: red">Subscription Page Force Redirect</b>
                  </td>
                  <td>
                      <label class="switch s-danger">
                          <input type="checkbox" name="{{$settings[22]->id}}" {{$settings[22]->value ==1 ? "checked":NULL}} >
                          <span class="slider round" data-label-off="Off" data-label-on="On"></span>
                      </label>
                  </td>
              </tr>



              <tr>
                  <td class="table-user">
                      <b>Cash</b>
                  </td>

                  <td>
                      <label class="switch s-info">
                          <input type="checkbox" checked="" disabled>
                          <span class="slider round" data-label-off="Off" data-label-on="On"></span>
                      </label>
                  </td>
              </tr>


              <tr>
                  <td class="table-user">
                      <b>Paypal</b>
                  </td>
                  <td>
                      <label class="switch s-info">
                          <input type="checkbox" name="{{$settings[18]->id}}" {{$settings[18]->value ==1 ? "checked":NULL}} >
                          <span class="slider round" data-label-off="Off" data-label-on="On"></span>
                      </label>
                  </td>
              </tr>

              <tr>
                  <td class="table-user">
                      <b>Stripe</b>
                  </td>
                  <td>
                      <label class="switch s-info">
                          <input type="checkbox" name="{{$settings[0]->id}}" {{$settings[0]->value ==1 ? "checked":NULL}} >
                          <span class="slider round" data-label-off="Off" data-label-on="On"></span>
                      </label>
                  </td>
              </tr>
              <tr>
                  <td class="table-user">
                      <b>Razorpay</b>
                  </td>
                  <td>
                      <label class="switch s-info">
                          <input type="checkbox" name="{{$settings[11]->id}}" {{$settings[11]->value ==1 ? "checked":NULL}} >
                          <span class="slider round" data-label-off="Off" data-label-on="On"></span>
                      </label>
                  </td>
              </tr>
              </tbody>
            </table>
            <hr>
            <div class="row">
                <div class="col-lg-12 mb-2">
                    <div class="form-group">
                        <label class="form-control-label" for="input-username">Currency:</label>
                        <select name="{{$settings[1]->id}}" value="{{$settings[1]->value ?? ''}}"
                                class="form-control">
                            <option value="">Select Currency</option>
                            @foreach(config('global.currency') as $key => $currency)
                                <option
                                    {{($settings[1]->value ?? '') == $currency ? "selected":null}} value="{{$currency}}"> {{$key}}</option>
                            @endforeach

                        </select>


{{--                                        <input type="text"  value="{{$settings[1]->value}}" name="{{$settings[1]->id}}"  class="form-control" placeholder="Stripe Public Key">--}}
                    </div>
                </div>

                <div class="col-lg-12 mb-2">
                    <hr>
                    <h2 class="text-indigo"> Paypal:</h2>

                    <div class="form-group">
                        <label class="form-control-label" for="input-email">Paypal Environment :</label>
                        <select class="form-control" name="{{$settings[19]->id}}">
                            <option {{($settings[19]->value ?? '') == "sandbox" ? "selected":"" }} value="sandbox">Test mode</option>
                            <option {{($settings[19]->value ?? '') == "production" ? "selected":"" }}  value="production">Live mode</option>

                        </select>

                    </div>
                </div>

                <div class="col-lg-12 mb-2">
                    <div class="form-group">
                        <label class="form-control-label" for="input-username">Paypal Client ID:</label>
                        <input type="text"  value="{{$settings[20]->value}}" name="{{$settings[20]->id}}" class="form-control" placeholder="Paypal Client ID">
                    </div>
                </div>
                <div class="col-lg-12 mb-2">
                    <div class="form-group">
                        <label class="form-control-label" for="input-email">Paypal Secret Key:</label>
                        <input type="text" value="{{$settings[21]->value}}" name="{{$settings[21]->id}}"  class="form-control" placeholder="Paypal Secret Key">
                    </div>
                </div>


                <div class="col-lg-12 mb-2">
                    <hr>
                    <h2 class="text-indigo"> Stripe:</h2>
                    <div class="form-group">
                        <label class="form-control-label" for="input-username">Stripe Public Key:</label>
                        <input type="text"  value="{{$settings[2]->value}}" name="{{$settings[2]->id}}" class="form-control" placeholder="Stripe Public Key">
                    </div>
                </div>
                <div class="col-lg-12 mb-2">
                    <div class="form-group">
                        <label class="form-control-label" for="input-email">Stripe Secret Key:</label>
                        <input type="text" value="{{$settings[3]->value}}" name="{{$settings[3]->id}}"  class="form-control" placeholder="Stripe Secret Key">
                    </div>
                </div>
                <div class="col-lg-12 mb-2">
                    <hr>
                    <h2 class="text-indigo">Razorpay:</h2>
                    <div class="form-group">
                        <label class="form-control-label" for="input-username">Razorpay Key Id</label>
                        <input type="text"  value="{{$settings[12]->value}}" name="{{$settings[12]->id}}" class="form-control" placeholder="Razorpay Key Id">
                    </div>
                </div>
                <div class="col-lg-12 mb-2">
                    <div class="form-group">
                        <label class="form-control-label" for="input-email">Razor pay Key Secret</label>
                        <input type="text" value="{{$settings[13]->value}}" name="{{$settings[13]->id}}"  class="form-control" placeholder="Razorpay Key Secret">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="mt-4 btn btn-primary">Save Settings</button>
            </div>
        </div>
    </form>
