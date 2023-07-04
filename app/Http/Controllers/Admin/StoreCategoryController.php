<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\StoreCategories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StoreCategoryController extends Controller
{
    public function  __construct()
    {
        $this->middleware('auth');
    }

    public function add_store_category(Request $request){

            $data = request()->validate([
                'name'=>'required',
                'photo_url'=>'image|mimes:jpeg,png,jpg,gif,svg|max:2048|required',
                'is_visible'=>'required'
            ]);
            if($request->photo_url !=NULL) {
                $url = $request->file("photo_url")->store('public/stores/store-category/');
                $data['photo_url'] = str_replace("public","storage",$url);
            }
            if(StoreCategories::create($data))
                return back()->with("MSG","Record added successfully")->with("TYPE", "success");
    }
    public function update_store_category(Request $request,$id){
        $data = request()->validate([
            'name'=>'required',
            'photo_url'=>'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'is_visible'=>'required'
        ]);
        if($request->photo_url !=NULL) {
            Storage::delete(str_replace("storage","public",StoreCategories::find($id)->photo_url));
            $url = $request->file("photo_url")->store('public/stores/store-category/');
            $data['photo_url'] = str_replace("public","storage",$url);
        }
        StoreCategories::whereId($id)->update($data);
        return back()->with("MSG", "Record Updated Successfully.")->with("TYPE", "success");


    }
    public function delete_store_category(Request $request){
        if(Storage::delete(str_replace("storage","public",StoreCategories::find($request->id)->photo_url))) {
            StoreCategories::destroy($request->id);
        }
        return back();
    }
}
