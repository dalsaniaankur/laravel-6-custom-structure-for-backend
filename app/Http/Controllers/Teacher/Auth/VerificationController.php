<?php

namespace App\Http\Controllers\Teacher\Auth;

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
    protected $redirectTo = '/teacher/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('teacher');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }
    public function show(Request $request)
    {
        return $request->user('teacher')->hasVerifiedEmail()
            ? redirect($this->redirectPath())
            : view('teacher.auth.verify');
    }

    public function resend(Request $request)
    {
        if ($request->user('teacher')->hasVerifiedEmail()) {
            return redirect($this->redirectPath());
        }

        $request->user('teacher')->sendEmailVerificationNotification();

        return back()->with('resent', true);
    }

    public function verify(Request $request)
    {
        if ($request->route('id') != $request->user('admin')->getKey()) {
            throw new AuthorizationException;
        }

        if ($request->user('teacher')->hasVerifiedEmail()) {
            return redirect($this->redirectPath());
        }

        if ($request->user('teacher')->markEmailAsVerified()) {
            event(new Verified($request->user('teacher')));
        }

        return redirect($this->redirectPath())->with('verified', true);
    }
}
