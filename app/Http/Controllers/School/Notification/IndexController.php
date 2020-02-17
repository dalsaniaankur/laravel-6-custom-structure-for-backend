<?php

namespace App\Http\Controllers\School\Notification;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Classes\Helpers\Notification\Helper;
use App\Classes\Common\Common;
use App\Classes\Helpers\SearchHelper;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use App\Classes\Helpers\Roles\Helper as HelperRoles;
use App\Classes\Models\Notification\Notification;
use App\Classes\Models\User\User;
use App\Classes\Models\Club\Club;

class IndexController extends Controller
{
    protected $notificationObj;
    protected $userObj;
    protected $clubObj;
    protected $_helper;
    protected $_helperRoles;

    public function __construct()
    {
        $this->notificationObj = new Notification();
        $this->userObj = new User();
        $this->clubObj = new Club();
        $this->_helper = new Helper();
        $this->_helperRoles = new HelperRoles();
    }

    public function index( Request $request )
    {
        $data = $request->all();
        $page = ! empty( $data['page'] ) ? $data['page'] : 0;
        $sortedBy = ! empty( $request->get( 'sorted_by' ) ) ? $request->get( 'sorted_by' ) : 'created_at';
        $sortedOrder = ! empty( $request->get( 'sorted_order' ) ) ? $request->get( 'sorted_order' ) : 'DESC';
        $schoolId = Auth::guard('school')->user()->user_id;

        $perPage = $this->_helper->getConfigPerPageRecord();
        $recordStart = common::getRecordStart( $page, $perPage );
        $filter = ['sender_id' => $schoolId];
        $searchHelper = new SearchHelper( $page, $perPage, $selectColumns = ['*'], $filter, $sortOrder = [$sortedBy => $sortedOrder] );
        $notifications = $this->notificationObj->getList( $searchHelper );
        $totalRecordCount = $this->notificationObj->getListTotalCount( $searchHelper );
        $paginationBasePath = Common::getPaginationBasePath( [] );
        $paging = $this->notificationObj->preparePagination( $totalRecordCount, $paginationBasePath, $searchHelper );

        $filter = ['status' => 1,'is_verified' => 1,'role_id_in' => [3,4,5],'school_id' => $schoolId];
        $searchHelper = new SearchHelper( -1, -1, $selectColumns = ['*'], $filter );
        $userDropDown = $this->userObj->getList( $searchHelper )->pluck( 'name', 'user_id' );
        $clubDropDown = $this->clubObj->getDropDown('Select Club', $schoolId, '');

        return view( 'school.notification.index', compact( 'sortedBy', 'recordStart','sortedOrder',  'notifications', 'paging', 'totalRecordCount','userDropDown','clubDropDown','schoolId' ) );
    }

    public function delete( Request $request )
    {
        $data = $request->all();
        if ( empty( $data['id'] ) ) {
            return abort( 404 );
        }
        $isDelete = $this->notificationObj->removed( $data['id'] );
        if ( $isDelete ) {
            $request->session()
                    ->flash( 'success', 'Notification deleted successfully.' );
        } else {
            $request->session()
                    ->flash( 'error', 'Notification is not deleted successfully.' );
        }
        return Redirect::back();
    }

    public function save(Request $request)
    {
        $data = $request->all();		
		$receiverIdArray = $data['receiver_id'];
        if ( empty( $receiverIdArray ) ) {            
            return Redirect::back()->withInput()->withErrors("The receiver id field is required.");
        }
		
		$data['status'] = 1;
        $data['sender_id'] = Auth::guard( 'school' )->user()->user_id;
		
		foreach( $receiverIdArray as $id ) {
			$data['receiver_id'] = $id;			
			$results = $this->notificationObj->saveRecord($data);
			if ( ! empty( $results['notification_id'] ) && $results['notification_id'] > 0 ) {

            } else {
                /* Set Validation Message */
                $message = null;
                foreach ( $results['message'] as $key => $value ) {
                    if ( empty( $message ) ) {
                        $message = $results['message']->{$key}[0];
                        break;
                    }
                }
                return Redirect::back()->withInput()->withErrors($message);
            }
		}
        $request->session()->flash( 'success', "Message saved successfully." );
        return Redirect::back();
    }
}