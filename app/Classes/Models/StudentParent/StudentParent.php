<?php

namespace App\Classes\Models\StudentParent;

use App\Classes\Models\BaseModel;
use App\Classes\Helpers\StudentParent\Helper;
use App\Classes\Models\User\User;

class StudentParent extends BaseModel
{
    protected $table = 'ka_student_parent';
    protected $primaryKey = 'student_parent_id';
    protected $entity = 'student_parent';
    protected $searchableColumns = [];
    protected $fillable = ['student_id',
                           'parent_id'];
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

    public function student()
    {
        return $this->belongsTo( User::class, 'student_id', 'user_id' );
    }

    public function parent()
    {
        return $this->belongsTo( User::class, 'parent_id', 'user_id' );
    }

    public function getDateById( $studentParentId )
    {
        $return = $this->setSelect()
                       ->addStudentParentIdFilter( $studentParentId )
                       ->get()
                       ->first();
        return $return;
    }

    public function addStudentParentIdFilter( $studentParentId = 0 )
    {
        if ( ! empty( $studentParentId ) && $studentParentId > 0 ) {
            $tableName = $this->getTableName();
            $this->queryBuilder->where( $tableName . '.student_parent_id', '=', $studentParentId );
        }
        return $this;
    }

    public function addParentIdFilter( $parentId = 0 )
    {
        if ( ! empty( $parentId ) && $parentId > 0 ) {
            $tableName = $this->getTableName();
            $this->queryBuilder->where( $tableName . '.parent_id', '=', $parentId );
        }
        return $this;
    }
    public function addParentIdNotFilter( $parentId = -1 )
    {
        if ( ! empty( $parentId ) && $parentId > 0 ) {
            $tableName = $this->getTableName();
            $this->queryBuilder->where( $tableName . '.parent_id', '!=', $parentId );
        }
        return $this;
    }

    public function addStudentIdFilter( $studentId = 0 )
    {
        if ( ! empty( $studentId ) && $studentId > 0 ) {
            $tableName = $this->getTableName();
            $this->queryBuilder->where( $tableName . '.student_id', '=', $studentId );
        }
        return $this;
    }

    public function joinStudent( $searchable = false )
    {
        $studentTableName = $this->userObj->getTable() . ' as student';
        $searchableColumns = $this->userObj->getSearchableColumns();
        $this->joinTables[] = ['table'             => $studentTableName,
                               'searchable'        => $searchable,
                               'searchableColumns' => $searchableColumns];
        $this->queryBuilder->leftJoin( $studentTableName, function ( $join ) use ( $studentTableName ) {
            $join->on( $this->table . '.student_id', '=', 'student.user_id' );

        } );
        return $this;
    }

    public function joinParent( $searchable = false )
    {
        $parentTableName = $this->userObj->getTable() . ' as parent';
        $searchableColumns = $this->userObj->getSearchableColumns();
        $this->joinTables[] = ['table'             => $parentTableName,
                               'searchable'        => $searchable,
                               'searchableColumns' => $searchableColumns];
        $this->queryBuilder->leftJoin( $parentTableName, function ( $join ) use ( $parentTableName ) {
            $join->on( $this->table . '.parent_id', '=', 'parent.user_id' );

        } );
        return $this;
    }

    public function addStudentClassIdFilter( $classId = 0 )
    {
        if ( ! empty( $classId ) && $classId > 0 ) {
            $this->queryBuilder->where( 'student.class_id', '=', $classId );
        }
        return $this;
    }

    public function addStudentStatusFilter( $status = -1 )
    {
        if ( $status != '-1' && $status != -1 ) {
            $this->queryBuilder->where( 'student.status', '=', $status );
        }
        return $this;
    }

    public function addStudentIsVerifiedFilter( $isVerified = -1 )
    {
        if ( $isVerified != '-1' && $isVerified != -1 ) {
            if ( $isVerified == 1 ) {
                $this->queryBuilder->where( 'student.email_verified_at', '!=', null );
            }
            if ( $isVerified == 0 ) {
                $this->queryBuilder->where( 'student.email_verified_at', '=', null );
            }
        }
        return $this;
    }

    public function getList( $searchHelper )
    {
        $this->reset();
        $perPage = ($searchHelper->_perPage == 0) ? $this->_helper->getConfigPerPageRecord() : $searchHelper->_perPage;

        $search = ( ! empty( $searchHelper->_filter['search'] )) ? $searchHelper->_filter['search'] : '';
        $parentId = ( ! empty( $searchHelper->_filter['parent_id'] )) ? $searchHelper->_filter['parent_id'] : '';
        $studentId = ( ! empty( $searchHelper->_filter['student_id'] )) ? $searchHelper->_filter['student_id'] : '';
        $parentIdNot = ( ! empty( $searchHelper->_filter['parent_id_not'] )) ? $searchHelper->_filter['parent_id_not'] : -1;

        $studentStatus = (isset ( $searchHelper->_filter['student_status'] )) ? $searchHelper->_filter['student_status'] : -1;
        $studentClassId = ( ! empty( $searchHelper->_filter['student_class_id'] )) ? $searchHelper->_filter['student_class_id'] : -1;
        $studentIsVerified = ( ! empty( $searchHelper->_filter['student_is_verified'] )) ? $searchHelper->_filter['student_is_verified'] : -1;

        $list = $this->setSelect()
                     ->joinStudent()
                     ->joinParent()
                     ->addSearch( $search )
                     ->addStudentClassIdFilter( $studentClassId )
                     ->addStudentIsVerifiedFilter( $studentIsVerified )
                     ->addStudentStatusFilter( $studentStatus )
                     ->addParentIdFilter( $parentId )
                     ->addParentIdNotFilter( $parentIdNot )
                     ->addStudentIdFilter( $studentId )
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
        $parentId = ( ! empty( $searchHelper->_filter['parent_id'] )) ? $searchHelper->_filter['parent_id'] : '';
        $studentId = ( ! empty( $searchHelper->_filter['student_id'] )) ? $searchHelper->_filter['student_id'] : '';
        $parentIdNot = ( ! empty( $searchHelper->_filter['parent_id_not'] )) ? $searchHelper->_filter['parent_id_not'] : -1;

        $studentStatus = (isset ( $searchHelper->_filter['student_status'] )) ? $searchHelper->_filter['student_status'] : -1;
        $studentClassId = ( ! empty( $searchHelper->_filter['student_class_id'] )) ? $searchHelper->_filter['student_class_id'] : -1;
        $studentIsVerified = ( ! empty( $searchHelper->_filter['student_is_verified'] )) ? $searchHelper->_filter['student_is_verified'] : -1;

        $count = $this->setSelect()
                      ->joinStudent()
                      ->joinParent()
                      ->addSearch( $search )
                      ->addStudentClassIdFilter( $studentClassId )
                      ->addStudentIsVerifiedFilter( $studentIsVerified )
                      ->addStudentStatusFilter( $studentStatus )
                      ->addParentIdFilter( $parentId )
                      ->addParentIdNotFilter( $parentIdNot )
                      ->addStudentIdFilter( $studentId )
                      ->addSortOrder( $searchHelper->_sortOrder )
                      ->addGroupBy( $searchHelper->_groupBy )
                      ->get()
                      ->count();

        return $count;
    }

    public function saveRecord( $data )
    {
        $studentParentId = 0;
        if ( ! empty( $data['student_parent_id'] ) && $data['student_parent_id'] > 0 ) {
            $studentParentId = $data['student_parent_id'];
        }
        $tableName = $this->getTableName();
        $parentId = $data['parent_id'];
        $rules = ['student_id' => ['required',
                                   'unique:' . $tableName . ',student_id,' . $studentParentId . ',student_parent_id,parent_id, ' . $parentId],
                  'parent_id'  => ['required'],];

        $attributeNames = ['student_id' => 'club'];
        $validationResult = $this->validateData( $rules, $data, [], $attributeNames );

        if ( $validationResult['success'] == false ) {
            $result['success'] = false;
            $result['message'] = $validationResult['message'];
            return $result;
        }

        if ( $studentParentId > 0 ) {
            $classes = self::findOrFail( $data['student_parent_id'] );
            $classes->update( $data );
            $result['student_parent_id'] = $classes->student_parent_id;
        } else {
            $classes = self::create( $data );
            $result['student_parent_id'] = $classes->student_parent_id;
        }
        $result['success'] = true;
        $result['message'] = "Parent saved successfully.";
        return $result;
    }

    public function createOrUpdateStudentParent( $parentId, $studentIdList )
    {
        $data['parent_id'] = $parentId;
        foreach ( $studentIdList as $key => $studentId ) {
            $data['student_id'] = $studentId;
            self::updateOrCreate( $data );
        }
        /* Delete Record */
        self::where( 'parent_id', $parentId )
            ->whereNotIn( 'student_id', $studentIdList )
            ->delete();
    }
}
