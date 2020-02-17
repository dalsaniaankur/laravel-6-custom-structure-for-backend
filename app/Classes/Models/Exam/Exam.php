<?php

namespace App\Classes\Models\Exam;

use App\Classes\Models\BaseModel;
use App\Classes\Helpers\Exam\Helper;
use App\Classes\Models\User\User;

class Exam extends BaseModel
{
    protected $table = 'ka_exam';
    protected $primaryKey = 'exam_id';
    protected $entity = 'exam';
    protected $searchableColumns = ['exam_name'];
    protected $fillable = ['exam_name',
                           'created_user_id',
                           'school_id',
                           'exam_date'];

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

    public function setExamDateAttribute( $value )
    {
        $this->attributes['exam_date'] = ! empty( $value ) ? date( "Y-m-d", strtotime( $value ) ) : null;
    }

    public function addJoinsAndFilters( $searchHelper )
    {
        $search = ( ! empty( $searchHelper->_filter['search'] )) ? $searchHelper->_filter['search'] : '';
        $signUpStartDate = ( ! empty( $searchHelper->_filter['created_start_date'] )) ? $searchHelper->_filter['created_start_date'] : '';
        $signUpEndDate = ( ! empty( $searchHelper->_filter['created_end_date'] )) ? $searchHelper->_filter['created_end_date'] : '';
        $schoolId = ( ! empty( $searchHelper->_filter['school_id'] )) ? $searchHelper->_filter['school_id'] : 0;
        $examName = ( ! empty( $searchHelper->_filter['exam_name'] )) ? $searchHelper->_filter['exam_name'] : '';
        $examStartDate = ( ! empty( $searchHelper->_filter['exam_start_date'] )) ? $searchHelper->_filter['exam_start_date'] : '';
        $examEndDate = ( ! empty( $searchHelper->_filter['exam_end_date'] )) ? $searchHelper->_filter['exam_end_date'] : '';

        $this->addSearch( $search )
             ->addEqualIdFilter( 'school_id', $schoolId )
             ->addLikeFilter( 'exam_name', $examName )
             ->addStartDateEndDateFilter( 'created_at', $signUpStartDate, $signUpEndDate )
             ->addStartDateEndDateFilter( 'exam_date', $examStartDate, $examEndDate );

        return $this;
    }

    public function saveRecord( $data )
    {
        $examId = 0;
        $schoolId = $data['school_id'];
        if ( ! empty( $data['exam_id'] ) && $data['exam_id'] > 0 ) {
            $examId = $data['exam_id'];
        }
        $tableName = $this->getTableName();
        $rules = ['exam_name' => ['required',
                                  'unique:' . $tableName . ',exam_name,' . $examId . ',exam_id,school_id, ' . $schoolId],
                  'school_id' => ['required'],
                  'exam_date' => ['required'],];

        $validationResult = $this->validateData( $rules, $data );

        if ( $validationResult['success'] == false ) {
            $result['success'] = false;
            $result['message'] = $validationResult['message'];
            return $result;
        }

        if ( $examId > 0 ) {
            $classes = self::findOrFail( $data['exam_id'] );
            $classes->update( $data );
            $result['exam_id'] = $classes->exam_id;
        } else {
            $classes = self::create( $data );
            $result['exam_id'] = $classes->exam_id;
        }
        $result['success'] = true;
        $result['message'] = "Exam saved successfully.";
        return $result;
    }
}
