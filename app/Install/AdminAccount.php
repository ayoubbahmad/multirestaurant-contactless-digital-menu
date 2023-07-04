<?php

namespace App\Install;

use App\User;
use Illuminate\Support\Collection;
use Spatie\Permission\Models\Role;

class AdminAccount
{
    /**
     * @param $data
     */
    public function setup($data)
    {

        //create admin account
        $admin = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

    }
}
