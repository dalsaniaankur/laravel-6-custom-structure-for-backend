<?php

namespace App\Http\Controllers;

use App\Classes\Models\User\User;
use Illuminate\Http\Request;
use App\Classes\Common\Common;
use App\Classes\Helpers\Notification\Helper;
use App\Classes\Helpers\SearchHelper;
use App\Classes\Models\Notification\Notification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class NotificationController extends Controller
{
    protected $_helper;
    protected $userObj;    
    protected $notificationObj;    

    public function __construct()
    {
        $this->_helper = new Helper();
        $this->userObj = new User();        
        $this->notificationObj = new Notification();        
    }

    public function SendNotificationToAndroidDevice( $token, $message, $id = '0' )
    {
        if ( ! empty( $token ) && ! empty( $message ) ) {
            $appServerKey = $this->_helper->getAppServerKey();
            $notification = ['body'  => $message,
                             'title' => 'Kidrend',                             
                             'id'    => $id,
							 'type'  => 'directmsg',
                             'sound' => 'default',];
            $arrayToSend = ['to'       => $token,
                            'data'     => $notification,
                            'priority' => 'high',];


            $json = json_encode( $arrayToSend );
            $headers = [];
            $headers[] = 'Content-Type: application/json';
            $headers[] = 'Authorization: key=' . $appServerKey;
            $ch = curl_init();
            curl_setopt( $ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
            curl_setopt( $ch, CURLOPT_POST, true );
            curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers );
            curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
            curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
            curl_setopt( $ch, CURLOPT_POSTFIELDS, $json );
            $notifyResponse = curl_exec( $ch ); //Send the request
            $responseData = json_decode( $notifyResponse, true );
            $response = [];
            if ( isset( $responseData['success'] ) && $responseData['success'] == 1 ) {
                $response['success'] = true;
                $response['message'] = 'Notification Send Successfully.';
            } else {
                $response['success'] = false;
                $response['message'] = isset( $responseData[0]['error'] ) ? $responseData[0]['error'] : 'Issue in sending Successfully.';
            }
            curl_close( $ch );
            return $response;
        }
    }

    public function SendNotificationToIosDevice( $token, $message, $id = 0 )
    {
        if ( ! empty( $token ) && ! empty( $message ) ) {
			$appServerKey = $this->_helper->getAppServerKey();
            $notification = ['body'  => $message,
                             'title' => 'Kidrend',                            
                             'sound' => 'default',
							 'id'    => $id,
							 'type'  => 'directmsg',
                             'badge' => '1'];
            $arrayToSend = ['to'                => $token,
                            'notification'      => $notification,
                            'priority'          => 'high',
                            'content_available' => true];
            $json = json_encode( $arrayToSend );

            $headers = [];
            $headers[] = 'Content-Type: application/json';
            $headers[] = 'Authorization: key=' . $appServerKey;
            $ch = curl_init();
            curl_setopt( $ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
            curl_setopt( $ch, CURLOPT_POST, true );
            curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers );
            curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
            curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
            curl_setopt( $ch, CURLOPT_POSTFIELDS, $json );
            $notifyResponse = curl_exec( $ch ); //Send the request
            $responseData = json_decode( $notifyResponse, true );

            $response = [];
            if ( isset( $responseData['success'] ) && $responseData['success'] == 1 ) {
                $response['success'] = true;
                $response['message'] = 'Notification Send Successfully.';
            } else {
                $response['success'] = false;
                $response['message'] = isset( $responseData[0]['error'] ) ? $responseData[0]['error'] : 'Issue in sending Successfully.';
            }
            curl_close( $ch );
            return $response;
        }
    }
	
	public function sendScheduleNotification( Request $request )
    {
        $cronLog = new Logger( 'Cron Run Time' );
        $cronLog->pushHandler( new StreamHandler( storage_path( 'logs/cron_run_time.log' ) ), Logger::DEBUG );
        $cronLog->debug( 'Start Cron Run America/New_York Time', [\DateFacades::getCurrentDateTime( 'format-7' )] );
        $cronLog->debug( 'Start Cron Run Server Time', [\DateFacades::getCurrentDateTimeWithRemoveHours( 'format-1', 4 )] );

        $displayEndDateTime = \DateFacades::getCurrentDateTimeWithRemoveHours( 'format-1', 3 );
        $notifications = DB::select( "SELECT n.*, u.`fcm_token`, u.`device_type` from `ka_notification` as n
                  JOIN `ka_users` as u ON n.`user_id` = u.`user_id`   
                  WHERE n.`status` = 1 AND CONVERT_TZ(n.`display_date`,'+00:00','-04:00') <= '$displayEndDateTime' ORDER BY n.`notification_id` ASC" );

        foreach ( $notifications as $notificationKey => $notification ) {

            $cronLog->debug( 'Cron Run For', ["notification_id: ".$notification->notification_id] );

            if ( ! empty( $notification->fcm_token ) ) {
                $message = $notification->description;
                $id = $notification->notification_id;
                $fcmToken = $notification->fcm_token;
                $appType = isset( $notification->device_type ) ? strtolower($notification->device_type) : '';
                $sendNotificationResponse = [];
                if ( $appType == 'android' ) {
                    $sendNotificationResponse = $this->SendNotificationToAndroidDevice( $fcmToken, $message, 'directmsg', $id );
                } else if ( $appType == 'ios' ) {
                    $sendNotificationResponse = $this->SendNotificationToIosDevice( $fcmToken, $message, 'directmsg', $id );
                }
                if ( ! empty( $sendNotificationResponse['success'] ) && $sendNotificationResponse['success'] == 1 ) {
                    DB::table( 'ka_notification' )
                      ->where( 'notification_id', $notification->notification_id )
                      ->update( ['status' => 0] );
                } else {
                    DB::table( 'ka_notification' )
                      ->where( 'notification_id', $notification->notification_id )
                      ->update( ['status' => 3] );
                }
            }else{
                DB::table( 'ka_notification' )
                  ->where( 'notification_id', $notification->notification_id )
                  ->update( ['status' => 3] );
            }
        }
        $cronLog->debug( 'End Cron Run America/New_York Time', [\DateFacades::getCurrentDateTime( 'format-7' )] );
        $cronLog->debug( 'End Cron Run Server Time', [\DateFacades::getCurrentDateTimeWithRemoveHours( 'format-1', 4 )] );
        $cronLog->debug( '-------------------------------------------------', [] );
    }
}
