<?php

namespace App\Http\Controllers\Admin\Grade;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Classes\Models\Grade\Grade;
use App\Classes\Helpers\Grade\Helper;
use App\Classes\Common\Common;
use App\Classes\Helpers\SearchHelper;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use App\Classes\Models\User\User;

class IndexController extends Controller
{
    protected $gradeObj;
    protected $userObj;
    protected $_helper;

    public function __construct( Grade $gradeModel )
    {
        $this->gradeObj = $gradeModel;
        $this->userObj = new User();
        $this->_helper = new Helper();
    }

    public function index( Request $request)
    {
        $data = $request->all();
        $page = ! empty( $data['page'] ) ? $data['page'] : 0;
        $sortedBy = ! empty( $request->get( 'sorted_by' ) ) ? $request->get( 'sorted_by' ) : 'updated_at';
        $sortedOrder = ! empty( $request->get( 'sorted_order' ) ) ? $request->get( 'sorted_order' ) : 'DESC';
        $gradeName = ! empty( $data['grade_name'] ) ? $data['grade_name'] : "";
        $createdStartDate = isset( $data['start_date'] ) ? $data['start_date'] : '';
        $createdEndDate = isset( $data['end_date'] ) ? $data['end_date'] : '';
        $schoolId = !empty( $data['school_id'] ) ? $data['school_id'] : -1;
        if ( empty($schoolId) || $schoolId <= 0 ) {
            return abort( 404 );
        }

        $perPage = $this->_helper->getConfigPerPageRecord();
        $recordStart = common::getRecordStart( $page, $perPage );
        $filter = ['grade_name'         => $gradeName,
                   'created_start_date' => $createdStartDate,
                   'created_end_date'   => $createdEndDate,
                   'school_id'          => $schoolId,];

        $searchHelper = new SearchHelper( $page, $perPage, $selectColumns = ['*'], $filter, $sortOrder = [$sortedBy => $sortedOrder] );
        $grades = $this->gradeObj->getList( $searchHelper );
        $totalRecordCount = $this->gradeObj->getListTotalCount( $searchHelper );
        $paginationBasePath = Common::getPaginationBasePath( ['grade_name' => $gradeName,
                                                              'start_date' => $createdStartDate,
                                                              'end_date'   => $createdEndDate,
                                                              'school_id'  => $schoolId,] );
        $paging = $this->gradeObj->preparePagination( $totalRecordCount, $paginationBasePath, $searchHelper );
        $schoolDropDownList = $this->userObj->getSchoolDropDown( 'Schools', 1, '' );
        return view( 'admin.grade.index', compact( 'schoolId', 'sortedBy', 'sortedOrder', 'recordStart', 'grades', 'paging', 'totalRecordCount', 'grade_name', 'createdStartDate', 'createdEndDate', 'gradeName', 'schoolDropDownList' ) );
    }

    public function delete( Request $request )
    {
        $data = $request->all();
        if ( empty( $data['id'] ) ) {
            return abort( 404 );
        }
        $isDelete = $this->gradeObj->removed( $data['id'] );
        if ( $isDelete ) {
            $request->session()
                    ->flash( 'success', 'Grade deleted successfully.' );
        } else {
            $request->session()
                    ->flash( 'error', 'Grade is not deleted successfully.' );
        }
        return Redirect::back();
    }

    public function saveAjax( Request $request )
    {
        $data = $request->all();
        $results = $this->gradeObj->saveRecord( $data );
        if ( ! empty( $results['grade_id'] ) && $results['grade_id'] > 0 ) {
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
        $results = $this->gradeObj->getDateById( $data['grade_id'] );

        $response = [];
        $response['success'] = false;
        $response['message'] = '';

        if ( ! empty( $results['grade_id'] ) && $results['grade_id'] > 0 ) {
            $response['success'] = true;
            $response['message'] = '';
            $response['data'] = $results;
        }
        return response()->json( $response );
    }

    public function save( Request $request )
    {
        $data = $request->all();
        $result = $this->gradeObj->saveRecord( $data );
        if ( ! empty( $result['grade_id'] ) && $result['grade_id'] > 0 ) {
            $request->session()
                    ->flash( 'success', $result['message'] );
            return redirect( 'admin/classes' );
        } else {
            return Redirect::back()
                           ->withInput()
                           ->withErrors( $result['message'] );
        }
    }

    public function createSave( Request $request, $schoolId = '' )
    {
        $schoolId = Common::getDecryptId( $schoolId );
        if ( $schoolId <= 0 ) {
            return abort( 404 );
        }
        $data = $request->all();
        $data['school_id'] = $schoolId;
        $result = $this->gradeObj->saveRecord( $data );
        if ( ! empty( $result['grade_id'] ) && $result['grade_id'] > 0 ) {
            $request->session()
                    ->flash( 'success', $result['message'] );
            $schoolId = Common::getEncryptId( $schoolId );
            return redirect( 'admin/grade/create/' . $schoolId );
        } else {
            return Redirect::back()
                           ->withInput()
                           ->withErrors( $result['message'] );
        }
    }

    public function create( Request $request, $schoolId = '' )
    {
        $schoolId = Common::getDecryptId( $schoolId );
        if ( $schoolId <= 0 ) {
            return abort( 404 );
        }
        $filter['school_id'] = $schoolId;
        $searchHelper = new SearchHelper( -1, -1, $selectColumns = ['*'], $filter, $sortOrder = ['updated_at' => 'DESC'] );
        $gradeList = $this->gradeObj->getList( $searchHelper );
        return view( 'admin.school.step.setup2', compact( 'schoolId', 'gradeList' ) );
    }
}
