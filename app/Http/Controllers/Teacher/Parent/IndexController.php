<?php

namespace App\Http\Controllers\Teacher\Parent;

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
use App\Classes\Models\State\State;

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
        $this->stateObj = new State();
        $this->countryObj = new Country();
        $this->studentParentObj = new StudentParent();
        $this->emailTemplateObj = new EmailTemplate();
    }

    public function index( Request $request )
    {
        $data = $request->all();
        $classId = Auth::guard( 'teacher' )
                       ->user()->class_id;
        $schoolId = Auth::guard( 'teacher' )
                          ->user()->school_id;
        $studentRoleId = $this->_helperRoles->getStudentRoleId();

        $filter = ['student_class_id'    => $classId];
        $searchHelper = new SearchHelper( -1, -1, $selectColumns = ['*'], $filter,$sortOrder = [], $groupBy = ['parent_id'] );
        $parentIdArray = $this->studentParentObj->getList( $searchHelper )
                                        ->pluck( 'parent_id' )
                                        ->toArray();
        if(empty($parentIdArray)) {
            $parentIdArray = [0];
        }

        $page = ! empty( $data['page'] ) ? $data['page'] : 0;
        $sortedBy = ! empty( $request->get( 'sorted_by' ) ) ? $request->get( 'sorted_by' ) : 'updated_at';
        $sortedOrder = ! empty( $request->get( 'sorted_order' ) ) ? $request->get( 'sorted_order' ) : 'DESC';
        $parentRoleId = $this->_helperRoles->getParentRoleId();
        $name = ! empty( $data['name'] ) ? $data['name'] : "";
        $email = ! empty( $data['email'] ) ? $data['email'] : "";
        $status = isset( $data['status'] ) ? $data['status'] : -1;
        $cityId = isset( $data['city_id'] ) ? $data['city_id'] : -1;
        $createdStartDate = isset( $data['start_date'] ) ? $data['start_date'] : '';
        $createdEndDate = isset( $data['end_date'] ) ? $data['end_date'] : '';

        $perPage = $this->_helper->getConfigPerPageRecord();
        $recordStart = common::getRecordStart( $page, $perPage );
        $filter = ['status'             => $status,
                   'is_verified'        => 1,
                   'user_id_in'         => $parentIdArray,
                   'role_id'            => $parentRoleId,
                   'name'               => $name,
                   'email'              => $email,
                   'city_id'            => $cityId,
                   'created_start_date' => $createdStartDate,
                   'created_end_date'   => $createdEndDate,];
        $groupBy = [$userTableName = $this->userObj->getTable() . '.user_id'];
        $searchHelper = new SearchHelper( $page, $perPage, $selectColumns = ['*'], $filter, $sortOrder = [$sortedBy => $sortedOrder],$groupBy );
        $parents = $this->userObj->getList( $searchHelper );
        $totalRecordCount = $this->userObj->getListTotalCount( $searchHelper );
        $paginationBasePath = Common::getPaginationBasePath( ['name'       => $name,
                                                              'status'     => $status,
                                                              'email'      => $email,
                                                              'city_id'    => $cityId,
                                                              'start_date' => $createdStartDate,
                                                              'end_date'   => $createdEndDate,] );

        $paging = $this->userObj->preparePagination( $totalRecordCount, $paginationBasePath, $searchHelper );
        $statusDropDown = $this->_helper->getStatusDropDownWithAllOption();
        $cityDropDown = $this->cityObj->getDropDown( $prepend = 'City', -1 );
        $countryDropDown = $this->countryObj->getDropDown( 'Select country', '' );
        $stateDropDown = $this->stateObj->getDropDown( 'Select state', '',1 );

        $searchHelper = new SearchHelper( -1, -1, $selectColumns = ['student_id'], $filter );
        $studentIdNotIn = $this->studentParentObj->getList( $searchHelper )->pluck('student_id')->toArray();
        $studentDropDown = $this->userObj->getDropDown('', $studentRoleId, $schoolId, 1, 1, $classId,$studentIdNotIn );

        $school = $this->userObj->getDateById($schoolId);
        return view( 'teacher.parent.index', compact(  'cityId', 'cityDropDown', 'sortedBy', 'sortedOrder', 'recordStart', 'paging', 'totalRecordCount', 'name', 'email', 'statusDropDown', 'status', 'createdStartDate', 'createdEndDate', 'parents', 'countryDropDown' ,'studentDropDown','school','stateDropDown') );
    }

    public function delete( Request $request )
    {
        $data = $request->all();

        if ( empty( $data['id'] ) ) {
            return abort( 404 );
        }

        $isDelete = $this->userObj->removed( $data['id'] );
        if ( $isDelete ) {
            $request->session()
                    ->flash( 'success', 'Parent deleted successfully.' );
        } else {
            $request->session()
                    ->flash( 'error', 'Parent is not deleted successfully.' );
        }
        return redirect( 'teacher/parents' );
        //return Redirect::back();
    }

    public function edit( Request $request, $parentStudentId, $userId )
    {
        $parent = $this->userObj->getDateById( $userId );
        $parentRoleId = $this->_helperRoles->getParentRoleId();
        if ( empty( $parent->user_id ) && $parent->role_id != $parentRoleId ) {
            return abort( 404 );
        }
        $stateDropDown = $this->stateObj->getDropDown();
        $cityDropDown = $this->cityObj->getCityDropDownByStateId( $parent->state_id );
        return view( 'teacher.parent.create', compact( 'stateDropDown', 'cityDropDown', 'parent', 'parentStudentId' ) );
    }

    public function create( Request $request, $parentStudentId )
    {
        $stateDropDown = $this->stateObj->getDropDown();
        $cityDropDown = $this->_helperCity->getDefaultDropDown();
        return view( 'teacher.parent.create', compact( 'stateDropDown', 'cityDropDown', 'parentStudentId' ) );
    }

    public function saveAjax( Request $request )
    {
        $data = $request->all();
        $password = Common::getDefaultPassword();
        $data['password'] = Common::generatePassword( $password );
        $data['ip_address'] = \Request::ip();
        $data['created_type'] = 'Web';
        $data['email_verified_at'] = \DateFacades::getCurrentDateTime( 'format-1' );
        $data['e_token_check'] = '1';
        $data['status'] = 1;
        $data['role_id'] = $this->_helperRoles->getParentRoleId();
        $data['class_id'] = Auth::guard( 'teacher' )->user()->class_id;
        $data['school_id'] = Auth::guard( 'teacher' )->user()->school_id;
        $data['grade_id'] = Auth::guard( 'teacher' )->user()->grade_id;
        $parentStudentId = $data['student_id'];
        $result = $this->userObj->saveRecord( $data );
        $response = [];
        $response['success'] = false;
        $response['message'] = '';
        if ( ! empty( $result['user_id'] ) && $result['user_id'] > 0 ) {

            if ( empty( $data['user_id'] ) ) {
                $parentId = $result['user_id'];
                foreach ($parentStudentId as $parentStudentIdKey => $studentId) {
                    $studentParentInfo = [];
                    $studentParentInfo['student_id'] = $studentId;
                    $studentParentInfo['parent_id'] = $parentId;
                    $results = $this->studentParentObj->saveRecord( $studentParentInfo );
                }
                if ( true ) {

                    $fromName = "Kidrend";
                    $toName = $data['first_name'] . ' ' . $data['last_name'];
                    $toEmail = $data['email'];

                    $entity = "parent_register";
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
                    return response()->json( $results );
                } else {
                    /* Set Validation Message */
                    $message = null;
                    foreach ( $results['message'] as $key => $value ) {
                        if ( empty( $message ) ) {
                            $message = $results['message']->{$key}[0];
                            break;
                        }
                    }
                    $response = [];
                    $response['success'] = false;
                    $response['message'] = $message;
                    return response()->json( $response );
                }
            }
        }
        /* Set Validation Message */
        $message = null;
        foreach ( $result['message'] as $key => $value ) {
            if ( empty( $message ) ) {
                $message = $result['message']->{$key}[0];
                break;
            }
        }
        $response = [];
        $response['success'] = false;
        $response['message'] = $message;
        return response()->json( $response );
    }

    public function profileDetails( Request $request, $parentId )
    {
        $parentId = Common::getDecryptId( $parentId );
        if ( $parentId <= 0 ) {
            return abort( 404 );
        }

        $parent = $this->userObj->getDateById( $parentId );
        if ( ! Common::isParent( $parent ) ) {
            return abort( 404 );
        }

        $filter = ['parent_id' => $parentId];
        $searchHelper = new SearchHelper( -1, -1, $selectColumns = ['student_id'], $filter );
        $selectedStudent = $this->studentParentObj->getList( $searchHelper )->pluck('student_id')->toArray();

        $filter = ['parent_id_not' => $parentId];
        $searchHelper = new SearchHelper( -1, -1, $selectColumns = ['student_id'], $filter );
        $studentIdNotIn = $this->studentParentObj->getList( $searchHelper )->pluck('student_id')->toArray();

        $studentRoleId = $this->_helperRoles->getStudentRoleId();
        $studentDropDown = $this->userObj->getDropDown('', $studentRoleId, $parent->school_id, 1,1, 0, $studentIdNotIn);

        return view( 'teacher.parent.profile', compact( 'parent','studentDropDown','selectedStudent' ) );
    }

    public function changePassword( Request $request )
    {
        $data = $request->all();
        $password = $data['password'];
        $result = $this->userObj->changePassword( $data );
        if ( ! empty( $result['user_id'] ) && $result['user_id'] > 0 ) {

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
            $request->session()
                    ->flash( 'success', $message );
            return Redirect::back();
        }
        return Redirect::back()
                       ->withErrors( $result['message'] );
    }

    public function banOrReActive( Request $request )
    {
        $data = $request->all();
        $userId = Common::getDecryptId( $data['user_id'] );
        if ( $userId <= 0 ) {
            return abort( 404 );
        }
        $data['user_id'] = $userId;
        $result = $this->userObj->banOrReActive( $data );
        if ( ! empty( $result['user_id'] ) && $result['user_id'] > 0 ) {
            $message = "Parent banned successfully";
            if ( $data['status'] == 1 ) {
                $message = "Parent reactivated successfully.";
            }
            $request->session()
                    ->flash( 'success', $message );
            return Redirect::back();
        } else {
            return Redirect::back()
                           ->withErrors( $result['message'] );
        }
    }

    public function profileSave( Request $request )
    {
        $data = $request->all();
        $result = $this->userObj->saveRecord( $data );

        if ( ! empty( $result['user_id'] ) && $result['user_id'] > 0 ) {
            /*$parentId = $result['user_id'];
            $studentIdList = $data['student_id'];
            $this->studentParentObj->createOrUpdateStudentParent($parentId,$studentIdList);*/
            $request->session()
                    ->flash( 'success', 'Parent profile update successfully.' );
            return Redirect::back();
        } else {
            return Redirect::back()
                           ->withErrors( $result['message'] );
        }
    }
}
