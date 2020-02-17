<?php

namespace App\Http\Controllers\Admin\EventAndNotification;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Classes\Helpers\EventAndNotification\Helper;
use App\Classes\Common\Common;
use App\Classes\Helpers\SearchHelper;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use App\Classes\Models\EventAndNotification\EventAndNotification;

class IndexController extends Controller
{
    protected $eventAndNotificationObj;
    protected $_helper;

    public function __construct()
    {
        $this->eventAndNotificationObj = new EventAndNotification();
        $this->_helper = new Helper();
    }

    public function index( Request $request )
    {
        $data = $request->all();
        $page = ! empty( $data['page'] ) ? $data['page'] : 0;
        $sortedBy = ! empty( $request->get( 'sorted_by' ) ) ? $request->get( 'sorted_by' ) : 'created_at';
        $sortedOrder = ! empty( $request->get( 'sorted_order' ) ) ? $request->get( 'sorted_order' ) : 'DESC';

        $perPage = $this->_helper->getConfigPerPageRecord();
        $recordStart = common::getRecordStart( $page, $perPage );
        $filter = [];
        $searchHelper = new SearchHelper( $page, $perPage, $selectColumns = ['*'], $filter, $sortOrder = [$sortedBy => $sortedOrder] );
        $eventAndNotifications = $this->eventAndNotificationObj->getList( $searchHelper );
        $totalRecordCount = $this->eventAndNotificationObj->getListTotalCount( $searchHelper );
        $paginationBasePath = Common::getPaginationBasePath( [] );
        $paging = $this->eventAndNotificationObj->preparePagination( $totalRecordCount, $paginationBasePath, $searchHelper );

        $notificationTypeDropDown = $this->_helper->getNotificationTypeDropDown();
        $typeDropDown = $this->_helper->getTypeDropDown();
        return view( 'admin.event_and_notification.index', compact( 'sortedBy', 'recordStart','sortedOrder',  'eventAndNotifications', 'paging', 'totalRecordCount','notificationTypeDropDown','typeDropDown' ) );
    }

    public function delete( Request $request )
    {
        $data = $request->all();
        if ( empty( $data['id'] ) ) {
            return abort( 404 );
        }
        $isDelete = $this->eventAndNotificationObj->removed( $data['id'] );
        if ( $isDelete ) {
            $request->session()
                    ->flash( 'success', 'Event & Notification deleted successfully.' );
        } else {
            $request->session()
                    ->flash( 'error', 'Event & Notification is not deleted successfully.' );
        }
        return Redirect::back();
    }

    public function save(Request $request)
    {
        $data = $request->all();
		$data['created_type'] = "Web";
        $data['sender_id'] = Auth::guard( 'admin' )->user()->user_id;
        $data['status'] = 1;
        $result = $this->eventAndNotificationObj->saveRecord( $data );
        if ( ! empty( $result['event_and_notification_id'] ) && $result['event_and_notification_id'] > 0 ) {
            $request->session()->flash( 'success', "Event & Notification saved successfully." );
            return Redirect::back();
        } else {
            return Redirect::back()->withInput();
        }
    }

    public function saveAjax(Request $request){
        $data = $request->all();
        $results = $this->eventAndNotificationObj->saveRecord($data);
        if(!empty($results['event_and_notification_id']) && $results['event_and_notification_id'] > 0) {
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

    public function getDataForEditModel(Request $request){
        $data = $request->all();
        $results = $this->eventAndNotificationObj->getDateById($data['event_and_notification_id']);

        $response = array();
        $response['success'] = false;
        $response['message'] = '';

        if(!empty($results['event_and_notification_id']) && $results['event_and_notification_id'] > 0) {
            $response['success'] = true;
            $response['message'] = '';
            $results->start_time_twelve_format = $results->start_time_twelve_format;
            $results->end_time_twelve_format = $results->end_time_twelve_format;
            $results->event_date_picker_format = $results->event_date_picker_format;
            $response['data'] = $results;
        }
        return response()->json($response);
    }
}
