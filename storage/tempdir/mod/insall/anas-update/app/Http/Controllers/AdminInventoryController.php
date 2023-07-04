<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Category;
use App\AddOnCategory;
use App\AddOnCategoryItem;
use App\AddOn;
use App\Brand;
use App\Product;
use Validator;
use Illuminate\Validation\Rule;
use Auth;
use Image;
use DataTables;

class AdminInventoryController extends Controller
{
    /* categories List */
    public function categoriesIndex(Request $request, Category $categories)
    {
  if ($request->ajax()) {
    /* if the url has get request */

    /* get category details */
    $data = Category::latest()->get();

    return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('action', function ($row) {
            $btn = '
            <div class="d-flex justify-content-end align-items-center">
            <button class="btn btn-sm bg-light mr-2 editCategory" data-id="'.$row->id.'">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                </svg>
            </button>
            <a href="' . url("admin/inventory/categories/delete/$row->id") . '" class="delete-btn">
            <button class="btn btn-sm bg-danger">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>
            </button>
            </a>
        </div>';
            return $btn;
        })
        ->editColumn('name', function ($row) {


            $image='';
            if($row->image !=""){
                $src=url('uploads/categories/'.$row->image);
             $image = '<div class="active-project-1 d-flex align-items-center mt-0 ">
            <div class="h-avatar is-medium">
                <img class="avatar rounded-pill" alt="user-icon" src="'.$src.'">
            </div>
            <div class="data-content">
                <div>
                    <span class="font-weight-bold">'.$row->name.'</span>
                </div>
                <p class="m-0 mt-1">'.mb_strimwidth($row->description, 0, 30, "...").'
                </p>
            </div>
        </div>';
            } else {
                $src=url('uploads/categories/default.jpg');
                $image = '<div class="active-project-1 d-flex align-items-center mt-0 ">
               <div class="h-avatar is-medium">
                   <img class="avatar rounded-pill" alt="user-icon" src="'.$src.'">
               </div>
               <div class="data-content">
                   <div>
                       <span class="font-weight-bold">'.$row->name.'</span>
                   </div>
                   <p class="m-0 mt-1">'.mb_strimwidth($row->description, 0, 30, "...").'
                   </p>
               </div>
           </div>';
            }
            return $image;
        })
        
        ->editColumn('total', function ($row) {
            return (($row->products)?count($row->products):'0');
        })
        ->editColumn('status', function ($row) {
            $status = "";
            if($row->is_active==1) {
             $status = "checked";   
            }
            return ('<div class="custom-control custom-switch custom-switch-color custom-control-inline">
                                 <input type="checkbox" '.$status.' class="custom-control-input bg-primary change-status" id="'.$row->id.'"  data-id="'.$row->id.'">
                                 <label class="custom-control-label" for="'.$row->id.'">&nbsp;</label>
                     </div>');
        })

        ->rawColumns(['action','status','name'])
        ->make(true);
}
return view('admin.inventory.category.index');

    }

    /* create new category */
    public function createCategory(Request $request)
    {
        if ($request->isMethod('get')) {
            /* request has get method */
            return response()->json("create");
        } else {
            /* request has post method */

            $category = new Category();
            $category->name = $request->name;
            $category->description = $request->description;
            $category->is_active = 1;
            $category->created_by = Auth::user()->id;
            /* if request has image */
            if ($request->hasFile('image')) {
                /* if request has image */
                $image = $request->file('image');
                $ImageName = uniqid() . '.' . $image->getClientOriginalExtension();
                if (!file_exists('uploads/categories')) {
                    mkdir('uploads/categories', 0777, true);
                }
                Image::make($image)->resize(200,200)->save('uploads/categories/' . $ImageName);
                $category->image = $ImageName;
            }
            $category->save();
            return response()->json("success");
        }
    }

    /* update category details */
    public function updateCategory(Request $request, $id)
    {
        $category = Category::find($id);
        if ($request->isMethod('get')) {
            /* url has get method */
            return response()->json([
                'data' => $category
            ]);
        } else {
            /* url has post method */

            $category->name = $request->edit_name;
            $category->description = $request->edit_description;
            if ($request->hasFile('edit_image')) {
                /* if request has image */
                $image = $request->file('edit_image');
                $ImageName = uniqid() . '.' . $image->getClientOriginalExtension();
                if (!file_exists('uploads/categories')) {
                    /* if the specified folder not exists */
                    mkdir('uploads/categories', 0777, true);
                }
                Image::make($image)->resize(200, 200)->save('uploads/categories/' . $ImageName);
                $category->image = $ImageName;
            }
            $category->save();
            return response()->json("success");
        }
    }

    /* delete the category */
    public function destroyCategory($id)
    {
        $category = Category::find($id);
        $product = Product::where('category_id',$category->id)->first();
        if(!empty($product)) {
            /* if category has product */
            return redirect()->back()->with('error', 'Category deletion restricted.');
        } else {
            /* category deletion success*/
            $category->delete();
            return redirect()->back()->with('message', 'Category Destroyed Successfully');
        }
    }

    /* update the category status */
    public function changeStatusCategories(Request $request)
    {
        $category = Category::find($request->id);
        if ($category->is_active == 1) {
            /* if active flag is 1 */
            $category->is_active = 0;
        } else {
            /* if active flag is 0 */
            $category->is_active = 1;
        }
        $category->save();
        return response()->json("success");
    }

    /* addOnCategories List */
    public function addOnCategoriesIndex(Request $request)
    {
        // $addOnCategories=AddOnCategory::latest()->paginate(15);
        // return view('admin.inventory.addOnCategory.index',compact('addOnCategories'));

        if ($request->ajax()) {
            /* if the url has get request */
        
            /* get add on category details */
            $data = AddOnCategory::latest()->get();
        
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '
                    <div class="d-flex justify-content-end align-items-center">
                    <button class="btn btn-sm bg-light mr-2 editCategory" data-id="'.$row->id.'">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                        </svg>
                    </button>
                    <a href="' . url("admin/inventory/add-on-categories/delete/$row->id") . '" class="delete-btn">
                    <button class="btn btn-sm bg-danger">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </button>
                    </a>
                </div>';
                    return $btn;
                })
                ->editColumn('name', function ($row) {
                    return ($row->name);
                })
                ->editColumn('type', function ($row) {
                switch ($row->type) {
                case 1:
                 return("Color");
                 break;
                case 2:
                 return("Size");
                 break;
                default:
                return ("");
                }
            })
                ->editColumn('total', function ($row) {
                    return (($row->addOns)?count($row->addOns):'0');
                })
    
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.inventory.addOnCategory.index');        
    }

    /* create new addOnCategory */
    public function createAddOnCategory(Request $request)
    {
        if ($request->isMethod('get')) {
            /* request has get method */
            return response()->json("create");
        } else {
            /* request has post method */

            $addOnCategory = new AddOnCategory();
            $addOnCategory->name = $request->name;
            $addOnCategory->type = $request->type;
            $addOnCategory->created_by = Auth::user()->id;
            $addOnCategory->save();
            return response()->json("success");
        }
    }

    /* update addOnCategory details */
    public function updateAddOnCategory(Request $request, $id)
    {
        $addOnCategory = AddOnCategory::find($id);
        if ($request->isMethod('get')) {
            /* url has get method */
            return response()->json([
                'data' => $addOnCategory
            ]);
        } else {
            /* url has post method */

            $addOnCategory->name = $request->edit_name;
            $addOnCategory->type = $request->edit_type;
            $addOnCategory->save();
            return response()->json("success");
        }
    }

    /* delete the addOnCategory */
    public function destroyAddOnCategory($id)
    {
        $addOnCategory = AddOnCategory::find($id);
        $addOnItemCategory = AddOnCategoryItem::where('add_on_category_id',$addOnCategory->id)->first();
        $addOn = AddOn::where('add_on_category_id',$addOnCategory->id)->first();

        if(!empty($addOnItemCategory) || !empty($addOn) ) {
            /* if addOnCategory has product */
            return redirect()->back()->with('error', 'AddOnCategory deletion restricted.');
        } else {
            /* addOnCategory deletion success*/
            $addOnCategory->delete();
            return redirect()->back()->with('message', 'AddOnCategory Destroyed Successfully');
        }
    }

    /* addOns List */
    public function addOnsIndex(Request $request)
    {
        if ($request->ajax()) {
            /* if the url has get request */
        
            /* get add on details */
            $data = AddOn::latest()->get();
        
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '
                    <div class="d-flex justify-content-end align-items-center">
                    <button class="btn btn-sm bg-light mr-2 edit" data-id="'.$row->id.'">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                        </svg>
                    </button>
                    <a href="' . url("admin/inventory/add-ons/delete/$row->id") . '" class="delete-btn">
                    <button class="btn btn-sm bg-danger">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </button>
                    </a>
                </div>';
                    return $btn;
                })
                ->editColumn('name', function ($row) {
                  return($row->add_on_name);
                })
                ->editColumn('color', function ($row) {
                $btn = '<span class="font-weight-bold"><button class="btn btn-sm" style="background-color:'.$row->add_on_color_code.' color: white">'.$row->add_on_color_code.'</button></span>';
                    return ($btn);
                })
                ->editColumn('category', function ($row) {
                    return(($row->addOnCategory)?$row->addOnCategory->name:'');
                  })
                  ->editColumn('price', function ($row) {
                    return($row->add_on_price);
                  })
                ->editColumn('status', function ($row) {
                    $status = "";
                    if($row->is_active==1) {
                     $status = "checked";   
                    }
                    return ('<div class="custom-control custom-switch custom-switch-color custom-control-inline">
                                         <input type="checkbox" '.$status.' class="custom-control-input bg-primary change-status" id="'.$row->id.'"  data-id="'.$row->id.'">
                                         <label class="custom-control-label" for="'.$row->id.'">&nbsp;</label>
                             </div>');
                })
        
                ->rawColumns(['action','status','name','color'])
                ->make(true);
        }
        return view('admin.inventory.addOn.index');

    }

    /* create new addOn */
    public function createAddOn(Request $request)
    {
        if ($request->isMethod('get')) {
            /* request has get method */
            return response()->json("create");
        } else {
            /* request has post method */

            $addOn = new AddOn();
            $addOn->add_on_name = $request->name;
            $addOn->add_on_category_id = $request->add_on_category_id;
            $addOn->add_on_price = ($request->price)?$request->price:0;
            $addOn->add_on_color_code = $request->code;
            $addOn->created_by = Auth::user()->id;
            $addOn->save();
            return response()->json("success");
        }
    }

    /* update addOn details */
    public function updateAddOn(Request $request, $id)
    {
        $addOn = AddOn::find($id);
        if ($request->isMethod('get')) {
            /* url has get method */
            return response()->json([
                'data' => $addOn
            ]);
        } else {
            /* url has post method */
            $addOn->add_on_name = $request->edit_name;
            $addOn->add_on_category_id = $request->edit_add_on_category_id;
            $addOn->add_on_price = ($request->edit_price)?$request->edit_price:0;
            $addOn->add_on_color_code = $request->edit_code;
            $addOn->save();
            return response()->json("success");
        }
    }

    /* delete the addOn */
    public function destroyAddOn($id)
    {
        $addOn = AddOn::find($id);
        $addOn->delete();
        return redirect()->back()->with('message', 'AddOn Destroyed Successfully');
    }

  /* brands */
    /* brands List */
    public function brandsIndex(Request $request)
    {
           if ($request->ajax()) {
            /* if the url has get request */
        
            /* get customer details */
            $data = Brand::latest()->get();
        
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '
                    <div class="d-flex justify-content-end align-items-center">
                    <button class="btn btn-sm bg-light mr-2 editBrand" data-id="'.$row->id.'">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                        </svg>
                    </button>
                    <a href="' . url("admin/inventory/brands/delete/$row->id") . '" class="delete-btn">
                    <button class="btn btn-sm bg-danger">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </button>
                    </a>
                </div>';
                    return $btn;
                })
                ->editColumn('name', function ($row) {
        
        
                    $image='';
                    if($row->image !=""){
                        $src=url('uploads/brands/'.$row->image);
                     $image = '<div class="active-project-1 d-flex align-items-center mt-0 ">
                    <div class="h-avatar is-medium">
                        <img class="avatar rounded-pill" alt="user-icon" src="'.$src.'">
                    </div>
                    <div class="data-content">
                        <div>
                            <span class="font-weight-bold">'.$row->name.'</span>
                        </div>
                        <p class="m-0 mt-1">'.$row->description.'
                        </p>
                    </div>
                </div>';
                    } else {
                        $src=url('uploads/brands/default.jpg');
                        $image = '<div class="active-project-1 d-flex align-items-center mt-0 ">
                       <div class="h-avatar is-medium">
                           <img class="avatar rounded-pill" alt="user-icon" src="'.$src.'">
                       </div>
                       <div class="data-content">
                           <div>
                               <span class="font-weight-bold">'.$row->name.'</span>
                           </div>
                           <p class="m-0 mt-1">'.$row->description.'
                           </p>
                       </div>
                   </div>';
                    }
                    return $image;
                })
                
                ->editColumn('total', function ($row) {
                    return (($row->products)?count($row->products):'0');
                })
                ->editColumn('status', function ($row) {
                    $status = "";
                    if($row->is_active==1) {
                     $status = "checked";   
                    }
                    return ('<div class="custom-control custom-switch custom-switch-color custom-control-inline">
                                         <input type="checkbox" '.$status.' class="custom-control-input bg-primary change-status" id="'.$row->id.'"  data-id="'.$row->id.'">
                                         <label class="custom-control-label" for="'.$row->id.'">&nbsp;</label>
                             </div>');
                })
        
                ->rawColumns(['action','status','name'])
                ->make(true);
        }
        return view('admin.inventory.brand.index');  
    }

    /* create new brand */
    public function createBrand(Request $request)
    {
        if ($request->isMethod('get')) {
            /* request has get method */
            return response()->json("create");
        } else {
            /* request has post method */

            $brand = new Brand();
            $brand->name = $request->name;
            $brand->is_active = 1;
            $brand->created_by = Auth::user()->id;
            /* if request has image */
            if ($request->hasFile('image')) {
                /* if request has image */
                $image = $request->file('image');
                $ImageName = uniqid() . '.' . $image->getClientOriginalExtension();
                if (!file_exists('uploads/brands')) {
                    mkdir('uploads/brands', 0777, true);
                }
                Image::make($image)->resize(200,200)->save('uploads/brands/' . $ImageName);
                $brand->image = $ImageName;
            }
            $brand->save();
            return response()->json("success");
        }
    }

    /* update brand details */
    public function updateBrand(Request $request, $id)
    {
        $brand = Brand::find($id);
        if ($request->isMethod('get')) {
            /* url has get method */
            return response()->json([
                'data' => $brand
            ]);
        } else {
            /* url has post method */

            $brand->name = $request->edit_name;
            if ($request->hasFile('edit_image')) {
                /* if request has image */
                $image = $request->file('edit_image');
                $ImageName = uniqid() . '.' . $image->getClientOriginalExtension();
                if (!file_exists('uploads/brands')) {
                    /* if the specified folder not exists */
                    mkdir('uploads/brands', 0777, true);
                }
                Image::make($image)->resize(200, 200)->save('uploads/brands/' . $ImageName);
                $brand->image = $ImageName;
            }
            $brand->save();
            return response()->json("success");
        }
    }

    /* delete the brand */
    public function destroyBrand($id)
    {
        $brand = Brand::find($id);
        $product = Product::where('brand_id', $brand->id)->first();
        if (!empty($product)) {
            /* if brand has product */
            return redirect()->back()->with('error', 'Brand deletion restricted.');
        } else {
            /* brand deletion success*/
            $brand->delete();
            return redirect()->back()->with('message', 'Brand Destroyed Successfully');
        }
    }

    /* update the brand status */
    public function changeStatusBrands(Request $request)
    {
        $brand = Brand::find($request->id);
        if ($brand->is_active == 1) {
            /* if active flag is 1 */
            $brand->is_active = 0;
        } else {
            /* if active flag is 0 */
            $brand->is_active = 1;
        }
        $brand->save();
        return response()->json("success");
    }

    /* product display */
    public function productsIndex(Request $request)
    {
      if ($request->ajax()) {
        /* if the url has get request */
    
        /* get category details */
        $data = Product::latest()->get();
    
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn = '
                <div class="d-flex justify-content-end align-items-center">
                <a href="' . url("admin/inventory/products/update/$row->id") . '">
                <button class="btn btn-sm bg-light mr-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                    </svg>
                </button>
                <a href="' . url("admin/inventory/products/delete/$row->id") . '" class="delete-btn">
                <button class="btn btn-sm bg-danger">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                </button>
                </a>
            </div>';
                return $btn;
            })
            ->editColumn('name', function ($row) {
    
                $image='';
                if($row->image !=""){
                    $src=url('uploads/products/'.$row->image);
                 $image = '<div class="active-project-1 d-flex align-items-center mt-0 ">
                <div class="h-avatar is-medium">
                    <img class="avatar rounded-pill" alt="user-icon" src="'.$src.'">
                </div>
                <div class="data-content">
                    <div>
                        <span class="font-weight-bold">'.$row->name.'</span>
                    </div>
                    <p class="m-0 mt-1">'.mb_strimwidth($row->description, 0, 30, "...").'
                    </p>
                </div>
            </div>';
                } else {
                    $src=url('uploads/products/default.jpg');
                    $image = '<div class="active-project-1 d-flex align-items-center mt-0 ">
                   <div class="h-avatar is-medium">
                       <img class="avatar rounded-pill" alt="user-icon" src="'.$src.'">
                   </div>
                   <div class="data-content">
                       <div>
                           <span class="font-weight-bold">'.$row->name.'</span>
                       </div>
                       <p class="m-0 mt-1">'.mb_strimwidth($row->description, 0, 30, "...").'
                       </p>
                   </div>
               </div>';
                }
                return $image;
            })
            ->editColumn('article_number', function ($row) {
                return ($row->article_number);
            })
            ->editColumn('category', function ($row) {
                return (($row->category)?$row->category->name:'0');
            })
    
            ->editColumn('brand', function ($row) {
                return (($row->brand)?$row->brand->name:'0');
            })

            ->editColumn('price', function ($row) {
                return ($row->price);
            })

            ->editColumn('tag', function ($row) {
                if($row->is_featured==1) {
                    return ('<span class="mt-2 badge badge-info">featured</span>');
                } else {
                  return "";
                }
                
            })

            ->editColumn('discount_price', function ($row) {
                return ($row->discount_price);
            })
            ->editColumn('created_at', function ($row) {
                return (($row->created_at)?$row->created_at->diffForHumans():"");
            })
            ->editColumn('status', function ($row) {
                $status = "";
                if($row->is_active==1) {
                 $status = "checked";   
                }
                return ('<div class="custom-control custom-switch custom-switch-color custom-control-inline">
                                     <input type="checkbox" '.$status.' class="custom-control-input bg-primary change-status" id="'.$row->id.'"  data-id="'.$row->id.'">
                                     <label class="custom-control-label" for="'.$row->id.'">&nbsp;</label>
                         </div>');
            })
    
            ->rawColumns(['action','status','name','tag'])
            ->make(true);
    }
    return view('admin.inventory.product.index');
}

    /* create product */
    public function createProduct(Request $request)
    {
        if ($request->isMethod('get')) {
            /* if the url has get request */
            return view('admin.inventory.product.create');
        } else {
            /* if the url has post request */
            $product = new Product();
            $product->name = $request->name;
            $product->description = $request->description;
            if ($request->hasFile('image')) {
                /* if the request has image */
                $image = $request->file('image');
                $ImageName = uniqid() . '.' . $image->getClientOriginalExtension();
                if (!file_exists('uploads/products')) {
                    /* if the specified folder not exists */
                    mkdir('uploads/products', 0777, true);
                }
                Image::make($image)->resize(200, 200)->save('uploads/products/' . $ImageName);
                $product->image = $ImageName;
            }
            $product->category_id = $request->category_id;
            $product->brand_id = $request->brand_id;
            $product->price = $request->price;
            $product->article_number = $request->article_number;
            $product->discount_price = ($request->discount_price) ? $request->discount_price : 0;
            $product->created_by = Auth::user()->id;
            $product->description = $request->description;
            $product->is_active = ($request->is_active) ? 1 : 0;
            $product->is_featured = ($request->is_featured) ? 1 : 0;
            $product->save();
            if(isset($request->add_on_category_id) && (count($request->add_on_category_id)>0)) {
                foreach ($request->add_on_category_id as $i) {
                    $add_on_category_item = new AddOnCategoryItem();
                    $add_on_category_item->add_on_category_id = $i;
                    $add_on_category_item->product_id = $product->id;
                    $add_on_category_item->save();
                }
            }

            return redirect('admin/inventory/products/')->with('message', 'Product created Successfully');
        }
    }

    /* update product */
    public function updateProduct(Request $request, $id)
    {
        $product = Product::find($id);
        if ($request->isMethod('get')) {
            /* if the request has get method */
            return view('admin.inventory.product.create', compact('product'));
        } else {
            /* if the request has post method */

            $product->name = $request->name;
            $product->article_number = $request->article_number;
            $product->description = $request->description;
            if ($request->hasFile('image')) {
                /* if the request has image */
                $image = $request->file('image');
                $ImageName = uniqid() . '.' . $image->getClientOriginalExtension();
                if (!file_exists('uploads/products')) {
                    /* if the specified folder not exists */
                    mkdir('uploads/products', 0777, true);
                }
                Image::make($image)->resize(200, 200)->save('uploads/products/' . $ImageName);
                $product->image = $ImageName;
            }
            $product->category_id = $request->category_id;
            $product->brand_id = $request->brand_id;
            $product->price = $request->price;
            $product->discount_price = ($request->discount_price) ? $request->discount_price : 0 ;
            $product->description = $request->description;
            $product->is_active = ($request->is_active) ? 1 : 0;
            $product->is_featured = ($request->is_featured) ? 1 : 0;
            $product->save();

            AddOnCategoryItem::where('product_id',$product->id)->delete();

            if(isset($request->add_on_category_id) && (count($request->add_on_category_id)>0)) {
                foreach ($request->add_on_category_id as $i) {
                    $add_on_category_item = new AddOnCategoryItem();
                    $add_on_category_item->add_on_category_id = $i;
                    $add_on_category_item->product_id = $product->id;
                    $add_on_category_item->save();
                }
            }

            return redirect('/admin/inventory/products/')->with('message', 'Product Updated Successfully.');
        }
    }

    /* destroyProduct */
    public function destroyProduct($id)
    {
        $product = Product::find($id);
         AddOnCategoryItem::where('product_id',$product->id)->delete();
         if (isset($product->image)) {
            /* if product image is exist */
            $path = 'uploads/products/' . $product->image;
            if (file_exists($path)) {
                /* unlink the file path */
                unlink($path);
            }
        }

        $product->delete();
        return redirect('/admin/inventory/products')->with('message', 'Product Deleted Successfully.');
    }

    /* show product details */
    public function show(Request $request, $id)
    {
        $product = Product::find($id);
        return view('admin.inventory.product.show', compact('product'));
    }

    /* get categories */
    public function getCategories(Request $request)
    {
        $result = Category::where('is_active', 1)->pluck('name', 'id');
        return json_encode($result);
    }


    /* change the product status */
    public function changeStatusProducts(Request $request)
    {
        $product = Product::find($request->id);
        if ($product->is_active == 1) {
            /* if active flag is 1 */
            $product->is_active = 0;
        } else {
            /* if active flag is 0 */
            $product->is_active = 1;
        }
        $product->save();
        return response()->json("success");
    }
}
