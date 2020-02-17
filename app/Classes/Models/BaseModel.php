<?php
namespace App\Classes\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Classes\Common\Common;

class BaseModel extends Model
{
    protected $queryBuilder;
    protected $modelObj;
    protected $joinTables=array();
    protected $entity='';
    protected $searchableColumns=[];

    public function reset()
    {
        $this->queryBuilder='';
        return $this;
    }

    public function setSelect(){

        $this->queryBuilder=$this->query();
        return $this;
    }

    public function getEntity()
    {
        return $this->entity;
    }

    public function getSearchableColumns()
    {
        return $this->searchableColumns;
    }

    public function addSearch($search='')
    {
        $search=trim($search);
        if(!empty($search)) {
            $searchKeyword = explode( " ", $search );
            $searchKeywordArray = [];
            if ( count( $searchKeyword ) > 0 ) {
                foreach ( $searchKeyword as $keyword ) {
                    $keyword = trim( $keyword );
                    if(!empty($keyword)) {
                        $searchKeywordArray[] = trim( $keyword );
                    }
                }
                array_unique( $searchKeywordArray );
            }

            if ( count( $searchKeywordArray ) > 0 ) {

                $this->queryBuilder->where( function ( $query ) use ( $searchKeywordArray ) {
                    $i = 0;
                    foreach ( $searchKeywordArray as $keyword ) { //first table
                        if ( $i == 0 ) {
                            $query->where( function ( $query ) use ( $keyword ) {
                                $j = 0;
                                foreach ( $this->searchableColumns as $column ) {
                                    if ( $j == 0 )
                                        $query->where( $this->table . '.' . $column, 'like', '%' . $keyword . '%' ); else
                                        $query->orWhere( $this->table . '.' . $column, 'like', '%' . $keyword . '%' );
                                    $j++;
                                }
                            } );
                        } else {
                            $query->orWhere( function ( $query ) use ( $keyword ) {
                                $j = 0;
                                foreach ( $this->searchableColumns as $column ) {
                                    if ( $j == 0 )
                                        $query->where( $this->table . '.' . $column, 'like', '%' . $keyword . '%' ); else
                                        $query->orWhere( $this->table . '.' . $column, 'like', '%' . $keyword . '%' );
                                    $j++;
                                }
                            } );
                        }
                        $i++;
                    }
                    if ( count( $this->joinTables ) > 0 ) {
                        foreach ( $this->joinTables as $tableRow ) {
                            if ( $tableRow['searchable'] ) {
                                foreach ( $searchKeywordArray as $keyword ) {
                                    if ( $i == 0 ) {
                                        $query->where( function ( $query ) use ( $keyword, $tableRow ) {
                                            $j = 0;
                                            foreach ( $tableRow['searchableColumns'] as $column ) {
                                                if ( $j == 0 )
                                                    $query->where( $tableRow['table'] . '.' . $column, 'like', '%' . $keyword . '%' ); else
                                                    $query->orWhere( $tableRow['table'] . '.' . $column, 'like', '%' . $keyword . '%' );
                                                $j++;
                                            }
                                        } );
                                    } else {
                                        $query->orWhere( function ( $query ) use ( $keyword, $tableRow ) {
                                            $j = 0;
                                            foreach ( $tableRow['searchableColumns'] as $column ) {
                                                if ( $j == 0 )
                                                    $query->where( $tableRow['table'] . '.' . $column, 'like', '%' . $keyword . '%' ); else
                                                    $query->orWhere( $tableRow['table'] . '.' . $column, 'like', '%' . $keyword . '%' );
                                                $j++;
                                            }
                                        } );
                                    }
                                    $i++;
                                }
                            }
                        }
                    }
                } );
            }
        }
        return $this;
    }

    public function get( $selectColumns = ['*'] ){

        foreach ($selectColumns as $columnsKey => $columnsValue){
            $selectColumns[$columnsKey] = $this->setFieldNameWithTableName($columnsValue);
        }
        return $this->queryBuilder->get($selectColumns);
    }

    public function sum( $selectColumns ){

        foreach ($selectColumns as $columnsKey => $columnsValue){
            $selectColumns[$columnsKey] = $this->setFieldNameWithTableName($columnsValue);
        }
        return $this->queryBuilder->sum($selectColumns[0]);
    }

    public function addSortOrder( $sortOrderList = [] )
    {
        if ( ! empty( $sortOrderList ) ) {

            foreach ( $sortOrderList as $fieldName => $sortOrder ) {

                $fieldName = $this->setFieldNameWithTableName($fieldName);

                $this->queryBuilder->orderBy( $fieldName, $sortOrder );
            }
        }
        return $this;
    }

    public function setFieldNameWithTableName($fieldName){

        $tableName = $this->getTableName();
        if(!strpos($fieldName,".") > 0){
            return $tableName.'.'.$fieldName;
        }
        return $fieldName;
    }

    public function addGroupBy( $groupByList = [] )
    {
        if ( ! empty( $groupByList ) ) {

            foreach ( $groupByList as $fieldName ) {

                $fieldName = $this->setFieldNameWithTableName($fieldName);

                $this->queryBuilder->groupBy( $fieldName );
            }
        }
        return $this;
    }

    public function addPaging($page = 0,$perPage){

        if($page != -1 || $page != '-1') {
            $limit = (($page > 0) ? ($page - 1) : $page) * $perPage;
            $this->queryBuilder->skip($limit)->take($perPage);
        }

        return $this;
    }

    public function validateData($rules,$data, $messages = [], $attributeNames = [])
    {
        $validator = '';
        $validationResult=array();
        $validationResult['success']=false;
        $validationResult['message']=array();

        $validator = \Validator::make($data, $rules, $messages)
                               ->setAttributeNames( $attributeNames );
        if($validator->passes()){
            $validationResult['success']=true;
            return $validationResult;
        }
        $errors = json_decode($validator->errors());
        $validationResult['success']=false;
        $validationResult['message']=$errors;
        return $validationResult;
    }

    public function preparePagination( $totalRecordCount,$paginationBasePath, $searchHelper, $pageName = 'page' ){

        $perPage = ($searchHelper->_perPage == 0) ? $this->_helper->getConfigPerPageRecord() : $searchHelper->_perPage;
        $pageHelper = new \App\Classes\PageHelper( $perPage, $pageName );
        $pageHelper->set_total( $totalRecordCount );
        $pageHelper->page_links( $paginationBasePath );
        return $pageHelper->page_links( $paginationBasePath );
    }

    public function getTableName(){
        return $this->table;
    }

    public function getPrimaryKey()
    {
        return $this->primaryKey;
    }

    public function getFileField()
    {
        return $this->fileFields;
    }

    public function removed( $id ){
        $deleteObj = $this->getDateById( $id );
        if ( ! empty( $deleteObj ) ) {

            /* Delete Image */
            if(!empty($deleteObj->photo)) {
                Common::deleteFile( $deleteObj->photo );
            }

            $delete = $deleteObj->delete();
            return $delete;
        }
        return false;
    }

    public function getDropDown( $searchHelper )
    {
        $prependKey = "";
        $prependValue = "";
        $pluckIdField = "";
        $pluckNameField = "";

        if ( isset( $searchHelper->_filter['key_field'] ) ) {
            $pluckIdField = $searchHelper->_filter['key_field'];
            unset( $searchHelper->_filter['key_field'] );
        }
        if ( isset( $searchHelper->_filter['value_field'] ) ) {
            $pluckNameField = $searchHelper->_filter['value_field'];
            unset( $searchHelper->_filter['value_field'] );
        }

        if(empty($pluckIdField)) {
            $pluckIdField = $searchHelper->_selectColumns[0];
        }
        if(empty($pluckNameField)) {
            $pluckNameField = $searchHelper->_selectColumns[1];
        }

        if ( empty( $searchHelper->_sortOrder ) ) {
            $searchHelper->_sortOrder = [$pluckNameField => "asc"];
        }

        if ( isset( $searchHelper->_filter['prepend_key'] ) ) {
            $prependKey = $searchHelper->_filter['prepend_key'];
            unset( $searchHelper->_filter['prepend_key'] );
        }
        if ( isset( $searchHelper->_filter['prepend_value'] ) ) {
            $prependValue = $searchHelper->_filter['prepend_value'];
            unset( $searchHelper->_filter['prepend_value'] );
        }

        $dropdownList = $this->getList( $searchHelper )
                             ->pluck( $pluckNameField, $pluckIdField );

        if ( ! empty( $prependValue ) ) {
            $dropdownList->prepend( $prependValue, $prependKey );
        }
        return $dropdownList;
    }

    /*$filter = ['school_id' => $schoolId, 'prepend_key' => '','prepend_value' => 'Select grade'];
    $searchHelperForGradeDropDown = new SearchHelper( -1, -1, ['grade_id','grade_name'] , $filter );
    $gradeDropDown = $this->gradeObj->getDropDown1($searchHelperForGradeDropDown);*/

    public function addEqualStringFilter( $fieldName, $value = '' )
    {
        $value = trim( $value );
        if ( ! empty( $value ) ) {
            $fieldName = $this->setFieldNameWithTableName( $fieldName );
            $this->queryBuilder->where( $fieldName, '=', $value );
        }
        return $this;
    }

    public function addLikeFilter( $fieldName, $value = '' )
    {
        $value = trim( $value );
        if ( ! empty( $value ) ) {
            $fieldName = $this->setFieldNameWithTableName( $fieldName );
            $this->queryBuilder->where( $fieldName, 'like', '%' . $value . '%' );
        }
        return $this;
    }

    public function addEqualIdFilter( $fieldName, $value = -1 )
    {
        if ( ! empty( $value ) && $value > 0 ) {
            $fieldName = $this->setFieldNameWithTableName( $fieldName );
            $this->queryBuilder->where( $fieldName, '=', trim( $value ) );
        }
        return $this;
    }

    public function addInIdFilter( $fieldName, $idArray = [] )
    {
        if ( ! empty( $idArray ) ) {
            $fieldName = $this->setFieldNameWithTableName( $fieldName );
            $this->queryBuilder->whereIn( $fieldName, $idArray );
        }
        return $this;
    }

    public function addNotInIdFilter( $fieldName, $idArray = [] )
    {
        if ( ! empty( $idArray ) ) {
            $fieldName = $this->setFieldNameWithTableName( $fieldName );
            $this->queryBuilder->whereNotIn( $fieldName, $idArray );
        }
        return $this;
    }

    public function addStartDateEndDateFilter( $fieldName, $startDate = '', $endDate = '' )
    {
        $fieldName = $this->setFieldNameWithTableName( $fieldName );
        if ( ! empty( $startDate ) ) {
            $startDate = date( "Y-m-d", strtotime( $startDate ) );
            $this->queryBuilder->whereDate( $fieldName, '>=', "$startDate" );
        }

        if ( ! empty( $endDate ) ) {
            $endDate = date( "Y-m-d", strtotime( $endDate ) );
            $this->queryBuilder->whereDate( $fieldName, '<=', "$endDate" );
        }

        return $this;
    }

    public function addStatusFilter( $fieldName, $value = -1 )
    {
        if ( $value != '-1' && $value != -1 ) {
            $fieldName = $this->setFieldNameWithTableName( $fieldName );
            $this->queryBuilder->where( $fieldName, '=', trim( $value ) );
        }
        return $this;
    }

    public function leftJoinMode( $modelObj, $currentModelKey='', $joinModelKey='', $tableAlias = '', $searchable = false )
    {
        $tableName = $modelObj->getTableName();
        if(!empty($tableAlias)){
            $tableName = $tableName . ' as '.$tableAlias;
        }
        if(empty($tableAlias)){
            $tableAlias = $modelObj->getTableName();
        }
        if(empty($currentModelKey)) {
            $currentModelKey = $this->getPrimaryKey();
        }
        if(empty($joinModelKey)) {
            $joinModelKey = $modelObj->getPrimaryKey();
        }

        $searchableColumns = $modelObj->getSearchableColumns();
        $this->joinTables[] = ['table'             => $tableName,
                               'searchable'        => $searchable,
                               'searchableColumns' => $searchableColumns];
        $this->queryBuilder->leftJoin( $tableName, function ( $join ) use ( $tableName, $tableAlias, $currentModelKey, $joinModelKey ) {

            $join->on( $this->getTableName().'.'.$currentModelKey, '=', $tableAlias.'.'.$joinModelKey );

        });
        return $this;
    }

    public function joinModel( $modelObj, $currentModelKey='', $joinModelKey='', $tableAlias = '', $searchable = false )
    {
        $tableName = $modelObj->getTableName();
        if(!empty($tableAlias)){
            $tableName = $tableName . ' as '.$tableAlias;
        }
        if(empty($tableAlias)){
            $tableAlias = $modelObj->getTableName();
        }
        if(empty($currentModelKey)) {
            $currentModelKey = $this->getPrimaryKey();
        }
        if(empty($joinModelKey)) {
            $joinModelKey = $modelObj->getPrimaryKey();
        }

        $searchableColumns = $modelObj->getSearchableColumns();
        $this->joinTables[] = ['table'             => $tableName,
                               'searchable'        => $searchable,
                               'searchableColumns' => $searchableColumns];
        $this->queryBuilder->leftJoin( $tableName, function ( $join ) use ( $tableName, $tableAlias, $currentModelKey, $joinModelKey ) {

            $join->on( $this->getTableName().'.'.$currentModelKey, '=', $tableAlias.'.'.$joinModelKey );

        });
        return $this;
    }

    public function addJoinsAndFilters( $searchHelper )
    {
        $search = ( ! empty( $searchHelper->_filter['search'] )) ? $searchHelper->_filter['search'] : '';
        $this->addSearch( $search );

        return $this;
    }

    public function getList( $searchHelper )
    {
        $this->reset();
        $perPage = ($searchHelper->_perPage == 0) ? $this->_helper->getConfigPerPageRecord() : $searchHelper->_perPage;
        $list = $this->setSelect()
                     ->addJoinsAndFilters( $searchHelper )
                     ->addSortOrder( $searchHelper->_sortOrder )
                     ->addPaging( $searchHelper->_page, $perPage )
                     ->addGroupBy( $searchHelper->_groupBy )
                     ->get( $searchHelper->_selectColumns );
        return $list;
    }

    public function getListTotalCount( $searchHelper )
    {
        $this->reset();
        return $this->setSelect()
                    ->addJoinsAndFilters( $searchHelper )
                    ->addSortOrder( $searchHelper->_sortOrder )
                    ->addGroupBy( $searchHelper->_groupBy )
                    ->get()
                    ->count();
    }

    public function getDateById( $id )
    {
        return $this->setSelect()
                    ->addEqualIdFilter( $this->primaryKey, $id )
                    ->get()
                    ->first();
    }

    public function deleteRecord( $request, $idList, $moduleName )
    {
        if ( empty( $idList ) || $idList == 0 ) {
            return abort( 404 );
        }

        if ( ! is_array( $idList ) ) {
            $idList = [$idList];
        }
        foreach ( $idList as $idKey => $id ){
            $isDelete = $this->removed( $id );
            if (! $isDelete ) {
                $request->session()->flash( 'error', $moduleName.' is not deleted successfully.' );
                return;
            }
        }
        $request->session()->flash( 'success', $moduleName.' deleted successfully.' );
    }
}
