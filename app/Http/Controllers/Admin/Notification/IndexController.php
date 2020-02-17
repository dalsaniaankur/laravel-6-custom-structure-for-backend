<?php

namespace App\Http\Controllers\Admin\Notification;

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
use App\Http\Controllers\NotificationController;

class IndexController extends Controller
{
    protected $notificationObj;
    protected $userObj;
    protected $clubObj;
    protected $_helper;
    protected $_helperRoles;
    protected $notificationControllerObj;

    public function __construct()
    {
        $this->notificationObj = new Notification();
        $this->userObj = new User();
        $this->clubObj = new Club();
        $this->_helper = new Helper();
        $this->_helperRoles = new HelperRoles();
		$this->notificationControllerObj = New NotificationController();
    }

    public function index(Request $request){

        $data = $request->all();
        $page= !empty($data['page']) ? $data['page'] : 0;
        $sortedBy = !empty($request->get('sorted_by')) ? $request->get('sorted_by') : 'updated_at';
        $sortedOrder = !empty($request->get('sorted_order')) ? $request->get('sorted_order') : 'DESC';
        $perPage = !empty($data['per_page']) ? $data['per_page'] : $this->_helper->getConfigPerPageRecord();

        $recordStart = common::getRecordStart($page, $perPage);
        $groupBy = 'unique_group_id';

        $displayStartDate = !empty($data['display_start_date']) ? $data['display_start_date'] : '';
        $displayEndDate = !empty($data['display_end_date']) ? $data['display_end_date'] : '';
        $uniqueGroupIds = $uniqueGroupSendIds = $uniqueGroupViewIds = array();
        if( empty( $displayStartDate ) && empty( $displayEndDate )) {
            $displayEndDateAndTime = \DateFacades::getCurrentDateTimeWithRemoveDays( 'format-1', 3 );
            $filterExclude = ['status_id_in' => [ 0, 2 ],
                              'display_end_date_and_time' => $displayEndDateAndTime];
            $searchHelperNotificationExclude = new SearchHelper( -1, -1, ['*'], $filterExclude,[$sortedBy => $sortedOrder], [$groupBy]);
            $notificationsList = $this->notificationObj->getList($searchHelperNotificationExclude);
            $notificationsListCount = $this->notificationObj->getListTotalCount($searchHelperNotificationExclude);
            if( $notificationsListCount > 0 ) {
                $uniqueGroupIds = $notificationsList->pluck('unique_group_id')->toArray();
            }
			
            /* $filterExclude = ['status' => 2,
                              'display_end_date_and_time' => $displayEndDateAndTime];
            $searchHelperNotificationExclude = new SearchHelper( -1, -1, ['*'], $filterExclude, $sortOrder = [$sortedBy => $sortedOrder ], [$groupBy]);
            $notificationsListView = $this->notificationObj->getList($searchHelperNotificationExclude);
            $notificationsListViewCount = $this->notificationObj->getListTotalCount($searchHelperNotificationExclude);
            if( $notificationsListViewCount > 0 ) {
                $uniqueGroupViewIds = $notificationsListView->pluck('unique_group_id')->toArray();
            }
            $uniqueGroupIds = array_merge( $uniqueGroupSendIds, $uniqueGroupViewIds );	 */
        }
		
        $filter = ['display_start_date' => $displayStartDate,
                   'display_end_date' => $displayEndDate,
                    'unique_group_id_not_in' => $uniqueGroupIds];

        $searchHelperNotification = new SearchHelper($page, $perPage, $selectColumns = ['*'], $filter, $sortOrder = [$sortedBy => $sortedOrder ], [$groupBy] );

        $notifications = $this->notificationObj->getList($searchHelperNotification);
        $totalRecordCount= $this->notificationObj->getListTotalCount($searchHelperNotification);
        $paginationBasePath = Common::getPaginationBasePath( ['display_start_date' => $displayStartDate,
                                                              'display_end_date' => $displayEndDate,
                                                              'per_page'     => $perPage] );
        $paging = $this->notificationObj->preparePagination($totalRecordCount,$paginationBasePath,$searchHelperNotification);
		$schoolDropDown = $this->userObj->getSchoolDropDown( 'Select school', 1, '' );
        return view('admin.notification.index',compact('sortedBy', 'sortedOrder', 'recordStart','notifications','paging','totalRecordCount','displayStartDate','displayEndDate','schoolDropDown'));
    }

    public function save(Request $request)
    {
        $data = $request->all();
		$receiverIdArray = $data['user_id'];
        if ( empty( $receiverIdArray ) ) {
            return Redirect::back()->withInput()->withErrors("The receiver id field is required.");
        }
		$currentDate 		=	date('YmdHis');
		$notificationType 	=	$data['notificationsendtype'];
		
		$data['status'] = 1;		
        $data['created_user_id']	=	Auth::guard( 'admin' )->user()->user_id;
		$data['unique_group_id']	=	md5($currentDate);
		$data['display_date']		=	$notificationType == 'schedule' ? \DateFacades::dateFormat( $data['display_date'], 'format-16' ) : \DateFacades::getCurrentDateTime('format-1');
		$description 				=	$data['description'];
		
		foreach( $receiverIdArray as $userId ) {
			$data['user_id']			=	$userId;
			if( $notificationType == 'schedule' ) {
					$results = $this->notificationObj->saveRecord($data);
			} else { /* Instant Notification */
					$userInfo		=	$this->userObj->getDateById($userId);
					$userfcmtoken	=	isset($userInfo->fcm_token) ? $userInfo->fcm_token : '';
					$userapptype 	=	isset($userInfo->device_type) ? $userInfo->device_type : '';					
					$results 		=	$this->notificationObj->saveRecord($data);
					$notificationId	=	isset( $results['notification_id'] ) ? $results['notification_id'] : '';
					if( !empty($userapptype) && !empty($userfcmtoken) && $notificationId > 0 ) {						
						$responseData = array();
						$userapptype = strtolower( $userapptype );
						if( $userapptype == 'ios' ) {
							$responseData = $this->notificationControllerObj->SendNotificationToIosDevice($userfcmtoken, $description, $notificationId);
						} else if( $userapptype == 'android' ) {
							$responseData = $this->notificationControllerObj->SendNotificationToAndroidDevice($userfcmtoken, $description, $notificationId );
						}						
						$notificationInfo = $this->notificationObj->getDateById($notificationId);
						if( isset($responseData['success']) && $responseData['success']==1 ) {
							$notificationInfo->status = 0;
						} else {						
							$notificationInfo->status = 3;
						}						
						$notificationInfo->save();						
					}
			}			
		}
		
		if(!empty($results['notification_id']) && $results['notification_id'] > 0) {
			$response['success'] = true;
            $response['message'] = 'Notification saved successfully';
            return response()->json($results);
        } else {
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
        $request->session()->flash( 'success', "Notification saved successfully." );
        return Redirect::back();
    }


	public function delete(Request $request)
    {
        $data = $request->all();
        if(empty($data['id'])){ return abort(404); }
        $notificationId = Common::getDecryptId($data['id']);
        if( $notificationId <= 0 ){ return abort(404); }

		if( isset( $data['unique_group_id'] ) ) {
			$notificationLists = $this->notificationObj->getDataByUniqueGroupId( $data['unique_group_id'] );
			foreach( $notificationLists as $notificationList ) {
				$isDelete = $this->notificationObj->removed( $notificationList->notification_id );
			}
		} else {
			$isDelete = $this->notificationObj->removed($notificationId);
		}
        if($isDelete){
            $request->session()->flash( 'success', 'Notification deleted successfully.' );
        }else{
            $request->session()->flash( 'error', 'Notification is not deleted successfully.' );
        }
        return Redirect::back();
    }

	public function updateNotification(Request $request) {
		$data = $request->all();
		$notifications = $this->notificationObj->getDataByUniqueGroupId($data['unique_group_id']);
		$description = $data['description'];
		$display_date = \DateFacades::dateFormat( $data['display_date'], 'format-16' );
		foreach( $notifications as $notificationKey=>$notification ) {
			$notification->description =$description;
			$notification->display_date =$display_date;
			$notification->save();
		}

		/*
		$user_id			=	isset( $data['user_id'] ) && !empty( $data['user_id'] ) ? $data['user_id'] : array();
		$coach_id			=	isset( $data['coach_id'] ) && !empty( $data['coach_id'] ) ? $data['coach_id'] : array();
		$userIdArray 		=	array_merge( $user_id, $coach_id );
		if( !empty( $userIdArray ) ) {
			$updatedNotifications = $notifications->first()->ToArray();
			foreach ( $userIdArray as $userId ) {
				$data['user_id']				=	$userId;
				$data['description']			=	$description;
				$data['unique_group_id']		=	$updatedNotifications['unique_group_id'];
				$data['status']					=	1;
				$data['notification_type']		=	$updatedNotifications['notification_type'];
				$data['notification_group_id']	=	$updatedNotifications['notification_group_id'];
				$data['created_by']				=	$updatedNotifications['created_by'];
				$results = $this->notificationObj->saveRecord($data);
			}
		} */
		$response['success'] = true;
        $response['message'] = 'Notification Updated Successfully';
        return response()->json($response);
	}

	public function getDataForViewModel(Request $request, $unique_group_id) {
        $data = $request->all();
        $notificationScheduled	=	$this->notificationObj->getDataByUniqueGroupId($unique_group_id, 1 );
        $notificationSents		=	$this->notificationObj->getDataByUniqueGroupId($unique_group_id, 0 );
        $notificationViews		=	$this->notificationObj->getDataByUniqueGroupId($unique_group_id, 2 );
        $notificationFailed		=	$this->notificationObj->getDataByUniqueGroupId($unique_group_id, 3 );
		$allnotificationStatus	=	$this->notificationObj->getDataByUniqueGroupId($unique_group_id);
		$notificationStatus		=	$allnotificationStatus->first();
		$excludeUsersLists		=	$allnotificationStatus->pluck('user_id')->ToArray();
		$userDropDownList 		=	[];
		$isInsert 				= 	false;

		return view('admin.notification.details',compact('notificationScheduled', 'notificationSents', 'notificationViews','notificationFailed', 'notificationStatus', 'isInsert' ));
    }
	
	function sendNotification(Request $request) {
		$data = $request->all();
		$notification = $this->notificationObj->getDateById($data['id']);
		$response['status'] = false;
        $response['message'] = 'Issue in sending notification';
        if(!empty($notification['notification_id']) && $notification['notification_id'] > 0) {
            $userid 		=	$notification['user_id'];
            $description 	=	$notification['description'];
			$userdata		=	$this->userObj->getDateById( $userid );
			
			if( isset($userdata['fcm_token']) && !empty($userdata['fcm_token']) && !empty($description) ) {
				$responseData = array();
				$userapptype 	= 	strtolower( $userdata['device_type'] );	
				if( $userapptype == 'ios' ) {
					$responseData = $this->notificationControllerObj->SendNotificationToIosDevice($userdata['fcm_token'], $description, $notification['notification_id']);
				} else if( $userapptype == 'android' ) {
					$responseData = $this->notificationControllerObj->SendNotificationToAndroidDevice($userdata['fcm_token'], $description, $notification['notification_id'] );
				}
				$notification->status = 3;
				if( isset($responseData['success']) && $responseData['success']==1 ) {
					$response['status'] = true;
					$response['message'] = 'Notification sent successfully.';
					$notification->status = 0;
				}
				$notification->save();
			} else {
                $response['message'] = 'fcm token is empty.';
            }
        }
        return response()->json($response);
	}
}
