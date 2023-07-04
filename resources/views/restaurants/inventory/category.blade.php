@extends("restaurants.layouts.restaurants_layout")

@section("restaurant_content")


        <!-- Start Content-->
        <div class="container-fluid">


            <div class="row">
               
                <div class="col-sm-6">
                    
                            <form class="row g-2 align-items-center mb-2 mb-sm-0">
                                <div class="col-auto">
                                   <h3> {{$selected_language->data['store_panel_common_category'] ?? 'Category'}}</h3>
                                </div>
                                
                            </form>
                   
                </div>
                
                <div class="col-sm-6">
                    <div class="float-end">
                    <a href="{{route('store_admin.addcategories')}}" class="btn btn-purple rounded-pill w-md waves-effect waves-light mb-3"><i class="mdi mdi-plus"></i> Create New Category</a>
                    <a href="{{route('store_admin.category_sort')}}" class="btn btn-success rounded-pill w-md waves-effect waves-light mb-3"><i class="fas fa-sort-alpha-up"></i> {{$selected_language->data['store_panel_sort_category_text'] ?? 'Sort Category'}}</a>
                    </div>
                </div>
            </div>


            <div class="row">
                @foreach($category as $cat)
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body widget-user">
                            <div class="d-flex align-items-center">
                                <div class="avatar-lg me-3 flex-shrink-0">
                                    <img src="{{asset($cat->image_url !=NULL ? $cat->image_url:'themes/default/images/all-img/empty.png')}}" class="img-fluid rounded-circle" style="width: 75px;height: 75px;" alt="user">
                                </div>
                                <div class="flex-grow-1 overflow-hidden">
                                    <h5 class="mt-0 mb-1">{{$cat->name}}</h5>
                                    <p class="text-muted mb-2 font-13 text-truncate">{{$cat->productinfos_count}} {{isset($selected_language->data['store_panel_common_products']) ? $selected_language->data['store_panel_common_products']: 'Products'}}</p>
                                    <small class="text-warning"><b><a href="{{route('store_admin.update_category',$cat->id)}}">{{$selected_language->data['store_edit'] ?? 'Edit'}}</a> | <a onclick="if(confirm('Are you sure you want to delete this category, auto delete all products in this category ?')){ event.preventDefault();document.getElementById('delete-form-{{$cat->id}}').submit(); }" class="text-danger">{{$selected_language->data['store_delete'] ?? 'Delete'}}</a></b></small>
                                    <form method="post" action="{{route('store_admin.delete_category')}}"
                                    id="delete-form-{{$cat->id}}" style="display: none">
                                  @csrf
                                  @method('DELETE')
                                  <input type="hidden" value="{{$cat->id}}" name="id">
                              </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
               @endforeach

            </div>
            
        </div> 
  


    @endsection











{{-- 


                    <div class="statbox widget box box-shadow">
                        <div class="widget-header">
                            <div class="row">
                                <div class="col-6">
                                    <h4>{{$selected_language->data['store_panel_common_category'] ?? 'Category'}}</h4>
                                </div>
                                <div class="col-6 text-right">
                                    <a href="{{route('store_admin.category_sort')}}" class="btn btn-sm btn-primary btn-round btn-icon" >
                                        <span class="btn-inner--text">    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-move"><polyline points="5 9 2 12 5 15"></polyline><polyline points="9 5 12 2 15 5"></polyline><polyline points="15 19 12 22 9 19"></polyline><polyline points="19 9 22 12 19 15"></polyline><line x1="2" y1="12" x2="22" y2="12"></line><line x1="12" y1="2" x2="12" y2="22"></line></svg></span>
                                        &nbsp;<span class="btn-inner--text">{{$selected_language->data['store_panel_sort_category_text'] ?? 'Sort Category'}}</span>
                                    </a>

                                </div>

                            </div>


                        </div>

                    

                        <div class="table-responsive">
                            <table class="multi-table table table-hover" style="width:100%">
                                <thead class="thead-light">
                                    <tr>
                                        <th>{{$selected_language->data['store_orders_no'] ?? 'No'}}</th>
                                        <th>{{$selected_language->data['store_panel_common_name'] ?? 'Name'}}</th>
                                        <th>{{$selected_language->data['store_panel_inventory_category_no_of_products'] ?? 'No of Products'}}</th>
                                        <th class="no-content">{{$selected_language->data['store_panel_common_action'] ?? 'Action'}}</th>
                                    </tr>
                                </thead>
                                <tbody>

                                @php $i=1 @endphp
                                @foreach($category as $cat)

                                    <tr>
                                        <td>{{ $i++}} </td>
                                        <td>
                                            <div class="d-flex">
                                                <div class="usr-img-frame mr-2 rounded-circle">
                                                    <img alt="avatar" class="img-fluid rounded-circle"
                                                         src="{{asset($cat->image_url !=NULL ? $cat->image_url:'themes/default/images/all-img/empty.png')}}">
                                                </div>
                                                <p class="align-self-center mb-0">{{$cat->name}}</p>
                                            </div>
                                        </td>
                                        <td><span class="badge badge-info">{{$cat->productinfos_count}} {{$selected_language->data['store_panel_common_products'] ?? 'Products'}}</span>
                                        </td>
                                        <td>
                                            <ul class="table-controls">
                                                <li>
                                                    <a href="{{route('store_admin.update_category',$cat->id)}}"
                                                       data-toggle="tooltip" data-placement="top" title=""
                                                       data-original-title="{{$selected_language->data['store_edit'] ?? 'Edit'}}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                             viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                             stroke-width="2" stroke-linecap="round"
                                                             stroke-linejoin="round" class="feather feather-edit-2">
                                                            <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"/>
                                                        </svg>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a onclick="if(confirm('Are you sure you want to delete this category, auto delete all products in this category ?')){ event.preventDefault();document.getElementById('delete-form-{{$cat->id}}').submit(); }"
                                                       data-toggle="tooltip" data-placement="top" title=""
                                                       data-original-title="{{$selected_language->data['store_delete'] ?? 'Delete'}}">
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
                                            <form method="post" action="{{route('store_admin.delete_category')}}"
                                                  id="delete-form-{{$cat->id}}" style="display: none">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" value="{{$cat->id}}" name="id">
                                            </form>
                                        </td>
                                    </tr>

                                @endforeach
                                </tbody>
                            </table>
                        </div>


                    </div>

                <a href="{{route('store_admin.addcategories')}}" class="float" style="background-color: #0E1726">
                    <div class="text-white" style="padding-top: 29%">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="feather feather-plus">
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                    </div>
                </a> --}}