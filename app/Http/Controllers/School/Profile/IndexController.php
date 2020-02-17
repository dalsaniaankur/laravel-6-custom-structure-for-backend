<?php

namespace App\Http\Controllers\School\Profile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Classes\Models\User\User;
use App\Classes\Helpers\User\Helper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Classes\Models\State\State;
use App\Classes\Models\City\City;
use App\Classes\Models\SchoolLevel\SchoolLevel;
use App\Classes\Models\Country\Country;

class IndexController extends Controller
{
    protected $userObj;
    protected $stateObj;
    protected $cityObj;
    protected $countryObj;
    protected $schoollevelObj;
    protected $_helper;
    protected $_searchHelper;

    public function __construct(User $userModel){

        $this->userObj = $userModel;
        $this->stateObj = new State();
        $this->cityObj = new City();
        $this->countryObj = new Country();
        $this->schoollevelObj = new SchoolLevel();
        $this->_helper = new Helper();
    }

    public function index(Request $request){

        $school = Auth::guard('school')->getUser();
        $schoollevelDropDown = $this->schoollevelObj->getDropDown();
        $countryDropDown = $this->countryObj->getDropDown();
        $stateDropDown = $this->stateObj->getDropDown($prepend = '', $prependKey = 0, $school->country_id);
        $cityDropDown = $this->cityObj->getDropDown($prepend = '', $prependKey = 0, $school->state_id);
        return view('school.profile.index', compact('school','stateDropDown', 'cityDropDown','schoollevelDropDown','countryDropDown'));
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

    public function savePrincipal( Request $request )
    {
        $data = $request->all();
        $result = $this->userObj->savePrincipal( $data );
        if ( ! empty( $result['success'] ) && $result['success'] == 1 ) {
            $request->session()
                    ->flash( 'success', "Principal profile updated successfully." );
            return Redirect::back();
        } else {
            return Redirect::back()
                           ->withErrors( $result['message'] );
        }
    }

    public function saveSchool( Request $request )
    {
        $data = $request->all();
        $result = $this->userObj->updateSchool( $data );
        if ( ! empty( $result['success'] ) && $result['success'] == 1 ) {
            $request->session()
                    ->flash( 'success', "School details updated successfully." );
            return Redirect::back();
        } else {
            return Redirect::back()
                           ->withErrors( $result['message'] );
        }
    }
}
