<?php

namespace App\Http\Controllers\StoreAdmin;

use App\Http\Controllers\Controller;
use App\Models\AddonCategory;
use App\Models\AddonCategoryItem;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Redirect;

class ProductController extends Controller
{
    public function  __construct()
    {
        $this->middleware('auth:store');
    }


    public function addproducts(Request $request){
        $data = request()->validate([
            'root' => 'category',
            'name'=>'required',
            'image_url'=>'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'is_active'=>'required',
            'category_id'=>'required',
            'is_veg'=>'',
            'description'=>'',
            'price'=>'required|numeric',
            'cooking_time'=>'required',
            'is_recommended'=>'',

            'store_id'=>''
        ]);


        $data['store_id'] = auth()->id();
        if($request->image_url !=NULL) {
            $url = $request->file("image_url")->store('public/stores/product/images/');
            $data['image_url'] = str_replace("public","storage",$url);
        }
        $insert = Product::create($data);
        if($insert) {
            if($request->addon_category_id!=NULL){
                foreach ($request->addon_category_id as $addon_id) {
                    if($addon_id != null)
                    {
                        $addon = new AddonCategoryItem();
                        $addon->addon_category_id = $addon_id;
                        $addon->product_id = $insert->id;
                        $addon->store_id = auth()->id();
                        $addon->save();
                    }
                }


            }
            return Redirect::route( "store_admin.products" )->with(Toastr::success('Product Added successfully ','Success'));
        }
    }


    public function edit_products(Request $request,$id){
        $data = request()->validate([
            'root' => 'category',
            'name'=>'required',
            'image_url'=>'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'is_active'=>'required',
            'category_id'=>'required',
            'is_veg'=>'',
            'description'=>'',
            'price'=>'required',
            'cooking_time'=>'required',
            'is_recommended'=>'',
        ]);
        if($request->image_url !=NULL) {
            Storage::delete(str_replace("storage","public",Product::find($id)->image_url));
            $url = $request->file("image_url")->store('public/stores/category/images/');
            $data['image_url'] = str_replace("public","storage",$url);
        }

        $insert = Product::whereId($id)->update($data);
        if($insert) {
                $this->remove_product_addon_categories($id,  auth()->id());
                foreach ($request->addon_category_id ?? [] as $addon_id) {
                    if($addon_id != null)
                    {
                    $addon = new AddonCategoryItem();
                    $addon->addon_category_id = $addon_id;
                    $addon->product_id = $id;
                    $addon->store_id = auth()->id();
                    $addon->save();
                    }
                }

        }
        return Redirect::route( "store_admin.products" )->with(Toastr::success('Product Updated successfully ','Success'));

    }


    public function toggle_product_status(Request $request,$id){
        $data = request()->validate([

            'is_active'=>'required',

        ]);

        $result = Product::whereId($id)->update($data);

        if($result) {
            return response()->json([
                "success" => true,
                "status" => "success",
                "payload" => [
                    'data' => $result
                ]
            ], 200);
        }
    }



    public function remove_product_addon_categories($id, $store_id)
    {
        AddonCategoryItem::where('product_id', '=', $id)->where('store_id', '=', $store_id)->delete();
    }

    public function delete_product(Request $request)
    {
        if (Storage::delete(str_replace("storage", "public", Product::find($request->id)->image_url))) {
            Product::destroy($request->id);
            AddonCategoryItem::destroy($request->product_id);
        }
        return back();

    }
    
    public function sort_product(Request $request){
        $data = request()->validate([
            'product'=>'required',
        ]);

        foreach ($request->product as $key=> $product){
            $pos = $key+1;
            Product::whereId($product)->update(['sort_order'=> $pos]);
        }
        
        return back()->with(Toastr::success('Product Order Saved Successfully ','Success'));
    }

}
