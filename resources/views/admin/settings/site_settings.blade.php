
    <div class="widget-header">
        <div class="row">
            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                <h4>Site Settings</h4>
            </div>
        </div>
    </div>

    @if(session()->has("MSG"))
        <div class="alert alert-{{session()->get("TYPE")}}">
            <strong> <a>{{session()->get("MSG")}}</a></strong>
        </div>
    @endif
    @if($errors->any()) @include('admin.admin_layout.form_error') @endif

    <form class="form-horizontal" method="post" action="{{route('update_settings')}}" enctype="multipart/form-data">
        {{csrf_field()}}

        <div class="pl-lg-4">
            <div class="row">
                <div class="col-lg-12 mb-2">
                    <div class="form-group">
                        <label class="form-control-label" for="input-username">Application Name</label>
                        <input type="text" value="{{$account_info !=NULL?$account_info->application_name:NULL}}" name="application_name" class="form-control" placeholder="Application Name" required>
                    </div>
                </div>
                <div class="col-lg-12 mb-2">
                    <div class="form-group">
                        <label class="form-control-label" for="input-email">Email address</label>
                        <input type="email" value="{{$account_info !=NULL?$account_info->application_email:NULL}}" name="application_email" class="form-control" placeholder="Email address" required>
                    </div>
                </div>
                <div class="col-lg-12 mb-2">
                    <div class="form-group">
                        <label class="form-control-label" for="input-email">Theme Id</label>
                        <select class="form-control" name="theme_id" required>
                            @if($account_info)
                            @foreach($modules as $module)
                                <option value="{{ $module->module_id }}" {{$account_info->theme_id ==$module->module_id ? "selected":null }}>{{ $module->name }}</option>
                            @endforeach
                            @endif
                        </select>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 mb-2">
                    <div class="form-group">
                        <label class="form-control-label" for="input-first-name"> Currency symbol</label>
                        <input type="text"  class="form-control" placeholder="Currency symbol(default : ₹)" value="{{$account_info !=NULL?$account_info->currency_symbol:NULL}}" name="currency_symbol" required />
                    </div>
                </div>

                <div class="col-lg-12 mb-2">
                    <div class="form-group">
                        <label class="form-control-label" for="input-first-name"> Currency Location</label>
                        <select name="currency_symbol_location"  class="form-control">
                            <option value="left" {{($account_info !=NULL?$account_info->currency_symbol_location:NULL) == "left" ?"selected":"" }}>Left</option>
                            <option value="right" {{($account_info !=NULL?$account_info->currency_symbol_location:NULL) == "right" ?"selected":"" }}>Right</option>
                        </select>

                    </div>
                </div>


                <div class="col-lg-12 mb-2">
                    <div class="form-group">
                        <label class="form-control-label" for="input-last-name">Decimal Digits</label>
                        <input type="number" name="decimal_digits" value="{{$account_info !=NULL? $account_info->decimal_digits:NULL}}" class="form-control" placeholder="Decimal Digits" required>
                    </div>
                </div>


                <div class="col-lg-12 mb-2">
                    <div class="form-group">
                        <label class="form-control-label" for="input-last-name">Contact No</label>
                        <input type="number" name="contact_no" value="{{$account_info !=NULL? $account_info->contact_no:NULL}}" class="form-control" placeholder="Contact No" required>
                    </div>
                </div>
                <div class="col-lg-12 mb-2">
                    <div class="form-group">
                        <label class="form-control-label">Logo</label><span class="text-danger">(size: 292px * 69px)</span>
                        <input type="file" name="application_logo" readonly="readonly" class="form-control ui-autocomplete-input" placeholder="Application Logo ()" autocomplete="off" required>
                    </div>
                </div>


                <div class="col-lg-12 mb-2">
                    <div class="form-group">
                        <label class="form-control-label">Fav Icon  : <span class="text-danger">(size: 80px * 80px)</span>  <a target="_blank" href={{asset($account_info['fav_icon'] == null ? 'themes/default/images/all-img/fav.png': $account_info['fav_icon'])}}><b class="text-{{$account_info['fav_icon'] == null ? "danger" : "primary"}}"> {{$account_info['fav_icon'] == null ? "Download Sample" : " View Uploaded Image"}}</b></a> </label>
                        <input type="file" name="fav_icon" readonly="readonly" class="form-control ui-autocomplete-input" placeholder="Fav Icon" autocomplete="off" required>
                    </div>
                </div>


                <div class="col-lg-12 mb-2">
                    <div class="form-group">
                        <label class="form-control-label"> Qr Code  : <span class="text-danger">(size: 331px * 334px)</span> <a target="_blank" href={{asset($account_info['qrcode_img'] == null ? 'themes/default/images/all-img/product-2.png': $account_info['qrcode_img'])}} ><b class="text-{{$account_info['qrcode_img'] == null ? "danger" : "primary"}}"> {{$account_info['qrcode_img'] == null ? "Download Sample" : " View Uploaded Image"}}</b></a> </label>
                        <input type="file" name="qrcode_img" readonly="readonly" class="form-control ui-autocomplete-input" placeholder="Qr Code" autocomplete="off" required>
                    </div>
                </div>

                <div class="col-lg-12 mb-2">
                    <div class="form-group">
                        <label class="form-control-label">Mobile Mockup  : <span class="text-danger">(size: 409px * 712px)</span> <a target="_blank"  href={{asset($account_info['mobile_img'] == null ? 'themes/default/images/banner/mbl-mockup-1.png': $account_info['mobile_img'])}}><b class="text-{{$account_info['mobile_img'] == null ? "danger" : "primary"}}"> {{$account_info['mobile_img'] == null ? "Download Sample" : " View Uploaded Image"}}</b></a> </label>
                        <input type="file" name="mobile_img" readonly="readonly" class="form-control ui-autocomplete-input" placeholder="Mobile Mockupp" autocomplete="off" required>
                    </div>
                </div>


                <div class="col-lg-12 ">


                    <table>
                        <tbody class="justify-content-center">

                        <tr>
                            <td class="table-user">
                                Reviews Section <font color="red">Enable/Disable</font>
                            </td>
                            <td></td>
                            <td class="container d-flex h-100">

                                    <label class="switch s-info row justify-content-center align-self-center">
                                        <input  name="is_review_enable" type="checkbox" {{$account_info['is_review_enable'] ?? '' == 1  ? "checked":false}} >
                                        <span class="slider round" data-label-off="Off" data-label-on="On"></span>
                                    </label>


                            </td>
                        </tr>


                        <tr>
                            <td class="table-user">
                                How its Work Section <font color="red">Enable/Disable</font>
                            </td>
                            <td></td>

                            <td>
                                <label class="switch s-info">
                                    <input name="is_how_its_work_enable" type="checkbox"  {{$account_info['is_how_its_work_enable'] ?? '' == 1  ? "checked":false}} >
                                    <span class="slider round" data-label-off="Off" data-label-on="On"></span>
                                </label>

                            </td>
                        </tr>


                        <tr>
                            <td class="table-user">
                                PlayStore Icon <font color="red">Enable/Disable</font>
                            </td>
                            <td width="20%"></td>
                            <td>

                                <label class="switch s-info">
                                    <input type="checkbox"  {{$account_info['is_playstore_enable'] ?? '' == 1  ? "checked":false}} name="is_playstore_enable" >
                                    <span class="slider round" data-label-off="Off" data-label-on="On"></span>
                                </label>
                            </td>
                        </tr>
                        </tbody>
                    </table>


                </div>
            </div>

            <br>
        </div>

        <div class="col-lg-12 mb-2">
            <div class="form-group">
                <label class="form-control-label" for="input-last-name">Play Store Link</label>
                <input type="url" name="playstore_link" value="{{$account_info !=NULL? $account_info->playstore_link:NULL}}" class="form-control" placeholder="Play Store Link">
            </div>
        </div>


        <div class="col-lg-12 ">
            <div class="form-group">
                <label class="form-control-label">Address</label>
                <textarea rows="4" name="address" class="form-control" >{{$account_info !=NULL?$account_info->Address:NULL}}</textarea>
            </div>
        </div>


        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="mt-4 btn btn-primary">Update</button>
            </div>
        </div>
    </form>
