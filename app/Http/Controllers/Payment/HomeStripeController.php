<?php

namespace App\Http\Controllers\payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Payment\PayPalController;
use App\Models\SelectedSubscription;
use App\Models\Setting;
use App\Models\Store;
use App\Models\StoreSubscription;
use App\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use MongoDB\Driver\Session;
use Razorpay\Api\Api;
use Stripe\Stripe;
use App\Models\Order;
class HomeStripeController extends Controller
{
    public function index(Request $request)
    {
        $order = Order::where('id',$request->order_id)->first();
        $store = Store::where('view_id','=',$request->view_id)->first();
        $storesettings = \App\StoreSetting::where('store_id',$store->id)->first();
        $currency = $storesettings->StoreCurrency;

        Stripe::setApiKey($storesettings->StripeSecretKey);
        $session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => $currency,
                    'product_data' => [
                        'name' => 'Order ',
                    ],
                    'unit_amount' => $order->total*100,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => url('/store/payment-complete/'.base64_encode($order->order_unique_id)),
            'cancel_url' => url('/store/payment/fail-stripe/'.base64_encode($order->order_unique_id)),
        ]);
        session(['transactional_id' => $session->id]);
        error_log('Some message here.'); 
        return response()->json($session);
        
    }
}
