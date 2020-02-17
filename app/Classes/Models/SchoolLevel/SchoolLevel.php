<?php
namespace App\Classes\Models\SchoolLevel;
use App\Classes\Models\BaseModel;
use DB;

class SchoolLevel extends BaseModel
{
    protected $table = 'ka_school_level';
    protected $primaryKey = 'school_level_id';
    protected $entity='school_level';
	protected $searchableColumns=['school_level_name'];
	protected $fillable = ['school_level_name'];
    public $timestamps = false;

    public function __construct(array $attributes = [])
    {
        $this->bootIfNotBooted();
        $this->syncOriginal();
        $this->fill($attributes);
    }

    public function getDropDown($prepend ='', $prependId = 0)
    {
        $return = $this->setSelect()
                    ->addSortOrder( ['school_level_name' => 'asc'] )
                    ->get()
                    ->pluck( 'school_level_name', 'school_level_id' );

        if(!empty($prepend)){

            $return->prepend( $prepend, $prependId );
        }

        return $return;
   }

   public function getDateById( $levelId ) {
        $return = $this->setSelect()
                       ->addLevelIdFilter( $levelId )
                       ->get()
                       ->first();
        return $return;
    }

	public function addLevelIdFilter( $levelId = 0 )
    {
        if ( ! empty( $levelId ) && $levelId > 0 ) {
            $tableName = $this->getTableName();
            $this->queryBuilder->where( $tableName . '.school_level_id', '=', $levelId );
        }
        return $this;
    }

    public function addSchoolLevelNameLikeFilter( $schoolLevelName = '' )
    {
        if ( ! empty( trim( $schoolLevelName ) ) ) {
            $tableName = $this->getTableName();
            $this->queryBuilder->where( $tableName . '.school_level_name', 'like', '%' . $schoolLevelName . '%' );
        }
        return $this;
    }

    public function getList( $searchHelper )
    {
        $this->reset();
        $perPage = ($searchHelper->_perPage == 0) ? $this->_helper->getConfigPerPageRecord() : $searchHelper->_perPage;

        $search = ( ! empty( $searchHelper->_filter['search'] )) ? $searchHelper->_filter['search'] : '';
        $schoolLevelName = ( ! empty( $searchHelper->_filter['school_level_name'] )) ? $searchHelper->_filter['school_level_name'] : '';

        $list = $this->setSelect()
                     ->addSearch( $search )
                     ->addSchoolLevelNameLikeFilter( $schoolLevelName )
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
        $schoolLevelName = ( ! empty( $searchHelper->_filter['allergy_name'] )) ? $searchHelper->_filter['allergy_name'] : '';

        $count = $this->setSelect()
                      ->addSearch( $search )
                      ->addSchoolLevelNameLikeFilter( $schoolLevelName )
                      ->addSortOrder( $searchHelper->_sortOrder )
                      ->addGroupBy( $searchHelper->_groupBy )
                      ->get()
                      ->count();

        return $count;
    }

    public function saveRecord( $data )
    {
        $schoolLevelId = 0;

        if ( ! empty( $data['school_level_id'] ) && $data['school_level_id'] > 0 ) {
            $schoolLevelId = $data['school_level_id'];
        }
        $tableName = $this->getTableName();
        $rules = ['school_level_name' => ['required', 'unique:'.$tableName.',school_level_name,'.$schoolLevelId. ',school_level_id' ]];

        $validationResult = $this->validateData( $rules, $data );

        if ( $validationResult['success'] == false ) {
            $result['success'] = false;
            $result['message'] = $validationResult['message'];
            return $result;
        }

        if ( $schoolLevelId > 0 ) {
            $schoolLevel = self::findOrFail( $data['school_level_id'] );
            $schoolLevel->update( $data );
            $result['school_level_id'] = $schoolLevel->school_level_id;
        } else {
            $schoolLevel = self::create( $data );
            $result['school_level_id'] = $schoolLevel->school_level_id;
        }
        $result['success'] = true;
        $result['message'] = "School level saved successfully.";
        return $result;
    }
}
