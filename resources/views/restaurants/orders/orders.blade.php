@extends("restaurants.layouts.restaurants_layout")

@section('restaurant_content')

    <div class="container-fluid">


        <div class="row">
            <div class="card ">
                <div class="card-body ">

                    <div class="col-lg-12">
                        <div class="statbox widget box box-shadow">
                            <div class="widget-header">
                                <div class="row">
                                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                        <h4>{{ $selected_language->data['store_orders_all_orders'] ?? 'All Orders' }}
                                            - {{ $orders_count }}</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table id="" class="table table-hover text-center" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>{{ $selected_language->data['store_orders_no'] ?? 'No' }}</th>
                                            <th>{{ $selected_language->data['store_orders_order_id'] ?? 'Order ID' }}</th>
                                            <th>{{ $selected_language->data['store_orders_total'] ?? 'Total' }}</th>
                                            <th>{{ $selected_language->data['store_orders_payment_type'] ?? 'Payment Type' }}
                                            </th>
                                            <th>{{ $selected_language->data['store_orders_status'] ?? 'Status' }}</th>
                                            <th>{{ $selected_language->data['store_orders_type'] ?? 'Type' }}</th>
                                            <th>{{ $selected_language->data['store_orders_placed_at'] ?? 'Placed At' }}</th>
                                            <th>{{ $selected_language->data['store_orders_table_no'] ?? 'Table No' }}</th>
                                            <th>{{ $selected_language->data['store_orders_action'] ?? 'Action' }}</th>
                                            <th class="no-content">
                                                {{ $selected_language->data['store_orders_more'] ?? 'More' }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $i=1 @endphp
                                        @foreach ($orders as $order)
                                        
                                        @if($order->is_merged==0)
                                            <tr>
                                                <td style="vertical-align: middle"> {{ $i++ }} </td>

                                                <td style="vertical-align: middle"> {{ $order->order_unique_id }} </td>

                                                <td style="vertical-align: middle">
                                                    @include('layouts.render.currency',["amount"=>$order->total])
                                                </td>
                                                <td style="vertical-align: middle"> {{ getPaymentType($order->payment_type) }} </td>

                                                <td style="vertical-align: middle">
                                                    {{-- @php print_r($order->status) @endphp --}}
                                                    @if ($order->status == 1)

                                                        <span
                                                            class="btn-xs btn-primary">{{ $selected_language->data['store_orders_status_placed'] ?? 'Order Placed' }}</span>
                                                    @endif

                                                    @if ($order->status == 2)
                                                        <span class="btn-xs btn-warning">
                                                            {{ $selected_language->data['store_orders_status_processing'] ?? 'Processing' }}</span>
                                                    @endif
                                                    @if ($order->status == 5)
                                                        <span
                                                            class="btn-xs btn-dark">{{ $selected_language->data['store_orders_status_ready'] ?? 'Ready' }}</span>
                                                    @endif

                                                    @if ($order->status == 3)
                                                        <span
                                                            class="btn-xs btn-danger">{{ $selected_language->data['store_orders_status_rejected'] ?? 'Rejected' }}</span>
                                                    @endif

                                                    @if ($order->status == 4)
                                                        <span
                                                            class="btn-xs btn-success">{{ $selected_language->data['store_orders_status_order_completed'] ?? 'Order Completed' }}</span>
                                                    @endif


                                                </td>

                                                <td style="vertical-align: middle">
                                                    @if ($order->order_type == 1)
                                                        <span
                                                            class="btn-xs" style="background-color: rgb(230, 230, 230);color: #000"><b>{{ $selected_language->data['store_orders_type_dinning'] ?? 'Dining' }}</b></span>
                                                    @endif

                                                    @if ($order->order_type == 2)
                                                        <span
                                                            class="btn-xs" style="background-color: rgb(230, 230, 230);color: #000"><b>{{ $selected_language->data['store_orders_type_takeaway'] ?? 'Takeaway' }}</b></span>
                                                    @endif

                                                    @if ($order->order_type == 3)
                                                        <span
                                                            class="btn-xs" style="background-color: rgb(230, 230, 230);color: #000"><b>{{ $selected_language->data['store_orders_type_delivery'] ?? 'Delivery' }}</b></span>
                                                    @endif
                                                    @if ($order->order_type == 4)
                                                        <span
                                                            class="btn-xs" style="background-color: rgb(230, 230, 230);color: #000"><b>{{ $selected_language->data['store_orders_type_room'] ?? 'Room' }}</b></span>
                                                    @endif
                                                </td>
                                                <td style="vertical-align: middle">
                                                    {{ $order->created_at->diffForHumans() }}
                                                </td>
                                                <td style="vertical-align: middle">

                                                    @if ($order->table_no != null)
                                                        <span class="btn btn-sm rounded-pill" style="background-color: rgb(230, 230, 230);color: #000">
                                                            {{ $order->table_no }}</span>
                                                    @endif
                                                    @if($order->room_number != null)
                                                    <span class="btn btn-sm rounded-pill" style="background-color: rgb(230, 230, 230);color: #000">
                                                        {{ $order->room_number }}</span>
                                                    @endif


                                                </td>
                                                <td style="vertical-align: middle">
                                                    @if ($order->status == 1)
                                                        <a class="btn btn-primary btn-sm text-white mb-1"
                                                            onclick="document.getElementById('accept_order{{ $order->id }}').submit();">
                                                            {{ $selected_language->data['store_orders_action_accept'] ?? 'Accept Order' }}
                                                        </a>
                                                        <a class="btn btn-danger btn-sm text-white mb-1"
                                                            onclick="document.getElementById('reject_order{{ $order->id }}').submit();">
                                                            {{ $selected_language->data['store_orders_action_reject'] ?? 'Reject Order' }}
                                                        </a>
                                                    @endif

                                                    @if ($order->status == 2)
                                                        <a class="btn btn-warning btn-sm mb-1"
                                                            onclick="document.getElementById('ready_to_serve{{ $order->id }}').submit();">
                                                            {{ $selected_language->data['store_orders_action_ready_to_serve'] ?? 'Ready to Serve' }}
                                                        </a>
                                                    @endif

                                                    @if ($order->status == 5)
                                                        <a class="btn btn-info btn-sm mb-1"
                                                            onclick="document.getElementById('complete_order{{ $order->id }}').submit();">
                                                            {{ $selected_language->data['store_orders_status_order_completed'] ?? 'Order Completed' }}
                                                        </a>
                                                    @endif

                                                    @if ($order->status == 3)
                                                        <a class="btn btn-danger btn-sm text-white mb-1">
                                                            {{ $selected_language->data['store_orders_status_rejected'] ?? 'Rejected' }}
                                                        </a>
                                                    @endif

                                                    @if ($order->status == 4)
                                                        <a class="btn btn-success btn-sm text-white mb-1">
                                                            {{ $selected_language->data['store_orders_action_completed'] ?? 'Completed' }}
                                                        </a>
                                                        @if ($order->payment_status == 1)
                                                            <a class="btn btn-dark btn-sm text-success mb-1"
                                                                onclick="document.getElementById('marks_as_paid{{ $order->id }}').submit();">
                                                                <i class="fas fa-check-circle"></i>
                                                                {{ $selected_language->data['store_orders_action_mark_as_paid'] ?? 'Mark As Paid' }}
                                                            </a>
                                                        @endif

                                                        @if ($order->payment_status == 2)
                                                            <a class="btn btn-dark btn-sm text-yellow mb-1">
                                                                <i class="fas fa-check-double"></i>
                                                                {{ $selected_language->data['store_orders_action_paid'] ?? 'Paid' }}
                                                            </a>
                                                        @endif
                                                    @endif


                                                    <form style="visibility: hidden" method="post"
                                                        action="{{ route('store_admin.update_payment_status', ['id' => $order->id]) }}"
                                                        id="marks_as_paid{{ $order->id }}">
                                                        @csrf
                                                        @method('patch')
                                                        <input style="visibility:hidden" name="payment_status" type="hidden"
                                                            value="2">
                                                    </form>

                                                    <form style="visibility: hidden" method="post"
                                                        action="{{ route('store_admin.update_order_status', ['id' => $order->id]) }}"
                                                        id="accept_order{{ $order->id }}">
                                                        @csrf
                                                        @method('patch')
                                                        <input style="visibility:hidden" name="status" type="hidden"
                                                            value="2">
                                                    </form>
                                                    <form style="visibility: hidden" method="post"
                                                        action="{{ route('store_admin.update_order_status', ['id' => $order->id]) }}"
                                                        id="reject_order{{ $order->id }}">
                                                        @csrf
                                                        @method('patch')
                                                        <input style="visibility:hidden" name="status" type="hidden"
                                                            value="3">
                                                    </form>
                                                    <form style="visibility: hidden" method="post"
                                                        action="{{ route('store_admin.update_order_status', ['id' => $order->id]) }}"
                                                        id="ready_to_serve{{ $order->id }}">
                                                        @csrf
                                                        @method('patch')
                                                        <input style="visibility:hidden" name="status" type="hidden"
                                                            value="5">
                                                    </form>

                                                    <form style="visibility: hidden" method="post"
                                                        action="{{ route('store_admin.update_order_status', ['id' => $order->id]) }}"
                                                        id="complete_order{{ $order->id }}">
                                                        @csrf
                                                        @method('patch')
                                                        <input style="visibility:hidden" name="status" type="hidden"
                                                            value="4">
                                                    </form>

                                                </td>

                                                <td style="text-align: center; vertical-align: middle">
                                                    <span>
                                                        <a href="{{ route('store_admin.view_order', $order->id) }}"
                                                            target="_blank" class="btn btn-dark waves-effect waves-light"><i
                                                                class="fas fa-eye text-warning"></i></a>

                                                                <a href="#"
                                                                onclick="if(confirm('Are you sure you want to delete this Order ?')){ event.preventDefault();document.getElementById('delete-form-{{ $order->id }}').submit(); }" class="btn btn-dark waves-effect waves-light"><i
                                                                        class="fas fa-trash text-danger"></i></a>


                                                            <form method="post"
                                                                action="{{ route('store_admin.order_delete') }}"
                                                                id="delete-form-{{ $order->id }}" style="display: none">
                                                                @csrf
                                                                @method('DELETE')
                                                                <input type="hidden" value="{{ $order->id }}" name="id">
                                                            </form>
                                                    </span>
                                                </td>
                                            </tr>
                                        @endif
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="justify-content-center">
                                    {{ $orders->links('restaurants.orders.custom-pagination') }}
                                </div>

                            </div>

                        </div>
                    </div>
                </div>

            @endsection
