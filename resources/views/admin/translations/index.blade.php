@extends("admin.admin_layout.adminlayout")

@section("admin_content")

<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-12">
            <div class="page-title-box page-title-box-alt">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <button onclick="event.preventDefault(); document.getElementById('add_new').submit();" class="btn btn-primary" data-toggle="tooltip" data-original-title="Add New Language">
                            <span class="btn-inner--text">Add New Language</span>
                        </button>
                        <form action="{{route('add_translations')}}" method="get" id="add_new"></form>
                    </ol>
                </div>
                <h4 class="page-title">All Translation</h4>
            </div>
        </div>
    </div>  


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
                        <!-- Light table -->
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush text-center">
                                <thead class="thead-light">
                                <tr>
                                    <th class="text-center">Id</th>
                                    <th class="text-center">Language Name</th>

                                    <th class="text-center">Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
                                </thead>
                                <tbody>



                                @php $i=1 @endphp
                                @foreach($data as $value)
                                    <tr>

                                        <td>
                                            <span class="text-muted">{{ $i++}}</span>
                                        </td>
                                        <td>
                                            <span class="text-muted">{{ $value->language_name}}</span>
                                        </td>
                                        <td>
                                            <span class="badge badge-soft-{{$value->is_active == 1 ? "success":"danger"}}">
                                                {{$value->is_active == 1 ? "Active":"Inactive"}}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{route('update_translation',['id'=>$value->id])}}" data-toggle="tooltip" data-original-title="Edit ">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                            </a>&nbsp; &nbsp; &nbsp;

                                            <a href="#" onclick="if(confirm('Are you sure you want to delete this Translation?')){ event.preventDefault();document.getElementById('delete-form-{{$value->id}}').submit(); }"  data-toggle="tooltip" data-original-title="Delete">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                            </a>

                                            <form method="post" action="{{route('delete_translation')}}"
                                                  id="delete-form-{{$value->id}}" style="display: none">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" value="{{$value->id}}" name="id">
                                            </form>


                                        </td>

                                    </tr>
                                @endforeach


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
@endsection
