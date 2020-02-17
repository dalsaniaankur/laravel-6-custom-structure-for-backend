<?php

namespace App\Http\Controllers\Admin\Club;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Classes\Models\Club\Club;
use App\Classes\Helpers\Club\Helper;
use App\Classes\Common\Common;
use App\Classes\Helpers\SearchHelper;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use App\Classes\Models\User\User;
use App\Classes\Models\UserClub\UserClub;
use App\Classes\Helpers\Roles\Helper as HelperRoles;

class IndexController extends Controller
{
    protected $clubObj;
    protected $schoolObj;
    protected $userClubObj;
    protected $userObj;
    protected $_helper;
    protected $_helperRoles;

    public function __construct( Club $clubModel )
    {
        $this->clubObj = $clubModel;
        $this->schoolObj = new User();
        $this->userObj = new User();
        $this->userClubObj = new UserClub();
        $this->_helper = new Helper();
        $this->_helperRoles = new HelperRoles();
    }

    public function index( Request $request )
    {
        $data = $request->all();
        $page = ! empty( $data['page'] ) ? $data['page'] : 0;
        $sortedBy = ! empty( $request->get( 'sorted_by' ) ) ? $request->get( 'sorted_by' ) : 'updated_at';
        $sortedOrder = ! empty( $request->get( 'sorted_order' ) ) ? $request->get( 'sorted_order' ) : 'DESC';
        $clubName = ! empty( $data['club_name'] ) ? $data['club_name'] : "";
        $createdStartDate = isset( $data['start_date'] ) ? $data['start_date'] : '';
        $createdEndDate = isset( $data['end_date'] ) ? $data['end_date'] : '';
        $schoolId = ! empty( $data['school_id'] ) ? $data['school_id'] : -1;

        if ( empty($schoolId) || $schoolId <= 0 ) {
            return abort( 404 );
        }

        $perPage = $this->_helper->getConfigPerPageRecord();
        $recordStart = common::getRecordStart( $page, $perPage );
        $filter = ['club_name'          => $clubName,
                   'school_id'          => $schoolId,
                   'created_start_date' => $createdStartDate,
                   'created_end_date'   => $createdEndDate,];

        $searchHelper = new SearchHelper( $page, $perPage, $selectColumns = ['*'], $filter, $sortOrder = [$sortedBy => $sortedOrder] );
        $clubs = $this->clubObj->getList( $searchHelper );
        $totalRecordCount = $this->clubObj->getListTotalCount( $searchHelper );
        $paginationBasePath = Common::getPaginationBasePath( ['club_name'  => $clubName,
                                                              'school_id'  => $schoolId,
                                                              'start_date' => $createdStartDate,
                                                              'end_date'   => $createdEndDate,] );
        $paging = $this->clubObj->preparePagination( $totalRecordCount, $paginationBasePath, $searchHelper );
        $schoolDropDown = $this->schoolObj->getSchoolDropDown();
        $schoolDropDownList = $this->schoolObj->getSchoolDropDown( 'Schools', 1, '' );
        return view( 'admin.club.index', compact( 'schoolDropDownList', 'sortedBy', 'sortedOrder', 'recordStart', 'clubs', 'paging', 'totalRecordCount', 'club_name', 'createdStartDate', 'createdEndDate', 'clubName', 'schoolDropDown', 'schoolId' ) );
    }

    public function delete( Request $request )
    {
        $data = $request->all();
        if ( empty( $data['id'] ) ) {
            return abort( 404 );
        }
        $isDelete = $this->clubObj->removed( $data['id'] );
        if ( $isDelete ) {
            $request->session()
                    ->flash( 'success', 'Club deleted successfully.' );
        } else {
            $request->session()
                    ->flash( 'error', 'Club is not deleted successfully.' );
        }
        return Redirect::back();
    }

    public function save( Request $request )
    {
        $data = $request->all();
        $results = $this->clubObj->saveRecord( $data );
        if ( ! empty( $results['club_id'] ) && $results['club_id'] > 0 ) {
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

    public function getDataForEditModel( Request $request )
    {
        $data = $request->all();
        $results = $this->clubObj->getDateById( $data['club_id'] );

        $response = [];
        $response['success'] = false;
        $response['message'] = '';

        if ( ! empty( $results['club_id'] ) && $results['club_id'] > 0 ) {
            $response['success'] = true;
            $response['message'] = '';
            $response['data'] = $results;
        }
        return response()->json( $response );
    }

    public function member( Request $request, $clubId )
    {
        $clubId = Common::getDecryptId( $clubId );
        if ( $clubId <= 0 ) {
            return abort( 404 );
        }

        $club = $this->clubObj->getDateById( $clubId );
        $clubName = $club->club_name;
        $schoolId = $club->school_id;
        $schoolName = $club->school->school_name;
        $studentRoleId = $this->_helperRoles->getStudentRoleId();
        $teacherRoleId = $this->_helperRoles->getTeacherRoleId();

        /* Student List */
        $filter = ['club_id' => $clubId,
                   'role_id' => $studentRoleId];
        $searchHelper = new SearchHelper( -1, -1, $selectColumns = ['*'], $filter, ['updated_at' => 'DESC'] );
        $students = $this->userClubObj->getList( $searchHelper );

        $totalRecordCountForStudent = $this->userClubObj->getListTotalCount( $searchHelper );
        $addedStudentIdArray = [];
        if ( $totalRecordCountForStudent > 0 ) {
            $addedStudentIdArray = $students->pluck( 'user_id' )
                                            ->toArray();
        }

        /* Teacher List */
        $filter = ['club_id' => $clubId,
                   'role_id' => $teacherRoleId];
        $searchHelper = new SearchHelper( -1, -1, $selectColumns = ['*'], $filter, ['updated_at' => 'DESC'] );
        $teachers = $this->userClubObj->getList( $searchHelper );
        $totalRecordCountForTeacher = $this->userClubObj->getListTotalCount( $searchHelper );
        $addedTeacherIdArray = [];
        if ( $totalRecordCountForTeacher > 0 ) {
            $addedTeacherIdArray = $teachers->pluck( 'user_id' )
                                            ->toArray();
        }

        /* Student Dropdown */
        $filter = ['school_id'      => $schoolId,
                   'role_id'        => $studentRoleId,
                   'status'         => 1,
                   'is_verified'    => 1,
                   'user_id_not_in' => $addedStudentIdArray,];
        $searchHelper = new SearchHelper( -1, -1, $selectColumns = ['*'], $filter, ['first_name' => 'ASC'] );
        $studentDropDown = $this->userObj->getList( $searchHelper )
                                         ->pluck( 'name', 'user_id' );

        /* Teacher Dropdown */
        $filter = ['school_id'      => $schoolId,
                   'role_id'        => $teacherRoleId,
                   'status'         => 1,
                   'is_verified'    => 1,
                   'user_id_not_in' => $addedTeacherIdArray,];
        $searchHelper = new SearchHelper( -1, -1, $selectColumns = ['*'], $filter, ['first_name' => 'ASC'] );
        $teacherDropDown = $this->userObj->getList( $searchHelper )->pluck( 'name', 'user_id' );
        return view( 'admin.club.details', compact( 'teachers','students', 'totalRecordCountForStudent', 'totalRecordCountForTeacher', 'studentDropDown', 'teacherDropDown', 'studentRoleId', 'teacherRoleId', 'clubId','schoolName','clubName' ) );
    }

    public function deleteUserClub( Request $request )
    {
        $data = $request->all();
        if ( empty( $data['id'] ) ) {
            return abort( 404 );
        }
        $isDelete = $this->userClubObj->removed( $data['id'] );
        if ( $isDelete ) {
            $request->session()
                    ->flash( 'success', 'Club member deleted successfully.' );
        } else {
            $request->session()
                    ->flash( 'error', 'Club member is not deleted successfully.' );
        }
        return Redirect::back();
    }

    public function saveClubMember( Request $request )
    {
        $data = $request->all();
        if ( empty( $data['student_id'] ) && empty( $data['teacher_id'] ) ) {
            $request->session()
                    ->flash( 'error', 'Please select at least one member.' );
            return Redirect::back()
                           ->withInput();
        }

        if ( ! empty( $data['student_id'] ) ) {
            $studentIdArray = $data['student_id'];
            foreach ( $studentIdArray as $studentKey => $studentId ) {
                $data['user_id'] = $studentId;
                $this->userClubObj->saveRecord( $data );
            }

        }
        if ( ! empty( $data['teacher_id'] ) ) {
            $teacherIdArray = $data['teacher_id'];
            foreach ( $teacherIdArray as $teacherKey => $teacherId ) {
                $data['user_id'] = $teacherId;
                $this->userClubObj->saveRecord( $data );
            }

        }
        $request->session()
                ->flash( 'success', 'Club member saved successfully.' );
        return Redirect::back();
    }

    public function saveAjaxClubMember( Request $request )
    {
        $data = $request->all();
        $response = [];
        $response['success'] = true;
        $response['message'] = 'Club member added successfully.';

        if ( empty( $data['student_id'] ) && empty( $data['teacher_id'] ) ) {
            $response['message'] = 'Please select at least one member.';
            $response['success'] = false;
        }

        if ( ! empty( $data['student_id'] ) ) {
            $studentIdArray = $data['student_id'];
            foreach ( $studentIdArray as $studentKey => $studentId ) {
                $data['user_id'] = $studentId;
                $this->userClubObj->saveRecord( $data );
            }
        }
        if ( ! empty( $data['teacher_id'] ) ) {
            $teacherIdArray = $data['teacher_id'];
            foreach ( $teacherIdArray as $teacherKey => $teacherId ) {
                $data['user_id'] = $teacherId;
                $this->userClubObj->saveRecord( $data );
            }
        }
        return response()->json( $response );
    }
}
