<?php

namespace App\Classes\Models\Club;

use App\Classes\Models\BaseModel;
use App\Classes\Helpers\Club\Helper;
use App\Classes\Models\User\User;
use App\Classes\Models\UserClub\UserClub;
use App\Classes\Helpers\SearchHelper;

class Club extends BaseModel
{
    protected $table = 'ka_club';
    protected $primaryKey = 'club_id';
    protected $entity = 'club';
    protected $searchableColumns = ['club_name'];
    protected $fillable = ['school_id',
                           'club_name'];
    protected $_helper;
    protected $userClubObj;

    public function __construct( array $attributes = [] )
    {
        $this->bootIfNotBooted();
        $this->syncOriginal();
        $this->fill( $attributes );
        $this->_helper = new Helper();
        $this->userClubObj = new UserClub();
    }

    public function school()
    {
        return $this->belongsTo( User::class, 'school_id', 'user_id' );
    }

    public function addSchoolIdFilter( $schoolId = 0 )
    {
        if ( ! empty( $schoolId ) && $schoolId > 0 ) {
            $tableName = $this->getTableName();
            $this->queryBuilder->where( $tableName . '.school_id', '=', $schoolId );
        }
        return $this;
    }

    public function getDropDown( $prepend = '', $schoolId = 0, $prependId = 0 )
    {
        $return = $this->setSelect()
                       ->addSchoolIdFilter( $schoolId )
                       ->addSortOrder( ['club_name' => 'asc'] )
                       ->get()
                       ->pluck( 'club_name', 'club_id' );

        if ( ! empty( $prepend ) ) {
            $return->prepend( $prepend, $prependId );
        }

        return $return;
    }

    public function getDateById( $clubId )
    {
        $return = $this->setSelect()
                       ->addClubIdFilter( $clubId )
                       ->get()
                       ->first();
        return $return;
    }

    public function addClubNameLikeFilter( $clubName = '' )
    {
        if ( ! empty( trim( $clubName ) ) ) {
            $tableName = $this->getTableName();
            $this->queryBuilder->where( $tableName . '.club_name', 'like', '%' . $clubName . '%' );
        }
        return $this;
    }

    public function addClubIdFilter( $clubId = 0 )
    {
        if ( ! empty( $clubId ) && $clubId > 0 ) {
            $tableName = $this->getTableName();
            $this->queryBuilder->where( $tableName . '.club_id', '=', $clubId );
        }
        return $this;
    }


    public function club_members_count( $clubId )
    {
        $searchHelper = new SearchHelper( -1, -1, $selectColumns = ['*'], $filter = ['club_id' => $clubId] );
        $totalMembers = $this->userClubObj->getListTotalCount( $searchHelper );
        return $totalMembers;
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

    public function getList( $searchHelper )
    {
        $this->reset();
        $perPage = ($searchHelper->_perPage == 0) ? $this->_helper->getConfigPerPageRecord() : $searchHelper->_perPage;

        $search = ( ! empty( $searchHelper->_filter['search'] )) ? $searchHelper->_filter['search'] : '';
        $clubName = ( ! empty( $searchHelper->_filter['club_name'] )) ? $searchHelper->_filter['club_name'] : '';
        $signUpStartDate = ( ! empty( $searchHelper->_filter['created_start_date'] )) ? $searchHelper->_filter['created_start_date'] : '';
        $signUpEndDate = ( ! empty( $searchHelper->_filter['created_end_date'] )) ? $searchHelper->_filter['created_end_date'] : '';
        $schoolId = ( ! empty( $searchHelper->_filter['school_id'] )) ? $searchHelper->_filter['school_id'] : '';

        $list = $this->setSelect()
                     ->addSearch( $search )
                     ->addSchoolIdFilter( $schoolId )
                     ->addClubNameLikeFilter( $clubName )
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
        $clubName = ( ! empty( $searchHelper->_filter['club_name'] )) ? $searchHelper->_filter['club_name'] : '';
        $signUpStartDate = ( ! empty( $searchHelper->_filter['created_start_date'] )) ? $searchHelper->_filter['created_start_date'] : '';
        $signUpEndDate = ( ! empty( $searchHelper->_filter['created_end_date'] )) ? $searchHelper->_filter['created_end_date'] : '';
        $schoolId = ( ! empty( $searchHelper->_filter['school_id'] )) ? $searchHelper->_filter['school_id'] : '';

        $count = $this->setSelect()
                      ->addSearch( $search )
                      ->addSchoolIdFilter( $schoolId )
                      ->addClubNameLikeFilter( $clubName )
                      ->addCreatedDateFilter( $signUpStartDate, $signUpEndDate )
                      ->addSortOrder( $searchHelper->_sortOrder )
                      ->addGroupBy( $searchHelper->_groupBy )
                      ->get()
                      ->count();

        return $count;
    }

    public function saveRecord( $data )
    {
        $clubId = 0;
        $schoolId = $data['school_id'];
        if ( ! empty( $data['club_id'] ) && $data['club_id'] > 0 ) {
            $clubId = $data['club_id'];
        }
        $tableName = $this->getTableName();
        $rules = ['club_name' => ['required',
                                  'unique:' . $tableName . ',club_name,' . $clubId . ',club_id,school_id, ' . $schoolId],
                  'school_id' => ['required'],];

        $validationResult = $this->validateData( $rules, $data );

        if ( $validationResult['success'] == false ) {
            $result['success'] = false;
            $result['message'] = $validationResult['message'];
            return $result;
        }

        if ( $clubId > 0 ) {
            $classes = self::findOrFail( $data['club_id'] );
            $classes->update( $data );
            $result['club_id'] = $classes->club_id;
        } else {
            $classes = self::create( $data );
            $result['club_id'] = $classes->club_id;
        }
        $result['success'] = true;
        $result['message'] = "Club saved successfully.";
        return $result;
    }


}
