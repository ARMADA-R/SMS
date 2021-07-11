<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Admin;
use App\Http\Controllers\Controller;
use App\Jobs\SendMail;
use App\Mail\AdminResetPassword;
use App\Models\User;
use Carbon\Carbon;
use Session;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    //
    use SendsPasswordResetEmails;
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
    public function __construct()
    {
        // $this->middleware('admin');
    }


    protected function broker()
    {
        return Password::broker();
    }

    public function showLinkRequestForm()
    {
        // dd('showLinkRequestForm');
        return view('admin.auth.password.email');
    }


    public function sendResetLinkEmail(Request $request)
    {
        $admin = User::where('email', $request->email)->first();

        if (!empty($admin)) {
            if (!$admin->hasPermission('access-dashboard')) return back()->withErrors('YOU DO NOT HAVE PERMISSION TO USE ADMINS TOOLS');

            $token = $this->broker()->createToken($admin);


            dispatch((new SendMail($admin->email, new AdminResetPassword( ['admin' => $admin, 'token' => $token])))->delay(Carbon::now()->addSeconds(5)));
            // Mail::to($admin->email)->send(new AdminResetPassword(['admin' => $admin, 'token' => $token]));

            session()->flash('success', trans('passwords.sent'));
            return back();
        }
        $msg = new MessageBag([[trans('passwords.user')]]);
        Session::flash('errors', $msg);
        return back();
    }
}
