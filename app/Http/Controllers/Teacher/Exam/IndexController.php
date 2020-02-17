<?php

namespace App\Http\Controllers\Teacher\Exam;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Classes\Models\Exam\Exam;
use App\Classes\Helpers\Exam\Helper;
use App\Classes\Common\Common;
use App\Classes\Helpers\SearchHelper;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use App\Classes\Models\User\User;

class IndexController extends Controller
{
    protected $examObj;
    protected $userObj;
    protected $_helper;

    public function __construct( Exam $examModel )
    {
        $this->examObj = $examModel;
        $this->userObj = new User();
        $this->_helper = new Helper();
    }

    public function index( Request $request )
    {
        $data = $request->all();
        $page = ! empty( $data['page'] ) ? $data['page'] : 0;
        $sortedBy = ! empty( $request->get( 'sorted_by' ) ) ? $request->get( 'sorted_by' ) : 'updated_at';
        $sortedOrder = ! empty( $request->get( 'sorted_order' ) ) ? $request->get( 'sorted_order' ) : 'DESC';
        $examName = ! empty( $data['exam_name'] ) ? $data['exam_name'] : "";
        $schoolId = Auth::guard('teacher')->user()->school_id;
        $examStartDate = isset( $data['start_date'] ) ? $data['start_date'] : '';
        $examEndDate = isset( $data['end_date'] ) ? $data['end_date'] : '';

        $perPage = $this->_helper->getConfigPerPageRecord();
        $recordStart = common::getRecordStart( $page, $perPage );
        $filter = ['exam_name'         => $examName,
                   'school_id'          => $schoolId,
                   'exam_start_date' => $examStartDate,
                   'exam_end_date'   => $examEndDate,];

        $searchHelper = new SearchHelper( $page, $perPage, $selectColumns = ['*'], $filter, $sortOrder = [$sortedBy => $sortedOrder] );
        $exams = $this->examObj->getList( $searchHelper );
        $totalRecordCount = $this->examObj->getListTotalCount( $searchHelper );
        $paginationBasePath = Common::getPaginationBasePath( ['exam_name'         => $examName,
                                                              'start_date' => $examStartDate,
                                                              'end_date'   => $examEndDate,] );

        $paging = $this->examObj->preparePagination( $totalRecordCount, $paginationBasePath, $searchHelper );
        return view( 'teacher.exam.index', compact( 'examName','schoolId', 'examStartDate', 'examEndDate','sortedBy', 'sortedOrder', 'recordStart', 'exams', 'paging', 'totalRecordCount' ) );
    }

    public function delete( Request $request )
    {
        $data = $request->all();
        if ( empty( $data['id'] ) ) {
            return abort( 404 );
        }
        $isDelete = $this->examObj->removed( $data['id'] );
        if ( $isDelete ) {
            $request->session()
                    ->flash( 'success', 'Exam deleted successfully.' );
        } else {
            $request->session()
                    ->flash( 'error', 'Exam is not deleted successfully.' );
        }
        return Redirect::back();
    }

    public function saveAjax( Request $request )
    {
        $data = $request->all();
        $data['created_user_id'] = Auth::guard('teacher')->getUser()->user_id;
        $data['school_id'] = Auth::guard('teacher')->getUser()->school_id;
        $results = $this->examObj->saveRecord( $data );
        if ( ! empty( $results['exam_id'] ) && $results['exam_id'] > 0 ) {
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
        $results = $this->examObj->getDateById( $data['exam_id'] );

        $response = [];
        $response['success'] = false;
        $response['message'] = '';

        if ( ! empty( $results['exam_id'] ) && $results['exam_id'] > 0 ) {
            $response['success'] = true;
            $response['message'] = '';
            $response['data'] = $results;
        }
        return response()->json( $response );
    }
}
