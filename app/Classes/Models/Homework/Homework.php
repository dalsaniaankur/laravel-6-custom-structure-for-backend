<?php

namespace App\Classes\Models\Homework;

use App\Classes\Models\BaseModel;
use App\Classes\Helpers\Homework\Helper;
use App\Classes\Helpers\SearchHelper;
use App\Classes\Models\User\User;
use App\Classes\Common\Common;

class Homework extends BaseModel
{
    protected $table = 'ka_homework';
    protected $primaryKey = 'homework_id';
    protected $entity = 'homework';
    protected $searchableColumns = ['content'];
    protected $fillable = ['class_id',
                           'created_user_id',
                           'school_id',
                           'content',
                           'photo',
						   'homework_date'];
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

    public function getDateById( $homeworkId )
    {
        $return = $this->setSelect()
                       ->addHomeworkIdFilter( $homeworkId )
                       ->get()
                       ->first();
        return $return;
    }

    public function addHomeworkIdFilter( $homeworkId = 0 )
    {
        if ( ! empty( $homeworkId ) && $homeworkId > 0 ) {
            $tableName = $this->getTableName();
            $this->queryBuilder->where( $tableName . '.homework_id', '=', $homeworkId );
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

	public function addClassIdFilter( $classId = 0 )
    {
        if ( ! empty( $classId ) && $classId > 0 ) {
            $tableName = $this->getTableName();
            $this->queryBuilder->where( $tableName . '.class_id', '=', $classId );
        }
        return $this;
    }
	
    public function addHomeworkLikeFilter( $examName )
    {
        if ( ! empty( $examName ) ) {
            $tableName = $this->getTableName();
            $this->queryBuilder->where( $tableName . '.content', 'like', '%' . $examName . '%' );
        }
        return $this;
    }


    public function addCreatedDateFilter( $startDate = '', $endDate = '' )
    {
        $tableName = $this->getTableName();
        if ( ! empty( $startDate ) ) {
            $startDate = date( "Y-m-d", strtotime( $startDate ) );
            $this->queryBuilder->whereDate( $tableName . '.homework_date', '>=', "$startDate" );
        }

        if ( ! empty( $endDate ) ) {
            $endDate = date( "Y-m-d", strtotime( $endDate ) );
            $this->queryBuilder->whereDate( $tableName . '.homework_date', '<=', "$endDate" );
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
        $classId = ( ! empty( $searchHelper->_filter['class_id'] )) ? $searchHelper->_filter['class_id'] : 0;
        $examName = ( ! empty( $searchHelper->_filter['content'] )) ? $searchHelper->_filter['content'] : '';

        $list = $this->setSelect()
                     ->addSearch( $search )
                     ->addSchoolIdFilter( $schoolId )
                     ->addClassIdFilter( $classId )
                     ->addHomeworkLikeFilter( $examName )
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
		$classId = ( ! empty( $searchHelper->_filter['class_id'] )) ? $searchHelper->_filter['class_id'] : 0;
        $examName = ( ! empty( $searchHelper->_filter['content'] )) ? $searchHelper->_filter['content'] : '';

        $count = $this->setSelect()
                      ->addSearch( $search )
                      ->addSchoolIdFilter( $schoolId )
					  ->addClassIdFilter( $classId )
                      ->addHomeworkLikeFilter( $examName )
                      ->addCreatedDateFilter( $signUpStartDate, $signUpEndDate )
                      ->addSortOrder( $searchHelper->_sortOrder )
                      ->addGroupBy( $searchHelper->_groupBy )
                      ->get()
                      ->count();

        return $count;
    }

    public function saveRecord( $data )
    {
        $homeworkId = 0;
        $schoolId = $data['school_id'];
        $classId = $data['class_id'];
        if ( ! empty( $data['homework_id'] ) && $data['homework_id'] > 0 ) {
            $homeworkId = $data['homework_id'];
        }
        $tableName = $this->getTableName();
        $rules = ['homework_date' => ['required',
                                  'unique:' . $tableName . ',homework_date,' . $homeworkId . ',homework_id,school_id, ' . $schoolId.',class_id,'.$classId],
                  'content' => ['required'],];

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
		
        if ( $homeworkId > 0 ) {
            $homework = self::findOrFail( $data['homework_id'] );
			/* Delete Image */
			if ( ! empty( $data['photo'] ) && ! empty( $homework->photo ) ) {
				Common::deleteFile( $homework->photo );
			}
            $homework->update( $data );
            $result['homework_id'] = $homework->homework_id;
        } else {
            $homework = self::create( $data );
            $result['homework_id'] = $homework->homework_id;
        }
        $result['success'] = true;
        $result['message'] = "Homework saved successfully.";
        return $result;
    }
}