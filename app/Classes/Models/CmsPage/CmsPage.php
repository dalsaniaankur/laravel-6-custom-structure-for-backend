<?php

namespace App\Classes\Models\CmsPage;

use App\Classes\Common\Common;
use App\Classes\Models\BaseModel;
use App\Classes\Helpers\CmsPage\Helper;

class CmsPage extends BaseModel
{
    protected $table = 'ka_cms_page';
    protected $primaryKey = 'page_id';

    protected $entity = 'cms_page';
    protected $searchableColumns = [];
    protected $fillable = ['content','image_path'];
    protected $_helper;

    public function __construct( array $attributes = [] )
    {
        $this->bootIfNotBooted();
        $this->syncOriginal();
        $this->fill( $attributes );
        $this->_helper = new Helper();
    }

    public function setContentAttribute( $value )
    {
        $this->attributes['content'] =  stripslashes($value) ;
    }

    public function getDateById( $pageId ){

        $return = $this->setSelect()
                       ->addPageIdFilter( $pageId )
                       ->get()
                       ->first();
        return $return;
    }

    public function addPageIdFilter( $pageId = 0 )
    {
        if ( !empty($pageId) && $pageId > 0) {
            $tableName = $this->getTableName();
            $this->queryBuilder->where( $tableName.'.page_id','=' ,$pageId );
        }
        return $this;
    }

    public function getList($searchHelper, $search =''){

        $this->reset();
        $perPage = ($searchHelper->_perPage == 0) ? $this->_helper->getConfigPerPageRecord() : $searchHelper->_perPage;

        $list = $this->setSelect()
                     ->addSearch( $search )
                     ->addSortOrder( $searchHelper->_sortOrder )
                     ->addPaging( $searchHelper->_page, $perPage )
                     ->addGroupBy( $searchHelper->_groupBy )
                     ->get($searchHelper->_selectColumns);

        return $list;
    }

    public function getListTotalCount($searchHelper, $search ='')
    {
        $this->reset();
        $count = $this->setSelect()
                      ->addSearch( $search )
                      ->addSortOrder( $searchHelper->_sortOrder )
                      ->addGroupBy( $searchHelper->_groupBy )
                      ->get()
                      ->count();

        return $count;
    }

    public function saveRecord( $data )
    {
        $pageId = 0;
        if ( isset( $data['page_id'] ) && $data['page_id'] != '' && $data['page_id'] > 0) {
            $pageId = $data['page_id'];
        }

        $rules = ['content' => ['required']];

        $validationResult = $this->validateData( $rules, $data);

        if ( $validationResult['success'] == false ) {
            $result['success'] = false;
            $result['message'] = $validationResult['message'];
            return $result;
        }

        if ( ! empty( $data['image'] ) ) {
            $filePath = $this->_helper->getImagePath();
            $data['image_path'] = Common::fileUpload( $filePath, $data['image'] );
        }

        if ( $pageId > 0 ) {
            $cmsPage = self::findOrFail( $data['page_id'] );

            /* Delete Image */
            if ( ! empty( $data['image_path'] ) ) {
                Common::deleteFile( $cmsPage->image_path );
            }

            $cmsPage->update( $data );
            $result['page_id'] = $cmsPage->page_id;
        } else {
            $cmsPage = self::create( $data );
            $result['page_id'] = $cmsPage->page_id;
        }
        $result['success'] = true;
        $result['message'] = "Cms page saved successfully.";
        return $result;
    }
}
