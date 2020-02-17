<?php

namespace App\Classes\Models\ExamResult;

use App\Classes\Models\BaseModel;
use App\Classes\Helpers\ExamResult\Helper;
use App\Classes\Helpers\SearchHelper;
use App\Classes\Models\Exam\Exam;
use App\Classes\Models\User\User;

class ExamResult extends BaseModel
{
    protected $table = 'ka_exam_result';
    protected $primaryKey = 'exam_result_id';
    protected $entity = 'exam_result';
    protected $searchableColumns = [];
    protected $fillable = ['exam_id',
                           'user_id',
                           'subject',
                           'percent',
                           'created_user_id',
                           'exam_date'];
    protected $_helper;

    public function __construct( array $attributes = [] )
    {
        $this->bootIfNotBooted();
        $this->syncOriginal();
        $this->fill( $attributes );
        $this->_helper = new Helper();
    }

    public function exam()
    {
        return $this->belongsTo( Exam::class, 'exam_id', 'exam_id' );
    }

    public function created_user()
    {
        return $this->belongsTo( User::class, 'created_user_id', 'user_id' );
    }

    public function getDateById( $examResultId )
    {
        $return = $this->setSelect()
                       ->addExamResultIdFilter( $examResultId )
                       ->get()
                       ->first();
        return $return;
    }

    public function addExamResultIdFilter( $examResultId = 0 )
    {
        if ( ! empty( $examResultId ) && $examResultId > 0 ) {
            $tableName = $this->getTableName();
            $this->queryBuilder->where( $tableName . '.exam_result_id', '=', $examResultId );
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

    public function addExamIdFilter( $examId = 0 )
    {
        if ( ! empty( $examId ) && $examId > 0 ) {
            $tableName = $this->getTableName();
            $this->queryBuilder->where( $tableName . '.exam_id', '=', $examId );
        }
        return $this;
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

    public function addExamDateFilter( $examDate = '' )
    {
        $tableName = $this->getTableName();
        if ( ! empty( $examDate ) ) {
            $examDate = date( "Y-m-d", strtotime( $examDate ) );
            $this->queryBuilder->whereDate( $tableName . '.exam_date', '=', "$examDate" );
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
        $userId = ( ! empty( $searchHelper->_filter['user_id'] )) ? $searchHelper->_filter['user_id'] : 0;
        $examId = ( ! empty( $searchHelper->_filter['exam_id'] )) ? $searchHelper->_filter['exam_id'] : 0;
        $examDate = ( ! empty( $searchHelper->_filter['exam_date'] )) ? $searchHelper->_filter['exam_date'] : '';

        $list = $this->setSelect()
                     ->addSearch( $search )
                     ->addUserIdFilter( $userId )
                     ->addExamIdFilter( $examId )
                     ->addExamDateFilter( $examDate )
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
        $userId = ( ! empty( $searchHelper->_filter['user_id'] )) ? $searchHelper->_filter['user_id'] : 0;
        $examId = ( ! empty( $searchHelper->_filter['exam_id'] )) ? $searchHelper->_filter['exam_id'] : 0;
        $examDate = ( ! empty( $searchHelper->_filter['exam_date'] )) ? $searchHelper->_filter['exam_date'] : '';

        $count = $this->setSelect()
                      ->addSearch( $search )
                      ->addUserIdFilter( $userId )
                      ->addExamIdFilter( $examId )
                      ->addExamDateFilter( $examDate )
                      ->addCreatedDateFilter( $signUpStartDate, $signUpEndDate )
                      ->addSortOrder( $searchHelper->_sortOrder )
                      ->addGroupBy( $searchHelper->_groupBy )
                      ->get()
                      ->count();

        return $count;
    }

    public function getExamList( $examId, $userId, $examDate )
    {
        $filter = ['exam_id'   => $examId,
                   'user_id'   => $userId,
                   'exam_date' => $examDate];
        $searchHelper = new SearchHelper( -1, -1, $selectColumns = ['*'], $filter, $sortOrder = ['subject' => 'ASC'] );
        return $this->getList( $searchHelper );
    }

    public function saveRecord( $data )
    {
        $examResultId = 0;
        if ( ! empty( $data['exam_result_id'] ) && $data['exam_result_id'] > 0 ) {
            $examResultId = $data['exam_result_id'];
        }
        $tableName = $this->getTableName();
		$rules = ['exam_id' => ['required'],
				  'user_id' => ['required'],	
				  'subject' => ['required'],	
				  'percent' => ['required'],	
				];
        $validationResult = $this->validateData( $rules, $data );

        if ( $validationResult['success'] == false ) {
            $result['success'] = false;
            $result['message'] = $validationResult['message'];
            return $result;
        }

        if ( $examResultId > 0 ) {
            $examResult = self::findOrFail( $data['exam_result_id'] );
            $examResult->update( $data );
            $result['exam_result_id'] = $examResult->exam_result_id;
        } else {
            $examResult = self::create( $data );
            $result['exam_result_id'] = $examResult->exam_result_id;
        }
        $result['success'] = true;
        $result['message'] = "Exam result saved successfully.";
        return $result;
    }
}