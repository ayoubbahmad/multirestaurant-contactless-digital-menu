<?php

namespace App\Http\Controllers\Auth;

use App\Application;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */
    public function showLinkRequestForm()
    {
        $account_info = Application::all()->first();
        return view('admin.auth.passwords.email',compact('account_info'));
    }
    use SendsPasswordResetEmails;
}
