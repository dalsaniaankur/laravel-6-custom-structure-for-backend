<?php

namespace App\Classes\Models\UserClub;

use App\Classes\Models\BaseModel;
use App\Classes\Helpers\UserClub\Helper;
use App\Classes\Models\Club\Club;
use App\Classes\Models\User\User;

class UserClub extends BaseModel
{
    protected $table = 'ka_user_club';
    protected $primaryKey = 'user_club_id';
    protected $entity = 'user_club';
    protected $searchableColumns = [];
    protected $fillable = ['user_id',
                           'club_id'];
    protected $_helper;

    public function __construct( array $attributes = [] )
    {
        $this->bootIfNotBooted();
        $this->syncOriginal();
        $this->fill( $attributes );
        $this->_helper = new Helper();
    }

    public function club()
    {
        return $this->belongsTo( Club::class, 'club_id', 'club_id' );
    }

    public function user()
    {
        return $this->belongsTo( User::class, 'user_id', 'user_id' );
    }

    public function getDateById( $userClubId )
    {
        $return = $this->setSelect()
                       ->addUserClubIdFilter( $userClubId )
                       ->get()
                       ->first();
        return $return;
    }

    public function addUserClubIdFilter( $userClubId = 0 )
    {
        if ( ! empty( $userClubId ) && $userClubId > 0 ) {
            $tableName = $this->getTableName();
            $this->queryBuilder->where( $tableName . '.user_club_id', '=', $userClubId );
        }
        return $this;
    }

    public function addUserIdFilter( $userId = 0 )
    {
        if ( ! empty( $userId ) && $userId > 0 ) {
            $tableName = $this->getTableName();
            $this->queryBuilder->where( $tableName . '.user_id', '=', $userId );
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

    public function addRoleIdFilter( $roleId = 0 )
    {
        if ( ! empty( $roleId ) && $roleId > 0 ) {
            $tableName = 'user';
            $this->queryBuilder->where( $tableName . '.role_id', '=', $roleId );
        }
        return $this;
    }

    public function joinUser( $searchable = false )
    {
        $userObj = new User();
        $userTableName = $userObj->getTable() . ' as user';
        $searchableColumns = $userObj->getSearchableColumns();
        $this->joinTables[] = ['table'             => $userTableName,
                               'searchable'        => $searchable,
                               'searchableColumns' => $searchableColumns];
        $this->queryBuilder->leftJoin( $userTableName, function ( $join ) use ( $userTableName ) {
            $join->on( $this->table . '.user_id', '=', 'user.user_id' );

        } );
        return $this;
    }

    public function getList( $searchHelper )
    {
        $this->reset();
        $perPage = ($searchHelper->_perPage == 0) ? $this->_helper->getConfigPerPageRecord() : $searchHelper->_perPage;

        $search = ( ! empty( $searchHelper->_filter['search'] )) ? $searchHelper->_filter['search'] : '';
        $userId = ( ! empty( $searchHelper->_filter['user_id'] )) ? $searchHelper->_filter['user_id'] : '';
        $clubId = ( ! empty( $searchHelper->_filter['club_id'] )) ? $searchHelper->_filter['club_id'] : '';
        $roleId = ( ! empty( $searchHelper->_filter['role_id'] )) ? $searchHelper->_filter['role_id'] : 0;

        $list = $this->setSelect()
                     ->joinUser()
                     ->addSearch( $search )
                     ->addUserIdFilter( $userId )
                     ->addClubIdFilter( $clubId )
                     ->addRoleIdFilter( $roleId )
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
        $userId = ( ! empty( $searchHelper->_filter['user_id'] )) ? $searchHelper->_filter['user_id'] : '';
        $clubId = ( ! empty( $searchHelper->_filter['club_id'] )) ? $searchHelper->_filter['club_id'] : '';
        $roleId = ( ! empty( $searchHelper->_filter['role_id'] )) ? $searchHelper->_filter['role_id'] : '';

        $count = $this->setSelect()
                      ->joinUser()
                      ->addSearch( $search )
                      ->addUserIdFilter( $userId )
                      ->addClubIdFilter( $clubId )
                      ->addRoleIdFilter( $roleId )
                      ->addSortOrder( $searchHelper->_sortOrder )
                      ->addGroupBy( $searchHelper->_groupBy )
                      ->get()
                      ->count();

        return $count;
    }

    public function saveRecord( $data )
    {
        $userClubId = 0;
        if ( ! empty( $data['user_club_id'] ) && $data['user_club_id'] > 0 ) {
            $userClubId = $data['user_club_id'];
        }
        $tableName = $this->getTableName();
        $userId = $data['user_id'];
        $rules = ['club_id' => ['required',
                                'unique:' . $tableName . ',club_id,' . $userClubId . ',user_club_id,user_id, ' . $userId],
                  'user_id' => ['required'],];

        $attributeNames = ['club_id' => 'club'];
        $validationResult = $this->validateData( $rules, $data, [], $attributeNames );

        if ( $validationResult['success'] == false ) {
            $result['success'] = false;
            $result['message'] = $validationResult['message'];
            return $result;
        }

        if ( $userClubId > 0 ) {
            $classes = self::findOrFail( $data['user_club_id'] );
            $classes->update( $data );
            $result['user_club_id'] = $classes->user_club_id;
        } else {
            $classes = self::create( $data );
            $result['user_club_id'] = $classes->user_club_id;
        }
        $result['success'] = true;
        $result['message'] = "Club member saved successfully.";
        return $result;
    }


}
