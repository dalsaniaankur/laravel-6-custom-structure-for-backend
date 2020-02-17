<?php

namespace App\Http\Controllers\School\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Classes\Models\User\User;
use App\Classes\Models\StudentFeed\StudentFeed;
use App\Classes\Helpers\User\Helper;
use App\Classes\Common\Common;
use App\Classes\Helpers\SearchHelper;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use App\Classes\Helpers\Roles\Helper as HelperRoles;


class FeedController extends Controller
{
    protected $userObj;   
    protected $studentFeedObj;
    protected $_helper;
    protected $_helperRoles;

    public function __construct( User $userModel )
    {
        $this->userObj = $userModel;       
        $this->_helper = new Helper();
        $this->studentFeedObj = new StudentFeed();
        $this->_helperRoles = new HelperRoles();
    }
   
	
    public function feedDetails(Request $request, $studentId){
        $studentId = Common::getDecryptId($studentId);

        if( $studentId <= 0 ){ return abort(404); }

        $student = $this->userObj->getDateById($studentId);
        if(! Common::isStudent( $student) ){ return abort(404); }

        $sortedBy = ! empty( $request->get( 'sorted_by' ) ) ? $request->get( 'sorted_by' ) : 'feed_date';
        $sortedOrder = ! empty( $request->get( 'sorted_order' ) ) ? $request->get( 'sorted_order' ) : 'DESC';
        $feedDate = ! empty( $request->get( 'feed_date' ) ) ? $request->get( 'feed_date' ) : '';

        $filter = ['user_id' => $studentId,'feed_date' => $feedDate];
        $searchHelper = new SearchHelper( -1, -1, $selectColumns = ['*'], $filter, $sortOrder = [$sortedBy => $sortedOrder] );
        $studentFeeds = $this->studentFeedObj->getList($searchHelper);
        $studentFeedsCount = $this->studentFeedObj->getListTotalCount($searchHelper);
        return view('school.student.feeddetails',compact('sortedOrder', 'student','studentFeeds', 'studentFeedsCount', 'studentId','feedDate' ));
    }
	
	 public function feedDelete( Request $request )
    {
        $data = $request->all();
        if ( empty( $data['id'] ) ) {
            return abort( 404 );
        }
        $isDelete = $this->studentFeedObj->removed( $data['id'] );
        if ( $isDelete ) {
            $request->session()
                    ->flash( 'success', 'Feed deleted successfully.' );
        } else {
            $request->session()
                    ->flash( 'error', 'Feed is not deleted successfully.' );
        }
        return Redirect::back();
    }
	
	public function getDataForEditModel( Request $request ){
		$data = $request->all();
        $results = $this->studentFeedObj->getDateById($data['student_feed_id']);

        $response = array();
        $response['success'] = false;
        $response['message'] = '';

        if(!empty($results['student_feed_id']) && $results['student_feed_id'] > 0) {
            $response['success'] = true;
            $response['message'] = '';
            $response['data'] = $results;
        }
        return response()->json($response);
	}
	
	public function saveAjax( Request $request ){
		$data = $request->all();		
		$data['created_user_id'] = Auth::guard('school')->getUser()->user_id;
        $data['feed_date'] = date( "Y-m-d", strtotime( $data['feed_date'] ) );
        $results = $this->studentFeedObj->saveRecord($data);
        if(!empty($results['student_feed_id']) && $results['student_feed_id'] > 0) {
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
}