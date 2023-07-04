<div x-data="
{
    rating: 0,    
    myrating : @entangle('mystaramount'),
    hoverRating: 0,
    ratings: [{'amount': 1, 'label':'Terrible'}, {'amount': 2, 'label':'Bad'}, {'amount': 3, 'label':'Okay'}, {'amount': 4, 'label':'Good'}, {'amount': 5, 'label':'Great'}],
    test(amount) {
        this.rate(amount);
        this.hoverRating = amount;
        this.myrating = this.rating;
    },
    rate(amount) {
    this.rating = amount;
    this.myrating = this.rating;
    
},
currentLabel() {
let r = this.rating;
if (this.hoverRating != this.rating) r = this.hoverRating;
let i = this.ratings.findIndex(e => e.amount == r);
if (i >=0) {return this.ratings[i].label;} else {return ''};     
},

}
" 

x-init="$watch('myrating', value => test(value))">
<style>
[x-cloak] { display: none !important; }
</style>

<style>
    .text-yellow{
        color: rgb(7, 187, 37)!important;
    }
    .text-gray{
        color:rgb(180, 180, 180);
    }
    .badge{
        color: white;
        background-color: rgb(7, 187, 37);
        font-size: 12px;
        margin-top: 5px;
        font-weight: 900;
    }
</style>
<div class="" x-data="{openinput : @entangle('openinput'), openlist : @entangle('openlist')}">

    <header>
        <div class="back-links">

                <a href="{{ url('/store/' . $view_id) }}"><button class="" style="padding: 0;border: none;background: none;"><i class="iconly-Arrow-Left icli"></i></button>
                    <div class="content">
                        <h2>{{$selected_language->data['my_order'] ?? 'My Orders'}} </h2>
                    </div>
                </a>
 
        </div>
    </header>


<div class="cartindex-wrapper" x-show="openinput" x-cloak>
    <section class="cart-section pt-0 top-space xl-space">
        <div class="container">

        <div class="mb-3">
            <label class="font-size-med" for="cardNumber">{{$selected_language->data['store_view_orders_customer_phone'] ?? 'Phone No'}}</label>
            <input class="form-control" type="text" placeholder="" wire:model="mobile_number">
            @error('mobile_number') <span class="error text-danger">{{ $message }}</span> @enderror

        </div>

        <button class="btn btn-warning btn-lg w-100" type="submit" wire:click.prevent="viewOrders()">{{$selected_language->data['view_my_orders'] ?? 'View My Orders'}}</button>
    </div>
    </section>
</div>

<div class="cartindex-wrapper mt-0" x-show="openlist" x-transition> 
    <section class="cart-section pt-0 top-space xl-space">
    <div class="container">
        <div class="card" style="border:none">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table mb-0" style="border:none">
                        <tbody>
                        @if($orders)
                        @forelse ($orders as $order)
                        @php
                        $ratings = \App\Models\OrderRating::where('order_id',$order->id)->first();
                         @endphp
                        <tr class="d-flex justify-content-between  mt-2" style="    padding: 12px 6px;
                        border-bottom: 1px solid rgba(237, 239, 244, 0.6); background-color:rgb(255, 248, 239);">
                        <td style="border:none">
                            <a>
                            <h4 class="text-danger ">{{$selected_language->data['menu_order_id'] ?? 'Order ID: '}} : {{$order->order_unique_id}}</h4><br>
                            <span class="font-size-med">{{$selected_language->data['order_type'] ?? 'Order Type'}} : <span class="status-label">{{$order->order_type == 1 ? $selected_language->data['store_panel_settings_dining'] ?? 'Dining':NULL}} 
                                {{$order->order_type == 2 ? $selected_language->data['store_panel_settings_takeaway'] ?? 'Takeaway' :NULL}}
                                {{$order->order_type == 3 ? $selected_language->data['store_panel_settings_delivery'] ?? 'Delivery':NULL}}</span></span><br>
                           
                            <div class="col-md-12 col-12">
                                <div class="stats-box">
                                    <div class="top-part">
                                        @if ($order->status == 1)
                                        <h5 >{{$selected_language->data['store_panel_common_status'] ?? 'Status'}} : {{ $selected_language->data['store_orders_status_placed'] ?? 'Order Placed' }}</h5><br>
                                        @endif

                                        @if ($order->status == 2)
                                            <h5>
                                                {{$selected_language->data['store_panel_common_status'] ?? 'Status'}} : {{ $selected_language->data['store_orders_status_processing'] ?? 'Processing' }}</h5><br>
                                        @endif
                                        @if ($order->status == 5)
                                            <h5>{{$selected_language->data['store_panel_common_status'] ?? 'Status'}} : {{ $selected_language->data['store_orders_status_ready'] ?? 'Ready' }}</h5><br>
                                        @endif

                                        @if ($order->status == 3)
                                            <h5>{{$selected_language->data['store_panel_common_status'] ?? 'Status'}} : {{ $selected_language->data['store_orders_status_rejected'] ?? 'Rejected' }}</h5><br>
                                        @endif

                                        @if ($order->status == 4)
                                            <h5 >{{$selected_language->data['store_panel_common_status'] ?? 'Status'}} : {{ $selected_language->data['store_orders_status_order_completed'] ?? 'Order Completed' }}</h5><br>
                                        @endif
                                    </div>
                                    <h6 class="content-color">{{$selected_language->data['store_panel_common_date'] ?? 'Date'}} : {{date('d-m-Y', strtotime($order->created_at)) }} </h6>
                                    @if($ratings)
                                    <span class="badge badge-success" >You Rated :  {{$ratings->rating}} <i class="fas fa-star" ></i></span>
                                    @endif
                                </div>
                            </div>
                        </a>                
                        
                        </td>     
                        <td style="border:none">
                          
                            <h4> @include('layouts.render.currency',["amount"=>$order->total])</h4> <br>
                             @if ($order->payment_status == 1 || $order->payment_status == 1)
                             <span class="fw-bold"> {{$selected_language->data['store_orders_action_unpaid'] ?? 'Not Paid'}}</span>
                             
                            @endif

                            @if ($order->payment_status == 2)
                            <span class="fw-bold text-success font-size-med"> {{$selected_language->data['store_orders_action_paid'] ?? 'Paid'}}</span>
                            @endif
                            <br>
                            <button class="btn btn-sm btn-danger mt-2" @if($order->status == 4 || $order->call_waiter_enabled == 0) disabled @endif wire:click="callWaiter({{$order->id}})" > <i class="fas fa-concierge-bell"></i></button>
                            @if(!$ratings)
                            
                            <button class="btn btn-sm btn-danger mt-2" data-bs-toggle="modal" data-bs-target="#selectrating"  wire:click="rateOrder({{$order->id}})"> <i class="fas fa-star"></i></button>
                            @endif
                        
                        </td>   
                    </tr>


                        @empty
                            
                        @endforelse
                        

                        @endif 
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


@include('livewire.home.layouts.navbar')
<div class="modal fade" id="successmodal" tabindex="-1" aria-labelledby="successmodal" aria-hidden="true" wire:ignore.self> 
    <div class="modal-dialog modal-dialog-centered px-3" >
      <div class="modal-content" >
        <div class="modal-header">
            <h5 class="modal-title" id="callwaiterModal">{{$selected_language->data['call_waiter'] ?? 'Call Waiter'}}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
        <div class="modal-body">
            @if(!$calledWaiter)
            <div class="form-group mb-3">
                <label>{{$selected_language->data['menu_comment'] ?? 'Comments'}}</label>
                <input type="text" class="form-control" wire:model="comments" style="height:40px">
            </div>
          @else 
          <h4>{{$selected_language->data['waiter_called'] ?? 'Waiter Has Been Called'}}</h4>
          <p>{{$selected_language->data['waiter_called_desc'] ?? 'You will be attended by our waiter soon....'}}</p>
          @endif 
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{$selected_language->data['menu_close'] ?? 'Close'}}</button>
          @if(!$calledWaiter) <button type="button" wire:click="confirmWaiterCall()" class="btn btn-danger">{{$selected_language->data['call_waiter'] ?? 'Call Waiter'}}</button> @endif
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="selectrating" tabindex="-1" aria-labelledby="selectrating" aria-hidden="true" wire:ignore.self> 
    <div class="modal-dialog modal-dialog-centered px-3" >
      <div class="modal-content" >
        <div class="modal-header">
            <h5 class="modal-title" id="callwaiterModal">{{$selected_language->data['call_waiter'] ?? 'Rate Order'}}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
        <div class="modal-body">
            <div 

    class="d-flex flex-column align-items-center justify-content-center space-y-2 rounded w-72 h-56 bg-gray-200 mx-auto">
    <div class="flex space-x-0 bg-gray-100">
	<template x-for="(star, index) in ratings" :key="index">
		<button @click="rate(star.amount)"  @mouseover="hoverRating = star.amount" @mouseleave="hoverRating = rating"
			aria-hidden="true" :title="star.label" class="btn text-gray"
			:class="{'text-gray': hoverRating >= star.amount, 'text-yellow': rating >= star.amount && hoverRating >= star.amount}">
			<i class="far fa-star" style="font-size: 18px; font-weight:600"></i>
		</button>
       
	</template>
  </div>
	<div class="p-2">
	</div>

        </div>
        <div class="mb-3">
            <label for="">Comments</label>
            <textarea  class="form-control" wire:model="ratingcomments"> </textarea>
            @error('ratingerror') <span class="text-danger">{{$message}}</span> @enderror
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{$selected_language->data['menu_close'] ?? 'Close'}}</button>
          @if(!$calledWaiter) <button type="button"  wire:click="saveRating()" class="btn btn-danger">{{$selected_language->data['save'] ?? 'Save'}}</button> @endif
        
        </div>
      </div>
    </div>
  </div>
</div>


@push('js')
<script>
    document.addEventListener("turbolinks:load", function() {
    Livewire.on('openModal',() => {
        $('#successmodal').modal('show')
    })
    Livewire.on('hidemodal',() => {
        $(".modal").modal('hide');
        $('.modal').remove();
        $('.modal-backdrop').remove();
    })
    });
</script>
@endpush

</div>
</div>