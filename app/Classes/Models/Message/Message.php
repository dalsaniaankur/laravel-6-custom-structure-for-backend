<?php

namespace App\Classes\Models\Message;

use App\Classes\Common\Common;
use App\Classes\Models\BaseModel;
use App\Classes\Helpers\Message\Helper;
use App\Classes\Models\User\User;

class Message extends BaseModel
{
    protected $table = 'ka_message';
    protected $primaryKey = 'message_id';
    protected $entity = 'message';
    protected $searchableColumns = [];
    protected $fillable = ['sender_id',
                           'receiver_id',
                           'message',
                           'attachment',
                           'status'];
    protected $_helper;
    protected $userObj;

    public function __construct( array $attributes = [] )
    {
        $this->bootIfNotBooted();
        $this->syncOriginal();
        $this->fill( $attributes );
        $this->userObj = new User();
        $this->_helper = new Helper();
    }

    public function sender()
    {
        return $this->belongsTo( User::class, 'sender_id', 'user_id' );
    }

    public function receiver()
    {
        return $this->belongsTo( User::class, 'receiver_id', 'user_id' );
    }

    public function addMessageIdFilter( $messageId = 0 )
    {
        if ( ! empty( $messageId ) && $messageId > 0 ) {
            $tableName = $this->getTableName();
            $this->queryBuilder->where( $tableName . '.message_id', '=', $messageId );
        }
        return $this;
    }

    public function addReceiverIdFilter( $receiverId = 0 )
    {
        if ( ! empty( $receiverId ) && $receiverId > 0 ) {
            $tableName = $this->getTableName();
            $this->queryBuilder->where( $tableName . '.receiver_id', '=', $receiverId );
        }
        return $this;
    }

    public function addSenderIdFilter( $senderId = 0 )
    {
        if ( ! empty( $senderId ) && $senderId > 0 ) {
            $tableName = $this->getTableName();
            $this->queryBuilder->where( $tableName . '.sender_id', '=', $senderId );
        }
        return $this;
    }

    public function getDateById( $messageId )
    {
        $return = $this->setSelect()
                       ->addMessageIdFilter( $messageId )
                       ->get()
                       ->first();
        return $return;
    }

    public function getIsUnReadCount( $senderId, $receiverId )
    {
        $this->reset();
        $count = $this->setSelect()
                      ->addSenderIdFilter( $senderId )
                      ->addReceiverIdFilter( $receiverId )
                      ->addStatusFilter( 1 )
                      ->get()
                      ->count();

        return $count;
    }

    public function getLastMessage( $senderId, $receiverId )
    {
        $result = $this->setSelect()
                       ->addSenderIdFilter( $senderId )
                       ->addReceiverIdFilter( $receiverId )
                       ->addSortOrder( ['message_id' => 'DESC'] )
                       ->get()
                       ->first();
        return $result;
    }

    public function getLastMessageForReceiver( $receiverId )
    {
        $result = $this->setSelect()
                       ->addReceiverIdFilter( $receiverId )
                       ->addSortOrder( ['message_id' => 'DESC'] )
                       ->get()
                       ->first();
        return $result;
    }

    public function addCreatedDateFilter( $startDate = '', $endDate = '' )
    {
        $tableName = $this->getTableName();
        if ( ! empty( $startDate ) ) {
            $startDate = date( "Y-m-d", strtotime( $startDate ) );
            $this->queryBuilder->whereDate( $tableName . '.created_at', '>=', "$startDate" );
        }

        if ( ! empty( $endDate ) ) {
            $endDate = date( "Y-m-d", strtotime( $endDate ) );
            $this->queryBuilder->whereDate( $tableName . '.created_at', '<=', "$endDate" );
        }

        return $this;
    }

    public function addSenderIdWithInFilter( $senderIdWithOrIn = [] )
    {
        if ( ! empty( $senderIdWithOrIn ) ) {
            $tableName = $this->getTableName();
            $this->queryBuilder->whereIn( $tableName . '.sender_id', $senderIdWithOrIn );
        }
        return $this;
    }

    public function addReceiverIdWithInFilter( $receiverIdWithOrIn = [] )
    {
        if ( ! empty( $receiverIdWithOrIn ) ) {
            $tableName = $this->getTableName();
            $this->queryBuilder->whereIn( $tableName . '.receiver_id', $receiverIdWithOrIn );
        }
        return $this;
    }

    public function addReceiverRoleIdFilter( $receiverRoleId = -1 )
    {
        if ( ! empty( $receiverRoleId ) && $receiverRoleId > 0 ) {
            $this->queryBuilder->where( 'receiver.role_id', '=', $receiverRoleId );
        }
        return $this;
    }

    public function addSenderRoleIdFilter( $senderRoleId = -1 )
    {
        if ( ! empty( $senderRoleId ) && $senderRoleId > 0 ) {
            $this->queryBuilder->where( 'sender.role_id', '=', $senderRoleId );
        }
        return $this;
    }

    public function joinReceiver( $searchable = false )
    {
        $receiverTableName = $this->userObj->getTable() . ' as receiver';
        $searchableColumns = $this->userObj->getSearchableColumns();
        $this->joinTables[] = ['table'             => $receiverTableName,
                               'searchable'        => $searchable,
                               'searchableColumns' => $searchableColumns];
        $this->queryBuilder->leftJoin( $receiverTableName, function ( $join ) use ( $receiverTableName ) {
            $join->on( $this->table . '.receiver_id', '=', 'receiver.user_id' );

        } );
        return $this;
    }


    public function joinSender( $searchable = false )
    {
        $senderTableName = $this->userObj->getTable() . ' as sender';
        $searchableColumns = $this->userObj->getSearchableColumns();
        $this->joinTables[] = ['table'             => $senderTableName,
                               'searchable'        => $searchable,
                               'searchableColumns' => $searchableColumns];
        $this->queryBuilder->leftJoin( $senderTableName, function ( $join ) use ( $senderTableName ) {
            $join->on( $this->table . '.sender_id', '=', 'sender.user_id' );

        } );
        return $this;
    }

    public function getList( $searchHelper )
    {
        $this->reset();
        $perPage = ($searchHelper->_perPage == 0) ? $this->_helper->getConfigPerPageRecord() : $searchHelper->_perPage;

        $search = ( ! empty( $searchHelper->_filter['search'] )) ? $searchHelper->_filter['search'] : '';
        $signUpStartDate = ( ! empty( $searchHelper->_filter['created_start_date'] )) ? $searchHelper->_filter['created_start_date'] : '';
        $signUpEndDate = ( ! empty( $searchHelper->_filter['created_end_date'] )) ? $searchHelper->_filter['created_end_date'] : '';
        $receiverId = ( ! empty( $searchHelper->_filter['receiver_id'] )) ? $searchHelper->_filter['receiver_id'] : 0;
        $senderId = ( ! empty( $searchHelper->_filter['sender_id'] )) ? $searchHelper->_filter['sender_id'] : 0;
        $senderIdWithIn = ( ! empty( $searchHelper->_filter['sender_id_with_in'] )) ? $searchHelper->_filter['sender_id_with_in'] : [];
        $receiverIdWithIn = ( ! empty( $searchHelper->_filter['receiver_id_with_in'] )) ? $searchHelper->_filter['receiver_id_with_in'] : [];
        $receiverRoleId = ( ! empty( $searchHelper->_filter['receiver_role_id'] )) ? $searchHelper->_filter['receiver_role_id'] : -1;
        $senderRoleId = ( ! empty( $searchHelper->_filter['sender_role_id'] )) ? $searchHelper->_filter['sender_role_id'] : -1;

        $list = $this->setSelect()
                     ->joinReceiver()
                     ->joinSender()
                     ->addSearch( $search )
                     ->addCreatedDateFilter( $signUpStartDate, $signUpEndDate )
                     ->addReceiverRoleIdFilter( $receiverRoleId )
                     ->addSenderRoleIdFilter( $senderRoleId )
                     ->addReceiverIdFilter( $receiverId )
                     ->addSenderIdFilter( $senderId )
                     ->addSenderIdWithInFilter( $senderIdWithIn )
                     ->addReceiverIdWithInFilter( $receiverIdWithIn )
                     ->addSortOrder( $searchHelper->_sortOrder )
                     ->addPaging( $searchHelper->_page, $perPage )
                     ->addGroupBy( $searchHelper->_groupBy )
                     ->get( $searchHelper->_selectColumns );

        return $list;
    }

    public function getListTotalCount( $searchHelper )
    {
        $this->reset();

        $search = ( ! empty( $searchHelper->_filter['search'] )) ? $searchHelper->_filter['search'] : '';
        $signUpStartDate = ( ! empty( $searchHelper->_filter['created_start_date'] )) ? $searchHelper->_filter['created_start_date'] : '';
        $signUpEndDate = ( ! empty( $searchHelper->_filter['created_end_date'] )) ? $searchHelper->_filter['created_end_date'] : '';
        $receiverId = ( ! empty( $searchHelper->_filter['receiver_id'] )) ? $searchHelper->_filter['receiver_id'] : 0;
        $senderId = ( ! empty( $searchHelper->_filter['sender_id'] )) ? $searchHelper->_filter['sender_id'] : 0;
        $senderIdWithIn = ( ! empty( $searchHelper->_filter['sender_id_with_in'] )) ? $searchHelper->_filter['sender_id_with_in'] : [];
        $receiverIdWithIn = ( ! empty( $searchHelper->_filter['receiver_id_with_in'] )) ? $searchHelper->_filter['receiver_id_with_in'] : [];
        $receiverRoleId = ( ! empty( $searchHelper->_filter['receiver_role_id'] )) ? $searchHelper->_filter['receiver_role_id'] : -1;
        $senderRoleId = ( ! empty( $searchHelper->_filter['sender_role_id'] )) ? $searchHelper->_filter['sender_role_id'] : -1;

        $count = $this->setSelect()
                      ->joinReceiver()
                      ->joinSender()
                      ->addSearch( $search )
                      ->addCreatedDateFilter( $signUpStartDate, $signUpEndDate )
                      ->addReceiverRoleIdFilter( $receiverRoleId )
                      ->addSenderRoleIdFilter( $senderRoleId )
                      ->addReceiverIdFilter( $receiverId )
                      ->addSenderIdFilter( $senderId )
                      ->addSenderIdWithInFilter( $senderIdWithIn )
                      ->addReceiverIdWithInFilter( $receiverIdWithIn )
                      ->addSortOrder( $searchHelper->_sortOrder )
                      ->addGroupBy( $searchHelper->_groupBy )
                      ->get()
                      ->count();

        return $count;
    }

    public function saveRecord( $data )
    {
        $tableName = $this->getTableName();
        $rules = ['sender_id'   => ['required'],
                  'receiver_id' => ['required'],
                  'message'     => ['required_without:attachment'],
                  'attachment'  => ['required_without:message']];

        $messageId = 0;
        if ( isset( $data['message_id'] ) && $data['message_id'] != '' && $data['message_id'] > 0 ) {
            $messageId = $data['message_id'];
        }
        $validationResult = $this->validateData( $rules, $data );

        if ( $validationResult['success'] == false ) {
            $result['success'] = false;
            $result['message'] = $validationResult['message'];
            $result['message_id'] = 0;
            return $result;
        }

        if ( ! empty( $data['attachment'] ) ) {
            $filePath = $this->_helper->getAttachmentPath();
            $data['attachment'] = Common::fileUpload( $filePath, $data['attachment'] );
        }

        if ( $messageId > 0 ) {
            $message = self::findOrFail( $data['message_id'] );

            /* Delete Image */
            if ( ! empty( $data['attachment'] ) ) {
                Common::deleteFile( $message->attachment );
            }

            $message->update( $data );
            $result['message_id'] = $message->message_id;;

        } else {
            $message = self::create( $data );
            $result['message_id'] = $message->message_id;;
        }
        $result['success'] = true;
        $result['message'] = "Message saved successfully.";
        return $result;
    }

    public function convertDataToHtmlForMessage( $messages, $receiverId, $senderName)
    {
        $htmlContent = '';
        $htmlContent .= '<div class="col-md-12">';
        $htmlContent .= '<h4 class="user-name">' . $senderName . '</h4>';
        if ( $messages->count() > 0 ) {
            foreach ( $messages as $messageKey => $message ) {

                /* Update read status */
                if($receiverId == $message->receiver_id) {
                    $message->status = 2;
                    $message->save();
                }

                $messageTypeClass = ($receiverId == $message->receiver_id) ? "received-message" : "sent-message";
                $htmlContent .= '<div class="' . $messageTypeClass . '">';
                if ( ! empty( $message->message ) && ! empty( $message->attachment ) ) {

                    $htmlContent .= '<div class="title_images">
                                        <div class="img_layout">
                                            <h4 class="message-block">' . nl2br($message->message) . '</h4>
                                            <img src="' . url( $message->attachment ) . '"/>
                                        </div>
                                        <span class="time_date">' . (\DateFacades::dateFormat( $message->created_at, 'format-7' )) . '</span>
                                    </div>';

                } else if ( ! empty( $message->message ) ) {

                    $htmlContent .= '<div class="texts">
                            <div class="message-block">' . nl2br($message->message) . '</div>
                            <span class="time_date">' . (\DateFacades::dateFormat( $message->created_at, 'format-7' )) . '</span>
                        </div>';

                } else {
                    $htmlContent .= '<div class="images">
                    <img src="' . url( $message->attachment ) . '"/>
                        <span class="time_date">' . (\DateFacades::dateFormat( $message->created_at, 'format-7' )) . '</span>
                    </div>';
                }
                $htmlContent .= '</div>';
            }

        } else {
            $htmlContent .= '<div>' . trans( 'admin.qa_no_entries_in_table' ) . '</div>';
        }
        $htmlContent .= '</div>';
        return $htmlContent;
    }
}
