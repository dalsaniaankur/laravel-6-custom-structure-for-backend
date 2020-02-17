<?php

namespace App\Classes\Models\Notification;

use App\Classes\Common\Common;
use App\Classes\Models\BaseModel;
use App\Classes\Helpers\Notification\Helper;
use App\Classes\Models\User\User;

class Notification extends BaseModel
{
    protected $table = 'ka_notification';
    protected $primaryKey = 'notification_id';
    protected $entity = 'ka_notification';
    protected $searchableColumns = [];
    protected $fillable = ['unique_group_id',
                           'user_id',
                           'description',
                           'display_date',
                           'display_date',
                           'created_user_id',
                           'notification_type',
                           'status'];
    protected $_helper;
    protected $userObj;

    public function __construct( array $attributes = [] )
    {
        $this->bootIfNotBooted();
        $this->syncOriginal();
        $this->fill( $attributes );
        $this->_helper = new Helper();
        $this->userObj = new User();
    }

    public function user()
    {
        return $this->belongsTo( User::class, 'user_id', 'user_id' );
    }

    public function addNotificationIdFilter( $notificationId = 0 )
    {
        if ( ! empty( $notificationId ) && $notificationId > 0 ) {
            $tableName = $this->getTableName();
            $this->queryBuilder->where( $tableName . '.notification_id', '=', $notificationId );
        }
        return $this;
    }

    public function getDateById( $notificationId )
    {
        $return = $this->setSelect()
                       ->addNotificationIdFilter( $notificationId )
                       ->get()
                       ->first();
        return $return;
    }

    function addNotificationUniqueGroupIDFilter( $unique_group_id = 0 )
    {
        if ( ! empty( $unique_group_id ) ) {
            $tableName = $this->getTableName();
            $this->queryBuilder->where( $tableName . '.unique_group_id', '=', $unique_group_id );
        }
        return $this;
    }

    public function getDataByUniqueGroupId( $unique_group_id, $status = -1 )
    {

        $return = $this->setSelect()
                       ->addNotificationUniqueGroupIDFilter( $unique_group_id )
                       ->addStatusFilter('status' ,$status )
                       ->get();
        return $return;
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


    public function addCreatedUserIdFilter( $createdUserId )
    {

        if ( $createdUserId > 0 ) {
            $userTableName = $this->getTable();
            $this->queryBuilder->where( $userTableName . '.created_user_id', '=', $createdUserId );
        }
        return $this;
    }

    public function addUserIdFilter( $userId = -1 )
    {
        if ( ! empty( $userId ) && $userId > 0 ) {
            $tableName = $this->getTableName();
            $this->queryBuilder->where( $tableName . '.user_id', '=', $userId );
        }
        return $this;
    }

    public function addDisplayDateFilter( $startDate = '', $endDate = '' )
    {
        $tableName = $this->getTableName();
        if ( ! empty( $startDate ) ) {
            $startDate = date( "Y-m-d", strtotime( $startDate ) );
            $this->queryBuilder->whereDate( $tableName . '.display_date', '>=', "$startDate" );
        }

        if ( ! empty( $endDate ) ) {
            $endDate = date( "Y-m-d", strtotime( $endDate ) );
            $this->queryBuilder->whereDate( $tableName . '.display_date', '<=', "$endDate" );
        }

        return $this;
    }

    public function addDisplayDateAndTimeFilter( $startDate = '', $endDate = '' )
    {
        $tableName = $this->getTableName();
        if ( ! empty( $startDate ) ) {
            $startDate = date( "Y-m-d H:i:s ", strtotime( $startDate ) );
            $this->queryBuilder->where( $tableName . '.display_date', '>=', "$startDate" );
        }

        if ( ! empty( $endDate ) ) {
            $endDate = date( "Y-m-d H:i:s", strtotime( $endDate ) );
            $this->queryBuilder->where( $tableName . '.display_date', '<=', "$endDate" );
        }

        return $this;
    }

    public function joinUser( $searchable = false )
    {
        $userTableName = $this->userObj->getTable();
        $searchableColumns = $this->userObj->getSearchableColumns();

        $this->joinTables[] = ['table'             => $userTableName,
                               'searchable'        => $searchable,
                               'searchableColumns' => $searchableColumns];

        $this->queryBuilder->leftJoin( $userTableName, function ( $join ) use ( $userTableName ) {
            $join->on( $this->table . '.user_id', '=', $userTableName . '.user_id' );
        } );

        return $this;
    }

    public function addNotificationIdNotInFilter( $notificationIdNotIn )
    {

        if ( ! empty( $notificationIdNotIn ) && count( $notificationIdNotIn ) > 0 ) {
            $tableName = $this->getTableName();
            $this->queryBuilder->whereNotIn( $tableName . '.notification_id', $notificationIdNotIn );
        }
        return $this;
    }

    public function addUniqueGroupIdNotInFilter( $uniqueGroupIdNotIn )
    {

        if ( ! empty( $uniqueGroupIdNotIn ) && count( $uniqueGroupIdNotIn ) > 0 ) {
            $tableName = $this->getTableName();
            $this->queryBuilder->whereNotIn( $tableName . '.unique_group_id', $uniqueGroupIdNotIn );
        }
        return $this;
    }

	public function addStatusIdInFilter( $statusIdIn )
    {

        if ( ! empty( $statusIdIn ) && count( $statusIdIn ) > 0 ) {
            $tableName = $this->getTableName();
            $this->queryBuilder->whereIn( $tableName . '.status', $statusIdIn );
        }
        return $this;
    }


    public function getList( $searchHelper )
    {
        $this->reset();
        $perPage = ($searchHelper->_perPage == 0) ? $this->_helper->getConfigPerPageRecord() : $searchHelper->_perPage;

        $search = ( ! empty( $searchHelper->_filter['search'] )) ? $searchHelper->_filter['search'] : '';
        $createdUserId = ( ! empty( $searchHelper->_filter['created_user_id'] )) ? $searchHelper->_filter['created_user_id'] : 0;
        $userId = ( ! empty( $searchHelper->_filter['user_id'] )) ? $searchHelper->_filter['user_id'] : 0;
        $status = (isset( $searchHelper->_filter['status'] )) ? $searchHelper->_filter['status'] : -1;
        $displayStartDate = ( ! empty( $searchHelper->_filter['display_start_date'] )) ? $searchHelper->_filter['display_start_date'] : '';
        $displayEndDate = ( ! empty( $searchHelper->_filter['display_end_date'] )) ? $searchHelper->_filter['display_end_date'] : '';
        $displayStartDateTime = ( ! empty( $searchHelper->_filter['display_start_date_and_time'] )) ? $searchHelper->_filter['display_start_date_and_time'] : '';
        $displayEndDateTime = ( ! empty( $searchHelper->_filter['display_end_date_and_time'] )) ? $searchHelper->_filter['display_end_date_and_time'] : '';
        $uniqueGroupIdNotIn = ( ! empty( $searchHelper->_filter['unique_group_id_not_in'] )) ? $searchHelper->_filter['unique_group_id_not_in'] : [];
        $notificationIdNotIn = ( ! empty( $searchHelper->_filter['notification_id'] )) ? $searchHelper->_filter['notification_id'] : [];
		$statusIdIn			 = (isset( $searchHelper->_filter['status_id_in'] )) ? $searchHelper->_filter['status_id_in'] : [];

        $list = $this->setSelect()
                  //   ->joinUser()
                     ->addSearch( $search )
                     ->addUserIdFilter( $userId )
                     ->addStatusFilter('status' ,$status )
                     ->addDisplayDateFilter( $displayStartDate, $displayEndDate )
                     ->addDisplayDateAndTimeFilter( $displayStartDateTime, $displayEndDateTime )
                     ->addCreatedUserIdFilter( $createdUserId )
                     ->addNotificationIdNotInFilter( $notificationIdNotIn )
                     ->addStatusIdInFilter( $statusIdIn )
                     ->addUniqueGroupIdNotInFilter( $uniqueGroupIdNotIn )
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
        $createdUserId = ( ! empty( $searchHelper->_filter['created_user_id'] )) ? $searchHelper->_filter['created_user_id'] : 0;
        $userId = ( ! empty( $searchHelper->_filter['user_id'] )) ? $searchHelper->_filter['user_id'] : 0;
        $status = (isset( $searchHelper->_filter['status'] )) ? $searchHelper->_filter['status'] : -1;
        $displayStartDate = ( ! empty( $searchHelper->_filter['display_start_date'] )) ? $searchHelper->_filter['display_start_date'] : '';
        $displayEndDate = ( ! empty( $searchHelper->_filter['display_end_date'] )) ? $searchHelper->_filter['display_end_date'] : '';
        $displayStartDateTime = ( ! empty( $searchHelper->_filter['display_start_date_and_time'] )) ? $searchHelper->_filter['display_start_date_and_time'] : '';
        $displayEndDateTime = ( ! empty( $searchHelper->_filter['display_end_date_and_time'] )) ? $searchHelper->_filter['display_end_date_and_time'] : '';
        $uniqueGroupIdNotIn = ( ! empty( $searchHelper->_filter['unique_group_id_not_in'] )) ? $searchHelper->_filter['unique_group_id_not_in'] : [];
        $notificationIdNotIn = ( ! empty( $searchHelper->_filter['notification_id'] )) ? $searchHelper->_filter['notification_id'] : [];
		$statusIdIn			 = (isset( $searchHelper->_filter['status_id_in'] )) ? $searchHelper->_filter['status_id_in'] : [];

        $count = $this->setSelect()
                      ->joinUser()
                      ->addSearch( $search )
                      ->addUserIdFilter( $userId )
                      ->addStatusFilter('status' ,$status )
                      ->addDisplayDateFilter( $displayStartDate, $displayEndDate )
                      ->addDisplayDateAndTimeFilter( $displayStartDateTime, $displayEndDateTime )
                      ->addCreatedUserIdFilter( $createdUserId )
					  ->addStatusIdInFilter( $statusIdIn )
                      ->addNotificationIdNotInFilter( $notificationIdNotIn )
                      ->addUniqueGroupIdNotInFilter( $uniqueGroupIdNotIn )
                      ->addSortOrder( $searchHelper->_sortOrder )
                      ->addGroupBy( $searchHelper->_groupBy )
                      ->get()
                      ->count();

        return $count;
    }

    public function saveRecord( $data )
    {
        $notificationId = 0;
        if ( isset( $data['notification_id'] ) && $data['notification_id'] != '' && $data['notification_id'] > 0 ) {
            $notificationId = $data['notification_id'];
        }

        $rules = ['user_id'      => ['required'],
                  'description'  => ['required'],
                  'display_date' => ['required']];

        $validationResult = $this->validateData( $rules, $data );

        if ( $validationResult['success'] == false ) {
            $result['success'] = false;
            $result['message'] = $validationResult['message'];
            return $result;
        }

        if ( $notificationId > 0 ) {
            $notification = self::findOrFail( $data['notification_id'] );
            $notification->update( $data );
            $result['notification_id'] = $notification->notification_id;
        } else {
            $notification = self::create( $data );
            $result['notification_id'] = $notification->notification_id;
        }
        $result['success'] = true;
        $result['message'] = "Notification saved successfully.";
        return $result;
    }
}
