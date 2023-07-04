<?php

use Nwidart\Modules\Facades\Module;

function for_payment_round($amount){

    return number_format((float)$amount , 2, '.', '');

}


function getPaymentType($id)
{
    if($id)
    {
        switch($id)
        {
            case 1:
                return 'Cash On Delivery';
            case 2:
                return 'Razorpay';
            case 3:
                return 'Stripe';
            case 4:
                return 'Paypal';
            case 5:
                return 'Stripe';
            default:
                return $id;
        }
    }
}

function sendMessageToAllWaiters($content,$store_id,$type = null)
{
    $module = Module::find('Waiter');
    if($module)
    {
        $fcmsettings = \Modules\Waiter\Entities\WaiterSettings::where('store_id',$store_id)->first();
        if($fcmsettings && $fcmsettings->enable_notifications)
        {
            $url = 'https://fcm.googleapis.com/fcm/send';
            $DeviceToekn = \Modules\Waiter\Entities\Waiter::where('store_id',$store_id)->whereNotNull('fb_token')->pluck('fb_token')->all();
            $FcmKey = strval($fcmsettings->fcm_key);

            $data = [
                "registration_ids" => $DeviceToekn,
                "notification" => [
                    "title" => $content['title'],
                    "body" => $content['body'],  
                ],
                "data" => [
                    "footer"    => $content['footer'] ?? '',
                ]
            ];
            $RESPONSE = json_encode($data);
            $headers = [
                'Authorization: key='.$FcmKey,
                'Content-Type: application/json',
            ];

            // CURL
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $RESPONSE );
            $output = curl_exec($ch);
            if ($output === FALSE) {
                die('Curl error: ' . curl_error($ch));
            }        
            curl_close($ch);

            $users = \Modules\Waiter\Entities\Waiter::where('store_id',$store_id)->whereNotNull('fb_token')->get();
            foreach($users as $row)
            {
                \Modules\Waiter\Entities\WaiterNotification::create([
                    'title' => $content['title'],
                    'content'   => $content['body'],
                    'type'  => $type??1,
                    'waiter_id' => $row->id,
                    'store_id'  => $store_id,
                    'read'  => 0,
                ]);
            }
        }
    
        
    }
   
}