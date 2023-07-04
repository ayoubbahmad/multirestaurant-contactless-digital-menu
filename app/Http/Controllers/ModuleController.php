<?php

namespace App\Http\Controllers;

use App\Module;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Redirect;
use Nwidart\Modules\Facades\Module as FacadesModule;
use ZipArchive;

class ModuleController extends Controller
{
    public function  __construct()
    {
        $this->middleware('auth');
    }

    public function install_modules(Request $request)
    {
        $request->validate([
            'module'    => 'required|mimes:zip'
        ]);
        $zip = new ZipArchive;
        $file = $request->module;
        $res = $zip->open($file);
        $tempath = base_path();
        $res = $zip->extractTo($tempath);
        try{
            \Artisan::call('module:install Waiter');

        }
        catch(\Exception $e)
        {
            return Redirect::route( "all_modules" )->with(Toastr::error("Improper / Modified Installation File",'Error'));
        }
        $module = FacadesModule::find('Waiter');
        $fail = false;
        if($module)
        {
            $path = FacadesModule::getModulePath('Waiter');
            $status = 'Finding Archive..... <br>';
            $res = $zip->open($path.'/installation.zip');
            $basepath = base_path();
            if($res === true)
            {
                $fail = false;
                try{
                    $checksum = md5($path.'/installation.zip');
                    $tempath = storage_path('tempdir/waiter/install');
                    $res = $zip->extractTo($tempath);
                    $res = rename($tempath.'/helpers.php', base_path('app\Http').'\helpers.php');
                    $res = rename($tempath.'/service-worker.js', public_path('/').'service-worker.js');
                    if (!is_dir(base_path('app/Http/Controllers/StoreAdmin'))) {
                        mkdir(base_path('app/Http/Controllers/StoreAdmin'), 0777, true);
                    }
                    $res = rename($tempath.'/UpdateOrderStatusController.php', base_path('app/Http/Controllers/StoreAdmin').'/UpdateOrderStatusController.php');
                    if (!is_dir(base_path('app/Http/Livewire/Home'))) {
                        mkdir(base_path('app/Http/Livewire/Home'), 0777, true);
                    }
                    $res = rename($tempath.'/ShowStore.php', base_path('app/Http/Livewire/Home').'/ShowStore.php');
                    $res = rename($tempath.'/auth.php', base_path('config').'/auth.php');
                    $res = rename($tempath.'/side_bar.blade.php', base_path('resources/views/restaurants/layouts').'/side_bar.blade.php');
                    \Artisan::call('module:install Waiter');
                    \Artisan::call('module:migrate Waiter');
                    \Artisan::call('module:publish Waiter');
                    \Artisan::call('module:enable Waiter');
                    $status = \Artisan::output();
                }
                catch(\Exception $e)
                {
                    dd($e);
                    $status .= 'Files missing / Improper Directory Permissions'; 
                    $fail = true;
                    return Redirect::route( "all_modules" )->with(Toastr::error($status,'Error'));
                }
                if($fail == false)
                {
                    $status .= 'Module Was Successfully Installed'; 
                }
            }
            else{
                    return Redirect::route( "all_modules" )->with(Toastr::error("A required file is missing, please re-download",'Error'));
            }

        }

            
        $data = [
            'name' => 'Waiter',
            'description' => 'Waiter Module',
            'version' => '1.0',
            'category' => '',
            'module_id' => 'required',
            'is_active' => '1',
            'is_installed' => '1',
            'is_paid' => '1',
        ];

        if (Module::create($data))
            return Redirect::route( "all_modules" )->with(Toastr::success('Module Added successfully ','Success'));
    }


}
