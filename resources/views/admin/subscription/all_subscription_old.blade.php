@extends("admin.adminlayout")

@section("admin_content")


<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-12">
            <div class="page-title-box page-title-box-alt">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <a href="{{route('add_subscription')}}"
                        class="btn btn-sm btn-primary btn-round btn-icon" data-toggle="tooltip"
                        data-original-title="Add Subscription">
                    <span class="btn-inner--icon"><i class="fas fa-user-edit"></i></span>
                    <span class="btn-inner--text"></span>
                </a>
                    </ol>
                </div>
                <h4 class="page-title">Add Subscription</h4>
            </div>
        </div>
    </div>  
        <div class="row">
            @foreach($subscription as $data)
            <div class="col-sm-3">
                <div class="card">
                    <!-- Card body -->
                    <div class="card-body">
                        <div class="row align-items-center">

                            <div class="col ml--2">
                                <h4 class="mb-0">
                                    Plan Name: <b class="text-blue">{{$data->name}}</b>
                                </h4>
                                <span class="text-dark"><b>
                                          @include('layouts.render.currency',["amount"=>$data->price])
                                        </b></span>
                            </div>
                            <div class="col-auto">
                                <a href="{{route('edit_subscription',$data->id)}}" class="btn btn-sm btn-primary">Edit</a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
@endsection
