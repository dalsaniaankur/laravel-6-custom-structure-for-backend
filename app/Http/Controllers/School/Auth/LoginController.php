<?php

namespace App\Http\Controllers\School\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Classes\Helpers\Roles\Helper;


class LoginController extends Controller
{

    use AuthenticatesUsers;

    protected $redirectTo = '/school/home';

    protected $_helper;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest_school')->except('logout');
        $this->_helper = new Helper();
    }

    public function showLoginForm(){

        return view('backend.auth.login',['roleName' => 'School','roleBaseRoute' => 'school']);
    }

    protected function guard()
    {
        return Auth::guard('school');
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {

            /* Login Date Update */
            $school = Auth::guard('school')->getUser();
            $school->last_login_date = !empty( $school->current_login_date ) ? $school->current_login_date : \DateFacades::getCurrentDateTime('format-1');
            $school->current_login_date = \DateFacades::getCurrentDateTime('format-1');
            $school->save();

            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    protected function credentials(Request $request)
    {
        $schoolRoleId = $this->_helper->getSchoolRoleId();
        return array_merge(
            $request->only($this->username(), 'password'),['role_id' => $schoolRoleId,'status' => 1]
        );
    }

    public function logout(Request $request)
    {
        $this->guard('school')->logout();
        $request->session()->invalidate();
        return redirect('/school_login');
    }
}
