

    <div class="widget-header pt-0">
        <div class="row">
            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                <h4>Account Setting</h4>
            </div>
        </div>
    </div>

    @if(session()->has("MSG"))
        <div class="alert alert-{{session()->get("TYPE")}}">
            <strong> <a>{{session()->get("MSG")}}</a></strong>
        </div>
    @endif
    @if($errors->any()) @include('admin.admin_layout.form_error') @endif

    <form class="form-horizontal" method="post" action="{{route('update_account_settings')}}" enctype="multipart/form-data">
        {{csrf_field()}}

        <div class="pl-lg-4">
            <div class="row">
                <div class="col-lg-12 mb-2">
                    <div class="form-group">
                        <label class="form-control-label" for="input-username">Name:</label>
                        <input type="text" required value="{{auth()->user()->name}}" name="name"  class="form-control" placeholder="Name">
                    </div>
                </div>
                <div class="col-lg-12 mb-2">
                    <div class="form-group">
                        <label class="form-control-label" for="input-username">Email:</label>
                        <input type="email" required value="{{auth()->user()->email}}"  name="email" class="form-control" placeholder="Email">
                    </div>
                </div>
                <div class="col-lg-12 ">
                    <div class="form-group">
                        <label class="form-control-label" for="input-email">Change Password:</label>
                        <input type="text" value="" name="password"  class="form-control" placeholder="New Password">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="mt-4 btn btn-primary">Save Settings</button>
            </div>
        </div>
    </form>
