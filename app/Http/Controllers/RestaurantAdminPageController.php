<?php

namespace App\Http\Controllers;

use App\Application;
use App\Category;
use App\Models\Addon;
use App\Models\AddonCategory;
use App\Models\AddonCategoryItem;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\OrderRating;
use App\Models\SelectedSubscription;
use App\Models\Setting;
use App\Models\StoreSlider;
use App\Models\StoreSubscription;
use App\Models\Table;
use App\Models\UserExpense;
use App\Models\WaiterCall;
use App\Product;
use App\StoreSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Translation;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Route;

class RestaurantAdminPageController extends Controller
{
    public function __construct(Redirector $redirect)
    {
        $this->middleware('auth:store');


        if(Route::currentRouteName()!='store_admin.subscription_plans' && (Setting::find(23)->value ?? 0) == 1){
            $redirect->to(route('store_admin.subscription_plans'))
                ->with("MSG", "There is no valid subscription plan in your account please renew it :)")->with("TYPE", "danger")
               ->send();
        }

    }
    public function index()
    {

        $store_id = Auth::user()->id;
        $translation = new TranslationService();
        $sanboxNumber = Setting::all()->where('key','PhoneCode')->first()->value;
        $order_count = Order::all()->where('store_id','=', $store_id )->count();
        $call_waiter_count = WaiterCall::all()->where('store_id','=', $store_id )->count();
        $item_sold = DB::table('orders')->where('store_id','=', $store_id )
            ->select('*')
            ->join('order_details','orders.id','=','order_details.order_id')
            ->where('orders.status','=',4)
            ->get()->sum('quantity');

        $earnings = Order::all()->where('status','=',4)->where('store_id','=', $store_id )->sum('total');
        $account_info = Application::all()->first();
        $orders = Order::orderBy('created_at','DESC')->where('store_id', auth()->id())->where('status','=',1)->limit(6)->get();
        $latestreviews = OrderRating::where('store_id', auth()->id())->orderBy('created_at','DESC')->limit(5)->get();
        $notification = $this->notification();

        return view('restaurants.index',[
            'root' =>'dashboard',
            "order_count"=>$order_count,
            'call_waiter_count'=>$call_waiter_count,
            "item_sold"=>$item_sold,
            "earnings"=> $earnings,
            "account_info" =>  $account_info,
            'orders'=>$orders,
            'notification'=>$notification,
            'sanboxNumber'=>$sanboxNumber,
            'root_name' => 'Dashboard',
            'ratings' => $latestreviews,
            'languages'=>$translation->languages(),
            'selected_language' => $translation->selected_language()
        ]);
    }

    public function orders(){
        $account_info = Application::all()->first();
        $sanboxNumber = Setting::all()->where('key','PhoneCode')->first()->value;
        $translation = new TranslationService();
        $orders = Order::where('store_id', auth()->id())->orderby('id','desc')->paginate(15);
        $orders_count = Order::all()->SortByDesc('id')->where('store_id', auth()->id())->count();
        return view('restaurants.orders.orders',[
            'root' => 'orders',
            'orders'=>$orders,
            'orders_count'=>$orders_count,
            'root_name' => 'Orders',
            "account_info" =>  $account_info,
            'sanboxNumber'=>$sanboxNumber,
            'languages'=>$translation->languages(),
            'selected_language' => $translation->selected_language()

        ]);
    }

    public function orderstatus(){
        $translation = new TranslationService();
        $account_info = Application::all()->first();
        $sanboxNumber = Setting::all()->where('key','PhoneCode')->first()->value;
        $orders = Order::all()->SortByDesc('id')->where('store_id', auth()->id())->where('status','=',2);
        $neworder = Order::all()->SortByDesc('id')->where('store_id', auth()->id())->where('status','=',1);
        $ready = Order::all()->SortByDesc('id')->where('store_id', auth()->id())->where('status','=',5);
        return view('restaurants.orders.orderstatus',[
            'root'=>'order_status',
            'orders'=>$orders,
            'neworder'=>$neworder,
            'ready'=>$ready,
            'root_name' => 'Order Status Screen',
            "account_info" =>  $account_info,
            'sanboxNumber'=>$sanboxNumber,
            'languages'=>$translation->languages(),
            'selected_language' => $translation->selected_language()
        ]);

    }


    public function order_delete(Request $request)
    {

        Order::destroy($request->id);

        return back()->with(Toastr::success('Order Deleted successfully ','Success'));

    }

    public function new_orders(){


        $orders = Order::all()->SortByDesc('id')->where('store_id', auth()->id());
        $orders_count = Order::all()->SortByDesc('id')->where('store_id', auth()->id())->count();
        $response = array();
        foreach ( $orders as $data)
            $response[] = $data;

        return response()->json([
            "success" => true,
            "status" => "success",
            "payload" => [
                'orders' =>$response,
                'count' =>$orders_count
            ]
        ], 200);

    }
    public function new_waiter_calls(){


        $orders = WaiterCall::all()->where('store_id', auth()->id());
        $orders_count = WaiterCall::all()->SortByDesc('id')->where('store_id', auth()->id())->count();
        $response = array();
        foreach ( $orders as $data)
            $response[] = $data;

        return response()->json([
            "success" => true,
            "status" => "success",
            "payload" => [
                'waiter_calls' =>$response,
                'call_waiter_count' =>$orders_count
            ]
        ], 200);

    }
    public function view_order(Order $id){

        $translation = new TranslationService();
        $orderDetails =  Order::with('orderDetails.OrderDetailsExtraAddon')->where('id',$id->id)->get()->toArray();
        $sanboxNumber = Setting::all()->where('key','PhoneCode')->first()->value;
//        return OrderDetails::with('OrderDetailsExtraAddon')->get();
//        return $orderDetails;
        $account_info = Application::all()->first();
        return view('restaurants.orders.view_order',[
            'root' => 'orders',
            'order'=>$id,
            'orderDetails'=>$orderDetails,
            'account_info'=>$account_info,
            'root_name' => 'Orders',
            'sanboxNumber'=>$sanboxNumber,
            'languages'=>$translation->languages(),
            'selected_language' => $translation->selected_language()
        ]);

    }
    public function inventory(){
        $translation = new TranslationService();
        $category_count = Category::all()->where('store_id', auth()->id())->count();
        $sanboxNumber = Setting::all()->where('key','PhoneCode')->first()->value;
        $account_info = Application::all()->first();
        $category = Category::withCount('productinfos')->where('store_id', auth()->id())->get();
        $products_count = Product::all()->where('store_id', auth()->id())->count();
        $products = Product::all()->SortByDesc('id')->where('store_id', auth()->id());
        $productsnonveg = Product::all()->SortByDesc('id')->where('store_id', auth()->id())->where('is_veg', '=', 0);
        $productsveg = Product::all()->SortByDesc('id')->where('store_id', auth()->id())->where('is_veg', '=', 1);
        $productsdisabled = Product::all()->SortByDesc('id')->where('store_id', auth()->id())->where('is_active', '=', 0);
        $addons_count = AddonCategory::all()->where('store_id', auth()->id())->count();
        $addons = AddonCategory::all()->SortByDesc('id')->where('store_id', auth()->id());
        $addons_category= AddonCategory::all()->where('store_id', auth()->id());
        $addon = Addon::all()->SortByDesc('id')->where('store_id', auth()->id());
        $addon_count = Addon::all()->where('store_id', auth()->id())->count();

        return view('restaurants.inventory.category',[
            'root' => 'inventory',
            'root_name' => 'Inventory',
            'title' => 'Inventory',
            'category'=>$category,
            'category_count'=>$category_count,
            "account_info" =>  $account_info,
            'sanboxNumber'=>$sanboxNumber,
            'languages'=>$translation->languages(),
            'selected_language' => $translation->selected_language(),
            'products'=>$products,
            'products_count'=>$products_count,
            'productsnonveg' => $productsnonveg,
            'productsveg' => $productsveg,
            'productsdisabled' => $productsdisabled,
            'addon'=>$addon,
            'addons'=>$addons,
            'addons_count'=>$addons_count,
            'addon_count'=>$addon_count,
            'addons_category' => $addons_category,
        ]);
    }
//    public function categories(){
//        $translation = new TranslationService();
//        $category_count = Category::all()->where('store_id', auth()->id())->count();
//        $sanboxNumber = Setting::all()->where('key','PhoneCode')->first()->value;
//        $account_info = Application::all()->first();
//        $category = Category::withCount('productinfos')->where('store_id', auth()->id())->get();
//        return view('restaurants.inventory.category',[
//            'title' => 'Category',
//            'root_name' => 'Category',
//            'root' => 'category',
//            'category'=>$category,
//            'category_count'=>$category_count,
//            "account_info" =>  $account_info,
//            'sanboxNumber'=>$sanboxNumber,
//            'languages'=>$translation->languages(),
//            'selected_language' => $translation->selected_language()
//        ]);
//
//
//    }
    public function addcategories(){
        $translation = new TranslationService();
        $account_info = Application::all()->first();
        $sanboxNumber = Setting::all()->where('key','PhoneCode')->first()->value;
        return view('restaurants.inventory.addcategory',[
            'root' => 'category',
            'root_name' => 'Category',
            'sanboxNumber'=>$sanboxNumber,
            "account_info" =>  $account_info,
            'languages'=>$translation->languages(),
            'selected_language' => $translation->selected_language()
        ]);

    }
    public function update_category(Category $id){
        $sanboxNumber = Setting::all()->where('key','PhoneCode')->first()->value;
        $account_info = Application::all()->first();
        $translation = new TranslationService();
        return view('restaurants.inventory.editcategory',
            [
                'title' => 'Category',
                'root_name' => 'Category',
                'root' => 'category',
                'data' => $id,
                "account_info" =>  $account_info,
                'sanboxNumber'=>$sanboxNumber,
                'languages'=>$translation->languages(),
                'selected_language' => $translation->selected_language()

            ]);
    }

    public function sort_category(){
        $sanboxNumber = Setting::all()->where('key','PhoneCode')->first()->value;
        $account_info = Application::all()->first();
        $translation = new TranslationService();
        $categories = Category::all()->sortBy('sort_order')->where('store_id', auth()->id());
        return view('restaurants.inventory.sort_category',
            [
                'title' => 'Category',
                'root_name' => 'Category',
                'root' => 'category',
                'data' => $categories,
                "account_info" =>  $account_info,
                'sanboxNumber'=>$sanboxNumber,
                'languages'=>$translation->languages(),
                'selected_language' => $translation->selected_language()
            ]);
    }

    public function sort_product($cat_id = null){
        $sanboxNumber = Setting::all()->where('key','PhoneCode')->first()->value;
        $account_info = Application::all()->first();
        $translation = new TranslationService();
        $categories = Category::all()->sortBy('sort_order')->where('store_id', auth()->id())->where('is_active',1);
        if(!$cat_id)
        {
            $selectedcat = $categories->first();
        }
        else{
            $selectedcat = Category::where('id',$cat_id)->where('store_id',auth()->id())->first();
            if(!$selectedcat)
            {
                $selectedcat = $categories->first();
            }
        }
        $products = Product::all()->sortBy('sort_order')->where('store_id', auth()->id())->where('is_active',1)->where('category_id',$selectedcat->id);
        return view('restaurants.inventory.sort_product',
            [
                'title' => 'Category',
                'root_name' => 'Category',
                'root' => 'category',
                'data' => $products,
                'selected_cat' => $selectedcat,
                'categories' => $categories,
                "account_info" =>  $account_info,
                'sanboxNumber'=>$sanboxNumber,
                'languages'=>$translation->languages(),
                'selected_language' => $translation->selected_language()
            ]);
    }

   public function products(){
       $translation = new TranslationService();
       $account_info = Application::all()->first();
       $sanboxNumber = Setting::all()->where('key','PhoneCode')->first()->value;
       $products_count = Product::all()->where('store_id', auth()->id())->count();
       $products = Product::all()->SortByDesc('id')->where('store_id', auth()->id());
       $productsnonveg = Product::all()->SortByDesc('id')->where('store_id', auth()->id())->where('is_veg', '=', 0);
       $productsveg = Product::all()->SortByDesc('id')->where('store_id', auth()->id())->where('is_veg', '=', 1);
       $productsdisabled = Product::all()->SortByDesc('id')->where('store_id', auth()->id())->where('is_active', '=', 0);
       return view('restaurants.inventory.products',[
           'root' => 'category',
           'products'=>$products,
           'products_count'=>$products_count,
           'root_name' => 'Products',
           "account_info" =>  $account_info,
           'productsnonveg' => $productsnonveg,
           'productsveg' => $productsveg,
           'productsdisabled' => $productsdisabled,
           'sanboxNumber'=>$sanboxNumber,
           'languages'=>$translation->languages(),
           'selected_language' => $translation->selected_language()

       ]);
   }

    public function addproducts(){
        $translation = new TranslationService();
        $sanboxNumber = Setting::all()->where('key','PhoneCode')->first()->value;
        $category = Category::all()->where('store_id', auth()->id());
        $account_info = Application::all()->first();
        $addon_category = AddonCategory::all()->where('store_id', auth()->id());
        return view('restaurants.inventory.addproducts',[
            'root' => 'category',
            'category'=>$category,
            'addon_category'=>$addon_category,
            'root_name' => 'Products',
            "account_info" =>  $account_info,
            'sanboxNumber'=>$sanboxNumber,
            'languages'=>$translation->languages(),
            'selected_language' => $translation->selected_language()
        ]);
    }

    public function update_products(Product $id){
        $translation = new TranslationService();
        $sanboxNumber = Setting::all()->where('key','PhoneCode')->first()->value;
        $addon_category = AddonCategory::all()->where('store_id', auth()->id());
        $category = Category::all()->where('store_id', auth()->id());
        $addon_category_items = AddonCategoryItem::all()->where('product_id','=',$id->id);
        $account_info = Application::all()->first();

//        return  $addon_category_items;
        return view('restaurants.inventory.editproducts',
            [
                'title' => 'update Products',
                'root_name' => 'Products',
                'root' => 'category',
                'data' => $id,
                'category'=>$category,
                'addon_category'=>$addon_category,
                'sanboxNumber'=>$sanboxNumber,
                "account_info" =>  $account_info,
                'addon_category_items'=>$addon_category_items,
                'languages'=>$translation->languages(),
                'selected_language' => $translation->selected_language()
            ]);


    }


   public function addon_categories(){
       $translation = new TranslationService();
       $sanboxNumber = Setting::all()->where('key','PhoneCode')->first()->value;
       $addons_count = AddonCategory::all()->where('store_id', auth()->id())->count();
       $addons = AddonCategory::all()->SortByDesc('id')->where('store_id', auth()->id());
       $account_info = Application::all()->first();
       return view('restaurants.addons.addon_categories',[
           'root' => 'category',
           'addons'=>$addons,
           'addons_count'=>$addons_count,
           'root_name' => 'Addon Category',
           "account_info" =>  $account_info,
           'sanboxNumber'=>$sanboxNumber,
           'languages'=>$translation->languages(),
           'selected_language' => $translation->selected_language()
       ]);
   }

    public function addon_categories_edit(AddonCategory $id){
        $sanboxNumber = Setting::all()->where('key','PhoneCode')->first()->value;
        $translation = new TranslationService();
        $account_info = Application::all()->first();
        return view('restaurants.addons.edit_addon_categories',
            [
                'title' => 'update Category',
                'root' => 'category',
                'data' => $id,
                'root_name' => 'Addon Category',
                "account_info" =>  $account_info,
                'sanboxNumber'=>$sanboxNumber,
                'languages'=>$translation->languages(),
                'selected_language' => $translation->selected_language()

            ]);
    }


   public function addon(){
       $translation = new TranslationService();
       $addons_category= AddonCategory::all()->where('store_id', auth()->id());
       $sanboxNumber = Setting::all()->where('key','PhoneCode')->first()->value;
       $addon_count = Addon::all()->where('store_id', auth()->id())->count();
       $addon = Addon::all()->SortByDesc('id')->where('store_id', auth()->id());
       $account_info = Application::all()->first();
       return view('restaurants.addons.addon',[
           'root' => 'category',
           'addon'=>$addon,
           'addon_count'=>$addon_count,
           'addons_category' => $addons_category,
           'root_name' => 'Addons',
           "account_info" =>  $account_info,
           'sanboxNumber'=>$sanboxNumber,
           'languages'=>$translation->languages(),
           'selected_language' => $translation->selected_language()
       ]);
   }
    public function update_addon(Addon $id){
        $translation = new TranslationService();
        $addons_category= AddonCategory::all()->where('store_id', auth()->id());
        $addon_count = Addon::all()->where('store_id', auth()->id())->count();
        $sanboxNumber = Setting::all()->where('key','PhoneCode')->first()->value;
        $account_info = Application::all()->first();

        return view('restaurants.addons.update_addon',[
            'root' => 'category',
            'addon'=>$id,
            'addon_count'=>$addon_count,
            'addons_category' => $addons_category,
            'root_name' => 'Addons',
            "account_info" =>  $account_info,
            'sanboxNumber'=>$sanboxNumber,
            'languages'=>$translation->languages(),
            'selected_language' => $translation->selected_language()
        ]);
    }


    public function tables(){
        $translation = new TranslationService();
        $tables = Table::all()->SortByDesc('id')->where('store_id', auth()->id());
        $sanboxNumber = Setting::all()->where('key','PhoneCode')->first()->value;
        $account_info = Application::all()->first();
        return view('restaurants.tables.all_tables',[
            'root' => 'tables',
            'title' => 'All Tables',
            'tables'=>$tables,
            "account_info" =>  $account_info,
            'root_name' => 'Tables',
            'sanboxNumber'=>$sanboxNumber,
            'languages'=>$translation->languages(),
            'selected_language' => $translation->selected_language()
        ]);

    }
    public function table_report(){
        $translation = new TranslationService();
        $tables = Table::all()->SortByDesc('id')->where('store_id', auth()->id());
        $sanboxNumber = Setting::all()->where('key','PhoneCode')->first()->value;
        $account_info = Application::all()->first();
        return view('restaurants.tables.table_report',[
            'root' => 'tables',
            'title' => 'All Tables',
            'tables'=>$tables,
            'root_name' => 'Table Report',
            "account_info" =>  $account_info,
            'sanboxNumber'=>$sanboxNumber,
            'languages'=>$translation->languages(),
            'selected_language' => $translation->selected_language()
        ]);
    }
    public function add_table(){
        $translation = new TranslationService();
        $sanboxNumber = Setting::all()->where('key','PhoneCode')->first()->value;
        $account_info = Application::all()->first();

        return view('restaurants.tables.add_new_table',[
            'root' => 'tables',
            'title' => 'Add New Tables',
            'root_name' => 'Tables',
            "account_info" =>  $account_info,
            'sanboxNumber'=>$sanboxNumber,
            'languages'=>$translation->languages(),
            'selected_language' => $translation->selected_language()
        ]);
    }


    public function edit_table(Table $id){
        $translation = new TranslationService();
        $head_name="Update Table";
        $account_info = Application::all()->first();
        $sanboxNumber = Setting::all()->where('key','PhoneCode')->first()->value;
        return view('restaurants.tables.edit_table',compact('id'),[
            'title' => 'Table',
            'root_name' => 'Table',
            "account_info" =>  $account_info,
            'root' => 'Table',
            'sanboxNumber'=>$sanboxNumber,
            'languages'=>$translation->languages(),
            'selected_language' => $translation->selected_language()
        ]);
    }


    public function banner(){
        $translation = new TranslationService();
        $banner = StoreSlider::all()->SortByDesc('id')->where('store_id', auth()->id());
        $account_info = Application::all()->first();
        $sanboxNumber = Setting::all()->where('key','PhoneCode')->first()->value;
        return view('restaurants.banner.banner',[
            'root' => 'promo_banner',
            'title' => 'All Tables',
            'banner'=>$banner,
            'root_name' => 'Banners',
            "account_info" =>  $account_info,
            'sanboxNumber'=>$sanboxNumber,
            'languages'=>$translation->languages(),
            'selected_language' => $translation->selected_language()
        ]);
    }

    public function banneredit(StoreSlider $id){
        $translation = new TranslationService();
        $head_name="Update Banner";
        $sanboxNumber = Setting::all()->where('key','PhoneCode')->first()->value;
        $account_info = Application::all()->first();
        return view('restaurants.banner.edit_banner',compact('id'),[
            'title' => 'Banner',
            'root_name' => 'Banner',
            "account_info" =>  $account_info,
            'root' => 'Banner',
            'sanboxNumber'=>$sanboxNumber,
            'languages'=>$translation->languages(),
            'selected_language' => $translation->selected_language()
        ]);
    }




    public function addbanner(){
        $translation = new TranslationService();
        $sanboxNumber = Setting::all()->where('key','PhoneCode')->first()->value;
        $account_info = Application::all()->first();
        return view('restaurants.banner.addbanner',[
            'root' => 'promo_banner',
            'title' => 'Add Banner',
            "account_info" =>  $account_info,
            'root_name' => 'Banners',
            'sanboxNumber'=>$sanboxNumber,
            'languages'=>$translation->languages(),
            'selected_language' => $translation->selected_language()
        ]);
    }

    public function subscription_plans(){
        $translation = new TranslationService();
        $publishableKey = Setting::all()->where('key','=','StripePublishableKey')->first()->value;
        $sanboxNumber = Setting::all()->where('key','PhoneCode')->first()->value;
        $subscription = StoreSubscription::all()->where('is_active','=',1)->where('price','!=',0);
        $subscription_count = StoreSubscription::all()->where('is_active','=',1)->where('price','!=',0)->count();
        $isStripeEnabled =  Setting::all()->where('key','=','IsStripePaymentEnabled')->first()->value;

        $razorpay_key_id = Setting::all()->where('key','=','RazorpayKeyId')->first()->value;
        $razorpayEnabled =  Setting::all()->where('key','=','IsRazorpayPaymentEnabled')->first()->value;

        $paypalMode = Setting::all()->where('key','=','PaypalMode')->first()->value;
        $paypalKeyId =  Setting::all()->where('key','=','PaypalKeyId')->first()->value;
        $isPaypalEnabled = Setting::all()->where('key','=','IsPaypalPaymentEnabled')->first()->value;

        $account_info = Application::all()->first();
        $currency = Setting::all()->where('key','=','Currency')->first()->value;
        $logo = Application::first()->application_logo;

        return view('restaurants.store_subscription.plans',[
            'root' => 'subscription',
            'title' => 'Subscription Plans',
            'subscription_count'=> $subscription_count,
            'subscription'=>$subscription,
            'publishableKey'=>$publishableKey,
            'isStripeEnabled'=> $isStripeEnabled,
            'root_name' => 'Subscription',
            "account_info" =>  $account_info,
            'sanboxNumber'=>$sanboxNumber,
            'razorpayEnabled'=>  $razorpayEnabled,
            'razorpay_key_id'=>$razorpay_key_id,
            'currency'=>$currency,
            'logo'=>$logo,
            'languages'=>$translation->languages(),
            'selected_language' => $translation->selected_language(),
            'paypalMode'=>$paypalMode,
            'paypalKeyId'=>$paypalKeyId,
            'isPaypalEnabled'=>$isPaypalEnabled

        ]);
    }
    public function subscription_history(){
        $translation = new TranslationService();
        $store_plan_history = SelectedSubscription::all()->where('store_id','=',\auth()->id());
        $account_info = Application::all()->first();
        $sanboxNumber = Setting::all()->where('key','PhoneCode')->first()->value;
        return view('restaurants.store_subscription.history',[
            'root' => 'subscription',
            'store_plan_history' => $store_plan_history,
            'root_name' => 'Subscription History',
            'sanboxNumber'=>$sanboxNumber,
            "account_info" =>  $account_info,
            'languages'=>$translation->languages(),
            'selected_language' => $translation->selected_language()
        ]);
    }

    public function settings(){
        $translation = new TranslationService();
        $store = Auth::user();
        $sanboxNumber = Setting::all()->where('key','PhoneCode')->first()->value;
        $store_settings = StoreSetting::all()->where('store_id',\auth()->id())->first();
        $account_info = Application::all()->first();



        return view('restaurants.settings.index',[
            'root' => 'settings',
            'title' => 'Settings',
            'store' =>$store,
            'root_name' => 'Settings',
            'sanboxNumber'=>$sanboxNumber,
            "account_info" =>  $account_info,
            'languages'=>$translation->languages(),
            'selected_language' => $translation->selected_language(),
            'store_settings'=>$store_settings,

        ]);


    }

    public function notification(){
        $translation = new TranslationService();
        $notification = array();
        if(Auth::user()->subscription_end_date < date('Y-m-d')) {
            $notification['head'] = "YOUR SUBSCRIPTION HAS EXPIRED";
            $notification['sub_head'] = "Please renew your subscription to continue enjoying our services.";
            $notification['route_submit_button_name'] = "Renew Now";
            $notification['route'] = "store_admin.subscription_plans";
        }
        return $notification;
    }
    // customers
    public function customers(){
        $translation = new TranslationService();
        $customers = Order::where('store_id',auth()->id())->distinct('customer_phone')->orderby('id','desc')->paginate(20);
        $account_info = Application::all()->first();
        $sanboxNumber = Setting::all()->where('key','PhoneCode')->first()->value;
//        return $customers[0]->total_orders(9544752154);
        return view('restaurants.customers.index',[
            'root' => 'customers',
            'title' => 'Customers',
            'customers' => $customers,
            'root_name' => 'Customers',
            "account_info" =>  $account_info,
            'sanboxNumber'=>$sanboxNumber,
            'languages'=>$translation->languages(),
            'selected_language' => $translation->selected_language()
        ]);
    }
    public function waiter_calls(){
        $translation = new TranslationService();
        $calls = WaiterCall::all()->where('store_id','=',auth()->id())->where('is_completed','0')->sortByDesc('id');
        $account_info = Application::all()->first();
        $sanboxNumber = Setting::all()->where('key','PhoneCode')->first()->value;

//        return $customers[0]->total_orders(9544752154);
        return view('restaurants.waiterCall.waiter_call',[
            'root' => 'waiter_call',
            'title' => 'Customers',
            'count' => $calls->where('is_completed','=',0)->count(),
            'calls' => $calls,
            'root_name' => 'Waiter Call',
            "account_info" =>  $account_info,
            'sanboxNumber'=>$sanboxNumber,
            'languages'=>$translation->languages(),
            'selected_language' => $translation->selected_language()
        ]);
    }


    public function store_expense(){
        $translation = new TranslationService();
        $sanboxNumber = Setting::all()->where('key','PhoneCode')->first()->value;
        $account_info = Application::all()->first();
        $expense = UserExpense::all()->where('store_id','=',auth()->id())->sortByDesc('id');
        return view('restaurants.expense.all_expense',[
            'root' => 'expense',
            'title' => 'Expense',
            "account_info" =>  $account_info,
            'root_name' => 'Expense',
            'sanboxNumber'=>$sanboxNumber,
            'languages'=>$translation->languages(),
            'selected_language' => $translation->selected_language(),
            'expense' => $expense,

        ]);
    }


    public function coupons(){
        $translation = new TranslationService();
        $sanboxNumber = Setting::all()->where('key','PhoneCode')->first()->value;
        $account_info = Application::all()->first();
        $coupons = Coupon::all()->where('store_id','=',auth()->id())->sortByDesc('id');
        return view('restaurants.coupons.all_coupons',[
            'root' => 'coupons',
            'title' => 'Coupons',
            "account_info" =>  $account_info,
            'root_name' => 'Coupons',
            'sanboxNumber'=>$sanboxNumber,
            'languages'=>$translation->languages(),
            'selected_language' => $translation->selected_language(),
            'coupons' => $coupons,

        ]);
    }


    public function add_coupons(){
        $translation = new TranslationService();
        $sanboxNumber = Setting::all()->where('key','PhoneCode')->first()->value;
        $account_info = Application::all()->first();
        return view('restaurants.coupons.add_coupons',[
            'root' => 'coupons',
            'title' => 'Coupons',
            "account_info" =>  $account_info,
            'root_name' => 'Coupons',
            'sanboxNumber'=>$sanboxNumber,
            'languages'=>$translation->languages(),
            'selected_language' => $translation->selected_language(),

        ]);
    }

}
