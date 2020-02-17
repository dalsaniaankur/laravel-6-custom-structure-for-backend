<?php

namespace App\Http\Controllers\Teacher\Events;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Classes\Models\Events\Events;
use App\Classes\Helpers\Events\Helper;
use App\Classes\Common\Common;
use App\Classes\Helpers\SearchHelper;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use App\Classes\Models\User\User;

class IndexController extends Controller
{
    protected $eventObj;
    protected $userObj;
    protected $_helper;

    public function __construct( Events $eventsModel )
    {
        $this->eventObj = $eventsModel;
        $this->userObj = new User();
        $this->_helper = new Helper();
    }

    public function index( Request $request )
    {
        $data = $request->all();
        $page = ! empty( $data['page'] ) ? $data['page'] : 0;
        $sortedBy = ! empty( $request->get( 'sorted_by' ) ) ? $request->get( 'sorted_by' ) : 'updated_at';
        $sortedOrder = ! empty( $request->get( 'sorted_order' ) ) ? $request->get( 'sorted_order' ) : 'DESC';
        $eventTitle = ! empty( $data['event_title'] ) ? $data['event_title'] : "";
        $description = ! empty( $data['description'] ) ? $data['description'] : "";
        $schoolId = Auth::guard('teacher')->user()->school_id;
        $classId = Auth::guard('teacher')->user()->class_id;
        $createdStartDate = isset( $data['start_date'] ) ? $data['start_date'] : '';
        $createdEndDate = isset( $data['end_date'] ) ? $data['end_date'] : '';

        $perPage = $this->_helper->getConfigPerPageRecord();
        $recordStart = common::getRecordStart( $page, $perPage );
        $filter = ['title'         => $eventTitle,
                   'description'          => $description,
                   'school_id'          => $schoolId,
                   'class_id'          => $classId,
                   'created_start_date' => $createdStartDate,
                   'created_end_date'   => $createdEndDate,];

        $searchHelper = new SearchHelper( $page, $perPage, $selectColumns = ['*'], $filter, $sortOrder = [$sortedBy => $sortedOrder] );
        $events = $this->eventObj->getList( $searchHelper );
        $totalRecordCount = $this->eventObj->getListTotalCount( $searchHelper );
        $paginationBasePath = Common::getPaginationBasePath( ['exam_name'         => $eventTitle,
                                                              'start_date' => $createdStartDate,
                                                              'end_date'   => $createdEndDate,] );

        $paging = $this->eventObj->preparePagination( $totalRecordCount, $paginationBasePath, $searchHelper );
        return view( 'teacher.events.index', compact( 'description', 'eventTitle','schoolId', 'createdStartDate', 'createdEndDate','sortedBy', 'sortedOrder', 'recordStart', 'events', 'paging', 'totalRecordCount' ) );
    }

    public function delete( Request $request )
    {
        $data = $request->all();
        if ( empty( $data['id'] ) ) {
            return abort( 404 );
        }
        $isDelete = $this->eventObj->removed( $data['id'] );
        if ( $isDelete ) {
            $request->session()
                    ->flash( 'success', 'Event deleted successfully.' );
        } else {
            $request->session()
                    ->flash( 'error', 'Event is not deleted successfully.' );
        }
        return Redirect::back();
    }

    public function saveAjax( Request $request )
    {
        $data = $request->all();
        $data['created_user_id'] = Auth::guard('teacher')->getUser()->user_id;
        $data['school_id'] = Auth::guard('teacher')->getUser()->school_id;
        $data['class_id'] = Auth::guard('teacher')->getUser()->class_id;
        $data['is_all'] = 1;
        $data['event_type'] = 5;
		
        $results = $this->eventObj->saveRecord( $data );
        if ( ! empty( $results['event_id'] ) && $results['event_id'] > 0 ) {
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
        $results = $this->eventObj->getDateById( $data['event_id'] );
        $response = [];
        $response['success'] = false;
        $response['message'] = '';

        if ( ! empty( $results['event_id'] ) && $results['event_id'] > 0 ) {
            $response['success'] = true;
            $response['message'] = '';	
			$results->start_time_twelve_format = $results->start_time_twelve_format;
			$results->end_time_twelve_format = $results->end_time_twelve_format;
            $response['data'] = $results;
        }
        return response()->json( $response );
    }
}