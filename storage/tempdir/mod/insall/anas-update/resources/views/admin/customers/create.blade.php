
@extends('layouts.admin-layout')
@section('title','Customer')
@section('content')
    <div class="content-page">
        <div class="container-fluid">
            <div class="row mb-5">
                <div class="col-lg-12">
                    <div class="d-flex flex-wrap align-items-center justify-content-between my-schedule mb-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <h4 class="font-weight-bold">Add Customer</h4>
                        </div>
                        <div class="create-workform">
                            <div class="d-flex flex-wrap align-items-center justify-content-between">
                                <div class="modal-product-search d-flex">
                                    <a href="{{ url('admin/customers/') }}" class="btn btn-primary btn-sm d-flex align-items-center justify-content-between ml-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                                        </svg>
                                        <span class="ml-2">Back</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <form class="date-icon-set-modal"
                                          action="{{ isset($user) ? url('admin/customers/update/' . $user->id) : url('admin/customers/create') }}"
                                          method="post" id="MyCustomerForm" enctype='multipart/form-data'>
                                        {{ @csrf_field() }}
                                        <div class="row">
                                            <div class="col-md-3 mb-3">
                                                <div class="card-body rounded bg-light">
                                                    <div class="d-flex justify-content-center mt-5">
                                                        <input type="file" class="form-control dropify" id="image"
                                                               accept=".png,.jpg,.jpeg,.PNG,.JPG,.JPEG"
                                                               data-height="150"
                                                               name="avatar"
                                                               data-default-file="{{(isset($user) && !empty($user->avatar) && File::exists('uploads/customers/'.$user->avatar)) ? asset('uploads/customers/'.$user->avatar):asset('uploads/customers/default.png') }}"
                                                               data-show-remove="{{isset($user) ? 'false':'true'}}">
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="row">
                                                    <div class="col-md-12 mb-5">
                                                        <div class="d-flex justify-content-center">
                                                            <p class="line-around text-secondary mb-0"><span class="line-around-1 text-uppercase">Basic Details</span></p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label font-weight-bold text-muted text-uppercase">Store Name<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" value="{{ (isset($user) && isset($user->customer) ?$user->customer->store_name:'') }}" name="store_name" id="store_name" autofocus placeholder="Enter Store Name">
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label font-weight-bold text-muted text-uppercase">License/Tax Number</label><span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" value="{{ (isset($user) && isset($user->customer) ?$user->customer->license_number:'') }}" name="license_number" id="license_number"  placeholder="Enter License/Tax Number">
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label font-weight-bold text-muted text-uppercase">District<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" value="{{ (isset($user)&& isset($user->customer) ?$user->customer->district:'') }}" name="district" id="district" placeholder="Enter District">
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        @php
                                                           $areaList = App\Area::where('is_active',1)->get();
                                                        @endphp
                                                        <label for="area_id" class="form-label font-weight-bold text-muted text-uppercase">Area<span class="text-danger">*</span></label>
                                                        <select id="area_id" class="form-select form-control" name="area_id">
                                                            <option value="">Select Area</option>
                                                            @foreach($areaList as $row)
                                                                <option value="{{$row->id}}" {{ ((isset($user)&&($user->area_id==$row->id))?'selected':'') }}>{{$row->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-12 mb-3">
                                                        <label for="Text9" class="form-label font-weight-bold text-muted text-uppercase">Address<span class="text-danger">*</span></label>
                                                        <textarea class="form-control" id="Text9" rows="2" placeholder="Enter Address" name="address" id="address">{{ (isset($user)&& isset($user->customer)?$user->customer->address:'') }}</textarea>
                                                    </div>
                                                    <div class="col-md-12 mt-3 mb-5">
                                                        <div class="d-flex justify-content-center">
                                                            <p class="line-around text-secondary mb-0"><span class="line-around-1 text-uppercase">Account Details</span></p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label font-weight-bold text-muted text-uppercase">Store Owner Name<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" placeholder="Enter Store Owner Name" value="{{ (isset($user) ?$user->name:'') }}" name="name" id="name" >
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label font-weight-bold text-muted text-uppercase">Email ID<span class="text-danger">*</span></label>
                                                        <input type="email" value="{{ (isset($user) ?$user->email:'') }}" name="email" id="email" class="form-control check-email" placeholder="Enter Email ID">
                                                        <b><span id="email_status" class="text-danger"></span></b>
                                                    </div>

                                                    @if(isset($user))
                                                        <input type="hidden" class="form-control" id="flag" name="flag" value="1">
                                                        <input type="hidden" class="form-control" id="id" name="id" value="{{$user->id}}">
                                                    @else
                                                        <input type="hidden" class="form-control" id="flag" name="flag" value="0">
                                                    @endif

                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label font-weight-bold text-muted text-uppercase">Phone Number<span class="text-danger">*</span></label>
                                                        <input type="number" value="{{ (isset($user) ?$user->phone:'') }}" name="phone" id="phone" class="form-control" placeholder="Enter Phone Number">
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label font-weight-bold text-muted text-uppercase">Password<span class="text-danger">*</span></label>
                                                        <input type="password"  value="" name="password" id="password" class="form-control" placeholder="Enter Password">
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label font-weight-bold text-muted text-uppercase mb-3">Status</label><br>
                                                        <div class="custom-control custom-switch custom-switch-color custom-control-inline">
                                                            <input type="checkbox"
                                                                   class="custom-control-input bg-primary"
                                                                   name="is_active"
                                                                   id="active" {{ (isset($user) ? (($user->is_active==1) ? 'checked=""':'') : 'checked=""')}}>
                                                            <label class="custom-control-label" for="active">is
                                                                active</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 mb-3">
                                                        <div class="d-flex justify-content-end mt-3">
                                                            <button type="reset" class="btn bg-secondary mr-3">
                                                                Cancel
                                                            </button>
                                                            <button type="submit" class="btn btn-primary">
                                                                Save
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection


@push('js')

    <script>

        /* check email uniqueness */
        $(document).on("keyup", ".check-email", function () {
            'use strict';

            var email=$("#email" ).val();
            var flag=$('#flag').val();
            var id=$('#id').val();
            if(email)
            {
                $.ajax({
                    type: 'post',
                    url: '{{ url('/checkEmail') }}',
                    data: {
                        user_email:email,
                        flag:flag,
                        id:id,
                        "_token": "{{ csrf_token() }}",
                    },
                    dataType: 'json',
                    success: function (response) {
                        if(response=="OK")
                        {
                            $('#email_status').html("");
                            $('.save').prop('disabled',false);
                            return true;
                        }
                        else
                        {
                            $( '#email_status' ).html(response);
                            $('#email').focus();
                            $('.save').prop('disabled',true);
                            return false;
                        }
                    }
                });
            }

        });
    </script>


@endpush
