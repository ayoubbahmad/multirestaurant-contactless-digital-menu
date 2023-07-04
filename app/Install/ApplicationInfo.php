<?php

namespace App\Install;

use App\Application;
use Illuminate\Support\Collection;
use Spatie\Permission\Models\Role;

class ApplicationInfo
{
    /**
     * @param $data
     */
    public function setup($data)
    {

        //create admin account
        $appinfo = Application::create([
            'application_name' => $data['application_name'],
            'application_email' => $data['application_email'],
            'application_logo' => $data['application_logo'],
            'currency_symbol' => $data['currency_symbol'],
            'contact_no' => $data['contact_no'],
            'Address' => $data['Address'],
            'currency_symbol_location' => $data['currency_symbol_location'],
            'theme_id' => $data['theme_id'],
        ]);

    }
}
