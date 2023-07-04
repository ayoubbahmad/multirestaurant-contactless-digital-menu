
@extends('layouts.admin-layout')
@section('title','Inventory Product')
@section('content')
    <div class="content-page">
        <div class="container-fluid">
            <div class="row mb-4">
                <div class="col-lg-12">
                    <div class="d-flex flex-wrap align-items-center justify-content-between my-schedule">
                        <div class="d-flex align-items-center justify-content-between">
                            <h4 class="font-weight-bold">Product Details</h4>
                        </div>
                        <div class="create-workform">
                            <div class="d-flex flex-wrap align-items-center justify-content-between">
                                <div class="modal-product-search d-flex">
                                    <a href="{{ url('admin/inventory/products/') }}" class="btn btn-primary position-relative d-flex align-items-center justify-content-between">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="mr-2" width="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                        </svg>
                                        Back
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <div class="card">
                        <img class="rounded px-3 py-3" alt="product-image" src="{{(!empty($product->image) && File::exists('uploads/products/'.$product->image)) ? asset('uploads/products/'.$product->image):asset('uploads/products/default.jpg') }}">
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item p-3">
                                <h5 class="font-weight-bold text-uppercase pb-2">{{ $product->name }}</h5>
                                <p class="text-muted mt-2">{{ $product->description }}</p>
                            </li>
                            <li class="list-group-item p-3">
                                <div class="table-responsive">
                                    <table class="table table-borderless mb-0">
                                        <tbody>
                                        <tr class="white-space-no-wrap">
                                            <td class="text-muted pl-0">
                                                Article Number
                                            </td>
                                            <td>
                                                {{ $product->article_number }}
                                            </td>
                                        </tr>
                                                <tr class="white-space-no-wrap">
                                            <td class="text-muted pl-0">
                                                Category
                                            </td>
                                            <td>
                                                {{ ($product->category) ? $product->category->name : "" }}
                                            </td>
                                        </tr>
                                        <tr class="white-space-no-wrap">
                                            <td class="text-muted pl-0">
                                                Brand
                                            </td>
                                            <td>
                                                {{ ($product->brand) ? $product->brand->name : "" }}
                                            </td>
                                        </tr>
                                        <tr class="white-space-no-wrap">
                                            <td class="text-muted pl-0">
                                                Addon
                                            </td>
                                            <td>
                                                @php
                                                  $add_on_categories = App\AddOnCategory::get();
                                                @endphp
                                                <div class="d-flex">
                                                @foreach($add_on_categories as $row)
                                                    @if(isset($product) &&  in_array($product->id, $row->items()->pluck('product_id')->toArray()))
                                                        @foreach($row->addOns as $addons)
                                                            <span class="product-addons text-uppercase">  {{$addons->add_on_name}} </span>
                                                            @endforeach
                                                          @endif
                                                @endforeach
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="white-space-no-wrap">
                                            <td class="text-muted pl-0">
                                                Status
                                            </td>
                                            <td>
                                                <div class="custom-control custom-switch custom-switch-color custom-control-inline">
                                                    <input type="checkbox" class="custom-control-input bg-primary change-status" id="{{ $product->id }}" {{($product->is_active==1)? 'checked=""':''}} data-id="{{ $product->id }}">
                                                    <label class="custom-control-label" for="{{ $product->id }}">&nbsp;</label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="white-space-no-wrap">
                                            <td class="text-muted pl-0">
                                                Actions
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <a class="btn btn-sm bg-light mr-2" href="{{ url('admin/inventory/products/update/' . $product->id) }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                        </svg> Edit
                                                    </a>
                                                    <a href="{{ url('admin/inventory/products/delete/' . $product->id) }}" class="delete-btn btn btn-sm bg-danger">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                        </svg> Delete
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection


@push('js')
    <script>
        /* change active and inactive status */
        $(document).on("click", ".change-status", function () {
            var id = $(this).data('id');
            if (id) {
                $.ajax({
                    url: "{{ url('admin/inventory/products/change-status-products/') }}",
                    data: {
                        id : id
                    },
                    type: "GET",
                    success: function (data) {
                    }
                });
            }
        });
    </script>
@endpush
