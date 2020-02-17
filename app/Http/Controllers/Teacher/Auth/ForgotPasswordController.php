<?php

namespace App\Http\Controllers\Teacher\Auth;

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
        $this->middleware('guest_teacher');
        $this->_helper = new Helper();
    }

    public function showLinkRequestForm()
    {
        return view('backend.auth.passwords.email',['roleName' => 'Teacher','roleBaseRoute' => 'teacher']);
    }
    //Password Broker for School Model
    public function broker()
    {
        return Password::broker('teacher');
    }

    public function sendResetLinkEmail(Request $request){

        $teacherRoleId = $this->_helper->getTeacherRoleId();

        $this->validateEmail($request);

        $response = $this->broker('teacher')->sendResetLink(
            array_merge(
                $request->only('email'),['role_id' => $teacherRoleId,'status' => 1 ]
            )
        );
        return $response == Password::RESET_LINK_SENT
            ? back()->with('success', trans($response))
            : back()
            ->withInput($request->only('email'))
            ->withErrors(['email' => trans($response)]);

        /*return $response == Password::RESET_LINK_SENT
            ? $this->sendResetLinkResponse($response)
            : $this->sendResetLinkFailedResponse($request, $response);*/
    }

    protected function validateEmail(Request $request)
    {
        $this->validate($request, ['email' => 'required|email']);
    }
}
