

    <h4 class="mb-4"> {{$selected_language->data['store_panel_settings_site'] ?? 'Site Settings'}}</h4>


    <div class="row">
        <div class="col-lg-6 mb-2">
            <div class="form-group">
                <label class="form-control-label" for="input-username">{{$selected_language->data['store_panel_settings_store_name'] ?? 'Store Name'}}</label>
                <input type="text" name="store_name" class="form-control"
                       value="{{$store->store_name}}" placeholder="Store Name" required>
            </div>
        </div>
        <div class="col-lg-6 mb-2">
            <div class="form-group">
                <label class="form-control-label" for="input-email">{{$selected_language->data['store_panel_settings_email_address'] ?? 'Email Address'}}</label>
                <input type="email" name="email" class="form-control"
                       value="{{$store->email}}" placeholder="Email address" required>
            </div>
        </div>

        <div class="col-lg-6 mb-2">
            <div class="form-group">
                <label class="form-control-label" for="input-username">{{$selected_language->data['store_panel_settings_new_password'] ?? 'New Password'}}</label>
                <input type="password" name="password" class="form-control"
                       placeholder="New Password">
            </div>
        </div>
        <div class="col-lg-6 mb-2">
            <div class="form-group">
                <label class="form-control-label" for="input-first-name">
                    {{$selected_language->data['store_panel_settings_phone_number'] ?? 'Phone Number'}}
                    <small>{{$selected_language->data['store_panel_settings_phone_number_msg'] ?? '(with country code:Eg:+91)'}}</small></label>
                <input type="text" class="form-control" value="{{$store->phone}}"
                       placeholder="Phone Number(with country code:Eg:+91)" name="phone"
                       required/>
            </div>
        </div>

        <div class="col-lg-6 mb-2">
            <div class="form-group">
                <label class="form-control-label text-danger">{{$selected_language->data['store_panel_settings_store_logo'] ?? 'Store Logo (358px X 358px)'}}</label>
                <input type="file" name="logo_url"
                       class="form-control ui-autocomplete-input"
                       placeholder="Application Logo ()" autocomplete="off">
            </div>
        </div>

        <div class="col-lg-6 mb-2">
            <div class="form-group">
                <label class="form-control-label" for="input-first-name">{{$selected_language->data['store_panel_settings_subscription_end_date'] ?? 'Subscription end date'}}</label>
                <input type="text" class="form-control"
                       value="{{$store->subscription_end_date}}" readonly disabled/>
            </div>
        </div>

        <div class="col-lg-3 mb-2">
            <div class="form-group">
                <label class="form-control-label" for="input-first-name">{{$selected_language->data['store_panel_settings_store_currency'] ?? 'Store Currency'}}</label>
                <input type="text" name="currency_symbol" class="form-control"
                       value="{{$store->currency_symbol ?? ''}}"/>
            </div>
        </div>

        <div class="col-lg-3 mb-2">
            <div class="form-group">
                <label class="form-control-label" for="input-first-name">{{$selected_language->data['store_panel_settings_store_service_charge'] ?? 'Store Service Charge'}}</label>
                <input type="text" name="service_charge" class="form-control"
                       value="{{$store->service_charge ?? ''}}"/>
            </div>
        </div>
        <div class="col-lg-3 mb-2">
            <div class="form-group">
                <label class="form-control-label" for="input-first-name">{{$selected_language->data['store_panel_settings_store_tax'] ?? 'Store Tax(%)'}}</label>
                <input type="text" name="tax" class="form-control"
                       value="{{$store->tax ?? ''}}"/>
            </div>
        </div>
        <div class="col-lg-3 mb-2">
            <div class="form-group">
                <label class="form-control-label" for="input-first-name">{{$selected_language->data['store_panel_settings_delivery_charge'] ?? 'Delivery Charge'}}</label>
                <input type="text" name="delivery_charge" class="form-control"
                       value="{{$store->delivery_charge ?? ''}}"/>
            </div>
        </div>
        <div class="col-lg-6 mb-2">
            <div class="form-group">
                <label class="form-control-label">{{$selected_language->data['store_panel_settings_address'] ?? 'Address'}}</label>
                <textarea rows="4" name="address" class="form-control"
                          required>{{$store->address}}</textarea>
            </div>
        </div>

        <div class="col-lg-6 mb-2">
            <div class="form-group">
                <label class="form-control-label">{{$selected_language->data['store_panel_settings_description'] ?? 'Description'}}</label>
                <textarea rows="4" name="description" class="form-control"
                          required>{{$store->description}}</textarea>
            </div>
        </div>

    </div>


    <div class="form-group" style="margin-top: 15px; padding: 10px;">
        <div class="col-sm-offset-2 col-sm-12">
            <button type="submit"
                    class="btn text-white btn-default btn-flat m-b-30 m-l-5 bg-primary border-none m-r-5 -btn"
                    style="float: right">{{$selected_language->data['store_panel_common_update'] ?? 'Update'}}
            </button>
        </div>
    </div>



