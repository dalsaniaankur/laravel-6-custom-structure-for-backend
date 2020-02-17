<?php

namespace App\Http\Controllers\Admin\School;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Classes\Models\User\User;
use App\Classes\Models\State\State;
use App\Classes\Models\City\City;
use App\Classes\Models\Country\Country;
use App\Classes\Models\SchoolLevel\SchoolLevel;
use App\Classes\Helpers\User\Helper;
use App\Classes\Helpers\Roles\Helper as HelperRoles;
use App\Classes\Common\Common;
use App\Classes\Helpers\SearchHelper;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use App\Classes\Models\EmailTemplate\EmailTemplate;
use App\Classes\Models\Club\Club;
use App\Classes\Models\Exam\Exam;
use App\Classes\Models\Message\Message;

class IndexController extends Controller
{
    protected $userObj;
    protected $cityObj;
    protected $stateObj;
    protected $countryObj;
    protected $schoollevelObj;
    protected $classesObj;
    protected $emailTemplateObj;
    protected $clubObj;
    protected $examObj;
    protected $messageObj;
    protected $_helper;
    protected $_helperRoles;
    protected $_helperCity;
    protected $_searchHelper;

    public function __construct( User $userModel )
    {
        $this->userObj = $userModel;
        $this->cityObj = new City();
        $this->stateObj = new State();
        $this->countryObj = new Country();
        $this->schoollevelObj = new SchoolLevel();
        $this->emailTemplateObj = new EmailTemplate();
        $this->clubObj = new Club();
        $this->examObj = new Exam();
        $this->messageObj = new Message();
        $this->_helper = new Helper();
        $this->_helperRoles = new HelperRoles();
    }

    public function index( Request $request )
    {
        $data = $request->all();
        $page = ! empty( $data['page'] ) ? $data['page'] : 0;
        $sortedBy = ! empty( $request->get( 'sorted_by' ) ) ? $request->get( 'sorted_by' ) : 'updated_at';
        $sortedOrder = ! empty( $request->get( 'sorted_order' ) ) ? $request->get( 'sorted_order' ) : 'DESC';
        $schoolRoleId = $this->_helperRoles->getSchoolRoleId();
        $name = ! empty( $data['name'] ) ? $data['name'] : "";
        $city = ! empty( $data['city'] ) ? $data['city'] : "";
        $email = ! empty( $data['email'] ) ? $data['email'] : "";
        $status = isset( $data['status'] ) ? $data['status'] : -1;
        $schoolLevel = isset( $data['school_level'] ) ? $data['school_level'] : -1;
        $createdStartDate = isset( $data['start_date'] ) ? $data['start_date'] : '';
        $createdEndDate = isset( $data['end_date'] ) ? $data['end_date'] : '';

        $perPage = $this->_helper->getConfigPerPageRecord();
        $recordStart = common::getRecordStart( $page, $perPage );
        $filter = ['status'             => $status,
                   'is_verified'        => 1,
                   'role_id'            => $schoolRoleId,
                   'school_name'        => $name,
                   'city_name'          => $city,
                   'principal_email'    => $email,
                   'school_level'       => $schoolLevel,
                   'created_start_date' => $createdStartDate,
                   'created_end_date'   => $createdEndDate,];
        $groupBy = [$userTableName = $this->userObj->getTable() . '.user_id'];
        $searchHelper = new SearchHelper( $page, $perPage, $selectColumns = ['*'], $filter, $sortOrder = [$sortedBy => $sortedOrder],$groupBy );
        $schools = $this->userObj->getList( $searchHelper );
        $totalRecordCount = $this->userObj->getListTotalCount( $searchHelper );
        $paginationBasePath = Common::getPaginationBasePath( ['name'         => $name,
                                                              'status'       => $status,
                                                              'city'         => $city,
                                                              'email'        => $email,
                                                              'school_level' => $schoolLevel,
                                                              'start_date'   => $createdStartDate,
                                                              'end_date'     => $createdEndDate,] );
        $paging = $this->userObj->preparePagination( $totalRecordCount, $paginationBasePath, $searchHelper );
        $statusDropDown = $this->_helper->getStatusDropDownWithAllOption();
        $levelDropDown = $this->schoollevelObj->getDropDown( 'Level', '-1' );
        return view( 'admin.school.index', compact( 'sortedBy', 'sortedOrder', 'recordStart', 'schools', 'paging', 'totalRecordCount', 'name', 'city', 'email', 'statusDropDown', 'status', 'levelDropDown', 'createdStartDate', 'createdEndDate', 'schoolLevel' ) );
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
                    ->flash( 'success', 'School deleted successfully.' );
        } else {
            $request->session()
                    ->flash( 'error', 'School is not deleted successfully.' );
        }
        //return Redirect::back();
        return redirect( 'admin/schools' );
    }

    public function edit( Request $request, $userId )
    {
        $school = $this->userObj->getDateById( $userId );
        if ( empty( $school->user_id ) ) {
            return abort( 404 );
        }
        $stateDropDown = $this->stateObj->getDropDown();
        $cityDropDown = $this->cityObj->getCityDropDownByStateId( $school->state_id );

        return view( 'admin.school.create', compact( 'stateDropDown', 'cityDropDown', 'school' ) );
    }

    public function create( Request $request, $schoolId = '' )
    {
        $school = new \stdClass();
        if ( ! empty( $schoolId ) ) {
            $schoolId = Common::getDecryptId( $schoolId );
            if ( $schoolId <= 0 ) { return abort( 404 ); }
            $school = $this->userObj->getDateById( $schoolId );
        }

        $schoollevelDropDown = $this->schoollevelObj->getDropDown();
        $countryDropDown = $this->countryObj->getDropDown();
        if(!empty($schoolId) && $schoolId > 0) {
            $countryId = ! empty( $school->country_id ) ? $school->country_id : -1;
            $stateId = ! empty( $school->state_id ) ? $school->state_id : -1;
            $stateDropDown = $this->stateObj->getDropDown( '', '', $countryId );
            $cityDropDown = $this->cityObj->getDropDown( '', '', $stateId );
        }else{
            $countryId = !empty($countryDropDown ) ? array_first( array_flip( $countryDropDown->toArray() )) : 1 ;
            $stateId = !empty($stateDropDown ) ? array_first( array_flip( $stateDropDown->toArray() )) : 1 ;
            $stateDropDown = $this->stateObj->getDropDown( '', '', $countryId );
            $cityDropDown = $this->cityObj->getDropDown( '', '', $stateId );
        }
        return view( 'admin.school.step.setup1', compact( 'school', 'stateDropDown', 'cityDropDown', 'countryDropDown', 'schoollevelDropDown' ) );
    }

    public function schoolCreate( Request $request )
    {
        $data = $request->all();
        if ( empty( $data['user_id'] ) || $data['user_id'] == 0 ) {
            $password = Common::getDefaultPassword();
            $data['password'] = Common::generatePassword( $password );
        }
        $data['ip_address'] = \Request::ip();
        $data['created_type'] = 'Web';
        $data['email_verified_at'] = \DateFacades::getCurrentDateTime( 'format-1' );
        $data['e_token_check'] = '1';
        $data['status'] = 1;
        $data['role_id'] = $this->_helperRoles->getSchoolRoleId();

        $result = $this->userObj->saveRecord( $data );

        if ( ! empty( $result['user_id'] ) && $result['user_id'] > 0 ) {

            /* Send mail*/
            if ( ! empty( $password ) ) {

                $fromName = "Kidrend";
                $toName = $data['school_name'];
                $toEmail = $data['email'];

                $entity = "school_register";
                $emailTemplate = $this->emailTemplateObj->getDateByEntity( $entity );
                $templateFields = $emailTemplate->template_fields;
                $templateContent = $emailTemplate->template_content;

                $templateFieldValues = ['name'     => $toName,
                                        'loginUrl' => url( 'school_login' ),
                                        'email'    => $toEmail,
                                        'password' => $password];
                $mailContent = Common::convertEmailTemplateContent( $templateFields, $templateContent, $templateFieldValues );

                $subject = $emailTemplate->subject;
                $htmlContent = \View::make( 'admin.emails.common.email_template', ['mailContent' => $mailContent,
                                                                                   'subject'     => $subject] )
                                    ->render();

                Common::sendMailByMailJet( $htmlContent, $fromName, '', $subject, $toName, $toEmail );
            }

            $request->session()
                    ->flash( 'success', $result['message'] );
            $schoolId = $result['user_id'];
            return redirect( 'admin/school/create/' . Common::getEncryptId( $schoolId ) );
        } else {
            return Redirect::back()
                           ->withInput()
                           ->withErrors( $result['message'] );
        }
    }

    public function schoolDetails( Request $request, $schoolId = '' )
    {
        $schoolId = Common::getDecryptId( $schoolId );
        if ( $schoolId <= 0 ) {
            return abort( 404 );
        }
        $school = $this->userObj->getDateById( $schoolId );
        $schoollevelDropDown = $this->schoollevelObj->getDropDown();
        $countryDropDown = $this->countryObj->getDropDown();
        $stateDropDown = $this->stateObj->getDropDown($prepend = '', $prependKey = 0, $school->country_id);
        $cityDropDown = $this->cityObj->getDropDown($prepend = '', $prependKey = 0, $school->state_id);

        $teacherRoleId = $this->_helperRoles->getTeacherRoleId();
        $filter = ['role_id'   => $teacherRoleId,
                   'school_id' => $schoolId];
        $searchHelper = new SearchHelper( 1, -1, $selectColumns = ['*'], $filter );
        $totalTeachers = $this->userObj->getListTotalCount( $searchHelper );

        $studentRoleId = $this->_helperRoles->getStudentRoleId();
        $filter = ['role_id'   => $studentRoleId,
                   'school_id' => $schoolId];
        $searchHelper = new SearchHelper( -1, -1, $selectColumns = ['*'], $filter );
        $totalStudents = $this->userObj->getListTotalCount( $searchHelper );

        $parentRoleId = $this->_helperRoles->getParentRoleId();
        $filter = ['role_id'   => $parentRoleId,
                   'school_id' => $schoolId];
        $searchHelper = new SearchHelper( -1, -1, $selectColumns = ['*'], $filter );
        $totalParents = $this->userObj->getListTotalCount( $searchHelper );

        $PTAMemberRoleId = $this->_helperRoles->getPTAMemberRoleId();
        $filter = ['role_id'   => $PTAMemberRoleId,
                   'school_id' => $schoolId];
        $searchHelper = new SearchHelper( -1, -1, $selectColumns = ['*'], $filter );
        $totalPTAMembers = $this->userObj->getListTotalCount( $searchHelper );

        $filter = ['school_id' => $schoolId];
        $searchHelper = new SearchHelper( -1, -1, $selectColumns = ['*'], $filter );
        $totalClubs = $this->clubObj->getListTotalCount( $searchHelper );

        $searchHelper = new SearchHelper( -1, -1, $selectColumns = ['*'], $filter );
        $totalExams = $this->examObj->getListTotalCount( $searchHelper );

        $receiverId = Auth::guard( 'admin' )->user()->user_id;
        $filter = ['sender_id' => $schoolId,'receiver_id' => $receiverId];
        $searchHelper = new SearchHelper( -1, -1, $selectColumns = ['*'], $filter );
        $totalMessages = $this->messageObj->getListTotalCount( $searchHelper );

        return view( 'admin.school.details', compact( 'totalTeachers', 'totalStudents', 'school', 'stateDropDown', 'cityDropDown', 'countryDropDown', 'schoollevelDropDown','totalParents','totalPTAMembers','totalClubs','totalExams','totalMessages' ) );
    }

    public function profileSave( Request $request )
    {
        $data = $request->all();

        $result = $this->userObj->adminProfileSave( $data );

        if ( ! empty( $result['success'] ) && $result['success'] == 1 ) {
            $request->session()
                    ->flash( 'success', 'School admin profile update successfully.' );
            return Redirect::back();
        } else {
            return Redirect::back()
                           ->withErrors( $result['message'] );
        }
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
            $toName = $user->school_name;
            $toEmail = $user->email;

            $entity = "school_password_change";
            $emailTemplate = $this->emailTemplateObj->getDateByEntity( $entity );
            $templateFields = $emailTemplate->template_fields;
            $templateContent = $emailTemplate->template_content;

            $templateFieldValues = ['name'     => $toName,
                                    'loginUrl' => url( 'school_login' ),
                                    'email'    => $toEmail,
                                    'password' => $password];
            $mailContent = Common::convertEmailTemplateContent( $templateFields, $templateContent, $templateFieldValues );

            $subject = $emailTemplate->subject;
            $htmlContent = \View::make( 'admin.emails.common.email_template', ['mailContent' => $mailContent,
                                                                               'subject'     => $subject] )
                                ->render();

            Common::sendMailByMailJet( $htmlContent, $fromName, '', $subject, $toName, $toEmail );
            /* Send mail end */

            $request->session()
                    ->flash( 'success', "School password changed successfully." );
            return Redirect::back();
        } else {
            return Redirect::back()
                           ->withErrors( $result['message'] );
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

    public function updateSchool( Request $request )
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
            $message = "School banned successfully";
            if ( $data['status'] == 1 ) {
                $message = "School reactivated successfully.";
            }
            $request->session()
                    ->flash( 'success', $message );
            return Redirect::back();
        } else {
            return Redirect::back()
                           ->withErrors( $result['message'] );
        }
    }
}
