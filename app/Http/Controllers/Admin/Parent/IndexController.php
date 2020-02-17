<?php

namespace App\Http\Controllers\Admin\Parent;

use App\Classes\Models\State\State;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Classes\Models\User\User;
use App\Classes\Helpers\User\Helper;
use App\Classes\Helpers\Roles\Helper as HelperRoles;
use App\Classes\Common\Common;
use App\Classes\Helpers\SearchHelper;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use App\Classes\Models\City\City;
use App\Classes\Models\StudentParent\StudentParent;
use App\Classes\Models\Country\Country;
use App\Classes\Models\EmailTemplate\EmailTemplate;

class IndexController extends Controller
{
    protected $userObj;
    protected $cityObj;
    protected $stateObj;
    protected $countryObj;
    protected $studentParentObj;
    protected $_helper;
    protected $_helperRoles;
    protected $emailTemplateObj;

    public function __construct( User $userModel )
    {
        $this->userObj = $userModel;
        $this->_helper = new Helper();
        $this->_helperRoles = new HelperRoles();
		$this->cityObj = new City();
		$this->countryObj = new Country();
		$this->stateObj = new State();
		$this->studentParentObj = new StudentParent();
		$this->emailTemplateObj = new EmailTemplate();
    }

    public function index( Request $request )
    {
		$data = $request->all();
        $page = ! empty( $data['page'] ) ? $data['page'] : 0;
        $sortedBy = ! empty( $request->get( 'sorted_by' ) ) ? $request->get( 'sorted_by' ) : 'updated_at';
        $sortedOrder = ! empty( $request->get( 'sorted_order' ) ) ? $request->get( 'sorted_order' ) : 'DESC';
        $parentRoleId = $this->_helperRoles->getParentRoleId();
        $schoolId = ! empty( $data['school_id'] ) ? $data['school_id'] : -1;
        $name = ! empty( $data['name'] ) ? $data['name'] : "";
        $email = ! empty( $data['email'] ) ? $data['email'] : "";
        $status = isset( $data['status'] ) ? $data['status'] : -1;
        $cityId = isset( $data['city_id'] ) ? $data['city_id'] : -1;
        $createdStartDate = isset( $data['start_date'] ) ? $data['start_date'] : '';
        $createdEndDate = isset( $data['end_date'] ) ? $data['end_date'] : '';

        if ( empty($schoolId) || $schoolId <= 0 ) {
            return abort( 404 );
        }

        $perPage = $this->_helper->getConfigPerPageRecord();
        $recordStart = common::getRecordStart( $page, $perPage );
        $filter = ['status'             => $status,
                   'is_verified'        => 1,
                   'role_id'            => $parentRoleId,
                   'name'               => $name,
                   'email'              => $email,
                   'school_id'          => $schoolId,
                   'city_id'          	=> $cityId,
                   'created_start_date' => $createdStartDate,
                   'created_end_date'   => $createdEndDate,];
        $groupBy = [$userTableName = $this->userObj->getTable() . '.user_id'];
        $searchHelper = new SearchHelper( $page, $perPage, $selectColumns = ['*'], $filter, $sortOrder = [$sortedBy => $sortedOrder],$groupBy );
        $parents = $this->userObj->getList( $searchHelper );
        $totalRecordCount = $this->userObj->getListTotalCount( $searchHelper );
        $paginationBasePath = Common::getPaginationBasePath( ['name'        => $name,
                                                              'status'      => $status,
                                                              'email'       => $email,
                                                              'school_id'   => $schoolId,
                                                              'city_id'   => $cityId,
                                                              'start_date'  => $createdStartDate,
                                                              'end_date'    => $createdEndDate,] );
        $paging = $this->userObj->preparePagination( $totalRecordCount, $paginationBasePath, $searchHelper );

        $statusDropDown = $this->_helper->getStatusDropDownWithAllOption();
		$cityDropDown = $this->cityObj->getDropDown( $prepend = 'City', -1 );

		$studentDropDown = [];
        $countryDropDown = $this->countryObj->getDropDown('Select country','');
        $schoolDropDownList = $this->userObj->getSchoolDropDown( 'Select school', 1, '' );
        $stateDropDown = $this->stateObj->getDropDown('Select state','',1);
        $schoolDropDownForSearch = $this->userObj->getSchoolDropDown( 'Schools', 1, '' );
        if(!empty($schoolId) && $schoolId > 0){

            $searchHelper = new SearchHelper( -1, -1, $selectColumns = ['student_id'], [] );
            $studentIdNotIn = $this->studentParentObj->getList( $searchHelper )->pluck('student_id')->toArray();

            $studentRoleId = $this->_helperRoles->getStudentRoleId();
            $studentDropDown = $this->userObj->getDropDown('', $studentRoleId, $schoolId, 1,1,0, $studentIdNotIn);
        }
        return view( 'admin.parent.index', compact( 'studentDropDown', 'cityId', 'cityDropDown', 'sortedBy', 'sortedOrder', 'recordStart', 'paging', 'totalRecordCount', 'name', 'email', 'statusDropDown', 'status', 'createdStartDate', 'createdEndDate', 'parents','countryDropDown','schoolDropDownList','schoolId','stateDropDown','schoolDropDownForSearch' ) );
    }

    public function delete( Request $request )
    {
        $data = $request->all();

        if ( empty( $data['id'] ) ) {
            return abort( 404 );
        }
        $schoolId = $data['school_id'];
        $isDelete = $this->userObj->removed( $data['id'] );
        if ( $isDelete ) {
            $request->session()
                    ->flash( 'success', 'Parent deleted successfully.' );
        } else {
            $request->session()
                    ->flash( 'error', 'Parent is not deleted successfully.' );
        }
        return redirect( 'admin/parents?school_id='.$schoolId );
        //return Redirect::back();
    }

    public function edit( Request $request, $parentStudentId, $userId)
    {
        $parent = $this->userObj->getDateById( $userId );
        $parentRoleId = $this->_helperRoles->getParentRoleId();
        if ( empty( $parent->user_id ) && $parent->role_id != $parentRoleId ) { return abort( 404 ); }
        $stateDropDown = $this->stateObj->getDropDown();
        $cityDropDown = $this->cityObj->getCityDropDownByStateId($parent->state_id);
        return view( 'admin.parent.create', compact( 'stateDropDown', 'cityDropDown','parent','parentStudentId' ) );
    }

    public function create( Request $request, $parentStudentId)
    {
        $stateDropDown = $this->stateObj->getDropDown();
        $cityDropDown = $this->_helperCity->getDefaultDropDown();
        return view( 'admin.parent.create', compact( 'stateDropDown', 'cityDropDown','parentStudentId' ) );
    }

    public function saveAjax(Request $request)
    {
        $data = $request->all();
        $password =  Common::getDefaultPassword();
        $data['password'] = Common::generatePassword( $password );
        $data['ip_address'] = \Request::ip();
        $data['created_type'] = 'Web';
        $data['email_verified_at'] = \DateFacades::getCurrentDateTime( 'format-1' );
        $data['e_token_check'] = '1';
        $data['status'] = 1;
        $data['role_id'] = $this->_helperRoles->getParentRoleId();
        $parentStudentId = $data['student_id'];
        $result = $this->userObj->saveRecord($data);
		$response = array();
		$response['success'] = false;
		$response['message'] = '';
        if ( !empty($result['user_id'] ) && $result['user_id'] > 0 ) {

            if(empty($data['user_id'])){
                $parentId = $result['user_id'];
                foreach ($parentStudentId as $parentStudentIdKey => $studentId) {
                    $studentParentInfo = [];
                    $studentParentInfo['student_id'] = $studentId;
                    $studentParentInfo['parent_id'] = $parentId;
                    $results = $this->studentParentObj->saveRecord( $studentParentInfo );
                }
                if(true) {

					$fromName = "Kidrend";
					$toName = $data['first_name'].' '.$data['last_name'];
					$toEmail = $data['email'];

					$entity = "parent_register";
					$emailTemplate = $this->emailTemplateObj->getDateByEntity($entity);
					$templateFields = $emailTemplate->template_fields;
					$templateContent = $emailTemplate->template_content;

					$templateFieldValues = ['name' => $toName,
											'loginUrl' => url('parent_login'),
											'email' => $toEmail,
											'password' => $password];
					$mailContent = Common::convertEmailTemplateContent($templateFields, $templateContent, $templateFieldValues);

					$subject = $emailTemplate->subject;
					$htmlContent = \View::make( 'admin.emails.common.email_template', ['mailContent' => $mailContent,
																			'subject' => $subject] )->render();

					Common::sendMailByMailJet( $htmlContent, $fromName, '', $subject, $toName, $toEmail );
					return response()->json($results);
				}else{
					/* Set Validation Message */
					$message = null;
					foreach ( $results['message'] as $key => $value ) {
						if(empty($message)) {
							$message = $results['message']->{$key}[0];
							break;
						}
					}
					$response = array();
					$response['success'] = false;
					$response['message'] = $message;
					return response()->json($response);
				}
			}
		}
		/* Set Validation Message */
		$message = null;
		foreach ( $result['message'] as $key => $value ) {
			if(empty($message)) {
				$message = $result['message']->{$key}[0];
				break;
			}
		}
		$response = array();
		$response['success'] = false;
		$response['message'] = $message;
		return response()->json($response);
    }

	public function profileDetails(Request $request, $parentId) {

        $parentId = Common::getDecryptId($parentId);
        if( $parentId <= 0 ){ return abort(404); }

        $parent = $this->userObj->getDateById($parentId);
        if(! Common::isParent( $parent) ){ return abort(404); }

        $filter = ['parent_id' => $parentId];
        $searchHelper = new SearchHelper( -1, -1, $selectColumns = ['student_id'], $filter );
        $selectedStudent = $this->studentParentObj->getList( $searchHelper )->pluck('student_id')->toArray();

        $filter = ['parent_id_not' => $parentId];
        $searchHelper = new SearchHelper( -1, -1, $selectColumns = ['student_id'], $filter );
        $studentIdNotIn = $this->studentParentObj->getList( $searchHelper )->pluck('student_id')->toArray();

        $studentRoleId = $this->_helperRoles->getStudentRoleId();
        $studentDropDown = $this->userObj->getDropDown( '', $studentRoleId, $parent->school_id, 1, 1, 0, $studentIdNotIn);

        return view('admin.parent.profile',compact('parent','studentDropDown','selectedStudent'));
    }

    public function changePassword(Request $request)
    {
        $data = $request->all();
        $password = $data['password'];
        $result = $this->userObj->changePassword($data);
        if ( !empty($result['user_id'] ) && $result['user_id'] > 0 ) {

            /* Send mail */
            $user = $this->userObj->getDateById( $result['user_id'] );

            $fromName = "Kidrend";
            $toName = $user->name;
            $toEmail = $user->email;

            $entity = "parent_password_change";
            $emailTemplate = $this->emailTemplateObj->getDateByEntity( $entity );
            $templateFields = $emailTemplate->template_fields;
            $templateContent = $emailTemplate->template_content;

            $templateFieldValues = ['name'     => $toName,
                                    'loginUrl' => url( 'parent_login' ),
                                    'email'    => $toEmail,
                                    'password' => $password];
            $mailContent = Common::convertEmailTemplateContent( $templateFields, $templateContent, $templateFieldValues );

            $subject = $emailTemplate->subject;
            $htmlContent = \View::make( 'admin.emails.common.email_template', ['mailContent' => $mailContent,
                                                                               'subject'     => $subject] )
                                ->render();

            Common::sendMailByMailJet( $htmlContent, $fromName, '', $subject, $toName, $toEmail );
            /* Send mail end */

            $message = "Parent password changed successfully.";
            $request->session()->flash( 'success', $message );
            return Redirect::back();
        }
        return Redirect::back()->withErrors($result['message']);
    }

    public function banOrReActive(Request $request)
    {
        $data = $request->all();
        $userId = Common::getDecryptId($data['user_id']);
        if( $userId <= 0 ){ return abort(404); }
        $data['user_id'] = $userId;
        $result = $this->userObj->banOrReActive($data);
        if ( !empty($result['user_id'] ) && $result['user_id'] > 0 ) {
            $message = "Parent banned successfully";
            if($data['status'] == 1) {
                $message = "Parent reactivated successfully.";
            }
            $request->session()->flash( 'success', $message );
            return Redirect::back();
        } else {
            return Redirect::back()->withErrors($result['message']);
        }
    }

    public function profileSave(Request $request)
    {
        $data = $request->all();
        $result = $this->userObj->saveRecord($data);
        if ( !empty($result['user_id'] ) && $result['user_id'] > 0 ) {
            /*$parentId = $result['user_id'];
            $studentIdList = $data['student_id'];
            $this->studentParentObj->createOrUpdateStudentParent($parentId,$studentIdList);*/
            $request->session()->flash( 'success', 'Parent profile update successfully.' );
            return Redirect::back();
        } else {
            return Redirect::back()->withErrors($result['message']);
        }
    }
}
