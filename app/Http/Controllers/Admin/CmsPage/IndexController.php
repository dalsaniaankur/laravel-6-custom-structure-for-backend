<?php

namespace App\Http\Controllers\Admin\CmsPage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Classes\Models\CmsPage\CmsPage;
use App\Classes\Helpers\CmsPage\Helper;
use App\Classes\Common\Common;
use App\Classes\Helpers\SearchHelper;
use Illuminate\Support\Facades\Redirect;
class IndexController extends Controller
{
    protected $cmsPageObj;
    protected $_helper;
    protected $_searchHelper;

    public function __construct(CmsPage $cmsPageModel){

        $this->cmsPageObj = $cmsPageModel;
        $this->_helper = new Helper();
    }

    public function index(Request $request){

        $data = $request->all();
        $page= !empty($data['page']) ? $data['page'] : 0;
        $sortedBy = !empty($request->get('sorted_by')) ? $request->get('sorted_by') : 'updated_at';
        $sortedOrder = !empty($request->get('sorted_order')) ? $request->get('sorted_order') : 'DESC';
        $perPage = $this->_helper->getConfigPerPageRecord();
        $recordStart = common::getRecordStart($page, $perPage);
        /*$title = !empty($data['title']) ? $data['title'] : "";*/

        $searchHelper = new SearchHelper( $page, $perPage, $selectColumns = ['*'], [], $sortOrder = [$sortedBy => $sortedOrder] );
        $cmsPages = $this->cmsPageObj->getList($searchHelper);
        $totalRecordCount= $this->cmsPageObj->getListTotalCount($searchHelper);
        $paginationBasePath = Common::getPaginationBasePath( [] );
        $paging = $this->cmsPageObj->preparePagination($totalRecordCount,$paginationBasePath,$searchHelper);
        return view('admin.cms_page.index',compact('sortedBy', 'sortedOrder', 'recordStart','cmsPages','paging','totalRecordCount'));
    }

    public function delete(Request $request)
    {
        $data = $request->all();
        if(empty($data['id'])){ return abort(404); }
        $isDelete = $this->cmsPageObj->removed($data['id']);
        if($isDelete){
            $request->session()->flash( 'success', 'Cms page deleted successfully.' );
        }else{
            $request->session()->flash( 'error', 'Cms page is not deleted successfully.' );
        }
        return Redirect::back();
    }

    public function save(Request $request){
        $data = $request->all();
        $results = $this->cmsPageObj->saveRecord($data);
        if(!empty($results['page_id']) && $results['page_id'] > 0) {
            return response()->json($results);
        }else{
            /* Set Validation Message */
            $message = null;
            foreach ( $results['message'] as $key => $value ) {
                if(empty($message)) {
                    $message = $results['message']->{$key}[0];
                    break;
                }
            }
            $response = array();
            $response['success'] = false;
            $response['message'] = $message;
            return response()->json($response);
        }
    }
    public function getDataForEditModel(Request $request){
        $data = $request->all();
        $results = $this->cmsPageObj->getDateById($data['page_id']);

        $response = array();
        $response['success'] = false;
        $response['message'] = '';

        if(!empty($results['page_id']) && $results['page_id'] > 0) {
            $response['success'] = true;
            $response['message'] = '';
            $response['data'] = $results;
        }
        return response()->json($response);
    }
    public function deleteImage(Request $request)
    {
        $data = $request->all();
        if(empty($data['id'])){ return abort(404); }
        $cmsPage = $this->cmsPageObj->getDateById($data['id']);
        Common::deleteFile( $cmsPage->image_path );
        $cmsPage->image_path = "";
        $cmsPage->save();
        $request->session()->flash( 'success', 'Image deleted successfully.' );
        return Redirect::back();
    }

}
