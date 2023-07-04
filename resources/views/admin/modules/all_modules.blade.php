@extends("admin.admin_layout.adminlayout")

@section("admin_content")

    <style>
        .orders-not-found {
            height: calc(100vh - 266px);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }
    </style>
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-12">
                <div class="page-title-box page-title-box-alt">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <a href="{{route('uploaded_modules')}}" class="btn btn-primary" data-toggle="tooltip" data-original-title="Uploaded Modules">
                                <span class="">Uploaded Modules</span>
                            </a>
                        </ol>
                    </div>
                    <h4 class="page-title">Premium Modules List</h4>
                </div>
            </div>
        </div>  
        <div class="layout-px-spacing">
            <div class="row layout-top-spacing">

                <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <form action="{{route('install_modules')}}" enctype="multipart/form-data" method="POST">
                                @csrf
                                <div class="col-12">
                                    <input type="file" name="module" class="dropify" data-height="250" data-max-file-size="3M" data-allowed-file-extensions="zip"/>
                                </div>
                                <div class="col-6 text-right">
                                    <button type="submit" class="btn btn-primary my-2">Upload</button>
                                </div>
                                </form>
                            </div>
                        <div class="table-responsive mb-4 mt-4">
                            @if($modules->count() > 0)

                                    <table id="zero-config" class="table" style="width:100%">
                                        <thead class="thead-light">
                                        <tr>
                                            <th scope="col">Name</th>
                                            <th scope="col">Module Id</th>
                                            <th scope="col">Version</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($modules as $data)
                                        <tr>
                                            <td>{{$data->name}}</td>
                                            <td>{{$data->module_id}}</td>
                                            <td>{{$data->version}}</td>
                                            <td>
                                             <a href="{{url('/admin/dashboard/modules/waiter/settings')}}"> <button class="btn btn-sm btn-warning mb-1">Settings</button></a>

                                            </td>
                                        </tr>
                                        @endforeach                
                                        </tbody>
                                    </table>
                            @else
                                <div class="orders-not-found"><img src="{{asset('img/no-orders-illustrations.svg')}}" style="border: none" alt="No orders"><h4 class="section-text-3">You don't have any Premium Modules</h4></div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection
