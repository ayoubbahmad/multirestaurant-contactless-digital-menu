
    <div class="widget-header">
        <div class="row">
            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                <h4>Cache Setting</h4>
            </div>
        </div>
    </div>

    @if(session()->has("MSG"))
        <div class="alert alert-{{session()->get("TYPE")}}">
            <strong> <a>{{session()->get("MSG")}}</a></strong>
        </div>
    @endif
    @if($errors->any()) @include('admin.admin_layout.form_error') @endif


    <div class="pl-lg-4">
        <table class="table align-items-left table-flush table-hover">

            <tbody>

            <tr>
                <td class="table-user">
                    <b>Force Clear Cache</b>
                </td>
                <td>
                    <a href="{{route('view_cache')}}" class="btn btn-primary btn-sm">Force Clear Cache</a>
                </td>
            </tr>

            </tbody>
        </table>
    </div>
