<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use Hash;
use Validator;
use Auth;
use Image;
use App\User;
use DataTables;

class AdminCustomerController extends Controller
{

    /* customer index Active */
    public function customersIndex(Request $request)
    {
        if ($request->ajax()) {
            /* if the url has get request */
        
            /* get user details */
            $data = User::where('user_type',2)->where('is_active',1)->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '
                    <div class="d-flex justify-content-end align-items-center">
                    <a class="btn btn-sm bg-secondary mr-2" href="' . url("admin/customers/show/$row->id") . '">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </a>
                    <a class="btn btn-sm bg-light mr-2"href="' . url("admin/customers/update/$row->id") . '">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                        </svg>
                    </a>
                    <a href="' . url("admin/customers/delete/$row->id") . '" class="delete-btn btn btn-sm bg-danger">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </a>
                </div>';
                    return $btn;
                })
                ->editColumn('name', function ($row) {
                  return($row->name);
                })
                ->editColumn('area', function ($row) {
                    return(($row->area)?($row->area->name) : "");
                  })
                  ->editColumn('phone_number', function ($row) {
                    return(($row->phone));
                  })
                  ->editColumn('area', function ($row) {
                    return(($row->area)?($row->area->name) : "");
                  })
                  ->editColumn('address', function ($row) {
                    return(($row->customer) ? $row->customer->address : "");
                  })
                  ->editColumn('total_orders', function ($row) {
                      $orders = \App\Order::where('customer_id',$row->id)->count();
                    return(($orders) ? $orders : "");
                  })
                ->editColumn('store_name', function ($row) {
                    return(($row->customer)?$row->customer->store_name:"");
                  })
                ->editColumn('color', function ($row) {
                $btn = '<span class="font-weight-bold"><button class="btn btn-sm" style="background-color:'.$row->add_on_color_code.' color: white">'.$row->add_on_color_code.'</button></span>';
                    return ($btn);
                })
                ->editColumn('category', function ($row) {
                    return(($row->addOnCategory)?$row->addOnCategory->name:'');
                  })
                  ->editColumn('recent_order', function ($row) {
                    $order_date_customer =\App\Order::where('customer_id',$row->id)->latest()->first();
                    return(($order_date_customer)?$order_date_customer->created_at->diffForHumans():"");
                  })
                  ->editColumn('total_ordertakers', function ($row) {
                    return(($row->order_takers)?count($row->order_takers):'0');
                  })
                ->editColumn('status', function ($row) {
                    return ('<span class="mt-2 badge badge-success">Active</span>');
                })
        
                ->rawColumns(['action','status'])
                ->make(true);
        }
        return view('admin.customers.index');
    }

    /* customer index Pending */
    public function customersIndexPending(Request $request)
    {
        if ($request->ajax()) {
            /* if the url has get request */
        
            /* get user details */
            $data = User::where('user_type',2)->where('is_verified',0)->latest()->get();
        
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('more', function ($row) {
                    $btn = '
                    <div class="d-flex justify-content-end align-items-center">
                    <a class="btn btn-sm bg-secondary mr-2" href="' . url("admin/customers/show/$row->id") . '">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </a>
                    <a class="btn btn-sm bg-light mr-2"href="' . url("admin/customers/update/$row->id") . '">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                        </svg>
                    </a>
                    <a href="' . url("admin/customers/delete/$row->id") . '" class="delete-btn btn btn-sm bg-danger">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </a>
                </div>';
                    return $btn;
                })
                ->addColumn('action', function ($row) {
                    $btn = '
                    <a href="' . url("admin/customers/accept/$row->id") . '">
                    <button type="button" class="btn btn-success btn-sm mr-1">Accept</button>
                    </a>
                    <a href="' . url("admin/customers/reject/$row->id") . '">
                    <button type="button" class="btn btn-danger btn-sm mr-1">Reject</button>
                    </a>';
                    return $btn;
                })
                ->editColumn('name', function ($row) {
                  return($row->name);
                })
                ->editColumn('area', function ($row) {
                    return(($row->area)?($row->area->name) : "");
                  })
                  ->editColumn('phone_number', function ($row) {
                    return(($row->phone));
                  })
                  ->editColumn('area', function ($row) {
                    return(($row->area)?($row->area->name) : "");
                  })
                  ->editColumn('address', function ($row) {
                    return(($row->customer) ? $row->customer->address : "");
                  })
                  
                ->editColumn('status', function ($row) {
                    return ('<span class="mt-2 badge badge-success">Pending</span>');
                })
        
                ->rawColumns(['action','status','more'])
                ->make(true);
        }
        return view('admin.customers.index-pending');
    }

    /* customer index Disabled*/
    public function customersIndexDisabled(Request $request)
    {
        if ($request->ajax()) {
            /* if the url has get request */
        
            /* get user details */
            $data = User::where('user_type',2)->where('is_active',0)->latest()->get();
        
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('more', function ($row) {
                    $btn = '
                    <div class="d-flex justify-content-end align-items-center">
                    <a class="btn btn-sm bg-secondary mr-2" href="' . url("admin/customers/show/$row->id") . '">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </a>
                    <a class="btn btn-sm bg-light mr-2"href="' . url("admin/customers/update/$row->id") . '">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                        </svg>
                    </a>
                    <a href="' . url("admin/customers/delete/$row->id") . '" class="delete-btn btn btn-sm bg-danger">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </a>
                </div>';
                    return $btn;
                })
                ->addColumn('action', function ($row) {
                    $btn = '
                    <a href="' . url("admin/customers/enable/$row->id") . '">
                    <button type="button" class="btn btn-success btn-sm mr-1">Accept</button>
                    </a>';
                    return $btn;
                })
                ->editColumn('name', function ($row) {
                  return($row->name);
                })
                ->editColumn('area', function ($row) {
                    return(($row->area)?($row->area->name) : "");
                  })
                  ->editColumn('phone_number', function ($row) {
                    return(($row->phone));
                  })
                  ->editColumn('area', function ($row) {
                    return(($row->area)?($row->area->name) : "");
                  })
                  ->editColumn('address', function ($row) {
                    return(($row->customer) ? $row->customer->address : "");
                  })
                ->editColumn('status', function ($row) {
                    return ('<span class="mt-2 badge badge-danger">Disabled</span>');
                })
        
                ->rawColumns(['action','status','more'])
                ->make(true);
        }
        return view('admin.customers.index-disabled');

    }

    /* create customer details */
    public function createCustomer(Request $request)
    {
        if ($request->isMethod('get')) {
            /* if the url has get method */
            return view('admin.customers.create');
        } else {

            $user = new User();
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->name = $request->name;
            $user->area_id = $request->area_id;
            $user->user_type = 2;
            $user->is_active = ($request->is_active) ? 1 : 0;
            $user->is_verified = 1;
            $user->created_by = Auth::user()->id;
            /* if the request has password */
            if ($request->password != "") {
                $user->password = Hash::make($request->password);
            }

            /* if the requst has avatar */
            if ($request->hasFile('avatar')) {
                /* if file has image */
                $image = $request->file('avatar');
                $ImageName = uniqid() . '.' . $image->getClientOriginalExtension();
                if (!file_exists('uploads/customers')) {
                    /* if user profile folder is exits */
                    mkdir('uploads/customers', 0777, true);
                }
                Image::make($image)->resize(400, 400)->save('uploads/customers/' . $ImageName);
                $user->avatar = $ImageName;
            }
            $user->save();

            $customer = new Customer();
            $customer->user_id = $user->id;
            $customer->store_name = $request->store_name;
            $customer->license_number = $request->license_number;
            $customer->district = $request->district;
            $customer->address = $request->address;
            $customer->save();
            return redirect('/admin/customers')->with('message', 'Customer Created Successfully.');
        }
    }

    /* destroy customer information*/
    public function destroyCustomer($id)
    {
        $user = User::find($id);
        $customer = Customer::where('user_id',$user->id)->first();
        $customer->delete();
        $user->delete();
        return redirect()->back()->with('message', 'Customer Destroyed Successfully');
    }

    /* update customer details */
    public function updateCustomer(Request $request, $id)
    {
        $user = User::find($id);
        $customer = Customer::where('user_id',$user->id)->first();
        if ($request->isMethod('get')) {
            /* if the url has get method */
            return view('admin.customers.create', compact('user'));
        } else {
            /* if the url has post method */

            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->name = $request->name;
            $user->area_id = $request->area_id;
            $user->is_active = ($request->is_active) ? 1 : 0;
            /* if the request has password */
            if ($request->password != "") {
                $user->password = Hash::make($request->password);
            }
            /* if the requst has avatar */
            if ($request->hasFile('avatar')) {
                /* if file has image */
                $image = $request->file('avatar');
                $ImageName = uniqid() . '.' . $image->getClientOriginalExtension();
                if (!file_exists('uploads/customers')) {
                    /* if user profile folder is exits */
                    mkdir('uploads/customers', 0777, true);
                }
                Image::make($image)->resize(400, 400)->save('uploads/customers/' . $ImageName);
                $user->avatar = $ImageName;
            }
            $user->save();

            $customer->store_name = $request->store_name;
            $customer->license_number = $request->license_number;
            $customer->district = $request->district;
            $customer->address = $request->address;
            $customer->save();
            return redirect('/admin/customers')->with('message', 'Customer Updated Successfully.');
        }
    }

    /* show customer */
    public function show($id)
    {
        $user = User::find($id);
        return view('admin.customers.show', compact('user'));
    }

    /* disable customers information*/
    public function disableCustomer($id)
    {
        $user = User::find($id);
        $user->is_active=0;
        $user->save();
        return redirect('/admin/customers')->with('message', 'Customer Disables Successfully.');
    }

    /* disable customers information*/
    public function enableCustomer($id)
    {
        $user = User::find($id);
        $user->is_active=1;
        $user->save();
        return redirect('/admin/customers')->with('message', 'Customer Enable Successfully.');
    }

    /* accept customers*/
    public function acceptCustomer($id)
    {
        $user = User::find($id);
        $user->is_active=1;
        $user->is_verified=1;
        $user->save();
        return redirect('/admin/customers')->with('message', 'Customer Accepted Successfully.');
    }

    /* reject customers*/
    public function rejectCustomer($id)
    {
        $user = User::find($id);
        $user->is_active=0;
        $user->is_verified=1;
        $user->save();
        return redirect('/admin/customers')->with('message', 'Customer Rejected Successfully.');
    }
}
