<?php

namespace App\Http\Controllers\Admin\Auth;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Mail\AdminEmailVerification;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

class VerificationController extends Controller
{
    // /*
    // |--------------------------------------------------------------------------
    // | Email Verification Controller
    // |--------------------------------------------------------------------------
    // |
    // | This controller is responsible for handling email verification for any
    // | user that recently registered with the application. Emails may also
    // | be re-sent if the user didn't receive the original email message.
    // |
    // */

    // use VerifiesEmails;



    // protected $guard = 'admin';
    // /**
    //  * Where to redirect users after verification.
    //  *
    //  * @var string
    //  */
    // protected $redirectTo = '/admin'; //RouteServiceProvider::HOME;

    // /**
    //  * Create a new controller instance.
    //  *
    //  * @return void
    //  */
    // public function __construct()
    // {
    //     // $this->middleware('auth');
    //     // $this->middleware('signed')->only('verify');
    //     // $this->middleware('throttle:6,1')->only('verify', 'resend');
    // }



    // /**
    //  * Show the email verification notice.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
    //  */
    // public function show(Request $request)
    // {
    //     // dd(1);
    //     return $request->user($this->guard)->hasVerifiedEmail()
    //         ? redirect($this->redirectPath())
    //         : view('admin.auth.verify');
    // }


    // /**
    //  * Get the post register / login redirect path.
    //  *
    //  * @return string
    //  */
    // public function redirectPath()
    // {
    //     if (method_exists($this, 'redirectTo')) {
    //         return $this->redirectTo();
    //     }

    //     return property_exists($this, 'redirectTo') ? $this->redirectTo : '/home';
    // }



    // /**
    //  * Resend the email verification notification.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
    //  */
    // public function resend(Request $request)
    // {
    //     if ($request->user($this->guard)->hasVerifiedEmail()) {
    //         return $request->wantsJson()
    //             ? new JsonResponse([], 204)
    //             : redirect($this->redirectPath());
    //     }

    //     $verificationUrl = $this->verificationUrl($request->user($this->guard));

    //     Mail::to($request->user($this->guard)->email)->send(new AdminEmailVerification(['verificationUrl' => $verificationUrl , 'admin' => $request->user($this->guard) ]));

    //     return $request->wantsJson()
    //         ? new JsonResponse([], 202)
    //         : back()->with('resent', true);
    // }



    // /**
    //  * Mark the authenticated user's email address as verified.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
    //  *
    //  * @throws \Illuminate\Auth\Access\AuthorizationException
    //  */
    // public function verify(Request $request)
    // {
    //     if (!hash_equals((string) $request->route('id'), (string) $request->user($this->guard)->getKey())) {
    //         throw new AuthorizationException;
    //     }

    //     if (!hash_equals((string) $request->route('hash'), sha1($request->user($this->guard)->getEmailForVerification()))) {
    //         throw new AuthorizationException;
    //     }

    //     if ($request->user($this->guard)->hasVerifiedEmail()) {
    //         return $request->wantsJson()
    //             ? new JsonResponse([], 204)
    //             : redirect($this->redirectPath());
    //     }

    //     if ($request->user($this->guard)->markEmailAsVerified()) {
    //         event(new verified($request->user($this->guard)));
    //     }

    //     if ($response = $this->verified($request)) {
    //         return $response;
    //     }

    //     return $request->wantsJson()
    //         ? new JsonResponse([], 204)
    //         : redirect($this->redirectPath())->with('verified', true);
    // }

    // /**
    //  * The user has been verified.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return mixed
    //  */
    // protected function verified(Request $request)
    // {
    //     //
    // }


    // /**
    //  * Get the verification URL for the given notifiable.
    //  *
    //  * @param  mixed  $notifiable
    //  * @return string
    //  */
    // protected function verificationUrl($notifiable)
    // {
    //     return URL::temporarySignedRoute(
    //         'admin.verification.verify',
    //         Carbon::now()->addMinutes(Config::get('auth.verification.expire', 60)),
    //         [
    //             'id' => $notifiable->getKey(),
    //             'hash' => sha1($notifiable->getEmailForVerification()),
    //         ]
    //     );
    // }

}
