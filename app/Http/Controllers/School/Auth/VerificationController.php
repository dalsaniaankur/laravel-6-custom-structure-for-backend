<?php

namespace App\Http\Controllers\School\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Verified;
use Illuminate\Auth\Access\AuthorizationException;


class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    protected $redirectTo = '/school/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('school');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }
    public function show(Request $request)
    {
        return $request->user('school')->hasVerifiedEmail()
            ? redirect($this->redirectPath())
            : view('school.auth.verify');
    }

    public function resend(Request $request)
    {
        if ($request->user('school')->hasVerifiedEmail()) {
            return redirect($this->redirectPath());
        }

        $request->user('school')->sendEmailVerificationNotification();

        return back()->with('resent', true);
    }

    public function verify(Request $request)
    {
        if ($request->route('id') != $request->user('admin')->getKey()) {
            throw new AuthorizationException;
        }

        if ($request->user('school')->hasVerifiedEmail()) {
            return redirect($this->redirectPath());
        }

        if ($request->user('school')->markEmailAsVerified()) {
            event(new Verified($request->user('school')));
        }

        return redirect($this->redirectPath())->with('verified', true);
    }
}
