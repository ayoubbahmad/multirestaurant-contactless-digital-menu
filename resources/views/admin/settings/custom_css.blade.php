
    <div class="widget-header">
        <div class="row">
            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                <h4>Custom Css</h4>
                @if(session()->has("MSG"))
                    <div class="alert alert-{{session()->get("TYPE")}}">
                        <strong> <a>{{session()->get("MSG")}}</a></strong>
                    </div>
                @endif
                @if($errors->any()) @include('admin.admin_layout.form_error') @endif
            </div>
        </div>
    </div>



    <form class="form-horizontal" method="post" action="{{route('update_customcss')}}" enctype="multipart/form-data">
        {{csrf_field()}}

        <div class="pl-lg-4">
            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group">
                        <label class="form-control-label" for="input-username">Below code will affect the styling for the Customer Application</label>
                        <p>
                            <b>example:</b> <small style="color: #98989b">.item-full-bottom-v2<br>
                            { color:#000000 !important; }
                            </small>
                        </p>
                        <textarea class="form-control" rows="8" wrap="off" autocapitalize="off" spellcheck="false" name="{{$customcss[17]->id}}">{{$customcss[17]->value}}</textarea>

                    </div>
                </div>

            </div>

            <div class="form-group">
                <button type="submit" class="mt-4 btn btn-primary">Save Settings</button>
            </div>
        </div>
    </form>
