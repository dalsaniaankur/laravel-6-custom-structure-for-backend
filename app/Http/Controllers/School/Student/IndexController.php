<?php

namespace App\Http\Controllers\School\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Classes\Models\User\User;
use App\Classes\Models\Classes\Classes;
use App\Classes\Helpers\User\Helper;
use App\Classes\Common\Common;
use App\Classes\Helpers\SearchHelper;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use App\Classes\Helpers\Roles\Helper as HelperRoles;
use App\Classes\Models\Grade\Grade;
use App\Classes\Models\Club\Club;
use App\Classes\Models\Allergy\Allergy;
use App\Classes\Models\StudentAllergies\StudentAllergies;
use App\Classes\Models\UserClub\UserClub;
use App\Classes\Models\StudentParent\StudentParent;
use App\Classes\Models\ExamResult\ExamResult;
use App\Classes\Models\Exam\Exam;
use App\Classes\Models\EmailTemplate\EmailTemplate;

class IndexController extends Controller
{
    protected $userObj;
    protected $classesObj;
    protected $gradeObj;
    protected $clubObj;
    protected $allergyObj;
    protected $studentAllergiesObj;
    protected $userClubObj;
    protected $studentParentObj;
    protected $examResultObj;
    protected $examObj;
    protected $emailTemplateObj;
    protected $_helper;
    protected $_helperRoles;

    public function __construct( User $userModel )
    {
        $this->userObj = $userModel;
        $this->classesObj = new Classes();
        $this->gradeObj = new Grade();
        $this->clubObj = new Club();
        $this->allergyObj = new Allergy();
        $this->studentAllergiesObj = new StudentAllergies();
        $this->userClubObj = new UserClub();
        $this->studentParentObj = new StudentParent();
        $this->examObj = new Exam();
        $this->examResultObj = new ExamResult();
        $this->emailTemplateObj = new EmailTemplate();
        $this->_helper = new Helper();
        $this->_helperRoles = new HelperRoles();
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

        $filterList['name'] = $paginationList['name'] = Common::getFilterValue($data,'name');
        $filterList['email'] = $paginationList['email'] = Common::getFilterValue($data,'email');
        $filterList['status'] = $paginationList['status'] = Common::getFilterValue($data,'status',-1);
        $filterList['club_id'] = $paginationList['club_id'] = Common::getFilterValue($data,'club_id',-1);
        $filterList['grade_id'] = $paginationList['grade_id'] = Common::getFilterValue($data,'grade_id',-1);
        $filterList['allergie_id'] = $paginationList['allergie_id'] = Common::getFilterValue($data,'allergie_id',-1);
        $filterList['gender'] = $paginationList['gender'] = Common::getFilterValue($data,'gender');
        $filterList['start_date'] = $paginationList['start_date'] = Common::getFilterValue($data,'start_date');
        $filterList['end_date'] = $paginationList['end_date'] = Common::getFilterValue($data,'end_date');
        $filterList['parent_id'] = $paginationList['parent_id'] = Common::getFilterValue($data,'parent_id');
        $filterList['school_id'] = $paginationList['school_id'] = $schoolId = Auth::guard('school')->user()->user_id;

        $groupBy = [$userTableName = $this->userObj->getTable() . '.user_id'];
        $searchHelper = new SearchHelper( $page, $perPage, ['*'], $filterList, [$filterList['sorted_by'] => $filterList['sorted_order']],$groupBy );
        $students = $this->userObj->getList( $searchHelper );
        $totalRecordCount = $this->userObj->getListTotalCount( $searchHelper );
        $paginationBasePath = Common::getPaginationBasePath( $paginationList );
        $paging = $this->userObj->preparePagination( $totalRecordCount, $paginationBasePath, $searchHelper );

        $statusDropDown = $this->_helper->getStatusDropDownWithAllOption();
        $clubDropDown = $this->clubObj->getDropDown( $prepend = 'Clubs', $schoolId,'' );
        $allergyDropDown = $this->allergyObj->getDropDown( $prepend = 'Allergies','' );
        $clubDropDownForAddEdit = $this->clubObj->getDropDown( '', $schoolId );
        $allergyDropDownForAddEdit = $this->allergyObj->getDropDown();

        $filter = ['school_id' => $schoolId, 'prepend_key' => '','prepend_value' => 'Select grade'];
        $searchHelperForGradeDropDown = new SearchHelper( -1, -1, ['grade_id','grade_name'] , $filter );
        $gradeDropDown = $this->gradeObj->getDropDown($searchHelperForGradeDropDown);

        $classesDropDown = ['' => 'Select class'];
        $parentRoleId = $this->_helperRoles->getParentRoleId();
        $parentDropDown = $this->userObj->getDropDown('Select parent', $parentRoleId, $schoolId, 1,1,0,[],'');

        $filterUrl = "school/students";
        $formFilterList[] = Common::setFormFieldArray('hidden','sorted_by','',$filterList['sorted_by'],'','','sortedBy');
        $formFilterList[] = Common::setFormFieldArray('hidden','sorted_order','',$filterList['sorted_order'],'','','sortedOrder');
        $formFilterList[] = Common::setFormFieldArray('hidden','school_id','',$filterList['school_id'],'','','schoolId');
        $formFilterList[] = Common::setFormFieldArray('hidden','parent_id','',$filterList['parent_id'],'','','parent_id');
        $formFilterList[] = Common::setFormFieldArray('text','name','Names',$filterList['name']);
        $formFilterList[] = Common::setFormFieldArray('email','email','Email',$filterList['email']);
        $formFilterList[] = Common::setFormFieldArray('dropdown','club_id','',$filterList['club_id'],$clubDropDown);
        $formFilterList[] = Common::setFormFieldArray('dropdown','allergie_id','',$filterList['allergie_id'],$allergyDropDown);
        $formFilterList[] = Common::setFormFieldArray('dropdown','grade_id','',$filterList['grade_id'],$gradeDropDown);
        $formFilterList[] = Common::setFormFieldArray('dropdown','gender','',$filterList['gender'],['' => 'Gender','1' => 'Male','2' => 'Female']);
        $formFilterList[] = Common::setFormFieldArray('dropdown','status','',$filterList['status'],$statusDropDown);
        $formFilterList[] = Common::setFormFieldArray('datepicker','start_date','Signed up from',$filterList['start_date'],[],'','start_date');
        $formFilterList[] = Common::setFormFieldArray('datepicker','end_date','Signed up to',$filterList['end_date'],[],'','end_date');

        $tableTh[] = Common::setTHArray(trans('admin.user.fields.id'),'user_id','listing_id');
        $tableTh[] = Common::setTHArray("NAMES",'first_name','first_name');
        $tableTh[] = Common::setTHArray("JOINED",'','joined');
        $tableTh[] = Common::setTHArray("GRADE",'','grade');
        $tableTh[] = Common::setTHArray("GENDER",'','gender');
        $tableTh[] = Common::setTHArray("STATUS",'','status');
        $tableTh[] = Common::setTHArray(trans('admin.user.fields.action'),'','action');

        return view( 'school.student.index', compact('filterList','filterUrl','formFilterList','tableTh', 'students', 'paging', 'totalRecordCount','recordStart', 'schoolId', 'gradeDropDown','classesDropDown','clubDropDownForAddEdit','allergyDropDownForAddEdit','parentDropDown' ) );
    }

    public function delete( Request $request )
    {
        $data = $request->all();
        $id = $data['id'];
        $this->userObj->deleteRecord($request,$id, "Student");
        return redirect( 'school/students' );
    }

    public function saveAjax( Request $request )
    {
        $data = $request->all();
        $parentId = $data['parent_id'] ;
		$password =  Common::getDefaultPassword();
        $data['password'] = Common::generatePassword( $password );
        $data['ip_address'] = \Request::ip();
        $data['created_type'] = 'Web';
        $data['email_verified_at'] = \DateFacades::getCurrentDateTime( 'format-1' );
        $data['e_token_check'] = '1';
        $data['status'] = 1;
        $data['role_id'] = $this->_helperRoles->getStudentRoleId();
        $results = $this->userObj->saveRecord( $data );
        if ( ! empty( $results['user_id'] ) && $results['user_id'] > 0 ) {

            /* Create student parent */
            $studentParentInfo = [];
            $studentParentInfo['student_id'] = $results['user_id'];;
            $studentParentInfo['parent_id'] = $parentId;
            $results = $this->studentParentObj->saveRecord( $studentParentInfo );

			$toName = $data['first_name'].' '.$data['last_name'];
			$toEmail = $data['email'];
			$templateFieldValues = ['name' => $toName,
									'loginUrl' => url('student_login'),
									'email' => $toEmail,
									'password' => $password];
            Common::sendMailByMailJetWithEmailTemplate($toName,$toEmail,"student_register",$templateFieldValues);
            return response()->json( $results );
        } else {
            /* Set Validation Message */
            $response = [];
            $response['success'] = false;
            $response['message'] = Common::setAjaxValidationMessage($results['message']);
            return response()->json( $response );
        }
    }

    public function profileDetails(Request $request, $studentId){

        $studentId = Common::getDecryptId($studentId);

        if( $studentId <= 0 ){ return abort(404); }

        $student = $this->userObj->getDateById($studentId);
        if(! Common::isStudent( $student) ){ return abort(404); }

        $schoolId = $student->school_id ;
        $gradeDropDown = $this->gradeObj->getDropDown('Select grade', $schoolId,'');
        $allergyDropDown = $this->allergyObj->getDropDown();
        $clubDropDown = $this->clubObj->getDropDown('', $schoolId);

        $filter = ['user_id' => $studentId];
        $searchHelperAllergies = new SearchHelper( -1, -1, $selectColumns = ['*'], $filter );
        $allergies = $this->studentAllergiesObj->getList($searchHelperAllergies);

        $filter = ['user_id' => $studentId];
        $searchHelperClub = new SearchHelper( -1, -1, $selectColumns = ['*'], $filter );
        $clubs = $this->userClubObj->getList($searchHelperClub);

        /* Student Parent */
        $filter = ['student_id' => $studentId];
        $searchHelper = new SearchHelper( -1, -1, $selectColumns = ['*'], $filter );
        $studentParents = $this->studentParentObj->getList($searchHelper);

        $classesDropDown = $this->classesObj->getDropDown( $student->school_id, 1, $student->grade_id,'Select class','' );

		$classId = $student->class_id ;
		$studentTeacher = [];
		if( $classId > 0 ) {
			$teacherRoleId = $this->_helperRoles->getTeacherRoleId();
			$filter = [ 'class_id' => $classId, 'role_id'=> $teacherRoleId, 'school_id'=>$schoolId ];
			$searchHelper = new SearchHelper( -1, -1, $selectColumns = ['*'], $filter );
			$studentTeacher = $this->userObj->getList($searchHelper);
		}

        $parentRoleId = $this->_helperRoles->getParentRoleId();
        $parentDropDown = $this->userObj->getDropDown('Select parent', $parentRoleId, $schoolId, 1,1,0,[],'');

        $filter = ['student_id' => $studentId];
        $searchHelper = new SearchHelper( -1, -1, $selectColumns = ['*'], $filter );
        $studentParent = $this->studentParentObj->getList( $searchHelper )->first();
        $parentId = "";
        $studentParentId = 0;
        if(!empty($studentParent->parent_id) && $studentParent->parent_id > 0){
            $parentId = $studentParent->parent_id;
            $studentParentId = $studentParent->student_parent_id;
        }

        return view('school.student.profile',compact('student','gradeDropDown','allergyDropDown','allergies','clubs','clubDropDown','studentParents','classesDropDown', 'studentTeacher','parentDropDown','parentId','studentParentId'));
    }

    public function changePassword(Request $request)
    {
        $data = $request->all();
        $password = $data['password'];
        $result = $this->userObj->changePassword($data);
        if ( !empty($result['user_id'] ) && $result['user_id'] > 0 ) {

            /* Send mail */
            $user = $this->userObj->getDateById( $result['user_id'] );
            $toName = $user->name;
            $toEmail = $user->email;
            $templateFieldValues = ['name'     => $toName,
                                    'loginUrl' => url( 'student_login' ),
                                    'email'    => $toEmail,
                                    'password' => $password];
            Common::sendMailByMailJetWithEmailTemplate($toName,$toEmail,"student_password_change",$templateFieldValues);
            /* Send mail end */

            $message = "Student password changed successfully.";
            $request->session()->flash( 'success', $message );
            return Redirect::back();
        }
        return Redirect::back()->withErrors($result['message']);
    }

    public function banOrReActive(Request $request)
    {
        $data = $request->all();
        $userId = Common::getDecryptId($data['user_id']);
        if( $userId <= 0 ){ return abort(404); }
        $data['user_id'] = $userId;
        $result = $this->userObj->banOrReActive($data);
        if ( !empty($result['user_id'] ) && $result['user_id'] > 0 ) {
            $message = "User banned successfully";
            if($data['status'] == 1) {
                $message = "User reactivated successfully.";
            }
            $request->session()->flash( 'success', $message );
            return Redirect::back();
        } else {
            return Redirect::back()->withErrors($result['message']);
        }
    }

    public function profileSave(Request $request)
    {
        $data = $request->all();
        $result = $this->userObj->saveRecord($data);

        if ( !empty($result['user_id'] ) && $result['user_id'] > 0 ) {

            /* Update student parent */
            if(!empty($data['student_parent_id'])) {
                $studentParentInfo = [];
                $studentParentInfo['student_parent_id'] = $data['student_parent_id'];
                $studentParentInfo['student_id'] = $data['user_id'];
                $studentParentInfo['parent_id'] = $data['parent_id'];
                $this->studentParentObj->saveRecord( $studentParentInfo );
            }

            $request->session()->flash( 'success', 'Student profile update successfully.' );
            return Redirect::back();
        } else {
            return Redirect::back()->withErrors($result['message']);
        }
    }
    public function allergySave(Request $request)
    {
        $data = $request->all();
        $result = $this->studentAllergiesObj->saveRecord($data);
        if ( !empty($result['student_allergie_id'] ) && $result['student_allergie_id'] > 0 ) {
            $request->session()->flash( 'success', 'Student allergy added successfully.' );
            return Redirect::back();
        } else {
            return Redirect::back()->withErrors($result['message']);
        }
    }
    public function allergyDelete(Request $request)
    {
        $data = $request->all();
        if(empty($data['id'])){ return abort(404); }
        $studentAllergieId = $data['id'];
        if( $studentAllergieId <= 0 ){ return abort(404); }
        $isDelete = $this->studentAllergiesObj->removed($studentAllergieId);
        if($isDelete){
            $request->session()->flash( 'success', 'Allergy deleted successfully.' );
        }else{
            $request->session()->flash( 'error', 'Allergy is not deleted successfully.' );
        }
        return Redirect::back();
    }

    public function clubSave(Request $request)
    {
        $data = $request->all();
        $result = $this->userClubObj->saveRecord($data);
        if ( !empty($result['user_club_id'] ) && $result['user_club_id'] > 0 ) {
            $request->session()->flash( 'success', 'Student club added successfully.' );
            return Redirect::back();
        } else {
            return Redirect::back()->withErrors($result['message']);
        }
    }
    public function clubDelete(Request $request)
    {
        $data = $request->all();
        if(empty($data['id'])){ return abort(404); }
        $clubId = $data['id'];
        if( $clubId <= 0 ){ return abort(404); }
        $isDelete = $this->userClubObj->removed($clubId);
        if($isDelete){
            $request->session()->flash( 'success', 'Club deleted successfully.' );
        }else{
            $request->session()->flash( 'error', 'Club is not deleted successfully.' );
        }
        return Redirect::back();
    }

    public function academicsDetails(Request $request, $studentId){
        $studentId = Common::getDecryptId($studentId);

        if( $studentId <= 0 ){ return abort(404); }

        $student = $this->userObj->getDateById($studentId);

        if(! Common::isStudent( $student) ){ return abort(404); }

        $page = -1;
        $sortedBy = ! empty( $request->get( 'sorted_by' ) ) ? $request->get( 'sorted_by' ) : 'exam_date';
        $sortedOrder = ! empty( $request->get( 'sorted_order' ) ) ? $request->get( 'sorted_order' ) : 'DESC';

        $perPage = -1;
        $filter = ['user_id'=>$studentId];
        $searchHelper = new SearchHelper( $page, $perPage, $selectColumns = ['*'], $filter, $sortOrder = [$sortedBy => $sortedOrder],['user_id','exam_date','exam_id'] );
        $exams = $this->examResultObj->getList( $searchHelper );
		$examsList = $this->examObj->getDropDown('', $student->school_id );
        return view( 'school.student.academics', compact(  'sortedOrder', 'exams','student', 'studentId', 'examsList' ) );
    }

    public function ExamResultDelete(Request $request)
    {
        $data = $request->all();
        if(empty($data['exam_id']) || empty($data['user_id']) || empty($data['exam_date'])){ return abort(404);}
        $examId = $data['exam_id'];
        $userId = $data['user_id'];
        $examDate = $data['exam_date'];
        if( $examId <= 0 || $userId <= 0 ){ return abort(404); }
        $examResults = $this->examResultObj->getExamList($examId, $userId, $examDate);
        foreach ($examResults as $examResultKey => $examResult){
            $this->examResultObj->removed($examResult->exam_result_id);
        }
        $request->session()->flash( 'success', 'Exam result deleted successfully.' );
        return Redirect::back();
    }

	public function examSubjectDelete(Request $request) {
		$data = $request->all();
        if(empty($data['id'])){ return abort(404); }
        $exam_subject_id = $data['id'];
        if( $exam_subject_id <= 0 ){ return abort(404); }
        $isDelete = $this->examResultObj->removed($exam_subject_id);
        if($isDelete){
            $response['success'] = true;
			$response['message'] = 'Subject deleted successfully';
        }else{
			$response['success'] = false;
			$response['message'] = 'Issue in deleting subject';
        }
        return response()->json($response);
	}

	public function getDataForEditModel(Request $request)
    {
        $data = $request->all();

		$response = array();
        $response['success'] = false;
        $response['message'] = '';
		$examId = $data['exam_id'];
        $userId = $data['user_id'];
        $examDate = $data['exam_date'];

		if(empty($examId) || empty($userId) || empty($examDate)){ return response()->json($response);}
        if( $examId <= 0 || $userId <= 0 ){ return response()->json($response); }

		$examResults = $this->examResultObj->getExamList($examId, $userId, $examDate);
		$results['exam_date'] = $examDate;
		$results['exam_id'] = $examId;
		$results['examLists'] = array();
        foreach ($examResults as $examResultKey => $examResult) {
				$results['examLists'][$examResult->exam_result_id]['subject'] = $examResult->subject;
				$results['examLists'][$examResult->exam_result_id]['percentage'] = $examResult->percent;
        }

		$response['success'] = true;
        $response['message'] = 'Exam saved successfully';
        $response['data'] = $results;
		return response()->json($response);
	}

	public function examResultSave(Request $request)	{
		$data = $request->all();

		$response = array();
        $response['success'] = false;
        $response['message'] = '';
		$examId = $data['exam_id'];
        $userId = $data['user_id'];
        $examDate = date( "Y-m-d", strtotime( $data['exam_date'] ) );
        $examLists = $data['examList'];

		if(empty($examId) || empty($userId) || empty($examDate) || empty($examLists) ){ return response()->json($response);}
        if( $examId <= 0 || $userId <= 0 ){ return response()->json($response); }

		foreach( $examLists as $examKey => $examList ) {
			$examResult = array();
			if( !empty($examList['subject']) && !empty( $examList['percentage'] ) ) {
				$examResult['exam_id'] = $examId;
				$examResult['user_id'] = $userId;
				$examResult['subject'] = $examList['subject'];
				$examResult['percent'] = $examList['percentage'];
				$examResult['exam_date'] = $examDate;
				$examResult['created_user_id'] = Auth::guard('school')->getUser()->user_id;
				$result = $this->examResultObj->saveRecord( $examResult );
			}
		}
        $response['success'] = true;
        $response['message'] = 'Exam saved successfully';
        $response['data'] = [];
        return response()->json($response);
	}
    public function updateBio(Request $request)
    {
        $data = $request->all();
        $user = $this->userObj->getDateById($data['user_id']);
        $user->bio = $data['bio'];
        $user->save();
        $message = "Student Intellectual description update successfully.";
        $request->session()->flash( 'success', $message );
        return Redirect::back();
    }
}
