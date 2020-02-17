<?php

namespace App\Http\Controllers\Admin\Message;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Classes\Models\User\User;
use App\Classes\Helpers\User\Helper;
use App\Classes\Common\Common;
use App\Classes\Helpers\SearchHelper;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use App\Classes\Helpers\Roles\Helper as HelperRoles;
use App\Classes\Models\Message\Message;

class IndexController extends Controller
{
    protected $userObj;
    protected $messageObj;
    protected $_helper;
    protected $_helperRoles;

    public function __construct()
    {
        $this->userObj = new User();
        $this->messageObj = new Message();
        $this->_helper = new Helper();
        $this->_helperRoles = new HelperRoles();
    }

    public function index( Request $request )
    {
        $data = $request->all();
        $page = ! empty( $data['page'] ) ? $data['page'] : 0;
        $sortedBy = ! empty( $request->get( 'sorted_by' ) ) ? $request->get( 'sorted_by' ) : 'created_at';
        $sortedOrder = ! empty( $request->get( 'sorted_order' ) ) ? $request->get( 'sorted_order' ) : 'DESC';
        $createdStartDate = isset( $data['start_date'] ) ? $data['start_date'] : '';
        $createdEndDate = isset( $data['end_date'] ) ? $data['end_date'] : '';
        $roleId = ! empty( $data['role_id'] ) ? $data['role_id'] : '';

        /* Sent Message */
        $pageForSent = ! empty( $data['page_for_sent'] ) ? $data['page_for_sent'] : 0;
        $sortedByForSent = ! empty( $request->get( 'sorted_by_for_sent' ) ) ? $request->get( 'sorted_by_for_sent' ) : 'created_at';
        $sortedOrderForSent = ! empty( $request->get( 'sorted_order_for_sent' ) ) ? $request->get( 'sorted_order_for_sent' ) : 'DESC';

        $currentTab = ! empty( $data['current_tab'] ) ? $data['current_tab'] : 'received';
        $userId = '';
        if ( ! empty( $data['user_id'] ) && $roleId > 0 ) {
            $userId = $data['user_id'];
        }

        $perPage = $this->_helper->getConfigPerPageRecord();
        $recordStart = common::getRecordStart( $page, $perPage );
        $receiverId = Auth::guard( 'admin' )->user()->user_id;

        $filter = ['sender_id'          => $userId,
                   'receiver_id'        => $receiverId,
                   'sender_role_id'     => $roleId,
                   'created_start_date' => $createdStartDate,
                   'created_end_date'   => $createdEndDate,];

        $searchHelper = new SearchHelper( $page, $perPage, $selectColumns = ['*'], $filter, [$sortedBy => $sortedOrder], ['sender_id'] );
        $messages = $this->messageObj->getList( $searchHelper );
        $totalRecordCount = $this->messageObj->getListTotalCount( $searchHelper );
        $paginationBasePath = Common::getPaginationBasePath( ['user_id'               => $userId,
                                                              'role_id'               => $roleId,
                                                              'start_date'            => $createdStartDate,
                                                              'end_date'              => $createdEndDate,
                                                              'page_for_sent'         => $pageForSent,
                                                              'current_tab'         => 'received',
                                                              /*'sorted_by'             => $sortedBy,
                                                              'sorted_order'          => $sortedOrder,
                                                              'sorted_by_for_sent'    => $sortedByForSent,
                                                              'sorted_order_for_sent' => $sortedOrderForSent,*/
                                                                 ] );
        $paging = $this->messageObj->preparePagination( $totalRecordCount, $paginationBasePath, $searchHelper );
        $userDropDown = ['' => 'Users'];
        if ( $roleId > 0 ) {
            $schoolRoleId = $this->_helperRoles->getSchoolRoleId();
            if ( $roleId == $schoolRoleId ) {
                $userDropDown = $this->userObj->getSchoolDropDown( 'Schools', $status = 1, $prependKey = 0 );
            } else {
                $userDropDown = $this->userObj->getDropDown( $prepend = 'Users', $roleId, -1, 1, 1 );
            }
        }

        /* Sent Message */
        $recordStartForSent = common::getRecordStart( $pageForSent, $perPage );
        $filter = ['sender_id'          => $receiverId,
                   'receiver_id'        => $userId,
                   'receiver_role_id'     => $roleId,
                   'created_start_date' => $createdStartDate,
                   'created_end_date'   => $createdEndDate,];

        $searchHelperForSent = new SearchHelper( $pageForSent, $perPage, $selectColumns = ['*'], $filter, [$sortedByForSent => $sortedOrderForSent], ['receiver_id'] );

        $messagesForSent = $this->messageObj->getList( $searchHelperForSent );
        $totalRecordCountSent = $this->messageObj->getListTotalCount( $searchHelperForSent );
        $paginationBasePathSent = Common::getPaginationBasePath( ['user_id'               => $userId,
                                                                  'role_id'               => $roleId,
                                                                  'start_date'            => $createdStartDate,
                                                                  'end_date'              => $createdEndDate,
                                                                  'page'                  => $page,
                                                                  'current_tab'         => 'sent',
                                                                  /*'sorted_by'             => $sortedBy,
                                                                  'sorted_order'          => $sortedOrder,
                                                                  'sorted_by_for_sent'    => $sortedByForSent,
                                                                  'sorted_order_for_sent' => $sortedOrderForSent,*/
                                                                     ] );
        $pagingForSent = $this->messageObj->preparePagination( $totalRecordCountSent, $paginationBasePathSent, $searchHelperForSent, 'page_for_sent' );
        return view( 'admin.message.index', compact( 'sortedBy', 'sortedOrder', 'recordStart', 'messages', 'paging', 'totalRecordCount', 'createdStartDate', 'createdEndDate', 'roleId', 'userDropDown', 'userId', 'currentTab', 'messagesForSent', 'totalRecordCountSent', 'pagingForSent', 'recordStartForSent' ) );
    }

    public function delete( Request $request )
    {
        $data = $request->all();
        if ( empty( $data['sender_id'] ) || empty( $data['receiver_id'] ) ) {
            return abort( 404 );
        }

        $senderId = $data['sender_id'];
        $receiverId = $data['receiver_id'];
        $filter = ['sender_id'   => $senderId,
                   'receiver_id' => $receiverId];

        $searchHelper = new SearchHelper( -1, -1, $selectColumns = ['message_id'], $filter );
        $messages = $this->messageObj->getList( $searchHelper );

        foreach ( $messages as $messageKey => $message ) {
            $this->messageObj->removed( $message->message_id );
        }
        $request->session()
                ->flash( 'success', 'Message deleted successfully.' );
        return Redirect::back();
    }

    public function saveAjax( Request $request )
    {
        $data = $request->all();
        $data['status'] = 1;
        $data['sender_id'] = Auth::guard( 'admin' )->user()->user_id;

        $response = [];
        $response['success'] = false;
        $response['message'] = "Message saved successfully.";

        $receiverIdArray = $data['receiver_id'];
        if ( empty( $receiverIdArray ) ) {
            $response['message'] = "The receiver id field is required.";
            return response()->json( $response );
        }

        foreach ( $receiverIdArray as $receiverIdKey => $receiverId ) {
            $data['receiver_id'] = $receiverId;
            $results = $this->messageObj->saveRecord( $data );
            if ( ! empty( $results['message_id'] ) && $results['message_id'] > 0 ) {

                    /* Mail send */
                    $messageId = $results['message_id'];
                    $messageData = $this->messageObj->getDateById($messageId);
                    $message = $messageData->message;
                    $attachment = $messageData->attachment;
                    $senderName = Auth::guard( 'admin' )->user()->name;
                    $receiver = $this->userObj->getDateById($receiverId);

                    $fromName = "Kidrend";
                    $toName = $receiver->name;;
                    $toEmail = $receiver->email;

                    /* Sender Mail */
                    $subject = "Message from the ".$senderName;
                    $htmlContent = \View::make( 'admin.emails.message.message', ['name'       => $toName,
                                                                                 'senderName' => $senderName,
                                                                                 'subject'    => $subject,
                                                                                 'attachment'    => $attachment,
                                                                                 'message'    => $message] )
                                        ->render();
                    Common::sendMailByMailJet( $htmlContent, $fromName, '', $subject, $toName, $toEmail );

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
        $response['success'] = true;
        $response['message'] = "Message saved successfully.";
        return response()->json( $response );
    }

    public function getDataForEditModel( Request $request )
    {
        $data = $request->all();
        $senderId = $data['sender_id'];
        $receiverId = $data['receiver_id'];
        $senderUser = $this->userObj->getDateById( $senderId );
        if ( $senderUser->role_id == $this->_helperRoles->getSchoolRoleId() ) {
            $senderName = $senderUser->school_name;
        } else {
            $senderName = $senderUser->name;
        }
        $filter = ['sender_id_with_in'   => [$senderId,
                                             $receiverId],
                   'receiver_id_with_in' => [$senderId,
                                             $receiverId]];

        $searchHelper = new SearchHelper( -1, -1, $selectColumns = ['*'], $filter, ['message_id' => 'ASC'] );
        $messages = $this->messageObj->getList( $searchHelper );
        $messageHtml = $this->messageObj->convertDataToHtmlForMessage( $messages, $receiverId, $senderName );
        $response['success'] = true;
        $response['message'] = '';
        $response['data']['message'] = $messageHtml;
        $response['data']['sender_id'] = $senderId;
        $response['data']['receiver_id'] = $receiverId;
        return response()->json( $response );
    }
}
