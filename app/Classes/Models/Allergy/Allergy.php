<?php

namespace App\Classes\Models\Allergy;

use App\Classes\Models\BaseModel;
use App\Classes\Helpers\Allergy\Helper;

class Allergy extends BaseModel
{
    protected $table = 'ka_allergies';
    protected $primaryKey = 'allergie_id';
    protected $entity = 'allergies';
    protected $searchableColumns = ['allergy_name'];
    protected $fillable = ['allergy_name'];
    protected $_helper;

    public function __construct( array $attributes = [] )
    {
        $this->bootIfNotBooted();
        $this->syncOriginal();
        $this->fill( $attributes );
        $this->_helper = new Helper();
    }

    public function getDropDown( $prepend = '', $prependId = 0 )
    {
        $return = $this->setSelect()
                    ->addSortOrder( ['allergy_name' => 'asc'] )
                    ->get()
                    ->pluck( 'allergy_name', 'allergie_id' );

        if(!empty($prepend)){
            $return->prepend( $prepend, $prependId );
        }

        return $return;

    }

    public function getDateById( $allergieId )
    {
        $return = $this->setSelect()
                       ->addAllergieIdFilter( $allergieId )
                       ->get()
                       ->first();
        return $return;
    }

    public function addAllergyNameLikeFilter( $allergyName = '' )
    {
        if ( ! empty( trim( $allergyName ) ) ) {
            $tableName = $this->getTableName();
            $this->queryBuilder->where( $tableName . '.allergy_name', 'like', '%' . $allergyName . '%' );
        }
        return $this;
    }

    public function addAllergieIdFilter( $allergieId = 0 )
    {
        if ( ! empty( $allergieId ) && $allergieId > 0 ) {
            $tableName = $this->getTableName();
            $this->queryBuilder->where( $tableName . '.allergie_id', '=', $allergieId );
        }
        return $this;
    }

    public function getList( $searchHelper )
    {
        $this->reset();
        $perPage = ($searchHelper->_perPage == 0) ? $this->_helper->getConfigPerPageRecord() : $searchHelper->_perPage;

        $search = ( ! empty( $searchHelper->_filter['search'] )) ? $searchHelper->_filter['search'] : '';
        $allergyName = ( ! empty( $searchHelper->_filter['allergy_name'] )) ? $searchHelper->_filter['allergy_name'] : '';

        $list = $this->setSelect()
                     ->addSearch( $search )
                     ->addAllergyNameLikeFilter( $allergyName )
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
        $allergyName = ( ! empty( $searchHelper->_filter['allergy_name'] )) ? $searchHelper->_filter['allergy_name'] : '';

        $count = $this->setSelect()
                      ->addSearch( $search )
                      ->addAllergyNameLikeFilter( $allergyName )
                      ->addSortOrder( $searchHelper->_sortOrder )
                      ->addGroupBy( $searchHelper->_groupBy )
                      ->get()
                      ->count();

        return $count;
    }

    public function saveRecord( $data )
    {
        $allergieId = 0;
		//$schoolId = $data['school_id'];
        if ( ! empty( $data['allergie_id'] ) && $data['allergie_id'] > 0 ) {
            $allergieId = $data['allergie_id'];
        }
		$tableName = $this->getTableName();
        //$rules = ['allergy_name' => ['required', 'unique:'.$tableName.',allergy_name,'.$allergieId. ',allergie_id,school_id, '.$schoolId ]];
        $rules = ['allergy_name' => ['required', 'unique:'.$tableName.',allergy_name,'.$allergieId. ',allergie_id' ]];

        $validationResult = $this->validateData( $rules, $data );

        if ( $validationResult['success'] == false ) {
            $result['success'] = false;
            $result['message'] = $validationResult['message'];
            return $result;
        }

        if ( $allergieId > 0 ) {
            $classes = self::findOrFail( $data['allergie_id'] );
            $classes->update( $data );
            $result['allergie_id'] = $classes->allergie_id;
        } else {
            $classes = self::create( $data );
            $result['allergie_id'] = $classes->allergie_id;
        }
        $result['success'] = true;
        $result['message'] = "Allergy saved successfully.";
        return $result;
    }


}
