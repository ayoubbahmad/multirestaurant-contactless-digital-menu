
    <div class="widget-header">
        <div class="row">
            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                <h4>Pages</h4>
            </div>
        </div>
    </div>

    @if(session()->has("MSG"))
        <div class="alert alert-{{session()->get("TYPE")}}">
            <strong> <a>{{session()->get("MSG")}}</a></strong>
        </div>
    @endif
    @if($errors->any()) @include('admin.admin_layout.form_error') @endif

    <form class="form-horizontal" method="post" action="{{route('update_privacy_policy')}}" enctype="multipart/form-data">
        {{csrf_field()}}


        <div class="pl-lg-4">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-title-2">
                        <h4>Privacy Policy</h4>
                    </div>
                    <div class="form-group">
                        <textarea class="ckeditor form-control" name="{{$privacy[9]->id}}">{{$privacy[9]->value}}</textarea>

                    </div>
                    <div class="card-title-2">
                        <h4>About Us</h4>
                    </div>
                    <div class="form-group">
                        <textarea class="ckeditor form-control" name="{{$privacy[14]->id}}">{{$privacy[14]->value}}</textarea>

                    </div>
                    <div class="card-title-2">
                        <h4>Terms and Condition</h4>
                    </div>

                    <div class="form-group">
                        <textarea class="ckeditor form-control" name="{{$privacy[15]->id}}">{{$privacy[15]->value}}</textarea>

                    </div>

                    <div class="card-title-2">
                        <h4>Refund & Cancellation</h4>
                    </div>
                    <div class="form-group">
                        <textarea class="ckeditor form-control" name="{{$privacy[16]->id}}">{{$privacy[16]->value}}</textarea>

                    </div>
                </div>


            </div>

            <div class="form-group">
                <button type="submit" class="mt-4 btn btn-primary">Save Settings</button>
            </div>
        </div>
    </form>


    <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
    <script type="text/javascript">
    $(document).ready(function () {
    $('.ckeditor').ckeditor();
    });
    </script>
