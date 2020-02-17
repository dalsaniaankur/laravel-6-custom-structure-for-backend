<?php

namespace App\Http\Controllers\Admin\PTAMember;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Classes\Models\User\User;
use App\Classes\Helpers\User\Helper;
use App\Classes\Common\Common;
use App\Classes\Helpers\SearchHelper;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use App\Classes\Helpers\Roles\Helper as HelperRoles;
use App\Classes\Models\EmailTemplate\EmailTemplate;

class IndexController extends Controller
{
    protected $userObj;
    protected $_helper;
    protected $_helperRoles;
    protected $emailTemplateObj;

    public function __construct( User $userModel )
    {
        $this->userObj = $userModel;
        $this->_helper = new Helper();
        $this->_helperRoles = new HelperRoles();
        $this->emailTemplateObj = new EmailTemplate();
    }

    public function index( Request $request )
    {
        $data = $request->all();
        $page = ! empty( $data['page'] ) ? $data['page'] : 0;
        $sortedBy = ! empty( $request->get( 'sorted_by' ) ) ? $request->get( 'sorted_by' ) : 'updated_at';
        $sortedOrder = ! empty( $request->get( 'sorted_order' ) ) ? $request->get( 'sorted_order' ) : 'DESC';
        $ptaMemberRoleId = $this->_helperRoles->getPTAMemberRoleId();
        $name = ! empty( $data['name'] ) ? $data['name'] : "";
        $email = ! empty( $data['email'] ) ? $data['email'] : "";
        $status = isset( $data['status'] ) ? $data['status'] : -1;
        $gender = isset( $data['gender'] ) ? $data['gender'] : '';
        $createdStartDate = isset( $data['start_date'] ) ? $data['start_date'] : '';
        $createdEndDate = isset( $data['end_date'] ) ? $data['end_date'] : '';
        $schoolId = ! empty( $data['school_id'] ) ? $data['school_id'] : -1;

        if ( empty($schoolId) || $schoolId <= 0 ) {
            return abort( 404 );
        }

        $perPage = $this->_helper->getConfigPerPageRecord();

        $recordStart = common::getRecordStart( $page, $perPage );
        $filter = ['status'             => $status,
                   'is_verified'        => 1,
                   'role_id'            => $ptaMemberRoleId,
                   'school_id'          => $schoolId,
                   'name'               => $name,
                   'email'              => $email,
                   'gender'             => $gender,
                   'created_start_date' => $createdStartDate,
                   'created_end_date'   => $createdEndDate];
        $groupBy = [$userTableName = $this->userObj->getTable() . '.user_id'];
        $searchHelper = new SearchHelper( $page, $perPage, $selectColumns = ['*'], $filter, $sortOrder = [$sortedBy => $sortedOrder],$groupBy );
        $ptaMembers = $this->userObj->getList( $searchHelper );
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
        $schoolDropDownList = $this->userObj->getSchoolDropDown( 'Schools', 1, '' );
        return view( 'admin.pta_member.index', compact( 'sortedBy', 'sortedOrder', 'recordStart', 'ptaMembers', 'paging', 'totalRecordCount', 'name', 'email', 'statusDropDown', 'status', 'createdStartDate', 'createdEndDate', 'gender', 'schoolDropDownList', 'schoolDropDownList', 'schoolId' ) );
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
                    ->flash( 'success', 'PTA Member deleted successfully.' );
        } else {
            $request->session()
                    ->flash( 'error', 'PTA Member is not deleted successfully.' );
        }
        return redirect( 'admin/pta-members?school_id='.$schoolId );
        //return Redirect::back();
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
        $data['role_id'] = $this->_helperRoles->getPTAMemberRoleId();

        $results = $this->userObj->saveRecord( $data );
        if ( ! empty( $results['user_id'] ) && $results['user_id'] > 0 ) {

            /*$fromName = "Kidrend";
            $toName = $data['first_name'].' '.$data['last_name'];
            $toEmail = $data['email'];

            $entity = "teacher_register";
            $emailTemplate = $this->emailTemplateObj->getDateByEntity($entity);
            $templateFields = $emailTemplate->template_fields;
            $templateContent = $emailTemplate->template_content;

            $templateFieldValues = ['name' => $toName,
                                    'loginUrl' => url('teacher_login'),
                                    'email' => $toEmail,
                                    'password' => $password];
            $mailContent = Common::convertEmailTemplateContent($templateFields, $templateContent, $templateFieldValues);

            $subject = $emailTemplate->subject;
            $htmlContent = \View::make( 'admin.emails.common.email_template', ['mailContent' => $mailContent,
                                                                    'subject' => $subject] )->render();

            Common::sendMailByMailJet( $htmlContent, $fromName, '', $subject, $toName, $toEmail );*/

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

    public function profileDetails( Request $request, $userId )
    {
        $userId = Common::getDecryptId( $userId );
        if ( $userId <= 0 ) {
            return abort( 404 );
        }
        $ptaMember = $this->userObj->getDateById( $userId );
        if ( ! Common::isPTAMember( $ptaMember ) ) {
            return abort( 404 );
        }
        $schoolDropDownList = $this->userObj->getSchoolDropDown( 'Select school', 1, '' );
        return view( 'admin.pta_member.profile', compact( 'ptaMember', 'schoolDropDownList' ) );
    }

    public function changePassword( Request $request )
    {
        $data = $request->all();
        $password = $data['password'];
        $result = $this->userObj->changePassword( $data );
        if ( ! empty( $result['user_id'] ) && $result['user_id'] > 0 ) {

            /* Send mail */ /*$user = $this->userObj->getDateById( $result['user_id'] );

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
            Common::sendMailByMailJet( $htmlContent, $fromName, '', $subject, $toName, $toEmail );*/
            /* Send mail end */

            $message = "PTA Member password changed successfully.";
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
            $message = "PTA Member banned successfully";
            if ( $data['status'] == 1 ) {
                $message = "PTA Member reactivated successfully.";
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
                    ->flash( 'success', 'PTA Member profile update successfully.' );
            return Redirect::back();
        } else {
            return Redirect::back()
                           ->withErrors( $result['message'] );
        }
    }
}
