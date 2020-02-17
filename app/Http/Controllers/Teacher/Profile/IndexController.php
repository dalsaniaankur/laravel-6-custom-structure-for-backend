<?php

namespace App\Http\Controllers\Teacher\Profile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Classes\Models\User\User;
use App\Classes\Helpers\User\Helper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Classes\Models\State\State;
use App\Classes\Models\City\City;
use App\Classes\Models\Country\Country;
use App\Classes\Models\Grade\Grade;
use App\Classes\Models\Classes\Classes;

class IndexController extends Controller
{
    protected $userObj;
    protected $stateObj;
    protected $cityObj;
    protected $countryObj;
    protected $gradeObj;
    protected $classesObj;
    protected $_helper;
    protected $_searchHelper;

    public function __construct(User $userModel){

        $this->userObj = $userModel;
        $this->stateObj = new State();
        $this->cityObj = new City();
        $this->countryObj = new Country();
        $this->gradeObj = new Grade();
        $this->classesObj = new Classes();
        $this->_helper = new Helper();
        $this->_helper = new Helper();
    }

    public function index(Request $request){

        $teacher = Auth::guard('teacher')->getUser();
        $schoolId = $teacher->school_id;
        $countryDropDown = $this->countryObj->getDropDown();
        $stateDropDown = $this->stateObj->getDropDown($prepend = '', $prependKey = 0, $teacher->country_id);
        $cityDropDown = $this->cityObj->getDropDown($prepend = '', $prependKey = 0, $teacher->state_id);
        $gradeDropDown = $this->gradeObj->getDropDown('', $schoolId);
        $classesDropDown = $this->classesObj->getDropDown( $schoolId, 1, $teacher->grade_id );
        
        return view('teacher.profile.index', compact('teacher','stateDropDown', 'cityDropDown','countryDropDown','gradeDropDown','classesDropDown'));
    }

    public function profileSave(Request $request)
    {
        $data = $request->all();
        $result = $this->userObj->adminProfileSave($data);
        if ( !empty($result['success'] ) && $result['success'] == 1 ) {
            $request->session()->flash( 'success', 'User profile update successfully.' );
            return Redirect::back();
        } else {
            return Redirect::back()->withErrors($result['message']);
        }
    }

    public function changePassword(Request $request)
    {
        $data = $request->all();
        $result = $this->userObj->changePassword($data);
        if ( !empty($result['user_id'] ) && $result['user_id'] > 0 ) {
            $request->session()->flash( 'success', "User password changed successfully." );
            return Redirect::back();
        } else {
            return Redirect::back()->withErrors($result['message']);
        }
    }
}
