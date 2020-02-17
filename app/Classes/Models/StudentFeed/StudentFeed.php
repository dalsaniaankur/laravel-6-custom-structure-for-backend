<?php

namespace App\Classes\Models\StudentFeed;

use App\Classes\Models\BaseModel;
use App\Classes\Models\User\User;
use App\Classes\Helpers\User\Helper;
use Illuminate\Validation\Rule;

class StudentFeed extends BaseModel
{
    protected $table = 'ka_student_feed';
    protected $primaryKey = 'student_feed_id';
    protected $entity = 'student_feed_id';
    protected $searchableColumns = ['student_feed_id'];
    protected $fillable = ['user_id',
                           'feed_date',
                           'created_user_id',
                           'attendance',
                           'general',
                           'behavior',
                           'food',
                           'health_medical',
                           'extra_curricular',];
    protected $_helper;

    public function __construct( array $attributes = [] )
    {
        $this->bootIfNotBooted();
        $this->syncOriginal();
        $this->fill( $attributes );
        $this->_helper = new Helper();
    }


    public function getDateById( $studentFeedId )
    {
        $return = $this->setSelect()
                       ->addStudentFeedIdFilter( $studentFeedId )
                       ->get()
                       ->first();
        return $return;
    }

    public function addStudentFeedIdFilter( $studentFeedId = 0 )
    {
        if ( ! empty( $studentFeedId ) && $studentFeedId > 0 ) {
            $tableName = $this->getTableName();
            $this->queryBuilder->where( $tableName . '.student_feed_id', '=', $studentFeedId );
        }
        return $this;
    }

    public function getAttendanceStatusAttribute()
    {
        if ( ! empty( $this->attendance ) ) {

            if ( $this->attendance == 1 ) {
                return "Present";
            }

            if ( $this->attendance == 2 ) {
                return "Absent";
            }

            if ( $this->attendance == 3 ) {
                return "Absent with request";
            }
        }
        return "Pending";
    }

    public function createdby()
    {
        return $this->belongsTo( User::class, 'created_user_id', 'user_id' );
    }

    public function addStudentIdFilter( $studentId = 0 )
    {
        if ( ! empty( $studentId ) && $studentId > 0 ) {
            $tableName = $this->getTableName();
            $this->queryBuilder->where( $tableName . '.user_id', '=', $studentId );
        }
        return $this;
    }

    public function addFeedDateFilter( $feedDate = '' )
    {
        $tableName = $this->getTableName();
        if ( ! empty( $feedDate ) ) {
            $feedDate = date( "Y-m-d", strtotime( $feedDate ) );
            $this->queryBuilder->whereDate( $tableName . '.feed_date', '=', "$feedDate" );
        }
        return $this;
    }

    public function getList( $searchHelper )
    {
        $this->reset();
        $perPage = ($searchHelper->_perPage == 0) ? $this->_helper->getConfigPerPageRecord() : $searchHelper->_perPage;

        $search = ( ! empty( $searchHelper->_filter['search'] )) ? $searchHelper->_filter['search'] : '';
        $studentId = ( ! empty( $searchHelper->_filter['user_id'] )) ? $searchHelper->_filter['user_id'] : '';
        $feedDate = ( ! empty( $searchHelper->_filter['feed_date'] )) ? $searchHelper->_filter['feed_date'] : '';

        $list = $this->setSelect()
                     ->addSearch( $search )
                     ->addStudentIdFilter( $studentId )
                     ->addFeedDateFilter( $feedDate )
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
        $studentId = ( ! empty( $searchHelper->_filter['user_id'] )) ? $searchHelper->_filter['user_id'] : '';
        $feedDate = ( ! empty( $searchHelper->_filter['feed_date'] )) ? $searchHelper->_filter['feed_date'] : '';

        $count = $this->setSelect()
                      ->addSearch( $search )
                      ->addStudentIdFilter( $studentId )
                      ->addFeedDateFilter( $feedDate )
                      ->addSortOrder( $searchHelper->_sortOrder )
                      ->addGroupBy( $searchHelper->_groupBy )
                      ->get()
                      ->count();

        return $count;
    }

    public function saveRecord( $data )
    {
        $studentFeedId = 0;
        $userId = $data['user_id'];
        $tableName = $this->getTableName();
        $rules = ['general'   => ['required'],
                  'feed_date' => ['required',
                                  Rule::unique($tableName)->where(function ($query) use($userId) {
                                      $query->where('user_id', $userId);
                                  })]];

        if ( ! empty( $data['student_feed_id'] ) && $data['student_feed_id'] > 0 ) {
            $studentFeedId = $data['student_feed_id'];
            $rules['feed_date'] = ['required',
                                   Rule::unique($tableName)->ignore($studentFeedId,'student_feed_id')->where(function ($query) use($userId) {
                                       $query->where('user_id', $userId);
                                   })];
        }

        $validationResult = $this->validateData( $rules, $data );

        if ( $validationResult['success'] == false ) {
            $result['success'] = false;
            $result['message'] = $validationResult['message'];
            return $result;
        }

        if ( $studentFeedId > 0 ) {
            $classes = self::findOrFail( $data['student_feed_id'] );
            $classes->update( $data );
            $result['student_feed_id'] = $classes->student_feed_id;
        } else {
            $classes = self::create( $data );
            $result['student_feed_id'] = $classes->student_feed_id;
        }
        $result['success'] = true;
        $result['message'] = "Student Feed saved successfully.";
        return $result;
    }
}
