<?php

namespace App\Http\Controllers\Teacher;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Classes\Models\User\User;
use App\Classes\Helpers\User\Helper;
use App\Classes\Helpers\SearchHelper;
use App\Classes\Helpers\Roles\Helper as HelperRoles;
use App\Classes\Common\Common;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Classes\Models\StudentParent\StudentParent;
use App\Classes\Models\Events\Events;
use App\Classes\Models\Club\Club;
use App\Classes\Models\UserClub\UserClub;

class HomeController extends Controller
{
    protected $userObj;
    protected $eventsObj;
    protected $clubObj;
    protected $userClubObj;
    protected $_helper;
    protected $_helperRoles;
    protected $_searchHelper;
    protected $studentParentObj;

    public function __construct( User $userModel )
    {

        $this->userObj = $userModel;
        $this->eventsObj = new Events();
        $this->clubObj = new Club();
        $this->userClubObj = new UserClub();
        $this->_helper = new Helper();
        $this->_helperRoles = new HelperRoles();
        $this->studentParentObj = new StudentParent();
    }

    public function index( Request $request )
    {

        $loginUser = Auth::guard( 'teacher' )
                         ->user();
        $teacherId = $loginUser->user_id;
        $schoolId = $loginUser->school_id;
        $classId = $loginUser->class_id;

        /* Student */
        $filter = ['role_id'  => $this->_helperRoles->getStudentRoleId(),
                   'class_id' => $classId];
        $searchHelper = new SearchHelper( 1, -1, ['*'], $filter );
        $totalStudent = $this->userObj->getListTotalCount( $searchHelper );

        /* Teacher */
        $filter = ['role_id'  => $this->_helperRoles->getTeacherRoleId(),
                   'class_id' => $classId];
        $searchHelper = new SearchHelper( 1, -1, ['*'], $filter );
        $totalTeacher = $this->userObj->getListTotalCount( $searchHelper );

        /* Parent */
        $filter = ['student_class_id' => $classId];
        $searchHelper = new SearchHelper( -1, -1, ['*'], $filter, [], $groupBy = ['parent_id'] );
        $parentIdArray = $this->studentParentObj->getList( $searchHelper )
                                                ->pluck( 'parent_id' )
                                                ->toArray();

        $filter = ['user_id_in' => $parentIdArray,
                   'role_id'    => $this->_helperRoles->getParentRoleId()];
        $searchHelper = new SearchHelper( -1, -1, ['*'], $filter, [] );
        $totalParent = $this->userObj->getListTotalCount( $searchHelper );

        /* Total user */
        $totalUser = $totalStudent + $totalParent + $totalTeacher;

        /* Recent Student */
        $filter = ['role_id'  => $this->_helperRoles->getStudentRoleId(),
                   'class_id' => $classId];
        $schoolSearchHelper = new SearchHelper( $page = 0, $perPage = 4, ['*'], $filter, ['updated_at' => 'DESC'] );
        $recentUsers = $this->userObj->getList( $schoolSearchHelper );

        /* Event */
        $filter = ['school_id' => $schoolId,
                   'class_id'  => $classId,];
        $searchHelper = new SearchHelper( -1, -1, ['*'], $filter );
        $totalEvent = $this->eventsObj->getListTotalCount( $searchHelper );

        /* Club */
        $filter = ['user_id' => $teacherId];
        $searchHelper = new SearchHelper( -1, -1, ['*'], $filter );
        $totalClub = $this->userClubObj->getListTotalCount( $searchHelper );

        /* Small box list */
        $smallBox[1] = Common::setHomeSmallBoxArray( 'Users', $totalUser, 'orange' );
        $smallBox[2] = Common::setHomeSmallBoxArray( 'Students', $totalStudent, 'gray', url( 'teacher/students' ) );
        $smallBox[3] = Common::setHomeSmallBoxArray( 'Parents', $totalParent, 'blue', url( 'teacher/parents' ) );
        ksort( $smallBox );

        /* Big box list */
        $bigBox[1] = Common::setHomeBixBoxArray( 'Students', $totalStudent, url( 'backend/images/studentsicon.png' ), 'brd-after', url( 'teacher/students' ) );
        $bigBox[3] = Common::setHomeBixBoxArray( 'Parents', $totalParent, url( 'backend/images/parentsicon.png' ), '', url( 'teacher/parents' ) );
        $bigBox[5] = Common::setHomeBixBoxArray( 'Clubs', $totalClub, url( 'backend/images/events.png' ), 'brd-after', url( 'teacher/clubs' ) );
        $bigBox[6] = Common::setHomeBixBoxArray( 'Announcements', $totalEvent, url( 'backend/images/announce.png' ), '', url( 'teacher/events' ) );
        ksort( $bigBox );

        return view( 'teacher.home', compact( 'loginUser', 'smallBox', 'bigBox', 'recentUsers' ) );
    }
}
