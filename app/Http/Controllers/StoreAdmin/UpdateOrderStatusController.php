<?php

namespace App\Http\Controllers\StoreAdmin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Notification\NotificationController;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\OrderDetailAddon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;
use App\Application;
use App\Http\Controllers\TranslationService;
use Illuminate\Support\Facades\Redirect;

class UpdateOrderStatusController extends Controller
{
    public function  __construct()
    {
        $this->middleware('auth:store');
    }
    public function updateStatus(Request $request,$id){
        $notification = new NotificationController();
////        return $request;
//        return $id;


        $data = request()->validate([
            'status'=>'required'
        ]);
        if($request->status == 5)
        {
            $order = Order::whereId($id)->first();
            if($order->order_type == 1)
            {
                sendMessageToAllWaiters([
                    'title' => 'Ready To Serve - '.$order->table_no,
                    'body'  => 'The food is now ready to be served at table '.$order->table_no.'.', 
                ],$order->store_id,2);
            }
            
        }
        if(Order::whereId($id)->update($data)){
//            $order = Order::find($id);
////            $notification->WhatsAppOrderNotification($order);
            return back()->with(Toastr::success('Status Updated successfully ','Success'));
        }
        return back()->with(Toastr::success('Status Updated successfully ','Success'));
    }


    public function updatepaymentStatus(Request $request,$id){
        $notification = new NotificationController();
////        return $request;
//        return $id;

        $data = request()->validate([
            'payment_status'=>'required'
        ]);

        if(Order::whereId($id)->update($data)){
//            $order = Order::find($id);
////            $notification->WhatsAppOrderNotification($order);
            return back()->with(Toastr::success('Payment Status Updated successfully ','Success'));
        }
        return back()->with(Toastr::success('Payment Status Updated successfully ','Success'));
    }

    /* merge order */
    public function mergeOrder(Request $request,$id){
        $notification = new NotificationController();

        $data = request()->validate([
            'status'=>'required'
        ]);
        $account_info = Application::all()->first();
        $translation = new TranslationService();
        $languages=$translation->languages();
        return view('restaurants.orders.merge_order',compact('id','account_info','languages'));
    }

    /* merge order */

    public function mergeOrders(Request $request) {
       
       $primaryOrder = Order::find($request->id);
    
      if($request->sub_order_id!=NULL){
        foreach ($request->sub_order_id as $order_id) {
            if($order_id != null)
            {
                $order = Order::find($order_id);
                $primaryOrder->sub_total = $primaryOrder->sub_total + $order->sub_total;
                $primaryOrder->tax = $primaryOrder->tax + (($order->tax) ?? 0);
                $primaryOrder->discount = $primaryOrder->discount + (($order->discount) ?? 0);
                $primaryOrder->total = $primaryOrder->total + $order->sub_total + (($order->tax) ?? 0) - (($order->discount) ?? 0);
                $primaryOrder->save();
                $order->is_merged = 1;
                $order->save();

                $orderDetail = OrderDetails::where('order_id',$order->id)->get();

                foreach($orderDetail as $detailRow) {
                    $detailRow->order_id = $primaryOrder->id;
                    $detailRow->save();
                }
                
            } 
        }
    }
    
    if($request->sub_order_id==NULL){
        return Redirect::route("store_admin.orders" )->with(Toastr::error('Merge Not Done. Orders To Merge is Empty.','Error'));
    }
        return Redirect::route("store_admin.orders" )->with(Toastr::success('Order Merged successfully ','Success'));
    }

}
