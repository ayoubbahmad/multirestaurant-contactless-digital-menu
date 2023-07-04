@extends("restaurants.layouts.restaurants_layout")

@section("restaurant_content")

    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="page-title-box page-title-box-alt">
                    <h4 class="page-title">{{$selected_language->data['store_expense_add_expense'] ?? 'Add Expense'}}</h4>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
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


                    <form method="post" action="{{route('store_admin.store_expense_create')}}"
                          enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="row">
                        <div class="col-md-4 mb-3">
                            <div class="form-group">
                                <label class="form-control-label"
                                       for="example3cols2Input"><b>{{$selected_language->data['store_expense_name'] ?? 'Name'}}</b></label>
                                <span class="text-danger">*</span>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="form-group">
                                <label class="form-control-label"
                                       for="example3cols2Input"><b>{{$selected_language->data['store_expense_amount'] ?? 'Amount'}}</b></label>
                                <span class="text-danger">*</span>
                                <input type="number" name="amount" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="form-group">
                                <label class="form-control-label"
                                       for="example3cols2Input"><b>{{$selected_language->data['store_expense_date'] ?? 'Date'}}</b></label>
                                <span class="text-danger">*</span>
                                <input type="date" name="date" class="form-control" required value={{\carbon\carbon::today()}}>
                            </div>
                        </div>

                        <div class="col-md-12 mb-2">
                            <div class="form-group">
                                <label class="form-control-label"
                                       for="example3cols2Input"><b>{{$selected_language->data['store_expense_notes'] ?? 'Notes'}}</b></label>
                                <textarea class="form-control" name="note" rows="3"></textarea>
                            </div>
                        </div>

                        <div class="col-md-4 ">
                            <div class="form-group">
                                <button class="btn btn-dark"
                                        type="submit">{{$selected_language->data['store_panel_common_submit'] ?? 'Submit'}}</button>
                            </div>
                        </div>
                        </div>
                    </form>
                    
            </div>
        </div>

    </div>

@endsection
