<?php

namespace App\Http\Controllers\Teacher\Homework;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Classes\Models\Homework\Homework;
use App\Classes\Helpers\Homework\Helper;
use App\Classes\Common\Common;
use App\Classes\Helpers\SearchHelper;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use App\Classes\Models\User\User;

class IndexController extends Controller
{
    protected $homeworkObj;
    protected $userObj;
    protected $_helper;

    public function __construct( Homework $homeworkModel )
    {
        $this->homeworkObj = $homeworkModel;
        $this->userObj = new User();
        $this->_helper = new Helper();
    }

    public function index( Request $request )
    {
        $data = $request->all();
        $page = ! empty( $data['page'] ) ? $data['page'] : 0;
        $sortedBy = ! empty( $request->get( 'sorted_by' ) ) ? $request->get( 'sorted_by' ) : 'updated_at';
        $sortedOrder = ! empty( $request->get( 'sorted_order' ) ) ? $request->get( 'sorted_order' ) : 'DESC';
        $content = ! empty( $data['content'] ) ? $data['content'] : "";
        $schoolId = Auth::guard('teacher')->user()->school_id;
        $classId = Auth::guard('teacher')->user()->class_id;
        $createdStartDate = isset( $data['start_date'] ) ? $data['start_date'] : '';
        $createdEndDate = isset( $data['end_date'] ) ? $data['end_date'] : '';

        $perPage = $this->_helper->getConfigPerPageRecord();
        $recordStart = common::getRecordStart( $page, $perPage );
        $filter = ['content'         => $content,
                   'school_id'          => $schoolId,
                   'class_id'          => $classId,
                   'created_start_date' => $createdStartDate,
                   'created_end_date'   => $createdEndDate,];

        $searchHelper = new SearchHelper( $page, $perPage, $selectColumns = ['*'], $filter, $sortOrder = [$sortedBy => $sortedOrder] );
        $homework = $this->homeworkObj->getList( $searchHelper );
        $totalRecordCount = $this->homeworkObj->getListTotalCount( $searchHelper );
        $paginationBasePath = Common::getPaginationBasePath( ['content'         => $content,
                                                              'start_date' => $createdStartDate,
                                                              'end_date'   => $createdEndDate,] );

        $paging = $this->homeworkObj->preparePagination( $totalRecordCount, $paginationBasePath, $searchHelper );
        return view( 'teacher.homework.index', compact( 'content','schoolId', 'createdStartDate', 'createdEndDate','sortedBy', 'sortedOrder', 'recordStart', 'homework', 'paging', 'totalRecordCount' ) );
    }

    public function delete( Request $request )
    {
        $data = $request->all();
        if ( empty( $data['id'] ) ) {
            return abort( 404 );
        }
        $isDelete = $this->homeworkObj->removed( $data['id'] );
        if ( $isDelete ) {
            $request->session()
                    ->flash( 'success', 'Homework deleted successfully.' );
        } else {
            $request->session()
                    ->flash( 'error', 'Homework is not deleted successfully.' );
        }
        return Redirect::back();
    }

    public function saveAjax( Request $request )
    {		
        $data = $request->all();
        $data['created_user_id'] = Auth::guard('teacher')->getUser()->user_id;
        $data['school_id'] = Auth::guard('teacher')->getUser()->school_id;
        $data['class_id'] = Auth::guard('teacher')->getUser()->class_id;
        $data['homework_date'] = date('Y-m-d', strtotime($data['homework_date']) );
        $results = $this->homeworkObj->saveRecord( $data );		
        if ( ! empty( $results['homework_id'] ) && $results['homework_id'] > 0 ) {
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
        $results = $this->homeworkObj->getDateById( $data['homework_id'] );

        $response = [];
        $response['success'] = false;
        $response['message'] = '';

        if ( ! empty( $results['homework_id'] ) && $results['homework_id'] > 0 ) {
			if ( !empty($results->photo) && Common::isFileExists($results->photo) )
				$results->photo = url($results->photo);
            $response['success'] = true;
            $response['message'] = '';
            $response['data'] = $results;
        }
        return response()->json( $response );
    }
}