<?php

namespace App\Http\Controllers\Admin\Classes;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Classes\Models\Grade\Grade;
use App\Classes\Models\Classes\Classes;
use App\Classes\Helpers\Classes\Helper;
use App\Classes\Common\Common;
use App\Classes\Helpers\SearchHelper;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use App\Classes\Models\User\User;

class IndexController extends Controller
{
    protected $gradeObj;
    protected $classesObj;
    protected $userObj;
    protected $_helper;

    public function __construct( Grade $gradeModel )
    {
        $this->gradeObj = $gradeModel;
        $this->classesObj = new Classes();
        $this->schoolObj = new User();
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
        $className = ! empty( $data['class_name'] ) ? $data['class_name'] : "";
        $status = isset( $data['status'] ) ? $data['status'] : -1;
        $createdStartDate = isset( $data['start_date'] ) ? $data['start_date'] : '';
        $createdEndDate = isset( $data['end_date'] ) ? $data['end_date'] : '';
        $schoolId = !empty( $data['school_id'] ) ? $data['school_id'] : -1;

        if ( empty($schoolId) || $schoolId <= 0 ) {
            return abort( 404 );
        }

        $perPage = $this->_helper->getConfigPerPageRecord();
        $recordStart = common::getRecordStart( $page, $perPage );
        $filter = ['grade_name'         => $gradeName,
                   'class_name'         => $className,
                   'status'             => $status,
                   'created_start_date' => $createdStartDate,
                   'created_end_date'   => $createdEndDate,
				   'school_id'   => $schoolId,
				   ];

        $searchHelper = new SearchHelper( $page, $perPage, $selectColumns = ['*'], $filter, $sortOrder = [$sortedBy => $sortedOrder] );
        $classes = $this->classesObj->getList( $searchHelper );
        $totalRecordCount = $this->classesObj->getListTotalCount( $searchHelper );
        $paginationBasePath = Common::getPaginationBasePath( ['grade_name' => $gradeName,
                                                              'class_name' => $className,
                                                              'status'     => $status,
                                                              'start_date' => $createdStartDate,
                                                              'end_date'   => $createdEndDate,
															  'school_id'   => $schoolId,
															  ] );
        $paging = $this->gradeObj->preparePagination( $totalRecordCount, $paginationBasePath, $searchHelper );
        $statusDropDown = $this->_helper->getStatusDropDownWithAllOption();
        $statusDropDownOption = $this->_helper->getStatusDropDownWithSpecificOption();
        $gradeTableName = $this->gradeObj->getTableName();
        $schoolDropDownList = $this->userObj->getSchoolDropDown( 'Schools', 1, '' );
		$gradeDropDownList = [];
		if(!empty($schoolId) && $schoolId > 0){
            $gradeDropDownList = $this->gradeObj->getDropDown('Select grade', $schoolId, '');
        }
        return view( 'admin.classes.index', compact( 'schoolDropDownList','gradeDropDownList', 'schoolId', 'statusDropDownOption', 'schoolDropDownList', 'sortedBy', 'sortedOrder', 'recordStart', 'classes', 'paging', 'totalRecordCount', 'statusDropDown', 'gradeName', 'className', 'status', 'createdStartDate', 'createdEndDate','gradeTableName' ) );
    }

    public function create( Request $request, $schoolId )
    {

        $schoolId = Common::getDecryptId( $schoolId );
        if ( $schoolId <= 0 ) {
            return abort( 404 );
        }
        $gradeDropDown = $this->gradeObj->getDropDown( $prepend = '', $schoolId );

        $filter = ['school_id' => $schoolId];
        $searchHelper = new SearchHelper( -1, -1, $selectColumns = ['*'], $filter, $sortOrder = ['updated_at' => 'DESC'] );
        $classes = $this->classesObj->getList( $searchHelper );

        return view( 'admin.school.step.setup3', compact( 'classes', 'gradeDropDown', 'schoolId' ) );
    }

    public function delete( Request $request )
    {
        $data = $request->all();
        if ( empty( $data['id'] ) ) {
            return abort( 404 );
        }
        $isDelete = $this->classesObj->removed( $data['id'] );
        if ( $isDelete ) {
            $request->session()
                    ->flash( 'success', 'Class deleted successfully.' );
        } else {
            $request->session()
                    ->flash( 'error', 'Class is not deleted successfully.' );
        }
        return Redirect::back();
    }

    public function save( Request $request )
    {
        $data = $request->all();
        $result = $this->classesObj->saveRecord( $data );
        if ( ! empty( $result['class_id'] ) && $result['class_id'] > 0 ) {
            $request->session()
                    ->flash( 'success', $result['message'] );
            return Redirect::back();
        } else {
            return Redirect::back()
                           ->withInput()
                           ->withErrors( $result['message'] );
        }
    }

    public function saveAjax(Request $request){
        $data = $request->all();
        $results = $this->classesObj->saveRecord($data);
        if(!empty($results['class_id']) && $results['class_id'] > 0) {
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

	public function getData(Request $request){
		 $data = $request->all();
        $results = $this->classesObj->getDateById($data['class_id']);

        $response = array();
        $response['success'] = false;
        $response['message'] = '';

        if(!empty($results['class_id']) && $results['class_id'] > 0) {
            $response['success'] = true;
            $response['message'] = '';
            $response['data'] = $results;
        }
        return response()->json($response);
	}
}
