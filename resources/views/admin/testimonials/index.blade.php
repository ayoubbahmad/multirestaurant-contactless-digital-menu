@extends("admin.admin_layout.adminlayout")

@section("admin_content")
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-12">
            <div class="page-title-box page-title-box-alt">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <a href="{{route('add_testimonials')}}" class="btn btn-primary" data-toggle="tooltip" data-original-title="Add New Testimonials">
                            <span class="">Add New Testimonials</span>
                        </a>
                    </ol>
                </div>
                <h4 class="page-title">Testimonials List</h4>
            </div>
        </div>
    </div>  
            <div class="row ">

                <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                    <div class="card">
                        <div class="card-body">
                        <!-- Light table -->
                        <div class="table-responsive mb-4">
                            @if(session()->has("MSG"))
                                <div class="alert alert-{{session()->get("TYPE")}}">
                                    <strong> <a>{{session()->get("MSG")}}</a></strong>
                                </div>
                            @endif
                                <table id="zero-config" class="table " style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>Designation</th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                    @php $i=1 @endphp
                                    @foreach($testimonial as $data)

                                        <tr>
                                            <td>{{$i++}}</td>
                                            <td>{{$data->name}}</td>
                                            <td>{{$data->designation}} </td>
                                            <td>
                                                <a href="#" onclick="if(confirm('Are you sure you want to delete this Testimonials?')){ event.preventDefault();document.getElementById('delete-form-{{$data->id}}').submit(); }">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                                </a>

                                                <form method="post" action="{{route('delete_testimonials')}}"
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection
