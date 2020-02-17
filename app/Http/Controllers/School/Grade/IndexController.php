<?php

namespace App\Http\Controllers\School\Grade;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Classes\Models\Grade\Grade;
use App\Classes\Helpers\Grade\Helper;
use App\Classes\Common\Common;
use App\Classes\Helpers\SearchHelper;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use App\Classes\Models\User\User;

class IndexController extends Controller
{
    protected $gradeObj;
    protected $userObj;
    protected $_helper;

    public function __construct( Grade $gradeModel )
    {
        $this->gradeObj = $gradeModel;
        $this->userObj = new User();
        $this->_helper = new Helper();
    }

    public function index( Request $request )
    {
        $data = $request->all();
        $filterList = [];
        $paginationList = [];

        $page = ! empty( $data['page'] ) ? $data['page'] : 0;
        $perPage = $this->_helper->getConfigPerPageRecord();
        $recordStart = common::getRecordStart( $page, $perPage );

        $filterList['sorted_by'] = $paginationList['sorted_by'] = Common::getFilterValue($data,'sorted_by','updated_at');
        $filterList['sorted_order'] = $paginationList['sorted_order'] = Common::getFilterValue($data,'sorted_order','DESC');

        $filterList['grade_name'] = $paginationList['grade_name'] = Common::getFilterValue($data,'grade_name');
        $filterList['created_start_date'] = $paginationList['created_start_date'] = Common::getFilterValue($data,'created_start_date');
        $filterList['created_end_date'] = $paginationList['created_end_date'] = Common::getFilterValue($data,'created_end_date');
        $filterList['school_id'] = $paginationList['school_id'] = Auth::guard('school')->user()->user_id;
        $schoolId = Auth::guard('school')->user()->user_id;


        $searchHelper = new SearchHelper( $page, $perPage, ['*'], $filterList, [$filterList['sorted_by'] => $filterList['sorted_order']] );
        $grades = $this->gradeObj->getList( $searchHelper );
        $totalRecordCount = $this->gradeObj->getListTotalCount( $searchHelper );
        $paginationBasePath = Common::getPaginationBasePath( $paginationList);
        $paging = $this->gradeObj->preparePagination( $totalRecordCount, $paginationBasePath, $searchHelper );

        $filterUrl = "school/grades";
        $formFilterList[] = Common::setFormFieldArray('hidden','sorted_by','',$filterList['sorted_by'],'','_sorted_by','');
        $formFilterList[] = Common::setFormFieldArray('hidden','sorted_order','',$filterList['sorted_order'],'','_sorted_order','');
        $formFilterList[] = Common::setFormFieldArray('text','grade_name','Grade',$filterList['grade_name']);
        $formFilterList[] = Common::setFormFieldArray('datepicker','created_start_date','Signed up from',$filterList['created_start_date'],[],'start_date');
        $formFilterList[] = Common::setFormFieldArray('datepicker','created_end_date','Signed up to',$filterList['created_end_date'],[],'end_date');

        $tableTh[] = Common::setTHArray(trans('admin.user.fields.id'),'grade_id','listing_id');
        $tableTh[] = Common::setTHArray("GRADE",'grade_name','');
        $tableTh[] = Common::setTHArray("ADDED");
        $tableTh[] = Common::setTHArray(trans('admin.user.fields.action'),'','action');

        $addFormFieldList[] = Common::setFormFieldArray('hidden','grade_id','',0,'','','','',['data-is-reset' => '1','data-reset-value' => '0']);
        $addFormFieldList[] = Common::setFormFieldArray('hidden','school_id','',$schoolId,'','','');
        $addFormFieldList[] = Common::setFormFieldArray('text','grade_name','','','','','','Grade Name',['required' => '','data-field-label' => 'Grade name'],'col-lg-12 col-md-12');

        return view( 'school.grade.index', compact( 'grades','paging', 'totalRecordCount', 'recordStart','filterList','filterUrl','formFilterList','tableTh','schoolId','addFormFieldList' ) );
    }

    public function delete( Request $request )
    {
        $data = $request->all();
        $id = $data['id'];
        $this->gradeObj->deleteRecord($request, $id, "Grade");
        return Redirect::back();
    }

    public function saveAjax(Request $request){
        $data = $request->all();
        $results = $this->gradeObj->saveRecord($data);
        if(!empty($results['grade_id']) && $results['grade_id'] > 0) {
            return response()->json($results);
        }else{
            $response = [];
            $response['success'] = false;
            $response['message'] = Common::setAjaxValidationMessage($results['message']);
            return response()->json( $response );
        }
    }

    public function getDataForEditModel(Request $request){

        $data = $request->all();
        $response['success'] = false;
        $response['data'] = $this->gradeObj->getDateById( $data['grade_id'] );;
        if(!empty($response['data'])){ $response['success'] = false; }
        return response()->json( $response );
    }
}
