<div>
    <div>

        
            <style>
        [x-cloak] { display: none !important; }
                </style>
         <header>
            <div class="back-links">
                    <a href="{{ url('/store/' . $view_id) }}"><button class="" style="padding: 0;border: none;background: none;"><i class="iconly-Arrow-Left icli"></i></button>
                        <div class="content">
                            <h2>{{$selected_language->data['home'] ?? 'Home'}}</h2>
                        </div>
                    </a>
     
            </div>
        </header>
        
        <div class="success-page"  >
            <div class="">
                <div class="d-flex pt-5 justify-content-center align-items-center flex-column" style="height: 75vh;">
                    <img src="{{asset('home_assets/img/success.png')}}" alt="" style="height: 40vh;">
                    <h3>{{$selected_language->data['your_order_placed'] ?? 'Your Order Has Been Placed'}}</h3>
                    <h4 class="text-success">{{$selected_language->data['your_order_number_is'] ?? 'Order Number'}} : {{$order->id}}</h4>
                    @if($successmsg)<h5 class="text-success">{{$selected_language->data['payment_id'] ?? 'Payment ID'}} : {{$successmsg}}</h5>@endif
                    <div class="mt-5">
                        <a href="{{ url('/store/' . $view_id.'/myorder') }}"><button type="button" class="btn btn-primary ">{{$selected_language->data['view_my_order'] ?? 'View Order'}}</button></a>
                        <a href="{{ url('/store/' . $view_id) }}"><button type="button" class="btn btn-primary ">{{$selected_language->data['home'] ?? 'Home'}}</button></a>
                        @if($final_order && $store->phone && $store->whatsappbutton_enable ==1)
                        @php 
                        function myUrlEncode($string) {
                            $entities = array('%21', '%2A', '%27', '%28', '%29', '%3B', '%3A', '%40', '%26', '%3D', '%2B', '%24', '%2C', '%2F', '%3F', '%25', '%23', '%5B', '%5D');
                            $replacements = array('!', '*', "'", "(", ")", ";", ":", "@", "&", "=", "+", "$", ",", "/", "?", "%", "#", "[", "]");
                            return str_replace($entities, $replacements, urlencode($string));
                        }
                        
                        
                        $products = '%0ACustomer Name: *'.$order->customer_name.'*';
                        if($order->order_type == 1)
                        {
                            $products .= '%0AOrder Type: *Dining*';
    
                        }
                        if($order->order_type == 2)
                        {
                            $products .= '%0AOrder Type: *Takeaway*';
    
                        }
                        if($order->order_type == 3)
                        {
                            $products .= '%0AOrder Type: *Delivery*';
    
                        }
                        if($order->order_type == 4)
                        {
                            $products .= '%0AOrder Type: *Room*';
    
                        }
                        if($order->address != null)
                        {
                            $products .= '%0ACustomer Address : *'.$order->address.'*';
                        }
                        if($order->customer_phone != null)
                        {
                            $products .= '%0ACustomer Phone:  *'.$order->customer_phone.'*';
                        }
                        if($order->table_no)
                        {
                            $products .= '%0ATable No: *'.$order->table_no.'*';
                        }
                        if($order->room_number)
                        {
                            $products .= '%0ARoom No: *'.$order->room_number.'*';
                        }
                        if($order->payment_status == 2)
                        {
                            $products .= '%0A*Order has been paid* ';
    
                        }
                       
                        $products .= '%0AProduct : ';
                        foreach($final_order as $order_data)
                        {
                            
                            foreach($order_data['order_details'] as $key => $data)
                            {
                                $products .= '%0A*'.$data['name'].'* Quantity : '.$data['quantity'];
                                $products .= '%0AAddons: ';
                                foreach($data['order_details_extra_addon'] as $key => $exra)
                                {
                                    $products .= '%0A*'.$exra['addon_name'].'*';
                                }
                            }
                        }
                        $products .= '%0AOrder ID : *'.$order->order_unique_id.'*';
                        $products .= '%0ATotal : *'.$order->total.'*';
                        @endphp 
                        <a href="https://wa.me/{{$store->phone}}?text={{myUrlEncode($products)}}">
                            
                            <button type="button" class="btn btn-success ">{{$selected_language->data['send_to_whatsapp'] ?? 'Send Via Whatsapp'}}</button></a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer Nav-->
        @include('livewire.home.layouts.navbar')
            
</div>
