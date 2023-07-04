
    <div class="widget-header">
        <div class="row">
            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                <h4>Whatsapp Notification Setting</h4>
            </div>
        </div>
    </div>

    @if(session()->has("MSG"))
        <div class="alert alert-{{session()->get("TYPE")}}">
            <strong> <a>{{session()->get("MSG")}}</a></strong>
        </div>
    @endif
    @if($errors->any()) @include('admin.admin_layout.form_error') @endif

    <form class="form-horizontal" method="post" action="{{route('update_whatsapp')}}" enctype="multipart/form-data">
        {{csrf_field()}}

        <div class="pl-lg-4">
            <table class="table align-items-left table-flush table-hover">

                <tbody>


                <tr>
                    <td class="table-user">
                        <b>Whatsapp Notification</b>
                    </td>
                    <td>
                        <label class="switch s-info">
                            <input type="checkbox" name="{{$whatsapp[4]->id}}" {{$whatsapp[4]->value ==1 ? "checked":NULL}} >
                            <span class="slider round" data-label-off="Off" data-label-on="On"></span>
                        </label>
                    </td>
                </tr>

                <tr>
                    <td class="table-user">
                        <b>Whatsapp Notification for Store Owners</b>
                    </td>
                    <td>
                        <label class="switch s-info">
                            <input type="checkbox" name="{{$whatsapp[8]->id}}" {{$whatsapp[8]->value ==1 ? "checked":NULL}} >
                            <span class="slider round" data-label-off="Off" data-label-on="On"></span>
                        </label>
                    </td>
                </tr>


                </tbody>
            </table>
            <hr>
            <div class="row">
                <div class="col-lg-12 mb-1">
                    <div class="form-group">
                        <label class="form-control-label" for="input-username">Twillo Whatsapp No:</label>
                        <input type="text"  value="{{$whatsapp[5]->value}}" name="{{$whatsapp[5]->id}}"  class="form-control" placeholder="PhoneCode">
                    </div>
                </div>
                <div class="col-lg-12 mb-1">
                    <div class="form-group">
                        <label class="form-control-label" for="input-username">SandBoxID:</label>
                        <input type="text"  value="{{$whatsapp[6]->value}}" name="{{$whatsapp[6]->id}}" class="form-control" placeholder="SandBoxID">
                    </div>
                </div>
                <div class="col-lg-12 mb-1">
                    <div class="form-group">
                        <label class="form-control-label" for="input-email">SandBoxToken:</label>
                        <input type="text" value="{{$whatsapp[7]->value}}" name="{{$whatsapp[7]->id}}"  class="form-control" placeholder="SandBoxToken">
                    </div>
                </div>


                <div class="col-lg-12">
                    <div class="form-group">
                        <label class="form-control-label" for="input-email">SandBox Trail Text:</label>
                        <input type="text" value="{{$whatsapp[10]->value}}" name="{{$whatsapp[10]->id}}"  class="form-control" placeholder="SandBox Trail Text">
                    </div>
                </div>


            </div>

            <div class="form-group">
                <button type="submit" class="mt-4 btn btn-primary">Save Settings</button>
            </div>
        </div>
    </form>
