<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Admin;
use Hash;
use Session;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Validation\Rule;

use App\Http\Controllers\Controller;
use App\InvitedAdmins;
use App\Mail\AdminsInvitation;
use Carbon\Carbon;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;
use Mail;

class RegisterController extends Controller
{
    // //
    // /**
    //  * Show the application invitation form.
    //  *
    //  * @return \Illuminate\View\View
    //  */
    // public function showAdminDefinitionForm()
    // {
    //     return view('admin.auth.AdminDefinition');
    // }

    // public function invitation(Request $request)
    // {
    //     $token = random_bytes(32);
    //     $token = bin2hex($token);
    //     $data = ['email' => request('email'), 'token' => $token, 'isValid' => true, 'invitedBy' => $this->guard()->user()->id];

    //     Validator::make($data, [
    //         'email' => ['required', 'string', 'email', 'max:255', 'unique:App\Admin,email', 'unique:App\InvitedAdmins,email']
    //     ])->validate();


    //     $invitedData = InvitedAdmins::create($data);

    //     try {

    //         $invitedAdmins = Mail::to($request->email)->send(new AdminsInvitation($invitedData));

    //         $msg = new MessageBag([[trans('admin.invitationEmailSent') . $request->email]]);
    //         Session::flash('success', $msg);

    //         return back();
    //     } catch (\Throwable $th) {
    //         $msg = new MessageBag([[trans('admin.wrong')]]);
    //         Session::flash('errors', $msg);
    //         return back();
    //     }
    // }

    // /**
    //  * Show the application registration form.
    //  *
    //  * @return \Illuminate\View\View
    //  */
    // public function showRegistrationForm($token, $email)
    // {
    //     $data = ['token' => $token, 'email' => $email];
    //     $this->registrationFormValidator($data, $email)->validate();

    //     $invitedAdminsExists = InvitedAdmins::where('email', 'LIKE', $email)
    //         ->where('isValid', true)->where('token', 'LIKE', $token)
    //         ->where('created_at', '>', Carbon::now()->subHours(Config::get('invitationValidity', 24 )))->get();


    //     if ($invitedAdminsExists->isEmpty()) {

    //         $errors = new MessageBag([[trans('admin.invalidInvitation')]]);
    //         Session::flash('errors', $errors);
    //         return view('admin.auth.register', ['token' => $token, 'email' => $email, 'disabled' => true]);
    //     }

    //     return view('admin.auth.register', ['token' => $token, 'email' => $email, 'disabled' => false]);
    // }

    // private function registrationFormValidator($data, $email)
    // {
    //     return Validator::make($data, [
    //         'token' => ['required', 'string', 'min:64', 'max:64'],
    //         'email' => ['required', 'string', 'email', 'max:255'],
    //     ]);
    // }


    // /**
    //  * Handle a registration request for the application.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
    //  */
    // public function register(Request $request)
    // {
    //     $this->validator($request->all())->validate();

    //     $invitedAdminsExists = InvitedAdmins::where('email', 'LIKE', $request->email)
    //         ->where('isValid', true)
    //         ->where('token', 'LIKE', $request->token)
    //         ->where('created_at', '>', Carbon::now()->subHours(Config::get('invitationValidity', 24 )))->get();

    //     if ($invitedAdminsExists->isEmpty()) {
    //         $msg = new MessageBag([[trans('admin.invalidRequestedData')]]);
    //         Session::flash('errors', $msg);
    //         return back();
    //     }

    //     $this->create($request->all());

    //     $updated = InvitedAdmins::where('email', 'LIKE', $request->email)->update(['isValid' => false]);


    //     return redirect(AdminUrl('login'));
    // }

    // /**
    //  * Get a validator for an incoming registration request.
    //  *
    //  * @param  array  $data
    //  * @return \Illuminate\Contracts\Validation\Validator
    //  */
    // protected function validator(array $data)
    // {
    //     return Validator::make($data, [
    //         'name' => ['required', 'string', 'max:255'],
    //         'email' => ['required', 'string', 'email', 'max:255', 'unique:admins', 'exists:invited_admins,email,email,' . $data['email']],
    //         'password' => ['required', 'string', 'min:6', 'confirmed'],
    //         'token' => ['required', 'string', 'min:64', 'max:64', 'exists:invited_admins,token,token,' . $data['token']],
    //     ]);
    // }

    // /**
    //  * Get the guard to be used during registration.
    //  *
    //  * @return \Illuminate\Contracts\Auth\StatefulGuard
    //  */
    // protected function guard()
    // {
    //     return Auth::guard('admin');
    // }

    // /**
    //  * The user has been registered.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  mixed  $user
    //  * @return mixed
    //  */
    // protected function registered(Request $request, $user)
    // {
    //     //
    // }


    // /**
    //  * Create a new Admin instance after a valid registration.
    //  *
    //  * @param  array  $data
    //  * @return \App\Admin
    //  */
    // protected function create(array $data)
    // {
    //     return Admin::create([
    //         'name' => $data['name'],
    //         'email' => $data['email'],
    //         'password' => Hash::make($data['password']),
    //     ]);
    // }
}
