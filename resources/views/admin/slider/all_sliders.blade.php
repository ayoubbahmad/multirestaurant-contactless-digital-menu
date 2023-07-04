@extends("admin.admin_layout.adminlayout")

@section("admin_content")

    <div id="content" class="main-content">
        <div class="layout-px-spacing">
            <div class="row layout-top-spacing">

                <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">

                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>User App Pro Module</strong> Coming Soon!
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>


                    <div class="statbox widget box box-shadow">
                        <div class="widget-header mb-4">
                            <div class="row">
                                <div class="col-6">
                                    <h4>All Sliders</h4>
                                </div>
                                <div class="col-6 text-right">
                                    <button onclick="event.preventDefault(); document.getElementById('add_new').submit();" class="btn btn-primary mt-2" data-toggle="tooltip" data-original-title="Add New Slider">
                                        <span class="btn-inner--text">Add New Slider</span>
                                    </button>
                                    <form action="{{route('add_slider')}}" method="get" id="add_new"></form>
                                </div>
                            </div>
                        </div>
                        <!-- Light table -->
                        <div class="table-responsive">
                            <table class="table table-hover align-items-center table-flush text-center">
                                <thead class="thead-light">

                                <tr>
                                    <th class="text-center">NO.</th>
                                    <th class="text-center">PREVIEW</th>
                                    <th class="text-center">SLIDER NAME</th>
                                    <th class="text-center">VISIBILITY</th>
                                    <th class="text-center">ACTION</th>
                                </tr>
                                </thead>
                                <tbody>



                                @php $i=1 @endphp
                                @foreach($sliders as $value)
                                    <tr>

                                        <td>
                                            <span class="text-muted">{{ $i++}}</span>
                                        </td>
                                        <td>

                                            <div class="avatar">
                                                <img alt="store-category-image" style="width: 40px;height: 40px" src="{{asset($value->photo_url)}}" class="rounded-circle" />
                                            </div>
                                        </td>
                                        <td>
                                            <span class="text-muted">{{$value->name}}</span>
                                        </td>
                                        <td>
                                            <span class="badge badge-{{$value->is_visible == 1 ? "success":"danger"}}">
                                                {{$value->is_visible == 1 ? "Active":"Inactive"}}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{route('update_slider',['id'=>$value->id])}}" data-toggle="tooltip" data-original-title="Edit ">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                            </a>&nbsp; &nbsp; &nbsp;

                                            <a href="#" onclick="if(confirm('Are you sure you want to delete this Slider?')){ event.preventDefault();document.getElementById('delete-form-{{$value->id}}').submit(); }"  data-toggle="tooltip" data-original-title="Delete">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                            </a>

                                            <form method="post" action="{{route('delete_slider')}}"
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
        </div>
    </div>

@endsection

