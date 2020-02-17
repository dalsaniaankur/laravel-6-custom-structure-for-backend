<?php

namespace App\Http\Controllers\School\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

//Password Broker Facade
use Illuminate\Support\Facades\Password;
use App\Classes\Helpers\Roles\Helper;

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

    use SendsPasswordResetEmails;

    protected $_helper;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest_school');
        $this->_helper = new Helper();
    }

    public function showLinkRequestForm()
    {
        return view('backend.auth.passwords.email',['roleName' => 'School','roleBaseRoute' => 'school']);
    }
    //Password Broker for School Model
    public function broker()
    {
        return Password::broker('school');
    }

    public function sendResetLinkEmail(Request $request){

        $schoolRoleId = $this->_helper->getSchoolRoleId();

        $this->validateEmail($request);

        $response = $this->broker('school')->sendResetLink(
            array_merge(
                $request->only('email'),['role_id' => $schoolRoleId,'status' => 1 ]
            )
        );
        return $response == Password::RESET_LINK_SENT
            ? back()->with('success', trans($response))
            : back()
            ->withInput($request->only('email'))
            ->withErrors(['email' => trans($response)]);
    }

    protected function validateEmail(Request $request)
    {
        $this->validate($request, ['email' => 'required|email']);
    }
}
