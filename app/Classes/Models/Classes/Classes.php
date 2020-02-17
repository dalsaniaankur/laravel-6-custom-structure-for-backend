<?php

namespace App\Classes\Models\Classes;

use App\Classes\Models\BaseModel;
use App\Classes\Helpers\Classes\Helper;
use App\Classes\Models\Grade\Grade;

class Classes extends BaseModel
{
    protected $table = 'ka_class';
    protected $primaryKey = 'class_id';
    protected $entity = 'class';
    protected $searchableColumns = ['class_name'];
    protected $fillable = ['school_id',
                           'grade_id',
                           'class_name',
                           'status'];
    protected $gradeObj;
    protected $_helper;

    public function __construct( array $attributes = [] )
    {
        $this->bootIfNotBooted();
        $this->syncOriginal();
        $this->fill( $attributes );
        $this->gradeObj = new Grade();
        $this->_helper = new Helper();
    }

    public function grade()
    {
        return $this->belongsTo( Grade::class, 'grade_id', 'grade_id' );
    }

    public function getStatusStringAttribute()
    {
        return $this->status == 1 ? 'Active' : 'Inactive';
    }

    public function getDropDown( $schoolId = 0, $status = 1, $gradeId = 0, $prepend = '', $prependId = 0 )
    {
        $return = $this->setSelect()
                    ->addSchoolIdFilter( $schoolId )
                    ->addStatusFilter('status' ,$status )
                    ->addGradeIdFilter( $gradeId )
                    ->addSortOrder( ['class_name' => 'asc'] )
                    ->get()
                    ->pluck( 'class_name', 'class_id' );

        if ( ! empty( $prepend ) ) {
            $return->prepend( $prepend, $prependId );
        }
        return $return;
    }

    public function getDateById( $classId )
    {
        $return = $this->setSelect()
                       ->addClassIdFilter( $classId )
                       ->get()
                       ->first();
        return $return;
    }

    public function addClassNameLikeFilter( $className = '' )
    {
        if ( ! empty( trim( $className ) ) ) {
            $tableName = $this->getTableName();
            $this->queryBuilder->where( $tableName . '.class_name', 'like', '%' . $className . '%' );
        }
        return $this;
    }

    public function addGradeNameLikeFilter( $gradeName = '' )
    {
        if ( ! empty( trim( $gradeName ) ) ) {
            $gradeTableName = $this->gradeObj->getTableName();
            $this->queryBuilder->where( $gradeTableName . '.grade_name', 'like', '%' . $gradeName . '%' );
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

    public function addSchoolIdFilter( $schoolId = 0 )
    {
        if ( ! empty( $schoolId ) && $schoolId > 0 ) {
            $tableName = $this->getTableName();
            $this->queryBuilder->where( $tableName . '.school_id', '=', $schoolId );
        }
        return $this;
    }

    public function addSignUpDateFilter( $startDate = '', $endDate = '' )
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

    public function addGradeIdFilter( $gradeId = 0 )
    {
        if ( ! empty( $gradeId ) && $gradeId > 0 ) {
            $tableName = $this->getTableName();
            $this->queryBuilder->where( $tableName . '.grade_id', '=', $gradeId );
        }
        return $this;
    }

    public function joinGrade( $searchable = false )
    {
        $gradeTableName = $this->gradeObj->getTable();
        $searchableColumns = $this->gradeObj->getSearchableColumns();
        $this->joinTables[] = ['table'             => $gradeTableName,
                               'searchable'        => $searchable,
                               'searchableColumns' => $searchableColumns];

        $this->queryBuilder->leftJoin( $gradeTableName, function ( $join ) use ( $gradeTableName ) {
            $join->on( $this->table . '.grade_id', '=', $gradeTableName . '.grade_id' );

        } );

        return $this;
    }

    public function getList( $searchHelper )
    {
        $this->reset();
        $perPage = ($searchHelper->_perPage == 0) ? $this->_helper->getConfigPerPageRecord() : $searchHelper->_perPage;

        $search = ( ! empty( $searchHelper->_filter['search'] )) ? $searchHelper->_filter['search'] : '';
        $className = ( ! empty( $searchHelper->_filter['class_name'] )) ? $searchHelper->_filter['class_name'] : '';
        $gradeName = ( ! empty( $searchHelper->_filter['grade_name'] )) ? $searchHelper->_filter['grade_name'] : '';
        $schoolId = ( ! empty( $searchHelper->_filter['school_id'] )) ? $searchHelper->_filter['school_id'] : '';
        $gradeId = ( ! empty( $searchHelper->_filter['grade_id'] )) ? $searchHelper->_filter['grade_id'] : '';
        $signUpStartDate = ( ! empty( $searchHelper->_filter['created_start_date'] )) ? $searchHelper->_filter['created_start_date'] : '';
        $signUpEndDate = ( ! empty( $searchHelper->_filter['created_end_date'] )) ? $searchHelper->_filter['created_end_date'] : '';
        $status = (isset ( $searchHelper->_filter['status'] )) ? $searchHelper->_filter['status'] : -1;

        $list = $this->setSelect()
                     ->joinGrade()
                     ->addSearch( $search )
                     ->addClassNameLikeFilter( $className )
                     ->addGradeNameLikeFilter( $gradeName )
                     ->addSchoolIdFilter( $schoolId )
                     ->addGradeIdFilter( $gradeId )
                     ->addStatusFilter('status' ,$status )
                     ->addSignUpDateFilter( $signUpStartDate, $signUpEndDate )
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
        $className = ( ! empty( $searchHelper->_filter['class_name'] )) ? $searchHelper->_filter['class_name'] : '';
        $gradeName = ( ! empty( $searchHelper->_filter['grade_name'] )) ? $searchHelper->_filter['grade_name'] : '';
        $schoolId = ( ! empty( $searchHelper->_filter['school_id'] )) ? $searchHelper->_filter['school_id'] : '';
        $gradeId = ( ! empty( $searchHelper->_filter['grade_id'] )) ? $searchHelper->_filter['grade_id'] : '';
        $signUpStartDate = ( ! empty( $searchHelper->_filter['created_start_date'] )) ? $searchHelper->_filter['created_start_date'] : '';
        $signUpEndDate = ( ! empty( $searchHelper->_filter['created_end_date'] )) ? $searchHelper->_filter['created_end_date'] : '';
        $status = (isset ( $searchHelper->_filter['status'] )) ? $searchHelper->_filter['status'] : -1;

        $count = $this->setSelect()
                      ->joinGrade()
                      ->addSearch( $search )
                      ->addClassNameLikeFilter( $className )
                      ->addGradeNameLikeFilter( $gradeName )
                      ->addSchoolIdFilter( $schoolId )
                      ->addGradeIdFilter( $gradeId )
                      ->addStatusFilter('status' ,$status )
                      ->addSignUpDateFilter( $signUpStartDate, $signUpEndDate )
                      ->addSortOrder( $searchHelper->_sortOrder )
                      ->addGroupBy( $searchHelper->_groupBy )
                      ->get()
                      ->count();

        return $count;
    }

    public function saveRecord( $data )
    {
        $classId = 0;
        if ( ! empty( $data['class_id'] ) && $data['class_id'] > 0 ) {
            $classId = $data['class_id'];
        }
        $tableName = $this->getTableName();
        $schoolId = $data['school_id'];
        $gradeId = $data['grade_id'];

        $rules = ['class_name' => ['required',
                                   'unique:' . $tableName . ',class_name, ' . $classId . ' ,class_id,grade_id, ' . $gradeId . ',school_id, ' . $schoolId],
                  'school_id'  => ['required'],];


        $validationResult = $this->validateData( $rules, $data );

        if ( $validationResult['success'] == false ) {
            $result['success'] = false;
            $result['message'] = $validationResult['message'];
            return $result;
        }

        if ( $classId > 0 ) {
            $classes = self::findOrFail( $data['class_id'] );
            $classes->update( $data );
            $result['class_id'] = $classes->class_id;
        } else {
            $classes = self::create( $data );
            $result['class_id'] = $classes->class_id;
        }
        $result['success'] = true;
        $result['message'] = "Class saved successfully.";
        return $result;
    }


}
