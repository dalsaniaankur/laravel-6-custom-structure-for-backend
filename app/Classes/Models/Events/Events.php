<?php

namespace App\Classes\Models\Events;

use App\Classes\Models\BaseModel;
use App\Classes\Helpers\Events\Helper;
use App\Classes\Helpers\SearchHelper;
use App\Classes\Models\User\User;
use App\Classes\Models\Club\Club;
use App\Classes\Common\Common;

class Events extends BaseModel
{
    protected $table = 'ka_events';
    protected $primaryKey = 'event_id';
    protected $entity = 'events';
    protected $searchableColumns = ['description'];
    protected $fillable = ['description',
                           'event_title',
                           'event_type',
                           'is_all',
                           'created_user_id',
                           'user_id',
                           'class_id',
                           'club_id',
                           'school_id',
                           'start_date',
                           'start_time',
                           'end_date',
                           'end_time',
                           'photo'
						   ];
    protected $_helper;

    public function __construct( array $attributes = [] )
    {
        $this->bootIfNotBooted();
        $this->syncOriginal();
        $this->fill( $attributes );
        $this->_helper = new Helper();
    }

    public function school()
    {
        return $this->belongsTo( User::class, 'school_id', 'user_id' );
    }

    public function club()
    {
        return $this->belongsTo( Club::class, 'club_id', 'club_id' );
    }

    public function getDateById( $eventId )
    {
        $return = $this->setSelect()
                       ->addEventIdFilter( $eventId )
                       ->get()
                       ->first();
        return $return;
    }

    public function addEventIdFilter( $eventId = 0 )
    {
        if ( ! empty( $eventId ) && $eventId > 0 ) {
            $tableName = $this->getTableName();
            $this->queryBuilder->where( $tableName . '.event_id', '=', $eventId );
        }
        return $this;
    }

    public function setStartDateAttribute( $value )
    {
        $this->attributes['start_date'] = ! empty( $value ) ? date( "Y-m-d", strtotime( $value ) ) : null;
    }

    public function setEndDateAttribute( $value )
    {
        $this->attributes['end_date'] = ! empty( $value ) ? date( "Y-m-d", strtotime( $value ) ) : null;
    }

    public function setStartTimeAttribute( $value )
    {
        if ( ! empty( $value ) ) {
            $value = str_replace( ' : ', ':', $value );
            $this->attributes['start_time'] = date( "H:i:s", strtotime( $value ) );
        } else {
            $this->attributes['start_time'] = null;
        }
    }

    public function setEndTimeAttribute( $value )
    {
        if ( ! empty( $value ) ) {
            $value = str_replace( ' : ', ':', $value );
            $this->attributes['end_time'] = date( "H:i:s", strtotime( $value ) );
        } else {
            $this->attributes['end_time'] = null;
        }
    }

    public function addSchoolIdFilter( $schoolId = 0 )
    {
        if ( ! empty( $schoolId ) && $schoolId > 0 ) {
            $tableName = $this->getTableName();
            $this->queryBuilder->where( $tableName . '.school_id', '=', $schoolId );
        }
        return $this;
    }
    public function addClassIdFilter( $classId = 0 )
    {
        if ( ! empty( $classId ) && $classId > 0 ) {
            $tableName = $this->getTableName();
            $this->queryBuilder->where( $tableName . '.class_id', '=', $classId );
        }
        return $this;
    }

    public function addEventTypeFilter( $eventType = 0 )
    {
        if ( ! empty( $eventType ) && $eventType > 0 ) {
            $tableName = $this->getTableName();
            $this->queryBuilder->where( $tableName . '.event_type', '=', $eventType );
        }
        return $this;
    }

    public function addEventNameLikeFilter( $description )
    {
        if ( ! empty( $description ) ) {
            $tableName = $this->getTableName();
            $this->queryBuilder->where( $tableName . '.description', 'like', '%' . $description . '%' );
        }
        return $this;
    }


    public function addEventTitleLikeFilter( $title )
    {
        if ( ! empty( $title ) ) {
            $tableName = $this->getTableName();
            $this->queryBuilder->where( $tableName . '.event_title', 'like', '%' . $title . '%' );
        }
        return $this;
    }

    public function addEventTypeExcludeFilter( $excludeEventId )
    {
        if ( ! empty( $excludeEventId ) ) {
            $tableName = $this->getTableName();
            $this->queryBuilder->whereNotIn( $tableName . '.event_type', $excludeEventId );
        }
        return $this;
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

    public function getEventShortDescriptionAttribute()
    {
        if ( ! empty( $this->description ) ) {
            return strlen( $this->description ) > 15 ? substr( $this->description, 0, 15 ) . '...' : $this->description;
        }
        return "";
    }

    public function getEventNameAttribute()
    {
        return $this->_helper->getEventName( $this->event_type );
    }

    public function addCreatedDateFilter( $startDate = '', $endDate = '' )
    {
        $tableName = $this->getTableName();
        if ( ! empty( $startDate ) ) {
            $startDate = date( "Y-m-d", strtotime( $startDate ) );
            $this->queryBuilder->whereDate( $tableName . '.start_date', '>=', "$startDate" );
        }

        if ( ! empty( $endDate ) ) {
            $endDate = date( "Y-m-d", strtotime( $endDate ) );
            $this->queryBuilder->whereDate( $tableName . '.end_date', '<=', "$endDate" );
        }
        return $this;
    }

    public function getList( $searchHelper )
    {
        $this->reset();
        $perPage = ($searchHelper->_perPage == 0) ? $this->_helper->getConfigPerPageRecord() : $searchHelper->_perPage;

        $search = ( ! empty( $searchHelper->_filter['search'] )) ? $searchHelper->_filter['search'] : '';
        $signUpStartDate = ( ! empty( $searchHelper->_filter['created_start_date'] )) ? $searchHelper->_filter['created_start_date'] : '';
        $signUpEndDate = ( ! empty( $searchHelper->_filter['created_end_date'] )) ? $searchHelper->_filter['created_end_date'] : '';
        $schoolId = ( ! empty( $searchHelper->_filter['school_id'] )) ? $searchHelper->_filter['school_id'] : 0;
        $description = ( ! empty( $searchHelper->_filter['description'] )) ? $searchHelper->_filter['description'] : '';
        $title = ( ! empty( $searchHelper->_filter['title'] )) ? $searchHelper->_filter['title'] : '';
        $eventType = ( ! empty( $searchHelper->_filter['event_type'] )) ? $searchHelper->_filter['event_type'] : '';
        $excludeEventId = ( ! empty( $searchHelper->_filter['exclude_event_type'] )) ? $searchHelper->_filter['exclude_event_type'] : [];
        $classId = ( ! empty( $searchHelper->_filter['class_id'] )) ? $searchHelper->_filter['class_id'] : -1;

        $list = $this->setSelect()
                     ->addSearch( $search )
                     ->addSchoolIdFilter( $schoolId )
                     ->addClassIdFilter( $classId )
                     ->addEventNameLikeFilter( $description )
                     ->addEventTitleLikeFilter( $title )
                     ->addEventTypeFilter( $eventType )
                     ->addEventTypeExcludeFilter( $excludeEventId )
                     ->addCreatedDateFilter( $signUpStartDate, $signUpEndDate )
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
        $schoolId = ( ! empty( $searchHelper->_filter['school_id'] )) ? $searchHelper->_filter['school_id'] : 0;
        $description = ( ! empty( $searchHelper->_filter['description'] )) ? $searchHelper->_filter['description'] : '';
        $title = ( ! empty( $searchHelper->_filter['title'] )) ? $searchHelper->_filter['title'] : '';
        $eventType = ( ! empty( $searchHelper->_filter['event_type'] )) ? $searchHelper->_filter['event_type'] : '';
        $excludeEventId = ( ! empty( $searchHelper->_filter['exclude_event_type'] )) ? $searchHelper->_filter['exclude_event_type'] : [];
        $classId = ( ! empty( $searchHelper->_filter['class_id'] )) ? $searchHelper->_filter['class_id'] : -1;

        $count = $this->setSelect()
                      ->addSearch( $search )
                      ->addSchoolIdFilter( $schoolId )
                      ->addClassIdFilter( $classId )
                      ->addEventNameLikeFilter( $description )
                      ->addEventTitleLikeFilter( $title )
                      ->addEventTypeFilter( $eventType )
                      ->addEventTypeExcludeFilter( $excludeEventId )
                      ->addCreatedDateFilter( $signUpStartDate, $signUpEndDate )
                      ->addSortOrder( $searchHelper->_sortOrder )
                      ->addGroupBy( $searchHelper->_groupBy )
                      ->get()
                      ->count();

        return $count;
    }

    public function saveRecord( $data )
    {
        $eventId = 0;
        $schoolId = $data['school_id'];
        if ( ! empty( $data['event_id'] ) && $data['event_id'] > 0 ) {
            $eventId = $data['event_id'];
        }
        $tableName = $this->getTableName();
        $rules = ['school_id'   => ['required'],
                  'description' => ['required'],
                  'event_title' => ['required'],
                  'start_date'  => ['required'],
                  'start_time'  => ['required'],
                  'end_date'    => ['required'],
                  'end_time'    => ['required']];

        $validationResult = $this->validateData( $rules, $data );

        if ( $validationResult['success'] == false ) {
            $result['success'] = false;
            $result['message'] = $validationResult['message'];
            return $result;
        }

		if ( ! empty( $data['photo'] ) ) {

            $filePath = $this->_helper->getImagePath();
            $data['photo'] = Common::fileUpload( $filePath, $data['photo'] );
        }

        if ( $eventId > 0 ) {
            $classes = self::findOrFail( $data['event_id'] );

			/* Delete Image */
			if ( ! empty( $data['photo'] ) && ! empty( $classes->photo ) ) {
				Common::deleteFile( $classes->photo );
			}

            $classes->update( $data );
            $result['event_id'] = $classes->event_id;
        } else {
            $classes = self::create( $data );
            $result['event_id'] = $classes->event_id;
        }
        $result['success'] = true;
        $result['message'] = "Event saved successfully.";
        return $result;
    }
}
