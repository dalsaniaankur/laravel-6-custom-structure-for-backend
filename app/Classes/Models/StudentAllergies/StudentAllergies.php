<?php

namespace App\Classes\Models\StudentAllergies;

use App\Classes\Models\BaseModel;
use App\Classes\Helpers\StudentAllergies\Helper;
use App\Classes\Models\Allergy\Allergy;
use App\Classes\Models\User\User;

class StudentAllergies extends BaseModel
{
    protected $table = 'ka_student_allergies';
    protected $primaryKey = 'student_allergie_id';
    protected $entity = 'student_allergie';
    protected $searchableColumns = [];
    protected $fillable = ['user_id',
                           'allergie_id'];
    protected $_helper;

    public function __construct( array $attributes = [] )
    {
        $this->bootIfNotBooted();
        $this->syncOriginal();
        $this->fill( $attributes );
        $this->_helper = new Helper();
    }

    public function allergy()
    {
        return $this->belongsTo( Allergy::class, 'allergie_id', 'allergie_id' );
    }

    public function user()
    {
        return $this->belongsTo( User::class, 'user_id', 'user_id' );
    }

    public function getDateById( $studentAllergieId )
    {
        $return = $this->setSelect()
                       ->addStudentAllergieIdFilter( $studentAllergieId )
                       ->get()
                       ->first();
        return $return;
    }

    public function addStudentAllergieIdFilter( $studentAllergieId = 0 )
    {
        if ( ! empty( $studentAllergieId ) && $studentAllergieId > 0 ) {
            $tableName = $this->getTableName();
            $this->queryBuilder->where( $tableName . '.student_allergie_id', '=', $studentAllergieId );
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

    public function getList( $searchHelper )
    {
        $this->reset();
        $perPage = ($searchHelper->_perPage == 0) ? $this->_helper->getConfigPerPageRecord() : $searchHelper->_perPage;

        $search = ( ! empty( $searchHelper->_filter['search'] )) ? $searchHelper->_filter['search'] : '';
        $userId = ( ! empty( $searchHelper->_filter['user_id'] )) ? $searchHelper->_filter['user_id'] : '';

        $list = $this->setSelect()
                     ->addSearch( $search )
                     ->addUserIdFilter( $userId )
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
		
        $count = $this->setSelect()
                      ->addSearch( $search )
					  ->addUserIdFilter( $userId )
                      ->addSortOrder( $searchHelper->_sortOrder )
                      ->addGroupBy( $searchHelper->_groupBy )
                      ->get()
                      ->count();

        return $count;
    }

    public function saveRecord( $data )
    {
        $studentAllergieId = 0;
        if ( ! empty( $data['student_allergie_id'] ) && $data['student_allergie_id'] > 0 ) {
            $studentAllergieId = $data['student_allergie_id'];
        }
		$tableName = $this->getTableName();
        $userId = $data['user_id'];
        $rules = ['allergie_id' => ['required', 'unique:'.$tableName.',allergie_id,'.$studentAllergieId. ',student_allergie_id,user_id, '.$userId ],
                  'user_id'  => ['required'],];

        $attributeNames = ['allergie_id' => 'allergy'];
        $validationResult = $this->validateData( $rules, $data,[],$attributeNames );

        if ( $validationResult['success'] == false ) {
            $result['success'] = false;
            $result['message'] = $validationResult['message'];
            return $result;
        }

        if ( $studentAllergieId > 0 ) {
            $classes = self::findOrFail( $data['student_allergie_id'] );
            $classes->update( $data );
            $result['student_allergie_id'] = $classes->student_allergie_id;
        } else {
            $classes = self::create( $data );
            $result['student_allergie_id'] = $classes->student_allergie_id;
        }
        $result['success'] = true;
        $result['message'] = "Allergy saved successfully.";
        return $result;
    }


}
