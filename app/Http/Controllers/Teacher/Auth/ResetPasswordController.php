<?php

namespace App\Http\Controllers\Teacher\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

//Password Broker Facade
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Auth;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
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
        $this->middleware('guest_teacher');
    }

    public function showResetForm(Request $request, $token = null){
        return view('backend.auth.passwords.reset')->with(
            ['token' => $token, 'email' => $request->email,'roleName' => 'Teacher','roleBaseRoute' => 'teacher']
        );
    }

    //returns Password broker of seller
    public function broker()
    {
        return Password::broker('teacher');
    }

    //returns authentication guard of seller
    protected function guard()
    {
        return Auth::guard('teacher');
    }
}
