<?php

namespace App\Http\Controllers\Admin;

use App\Application;
use App\Http\Controllers\Controller;
use App\Models\Store;
use App\StoreCategories;
use App\StoreCategoriesStore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Redirect;

use function MongoDB\BSON\toJSON;

class StoreController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(Request $request)
    {

        $data = request()->validate([
            'store_name' => 'required',
            'email' => ['required', Rule::unique('stores', 'email')],
            'password' => 'required',
            'phone' => 'required',
            'logo_url' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048|required',
            'address' => '',
            'description' => '',
            'theme_id' => '',
            'subscription_end_date' => 'required',
            'is_visible' => 'required'
        ]);


        $data['password'] = Hash::make($data['password']);
        if ($request->logo_url != NULL) {
            $url = $request->file("logo_url")->store('public/stores/logo');
            $data['logo_url'] = str_replace("public", "storage", $url);
        }

        $data['view_id'] = sha1(time());

        $result = Store::create($data);

        if ($result) {
            if ($request->store_categories) {
                $this->add_into_store_categories($request->store_categories, $result->id);
            }
            return Redirect::route("all_stores")->with(Toastr::success('Record added successfully ', 'Success'));
        }
    }

    public function update(request $data, $id)
    {
        $request = request()->validate([
            'store_name' => 'required',
            'email' => '',
            'password' => '',
            'phone' => 'required',
            'logo_url' => '',
            'address' => '',
            'description' => '',
            'theme_id' => '',
            'subscription_end_date' => 'required',
            'is_visible' => 'required'

        ]);

        if ($data->logo_url != NULL) {
            Storage::delete(str_replace("storage", "public", Store::find($id)->logo_url));
            $url = $data->file("logo_url")->store('public/stores/logo');
            $request['logo_url'] = str_replace("public", "storage", $url);
        }
        if ($data->password == NULL)
            unset($request['password']);
        else
            $request['password'] = Hash::make($request['password']);

        $result = Store::whereId($id)->update($request);
        if ($result) {
            if ($data->store_categories) {

                $this->add_into_store_categories($data->store_categories, $id);
            } else {
                $this->remove_store_categories($id);
            }
            return Redirect::route("all_stores")->with(Toastr::success('Record updated successfully ', 'Success'));
        }

    }

    public function save_url(request $data, $id)
    {
        $request = request()->validate([
            'view_id' => ['required', Rule::unique('stores', 'view_id')],

        ]);
        Store::whereId($id)->update($request);
        return Redirect::route("all_stores")->with(Toastr::success('Record Updated successfully ', 'Success'));
    }

    // storeCategories

    public function add_into_store_categories($store_categories, $id)
    {
        $this->remove_store_categories($id);
        foreach ($store_categories as $key) {
            $store_category = new StoreCategoriesStore();
            $store_category->store_category_id = $key;
            $store_category->store_id = $id;
            $store_category->is_active = 1;
            $store_category->save();
        }
    }

    public function remove_store_categories($id)
    {
        StoreCategoriesStore::where('store_id', '=', $id)->delete();
    }

    public function toggleStorePower($id)
    {
        $request = request()->validate([
            'is_visible' => 'required'
        ]);
        $result = Store::whereId($id)->update($request);
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
}
