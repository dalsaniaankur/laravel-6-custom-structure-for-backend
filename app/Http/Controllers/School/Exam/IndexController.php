<?php

namespace App\Http\Controllers\School\Exam;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Classes\Models\Exam\Exam;
use App\Classes\Helpers\Exam\Helper;
use App\Classes\Common\Common;
use App\Classes\Helpers\SearchHelper;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use App\Classes\Models\User\User;

class IndexController extends Controller
{
    protected $examObj;
    protected $userObj;
    protected $_helper;

    public function __construct( Exam $examModel )
    {
        $this->examObj = $examModel;
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

        $filterList['exam_name'] = $paginationList['exam_name'] = Common::getFilterValue($data,'exam_name');
        $filterList['exam_start_date'] = $paginationList['start_date'] = Common::getFilterValue($data,'start_date');
        $filterList['exam_end_date'] = $paginationList['end_date'] = Common::getFilterValue($data,'end_date');
        $filterList['school_id'] = $schoolId = Auth::guard('school')->user()->user_id;
        $schoolId = Auth::guard('school')->user()->user_id;

        $searchHelper = new SearchHelper( $page, $perPage, ['*'], $filterList, [$filterList['sorted_by'] => $filterList['sorted_order']] );
        $exams = $this->examObj->getList( $searchHelper );
        $totalRecordCount = $this->examObj->getListTotalCount( $searchHelper );
        $paginationBasePath = Common::getPaginationBasePath( $paginationList);
        $paging = $this->examObj->preparePagination( $totalRecordCount, $paginationBasePath, $searchHelper );

        $filterUrl = "school/exams";
        $formFilterList[] = Common::setFormFieldArray('hidden','sorted_by','',$filterList['sorted_by'],'','_sorted_by','');
        $formFilterList[] = Common::setFormFieldArray('hidden','sorted_order','',$filterList['sorted_order'],'','_sorted_order','');
        $formFilterList[] = Common::setFormFieldArray('text','exam_name','Exam',$filterList['exam_name']);
        $formFilterList[] = Common::setFormFieldArray('datepicker','start_date','Start date',$filterList['exam_start_date'],[],'start_date');
        $formFilterList[] = Common::setFormFieldArray('datepicker','end_date','End date',$filterList['exam_end_date'],[],'end_date');

        $tableTh[] = Common::setTHArray(trans('admin.user.fields.id'),'exam_id','listing_id');
        $tableTh[] = Common::setTHArray("EXAM",'exam_name','');
        $tableTh[] = Common::setTHArray("SCHOOL");
        $tableTh[] = Common::setTHArray("EXAM DATE");
        $tableTh[] = Common::setTHArray("ADDED");
        $tableTh[] = Common::setTHArray(trans('admin.user.fields.action'),'','action');

        $addFormFieldList[] = Common::setFormFieldArray('hidden','exam_id','',0,'','','');
        $addFormFieldList[] = Common::setFormFieldArray('hidden','school_id','',$schoolId,'','','');
        $addFormFieldList[] = Common::setFormFieldArray('text','exam_name','','','','','','Exam Name',['required' => '','data-field-label' => 'Exam name']);
        $addFormFieldList[] = Common::setFormFieldArray('datepicker','exam_date','','','','','','Exam Date',['required' => '', 'data-field-label' => 'Exam date']);

        return view( 'school.exam.index', compact( 'exams', 'paging', 'totalRecordCount', 'recordStart','filterList','filterUrl','formFilterList','tableTh','schoolId','addFormFieldList' ) );
    }

    public function delete( Request $request )
    {
        $data = $request->all();
        $id = $data['id'];
        $this->examObj->deleteRecord($request,$id, "Exam");
        return Redirect::back();
    }

    public function saveAjax( Request $request )
    {
        $data = $request->all();
        $data['created_user_id'] = Auth::guard('school')->getUser()->user_id;
        $results = $this->examObj->saveRecord( $data );
        if ( ! empty( $results['exam_id'] ) && $results['exam_id'] > 0 ) {
            return response()->json( $results );
        } else {
            $response = [];
            $response['success'] = false;
            $response['message'] = Common::setAjaxValidationMessage($results['message']);
            return response()->json( $response );
        }
    }

    public function getDataForEditModel( Request $request )
    {
        $data = $request->all();
        $response['success'] = false;
        $response['data'] = $this->examObj->getDateById( $data['exam_id'] );;
        if(!empty($response['data'])){ $response['success'] = false; }
        return response()->json( $response );
    }
}
