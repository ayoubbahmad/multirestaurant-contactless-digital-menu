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
                        <a href="{{route('add_expense')}}" class="btn btn-primary mr-2" data-toggle="tooltip" data-original-title="Add Expense">
                            <span class="">Add Expense</span>
                        </a>
                    </ol>
                </div>
                <h4 class="page-title">Expense</h4>
            </div>
        </div>
    </div>  
        <div class="layout-px-spacing">
            <div class="row layout-top-spacing">

                <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <h4></h4>
                                </div>
                                <div class="col-6 text-right">
                                   
                                </div>
                            </div>
                        <div class="table-responsive mb-4">
                            @if($expenses->count() > 0)
                                <table id="zero-config" class="table text-center" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>To</th>
                                        <th>Amount</th>
                                        <th>Date</th>
                                        <th class="no-content">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($expenses as $data)
                                        <tr>
                                            <td>{{$data->name}}</td>
                                            <td>@include('layouts.render.currency',["amount"=>$data->amount])</td>
                                            <td>{{$data->date}}</td>
                                            <td class="table-actions">
                                                <a href="{{route('edit_expense',$data->id)}}" class="table-action" data-toggle="tooltip" data-original-title="Edit">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                                </a>
                                                <a href="#" onclick="if(confirm('Are you sure you want to delete this Expense?')){ event.preventDefault();document.getElementById('delete-form-{{$data->id}}').submit(); }" class="table-action table-action-delete" data-toggle="tooltip" data-original-title="Delete">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                                </a>




                                                <form method="post" action="{{route('delete_expense')}}"
                                                      id="delete-form-{{$data->id}}" style="display: none">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" value="{{$data->id}}" name="id">
                                                </form>


                                            </td>

                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>



                            @else
                                <div class="orders-not-found"><img src="{{asset('img/no-orders-illustrations.svg')}}" style="border: none" alt="No orders"><h4 class="section-text-3 my8">No Expense Data found.</h4></div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection
