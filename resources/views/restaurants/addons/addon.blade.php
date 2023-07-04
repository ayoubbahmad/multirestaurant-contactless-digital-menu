@extends("restaurants.layouts.restaurants_layout")

@section("restaurant_content")
<div class="container-fluid">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-12">
                <div class="page-title-box page-title-box-alt">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <a  href="#"
                            class="btn btn-sm btn-primary btn-round btn-icon" data-bs-toggle="modal"
                            data-bs-target="#modal-form1">
                            <span class="btn-inner--text">{{$selected_language->data['store_panel_common_addon_add'] ?? 'Add Addons'}}</span>
                        </a>
                        </ol>
                    </div>
                    <h4 class="page-title">{{$selected_language->data['store_panel_common_addon_addons'] ?? 'Addons'}}</h4>
                </div>
            </div>
        </div>  
                    <div class="card">
                        <div class="card-body">
                            @if(session()->has("MSG"))
                            <div class="alert alert-{{session()->get("TYPE")}}">
                                <strong> <a>{{session()->get("MSG")}}</a></strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                </button>
                            </div>
                            @endif
                            @if($errors->any()) @include('admin.admin_layout.form_error') @endif


                            <!-- Light table -->
                            <div class="table-responsive mt-2">
                                <table class="multi-table table table-hover" style="width:100%">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>{{$selected_language->data['store_orders_no'] ?? 'No'}}</th>
                                            <th>{{$selected_language->data['store_panel_common_category'] ?? 'Category'}}</th>
                                            <th>{{$selected_language->data['store_panel_common_name'] ?? 'Name'}}</th>
                                            <th>{{$selected_language->data['store_panel_common_price'] ?? 'Price'}}</th>
                                            <th class="no-content">{{$selected_language->data['store_panel_common_action'] ?? 'Action'}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @php $i=1 @endphp
                                    @foreach($addon as $add)
                                        <tr>
                                            <td>{{ $i++}}</td>

                                            @foreach($add->addon_categories($add->addon_category_id) as $value)
                                                <td>{{$value->name }}
                                                </td>
                                            @endforeach
                                                
                                            <td>{{ $add->addon_name }}</td>
                                            <td>   @include('layouts.render.currency',["amount"=>$add->price])</td>
                                            <td>
                                                <ul style="    padding: 0;
                                                margin: 0;
                                                list-style: none;">
                                                    <li style="    display: inline-block;
                                                    margin: 0 2px;
                                                    line-height: 1;">
                                                        <a href="{{route('store_admin.update_addon',['id'=>$add->id])}}"
                                                           data-toggle="tooltip" data-placement="top" title=""
                                                           data-original-title="{{$selected_language->data['store_panel_common_edit'] ?? 'Edit'}}">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                                 viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                                 stroke-width="2" stroke-linecap="round"
                                                                 stroke-linejoin="round" class="feather feather-edit-2">
                                                                <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"/>
                                                            </svg>
                                                        </a>
                                                    </li>
                                                    <li style="    display: inline-block;
                                                    margin: 0 2px;
                                                    line-height: 1;">
                                                        <a onclick="if(confirm('Are you sure you want to delete this item?')){ event.preventDefault();document.getElementById('delete-form-{{$add->id}}').submit(); }"
                                                           data-toggle="tooltip" data-placement="top" title=""
                                                           data-original-title="{{$selected_language->data['store_panel_common_delete'] ?? 'Delete'}}">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                                 viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                                 stroke-width="2" stroke-linecap="round"
                                                                 stroke-linejoin="round" class="feather feather-trash-2">
                                                                <polyline points="3 6 5 6 21 6"/>
                                                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>
                                                                <line x1="10" y1="11" x2="10" y2="17"/>
                                                                <line x1="14" y1="11" x2="14" y2="17"/>
                                                            </svg>
                                                        </a></li>
                                                </ul>
                                                <form method="post" action="{{route('store_admin.delete_addon')}}" id="delete-form-{{$add->id}}" style="display: none">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" value="{{$add->id}}" name="id">
                                                </form>
                                            </td>



                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>



                    <div class="modal fade" id="modal-form1" tabindex="-1" role="dialog" aria-labelledby="modal-form1" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
                            <div class="modal-content">
                                <div class="modal-body p-0">
                                    <div class="card bg-dark border-0 mb-0">

                                        <div class="card-body ">

                                            <form method="post" action="{{route('store_admin.add_addon')}}" enctype="multipart/form-data">
                                                {{csrf_field()}}
                                                <div class="form-group mb-3">
                                                    <label class="form-control-label text-white" for="exampleFormControlSelect1">{{$selected_language->data['store_panel_common_name'] ?? 'Name'}}</label>

                                                        <input class="form-control" placeholder="Name" type="text" name="addon_name" required>

                                                </div>


                                                    <div class="form-group mb-3">
                                                        <label class="form-control-label text-white" for="exampleFormControlSelect1">{{$selected_language->data['store_panel_inventory_products_select_category'] ?? 'Select Category'}}</label>
                                                        <select class="form-control" name="addon_category_id" required>
                                                            @foreach($addons_category as $cat)
                                                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                <div class="form-group mb-3">
                                                    <label class="form-control-label text-white" for="exampleFormControlSelect1">{{$selected_language->data['store_panel_common_price'] ?? 'Price'}}</label>

                                                    <input class="form-control" placeholder="Price" type="number" name="price" required>

                                                </div>



                                                <div class="text-center">
                                                    <button type="submit" class="btn btn-success" >{{$selected_language->data['store_panel_common_submit'] ?? 'Submit'}}</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
@endsection