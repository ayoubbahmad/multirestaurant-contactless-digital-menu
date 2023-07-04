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
                <h4 class="page-title">Uploaded Modules</h4>
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
                                </div>
                            </div>

                        <table class="table text-center">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Module Id</th>
                                    <th>Version</th>
                                    <th>Category</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <form  method="post" action="{{route('install_modules')}}" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                    {!! $TH1PMsg !!}
                                </form>

                                <form  method="post" action="{{route('install_modules')}}" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                    {!! $M2PDMsg !!}
                                </form>
                            </tbody>
                        </table>

                        </div>
                    </div>
            </div>
        </div>
    </div>



@endsection
