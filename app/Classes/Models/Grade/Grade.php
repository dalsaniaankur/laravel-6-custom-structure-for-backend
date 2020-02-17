<?php

namespace App\Classes\Models\Grade;

use App\Classes\Models\BaseModel;
use App\Classes\Helpers\Grade\Helper;
use App\Classes\Models\User\User;

class Grade extends BaseModel
{
    protected $table = 'ka_grade';
    protected $primaryKey = 'grade_id';
    protected $entity = 'grade';
    protected $searchableColumns = ['grade_name'];
    protected $fillable = ['school_id',
                           'grade_name'];
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

    public function addJoinsAndFilters( $searchHelper )
    {
        $search = ( ! empty( $searchHelper->_filter['search'] )) ? $searchHelper->_filter['search'] : '';
        $gradeName = ( ! empty( $searchHelper->_filter['grade_name'] )) ? $searchHelper->_filter['grade_name'] : '';
        $schoolId = ( ! empty( $searchHelper->_filter['school_id'] )) ? $searchHelper->_filter['school_id'] : '';
        $createdStartDate = ( ! empty( $searchHelper->_filter['created_start_date'] )) ? $searchHelper->_filter['created_start_date'] : '';
        $createdEndDate = ( ! empty( $searchHelper->_filter['created_end_date'] )) ? $searchHelper->_filter['created_end_date'] : '';

        $this->addSearch( $search )
            ->addLikeFilter('grade_name',$gradeName)
            ->addStartDateEndDateFilter('created_at',$createdStartDate,$createdEndDate)
            ->addEqualIdFilter('school_id',$schoolId);

        return $this;
    }

    public function saveRecord( $data )
    {
        $gradeId = 0;
        $schoolId = $data['school_id'];
        if ( ! empty( $data['grade_id'] ) && $data['grade_id'] > 0 ) {
            $gradeId = $data['grade_id'];
        }
        $tableName = $this->getTableName();
        $rules = ['grade_name' => ['required',
                                   'unique:' . $tableName . ',grade_name,' . $gradeId . ',grade_id,school_id, ' . $schoolId],
                  'school_id'  => ['required'],];

        $validationResult = $this->validateData( $rules, $data );

        if ( $validationResult['success'] == false ) {
            $result['success'] = false;
            $result['message'] = $validationResult['message'];
            return $result;
        }

        if ( $gradeId > 0 ) {
            $classes = self::findOrFail( $data['grade_id'] );
            $classes->update( $data );
            $result['grade_id'] = $classes->grade_id;
        } else {
            $classes = self::create( $data );
            $result['grade_id'] = $classes->grade_id;
        }
        $result['success'] = true;
        $result['message'] = "Grade saved successfully.";
        return $result;
    }
}
