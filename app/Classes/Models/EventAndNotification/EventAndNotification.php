<?php

namespace App\Classes\Models\EventAndNotification;

use App\Classes\Common\Common;
use App\Classes\Models\BaseModel;
use App\Classes\Helpers\EventAndNotification\Helper;
use App\Classes\Models\User\User;

class EventAndNotification extends BaseModel
{
    protected $table = 'ka_event_and_notification';
    protected $primaryKey = 'event_and_notification_id';
    protected $entity = 'ka_event_and_notification';
    protected $searchableColumns = ['title'];
    protected $fillable = ['title',
                           'event_date',
                           'start_time',
                           'end_time',
                           'photo',
                           'description',
                           'sender_id',
                           'status',
                           'created_type',
                           'notification_type',];
    protected $_helper;

    public function __construct( array $attributes = [] )
    {
        $this->bootIfNotBooted();
        $this->syncOriginal();
        $this->fill( $attributes );
        $this->_helper = new Helper();
    }

    public function sender()
    {
        return $this->belongsTo( User::class, 'sender_id', 'user_id' );
    }

    public function setEventDateAttribute( $value )
    {
        $this->attributes['event_date'] = ! empty( $value ) ? date( "Y-m-d", strtotime( $value ) ) : null;
    }

    public function getTypeStringAttribute()
    {
        if ( ! empty( $this->type ) && $this->type > 0 ) {

            return $this->_helper->getTypeById($this->type);
        }
        return "";
    }
    public function getNotificationTypeStringAttribute()
    {
        if ( ! empty( $this->notification_type ) && $this->notification_type > 0 ) {
            return $this->_helper->getNotificationTypeById($this->notification_type);
        }
        return "";
    }

    public function getStartTimeTwelveFormatAttribute()
    {
        if ( ! empty( $this->start_time ) ) {
            return date( "h:i A", strtotime( $this->start_time ) );
        }
        return "";
    }

    public function getEndTimeTwelveFormatAttribute()
    {
        if ( ! empty( $this->end_time ) ) {
            return date( "h:i A", strtotime( $this->end_time ) );
        }
        return "";
    }

    public function getEventDatePickerFormatAttribute()
    {
        if ( ! empty( $this->event_date ) ) {
            return date( "m/d/Y", strtotime( $this->event_date ) );
        }
        return "";
    }

    public function addEventAndNotificationIdFilter( $eventAndNotificationId = 0 )
    {
        if ( ! empty( $eventAndNotificationId ) && $eventAndNotificationId > 0 ) {
            $tableName = $this->getTableName();
            $this->queryBuilder->where( $tableName . '.event_and_notification_id', '=', $eventAndNotificationId );
        }
        return $this;
    }

    public function getDateById( $eventAndNotificationId )
    {
        $return = $this->setSelect()
                       ->addEventAndNotificationIdFilter( $eventAndNotificationId )
                       ->get()
                       ->first();
        return $return;
    }

    public function addSenderIdFilter( $senderId = 0 )
    {
        if ( ! empty( $senderId ) && $senderId > 0 ) {
            $tableName = $this->getTableName();
            $this->queryBuilder->where( $tableName . '.sender_id', '=', $senderId );
        }
        return $this;
    }

    public function addEventDateFilter( $startDate = '', $endDate = '' )
    {
        $tableName = $this->getTableName();
        if ( ! empty( $startDate ) ) {
            $startDate = date( "Y-m-d", strtotime( $startDate ) );
            $this->queryBuilder->whereDate( $tableName . '.event_date', '>=', "$startDate" );
        }

        if ( ! empty( $endDate ) ) {
            $endDate = date( "Y-m-d", strtotime( $endDate ) );
            $this->queryBuilder->whereDate( $tableName . '.event_date', '<=', "$endDate" );
        }

        return $this;
    }

    public function getList( $searchHelper )
    {
        $this->reset();
        $perPage = ($searchHelper->_perPage == 0) ? $this->_helper->getConfigPerPageRecord() : $searchHelper->_perPage;

        $search = ( ! empty( $searchHelper->_filter['search'] )) ? $searchHelper->_filter['search'] : '';
        $eventStartDate = ( ! empty( $searchHelper->_filter['event_start_date'] )) ? $searchHelper->_filter['event_start_date'] : '';
        $eventEndDate = ( ! empty( $searchHelper->_filter['event_end_date'] )) ? $searchHelper->_filter['event_end_date'] : '';
        $senderId = ( ! empty( $searchHelper->_filter['sender_id'] )) ? $searchHelper->_filter['sender_id'] : 0;

        $list = $this->setSelect()
                     ->addSearch( $search )
                     ->addSenderIdFilter( $senderId )
                     ->addEventDateFilter( $eventStartDate, $eventEndDate )
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
        $eventStartDate = ( ! empty( $searchHelper->_filter['event_start_date'] )) ? $searchHelper->_filter['event_start_date'] : '';
        $eventEndDate = ( ! empty( $searchHelper->_filter['event_end_date'] )) ? $searchHelper->_filter['event_end_date'] : '';
        $senderId = ( ! empty( $searchHelper->_filter['sender_id'] )) ? $searchHelper->_filter['sender_id'] : 0;

        $count = $this->setSelect()
                      ->addSearch( $search )
                      ->addSenderIdFilter( $senderId )
                      ->addEventDateFilter( $eventStartDate, $eventEndDate )
                      ->addSortOrder( $searchHelper->_sortOrder )
                      ->addGroupBy( $searchHelper->_groupBy )
                      ->get()
                      ->count();

        return $count;
    }

    public function saveRecord( $data )
    {
        $rules = ['title'       => ['required'],
                  'event_date'  => ['required'],
                  'start_time'  => ['required'],
                  'end_time'    => ['required'],
                  'description' => ['required'],
                  'photo'       => ['mimes:jpeg,jpg,png,gif']];

        $eventAndNotificationId = 0;
        if ( isset( $data['event_and_notification_id'] ) && $data['event_and_notification_id'] != '' && $data['event_and_notification_id'] > 0 ) {
            $eventAndNotificationId = $data['event_and_notification_id'];
        }
        $validationResult = $this->validateData( $rules, $data );

        if ( $validationResult['success'] == false ) {
            $result['success'] = false;
            $result['message'] = $validationResult['message'];
            $result['event_and_notification_id'] = 0;
            return $result;
        }

        if ( ! empty( $data['photo'] ) ) {
            $filePath = $this->_helper->getImagePath();
            $data['photo'] = Common::fileUpload( $filePath, $data['photo'] );
        }

        if ( $eventAndNotificationId > 0 ) {
            $eventAndNotification = self::findOrFail( $data['event_and_notification_id'] );

            /* Delete Image */
            if ( ! empty( $data['photo'] ) ) {
                Common::deleteFile( $eventAndNotification->photo );
            }

            $eventAndNotification->update( $data );
            $result['event_and_notification_id'] = $eventAndNotification->event_and_notification_id;

        } else {
            $eventAndNotification = self::create( $data );
            $result['event_and_notification_id'] = $eventAndNotification->event_and_notification_id;
        }
        $result['success'] = true;
        $result['message'] = "Event & Notice saved successfully.";
        return $result;
    }
}
