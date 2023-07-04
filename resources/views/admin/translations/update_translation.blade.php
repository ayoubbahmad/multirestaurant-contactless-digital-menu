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
                <h4 class="page-title">Update Translation</h4>
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


                            <form class="form-horizontal" method="post" action="{{route('update_translation',['id'=>$data->id])}}" enctype="multipart/form-data">
                                {{csrf_field()}}
                                @method('patch')
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-username">Name </label>
                                            <input type="text" name="language_name" class="form-control"
                                                   placeholder="Language Name" value="{{$data->language_name}}" required>
                                        </div>
                                    </div>

                                    <div class="col-lg-3" style="margin-top: 20px;">
                                        <div class="form-group">

                                            <label class="form-control-label">Default : On/Off</label><br>
                                            <label class="switch s-success">
                                                <input type="checkbox"  {{$data->is_default == 1 ? "checked":""}} {{$data->is_default == 1 ? "disabled":""}} name="is_default">
                                                <span class="slider round" data-label-off="No" data-label-on="Yes"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-3" style="margin-top: 20px;">
                                        <div class="form-group">

                                            <label class="form-control-label">Enable : On/Off</label><br>
                                            <label class="switch s-success">
                                                <input type="checkbox"  {{$data->is_active == 1 ? "checked":""}} name="is_active">
                                                <span class="slider round" data-label-off="No" data-label-on="Yes"></span>
                                            </label>
                                        </div>
                                    </div>

                                </div>


                                    {{--                            Payment Page Start--}}

    {{--                                <div class="card-header bg-gradient-gray-dark text-white">User Panel <b class="text-success">Payment Page</b></div>--}}

    {{--                                <div class="row">--}}
    {{--                                    <div class="col-md-4">--}}
    {{--                                        <div class="card">--}}

    {{--                                            <div class="card-body">--}}
    {{--                                                <div class="form-group">--}}
    {{--                                                    <label class="form-control-label" for="input-username">Payment Method </label>--}}
    {{--                                                    <input type="text" name="payment_method" class="form-control" value="{{$data->data['payment_method'] ?? ''}}"--}}
    {{--                                                           required>--}}
    {{--                                                </div>--}}

    {{--                                            </div>--}}
    {{--                                        </div>--}}

    {{--                                    </div>--}}

                                        @foreach(config('global.translation.section') as $value)

                                    <br>
                                    <div class="card-header bg-dark">
                                        <div class="row">
                                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                                <h4 class="text-white">{{$value['name'] ?? 'NO_NAME_KEY_WARNING'}}</h4>
                                            </div>
                                        </div>
                                    </div>


                                            <div class="row">
                                                <div class="col-sm">
                                                    <div class="card ">
                                                        <div class="card-body ">
                                                            @foreach($value['values'] as $key => $default)
                                                                <div class="form-group row vertical-center mb-2">
                                                                    <label class="form-control-label col-lg-3 col-form-label" for="input-username">{{ucwords(str_replace('_', ' ', $key))}}</label>
                                                                    <div class="col-lg-9">
                                                                        @if($default[1] == "textarea")
                                                                            <textarea type="{{$default[1] ?? 'text'}}" name="{{$key ?? ''}}" class="form-control">{{$data->data[$key] ?? $default}}</textarea>
                                                                        @else
                                                                            <input type="{{$default[1] ?? 'text'}}" name="{{$key ?? ''}}" class="form-control" value="{{$data->data[$key] ?? $default}}"
                                                                                   required>
                                                                        @endif


                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                    {{--                            Payment Page End--}}
                                <div class="form-group mt-4">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit"
                                                class="btn btn-default btn-flat m-b-30 m-l-5 bg-primary text-white border-none m-r-5 -btn">
                                            Update
                                        </button>
                                    </div>
                                </div>



                                </form>




                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>





@endsection








