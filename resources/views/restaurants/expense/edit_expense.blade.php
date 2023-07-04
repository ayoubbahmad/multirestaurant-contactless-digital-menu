@extends("restaurants.layouts.restaurants_layout")

@section("restaurant_content")

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box page-title-box-alt">
                    <h4 class="page-title">{{$selected_language->data['store_expense_update_expense'] ?? 'Update Expense'}}</h4>
                </div>
            </div>
        </div>

            <div class="row ">
            <div class="card ">
            <div class="card-body ">
            <h4 class="header-title mb-2"></h4>
                <div class="col-lg-12">

                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    @if(session()->has("MSG"))
                                        <div class="alert alert-{{session()->get("TYPE")}}">
                                            <strong> <a>{{session()->get("MSG")}}</a></strong>
                                        </div>
                                    @endif
                                    @if($errors->any()) @include('admin.admin_layout.form_error') @endif
                                </div>
                            </div>
                             <div class="row">
                            <form  method="post" action="{{route('store_admin.store_expense_update',$id->id)}}" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <!-- Form groups used in grid -->
                                <div class="row">


                                    <div class="col-md-6 mb-2">
                                        <div class="form-group">
                                            <label class="form-control-label" for="example3cols2Input">{{$selected_language->data['store_expense_name'] ?? 'Name'}}</label>  <span class="text-danger">*</span>
                                            <input type="text" name="name" value="{{$id->name}}" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <div class="form-group">
                                            <label class="form-control-label" for="example3cols2Input">{{$selected_language->data['store_expense_amount'] ?? 'Amount'}}</label> <span class="text-danger">*</span>
                                            <input type="text" name="amount" value="{{$id->amount}}" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <div class="form-group">
                                            <label class="form-control-label" for="example3cols2Input">{{$selected_language->data['store_expense_date'] ?? 'Date'}}</label> <span class="text-danger">*</span>
                                            <input type="date" name="date" value="{{$id->date}}" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="col-md-12 mb-2">
                                        <div class="form-group">
                                            <label class="form-control-label" for="example3cols2Input">{{$selected_language->data['store_expense_notes'] ?? 'Notes'}}</label>
                                            <textarea class="form-control" name="note" rows="3">{{$id->note}}</textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <button class="btn btn-primary" type="submit">{{$selected_language->data['store_panel_common_update'] ?? 'Update'}}</button>
                                        </div>
                                    </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div></div>
        </div>
    </div>

@endsection
