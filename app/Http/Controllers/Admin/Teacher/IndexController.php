<?php

namespace App\Http\Controllers\Admin\Teacher;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Classes\Models\User\User;
use App\Classes\Models\Classes\Classes;
use App\Classes\Helpers\User\Helper;
use App\Classes\Common\Common;
use App\Classes\Helpers\SearchHelper;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use App\Classes\Helpers\Roles\Helper as HelperRoles;
use App\Classes\Models\Grade\Grade;
use App\Classes\Models\EmailTemplate\EmailTemplate;
use App\Classes\Models\Club\Club;
use App\Classes\Models\UserClub\UserClub;

class IndexController extends Controller
{
    protected $userObj;
    protected $classesObj;
    protected $gradeObj;
    protected $clubObj;
    protected $userClubObj;
    protected $_helper;
    protected $_helperRoles;
    protected $emailTemplateObj;

    public function __construct( User $userModel )
    {
        $this->userObj = $userModel;
        $this->classesObj = new Classes();
        $this->gradeObj = new Grade();
        $this->clubObj = new Club();
        $this->userClubObj = new UserClub();
        $this->_helper = new Helper();
        $this->_helperRoles = new HelperRoles();
        $this->emailTemplateObj = new EmailTemplate();
    }

    public function index( Request $request, $schoolId = 0 )
    {

        $data = $request->all();
        $page = ! empty( $data['page'] ) ? $data['page'] : 0;
        $sortedBy = ! empty( $request->get( 'sorted_by' ) ) ? $request->get( 'sorted_by' ) : 'updated_at';
        $sortedOrder = ! empty( $request->get( 'sorted_order' ) ) ? $request->get( 'sorted_order' ) : 'DESC';
        $teacherRoleId = $this->_helperRoles->getTeacherRoleId();
        $name = ! empty( $data['name'] ) ? $data['name'] : "";
        $email = ! empty( $data['email'] ) ? $data['email'] : "";
        $status = isset( $data['status'] ) ? $data['status'] : -1;
        $gender = isset( $data['gender'] ) ? $data['gender'] : '';
        $createdStartDate = isset( $data['start_date'] ) ? $data['start_date'] : '';
        $createdEndDate = isset( $data['end_date'] ) ? $data['end_date'] : '';

        $perPage = $this->_helper->getConfigPerPageRecord();
        if ( ! empty( $schoolId ) ) {
            $schoolId = Common::getDecryptId( $schoolId );
        }
        $schoolId = isset( $data['school_id'] ) && $schoolId <= 0 ? $data['school_id'] : $schoolId;
        if ( empty($schoolId) || $schoolId <= 0 ) {
            return abort( 404 );
        }
        $recordStart = common::getRecordStart( $page, $perPage );
        $filter = ['status'             => $status,
                   'is_verified'        => 1,
                   'role_id'            => $teacherRoleId,
                   'name'               => $name,
                   'email'              => $email,
                   'gender'             => $gender,
                   'school_id'          => $schoolId,
                   'created_start_date' => $createdStartDate,
                   'created_end_date'   => $createdEndDate];
        $groupBy = [$userTableName = $this->userObj->getTable() . '.user_id'];
        $searchHelper = new SearchHelper( $page, $perPage, $selectColumns = ['*'], $filter, $sortOrder = [$sortedBy => $sortedOrder],$groupBy );
        $teachers = $this->userObj->getList( $searchHelper );
        $totalRecordCount = $this->userObj->getListTotalCount( $searchHelper );
        $paginationBasePath = Common::getPaginationBasePath( ['name'       => $name,
                                                              'status'     => $status,
                                                              'email'      => $email,
                                                              'school_id'  => $schoolId,
                                                              'gender'     => $gender,
                                                              'start_date' => $createdStartDate,
                                                              'end_date'   => $createdEndDate] );
        $paging = $this->userObj->preparePagination( $totalRecordCount, $paginationBasePath, $searchHelper );
        $statusDropDown = $this->_helper->getStatusDropDownWithAllOption();

        $schoolDropDown = $this->userObj->getSchoolDropDown( 'Select school', 1, '' );
        $schoolDropDownList = $this->userObj->getSchoolDropDown( 'Schools', 1, '' );

        $gradeDropDown = ['' => 'Select grade'];
        $classesDropDown = ['' => 'Select class'];

        if(!empty($schoolId) && $schoolId > 0){
            $gradeDropDown = $this->gradeObj->getDropDown("Select grade",$schoolId,'');
        }
        return view( 'admin.teacher.index', compact( 'schoolId', 'sortedBy', 'sortedOrder', 'recordStart', 'teachers', 'paging', 'totalRecordCount', 'name', 'email', 'statusDropDown', 'status', 'createdStartDate', 'createdEndDate', 'gender', 'schoolDropDown', 'gradeDropDown', 'classesDropDown','schoolDropDownList' ) );
    }

    public function delete( Request $request )
    {
        $data = $request->all();
        if ( empty( $data['id'] ) ) {
            return abort( 404 );
        }
        $schoolId = isset($data['school_id']) ? $data['school_id'] : 0;
        $isDelete = $this->userObj->removed( $data['id'] );
        if ( $isDelete ) {
            $request->session()
                    ->flash( 'success', 'Teacher deleted successfully.' );
        } else {
            $request->session()
                    ->flash( 'error', 'Teacher is not deleted successfully.' );
        }
        if($schoolId > 0){
            return redirect( 'admin/teachers?school_id='.$schoolId );
        }else{
            return Redirect::back();
        }
    }

    public function save( Request $request )
    {
        $data = $request->all();
        $result = $this->userObj->saveRecord( $data );
        if ( ! empty( $result['user_id'] ) && $result['user_id'] > 0 ) {
            $request->session()
                    ->flash( 'success', $result['message'] );
            return redirect( 'admin/classes' );
        } else {
            return Redirect::back()
                           ->withInput()
                           ->withErrors( $result['message'] );
        }
    }

    public function createSave( Request $request )
    {
        $data = $request->all();
        $password = Common::getDefaultPassword();
        $data['password'] = Common::generatePassword( $password );
        $data['ip_address'] = \Request::ip();
        $data['created_type'] = 'Web';
        $data['email_verified_at'] = \DateFacades::getCurrentDateTime( 'format-1' );
        $data['e_token_check'] = '1';
        $data['status'] = 1;
        $data['role_id'] = $this->_helperRoles->getTeacherRoleId();
        $result = $this->userObj->saveRecord( $data );
        if ( ! empty( $result['user_id'] ) && $result['user_id'] > 0 ) {

            /* Send mail */
            $fromName = "Kidrend";
            $toName = $data['first_name'] . ' ' . $data['last_name'];
            $toEmail = $data['email'];

            $entity = "teacher_register";
            $emailTemplate = $this->emailTemplateObj->getDateByEntity( $entity );
            $templateFields = $emailTemplate->template_fields;
            $templateContent = $emailTemplate->template_content;

            $templateFieldValues = ['name'     => $toName,
                                    'loginUrl' => url( 'teacher_login' ),
                                    'email'    => $toEmail,
                                    'password' => $password];
            $mailContent = Common::convertEmailTemplateContent( $templateFields, $templateContent, $templateFieldValues );

            $subject = $emailTemplate->subject;
            $htmlContent = \View::make( 'admin.emails.common.email_template', ['mailContent' => $mailContent,
                                                                               'subject'     => $subject] )
                                ->render();

            Common::sendMailByMailJet( $htmlContent, $fromName, '', $subject, $toName, $toEmail );
            /*End send mail*/

            $request->session()
                    ->flash( 'success', $result['message'] );
            return Redirect::back();
        } else {
            return Redirect::back()
                           ->withInput()
                           ->withErrors( $result['message'] );
        }
    }

    public function create( Request $request, $schoolId )
    {
        $schoolId = Common::getDecryptId( $schoolId );
        if ( $schoolId <= 0 ) {
            return abort( 404 );
        }
        $teacherRoleId = $this->_helperRoles->getTeacherRoleId();
        $filter = ['school_id' => $schoolId,
                   'role_id'   => $teacherRoleId];
        $searchHelper = new SearchHelper( -1, -1, $selectColumns = ['*'], $filter, $sortOrder = ['updated_at' => 'DESC'] );
        $teacherList = $this->userObj->getList( $searchHelper );
        $classesDropDown = ['Select class'];
        $gradeDropDown = $this->gradeObj->getDropDown( $prepend = 'Select grade', $schoolId, '' );
        return view( 'admin.school.step.setup4', compact( 'schoolId', 'teacherList', 'classesDropDown', 'gradeDropDown' ) );
    }

    public function getDataForEditTeacherModel( Request $request )
    {
        $data = $request->all();
        $results = $this->userObj->getDateById( $data['id'] );

        $response = [];
        $response['success'] = false;
        $response['message'] = '';

        if ( ! empty( $results['user_id'] ) && $results['user_id'] > 0 ) {
            $response['success'] = true;
            $response['message'] = '';
            $response['data'] = $results;
        }
        return response()->json( $response );
    }

    public function saveAjaxForTeacher( Request $request )
    {
        $data = $request->all();
        $results = $this->userObj->saveRecord( $data );
        if ( ! empty( $results['user_id'] ) && $results['user_id'] > 0 ) {
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

    public function saveAjaxForTeacherModule( Request $request )
    {
        $data = $request->all();
        $password = Common::getDefaultPassword();
        $data['password'] = Common::generatePassword( $password );
        $data['ip_address'] = \Request::ip();
        $data['created_type'] = 'Web';
        $data['email_verified_at'] = \DateFacades::getCurrentDateTime( 'format-1' );
        $data['e_token_check'] = '1';
        $data['status'] = 1;
        $data['role_id'] = $this->_helperRoles->getTeacherRoleId();
        $results = $this->userObj->saveRecord( $data );
        if ( ! empty( $results['user_id'] ) && $results['user_id'] > 0 ) {

            $fromName = "Kidrend";
            $toName = $data['first_name'] . ' ' . $data['last_name'];
            $toEmail = $data['email'];

            $entity = "teacher_register";
            $emailTemplate = $this->emailTemplateObj->getDateByEntity( $entity );
            $templateFields = $emailTemplate->template_fields;
            $templateContent = $emailTemplate->template_content;

            $templateFieldValues = ['name'     => $toName,
                                    'loginUrl' => url( 'teacher_login' ),
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

    public function profileDetails( Request $request, $teacherId )
    {
        $teacherId = Common::getDecryptId( $teacherId );

        if ( $teacherId <= 0 ) {
            return abort( 404 );
        }

        $teacher = $this->userObj->getDateById( $teacherId );
        if ( ! Common::isTeacher( $teacher ) ) {
            return abort( 404 );
        }

        $schoolRoleId = $this->_helperRoles->getSchoolRoleId();
		$schoolDropDown = $this->userObj->getSchoolDropDown( 'Schools', 1, '' );
        $gradeDropDown = $this->gradeObj->getDropDown( 'Select grade', $teacher->school_id,'' );
        $classesDropDown = $this->classesObj->getDropDown( $teacher->school_id, 1, $teacher->grade_id,'Select class', '' );

        $clubDropDown = $this->clubObj->getDropDown( '',$teacher->school_id );
        $filter = ['user_id' => $teacherId];
        $searchHelperClub = new SearchHelper( -1, -1, $selectColumns = ['*'], $filter );
        $clubs = $this->userClubObj->getList( $searchHelperClub );
        return view( 'admin.teacher.profile', compact( 'teacher', 'schoolDropDown', 'gradeDropDown', 'classesDropDown', 'clubDropDown', 'clubs' ) );
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

            $entity = "teacher_password_change";
            $emailTemplate = $this->emailTemplateObj->getDateByEntity( $entity );
            $templateFields = $emailTemplate->template_fields;
            $templateContent = $emailTemplate->template_content;

            $templateFieldValues = ['name'     => $toName,
                                    'loginUrl' => url( 'teacher_login' ),
                                    'email'    => $toEmail,
                                    'password' => $password];
            $mailContent = Common::convertEmailTemplateContent( $templateFields, $templateContent, $templateFieldValues );

            $subject = $emailTemplate->subject;
            $htmlContent = \View::make( 'admin.emails.common.email_template', ['mailContent' => $mailContent,
                                                                               'subject'     => $subject] )
                                ->render();
            Common::sendMailByMailJet( $htmlContent, $fromName, '', $subject, $toName, $toEmail );
            /* Send mail end */

            $message = "Teacher password changed successfully.";
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
            $message = "Teacher banned successfully";
            if ( $data['status'] == 1 ) {
                $message = "Teacher reactivated successfully.";
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
            $request->session()
                    ->flash( 'success', 'Teacher profile update successfully.' );
            return Redirect::back();
        } else {
            return Redirect::back()
                           ->withErrors( $result['message'] );
        }
    }

    public function clubSave(Request $request)
    {
        $data = $request->all();
        $result = $this->userClubObj->saveRecord($data);
        if ( !empty($result['user_club_id'] ) && $result['user_club_id'] > 0 ) {
            $request->session()->flash( 'success', 'Student club added successfully.' );
            return Redirect::back();
        } else {
            return Redirect::back()->withErrors($result['message']);
        }
    }
    public function clubDelete(Request $request)
    {
        $data = $request->all();
        if(empty($data['id'])){ return abort(404); }
        $clubId = $data['id'];
        if( $clubId <= 0 ){ return abort(404); }
        $isDelete = $this->userClubObj->removed($clubId);
        if($isDelete){
            $request->session()->flash( 'success', 'Club deleted successfully.' );
        }else{
            $request->session()->flash( 'error', 'Club is not deleted successfully.' );
        }
        return Redirect::back();
    }
}
