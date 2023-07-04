@extends("admin.admin_layout.adminlayout")

@section("admin_content")

<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-12">
            <div class="page-title-box page-title-box-alt">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">

                    </ol>
                </div>
                <h4 class="page-title">Edit Subscription</h4>
            </div>
        </div>
    </div>  
        <div class="layout-px-spacing">
            <div class="row layout-top-spacing">

                <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <h4></h4>
                                    @if(session()->has("MSG"))
                                        <div class="alert alert-{{session()->get("TYPE")}}">
                                            <strong> <a>{{session()->get("MSG")}}</a></strong>
                                        </div>
                                    @endif
                                    @if($errors->any()) @include('admin.admin_layout.form_error') @endif
                                </div>
                            </div>
                        <!-- Card body -->
                            <form  method="post" action="{{route('update_subscription',$id->id)}}" enctype="multipart/form-data">
                            {{csrf_field()}}
                            @method('PATCH')
                            <!-- Form groups used in grid -->
                                <div class="row">

                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label class="form-control-label" for="example3cols2Input">Subscription Name</label>
                                            <input type="text" name="name" value="{{$id->name}}" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="form-control-label" for="example3cols2Input">Subscription Price</label>
                                            <input type="number" name="price" step="any" value="{{$id->price}}" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-control-label" for="example3cols2Input">Subscription Days</label>
                                            <input type="number" name="days" value="{{$id->days}}" class="form-control" value="30" required>
                                        </div>
                                    </div>

                                    <div class="col-md-2 mt-2 mb-2">
                                        <div class="form-group">
                                            <label class="form-control-label">Is active</label><br>
                                            <label class="switch s-primary">
                                                <input type="checkbox" name="is_active"  {{$id->is_active ? 'checked':NULL}}>
                                                <span class="slider round" data-label-off="No" data-label-on="Yes"></span>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-control-label" for="example3cols2Input">Subscription Description</label>
                                            <textarea class="form-control" name="description" class="form-control" required>{{$id->description}}</textarea>
                                        </div>
                                    </div>


                                    <div class="col-md-4 mt-2">
                                        <div class="form-group">
                                            <button class="btn btn-primary" type="submit">Update Subscription</button>
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
