

@extends("admin.admin_layout.adminlayout")

@section("admin_content")


    <div id="content" class="main-content">
        <div class="layout-px-spacing">

            <div class="row layout-top-spacing layout-spacing">
                <div class="col-lg-12">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-header">
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <h4 class="mb-0">Update Slider <small>(recommended: 425px x 425px)</small></h4>
                                    @if(session()->has("MSG"))
                                        <div class="alert alert-{{session()->get("TYPE")}}">
                                            <strong> <a>{{session()->get("MSG")}}</a></strong>
                                        </div>
                                    @endif
                                    @if($errors->any()) @include('admin.admin_layout.form_error') @endif
                                </div>
                            </div>
                        </div>
                        <!-- Card body -->
                        <div class="card-body">
                            <form class="form-horizontal" method="post" action="{{route('update_slider',['id'=>$data->id])}}" enctype="multipart/form-data">
                                @method('PATCH')
                            {{csrf_field()}}
                            <!-- Form groups used in grid -->
                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-control-label" for="example3cols1Input">Photo</label>
                                            <div class="custom-file">
                                                <input name="photo_url" class="file-name input-flat ui-autocomplete-input" type="file" readonly="readonly" placeholder="Browses photo" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-control-label" for="example3cols2Input">Slider Name</label>
                                            <input type="text" value="{{$data->name}}" name="name" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-control-label" for="exampleFormControlSelect1">Visibility</label>
                                            <select class="form-control" name="is_visible" required>
                                                <option value="1" {{$data->is_visible == 1 ? "selected":NULL}}>Visible</option>
                                                <option value="0" {{$data->is_visible == 0 ? "selected":NULL}}>Hidden</option>
                                            </select>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button class="btn btn-primary" type="submit">{{$selected_language->data['store_panel_common_submit'] ?? 'Submit'}}</button>
                                        </div>
                                    </div>


                                </div>

                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


