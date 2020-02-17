<?php

namespace App\Http\Controllers\School;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Classes\Models\User\User;
use App\Classes\Helpers\User\Helper;
use App\Classes\Helpers\SearchHelper;
use App\Classes\Helpers\Roles\Helper as HelperRoles;
use App\Classes\Common\Common;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Classes\Models\Events\Events;
use App\Classes\Models\Club\Club;


class HomeController extends Controller
{
    protected $userObj;
    protected $eventsObj;
    protected $clubObj;
    protected $_helper;
    protected $_helperRoles;
    protected $_searchHelper;

    public function __construct( User $userModel )
    {

        $this->userObj = $userModel;
        $this->eventsObj = new Events();
        $this->clubObj = new Club();
        $this->_helper = new Helper();
        $this->_helperRoles = new HelperRoles();
    }

    public function index( Request $request )
    {
        $loginUser = Auth::guard( 'school' )->user();
        $schoolId = $loginUser->user_id;
        $filter = ['school_id' => $schoolId];
        $searchHelper = new SearchHelper( -1, -1, ['*'], $filter );

        /* Event */
        $totalEvent = $this->eventsObj->getListTotalCount( $searchHelper );

        /* Club */
        $totalClub = $this->clubObj->getListTotalCount( $searchHelper );

        /* Student */
        $filter['role_id'] = $this->_helperRoles->getStudentRoleId();
        $searchHelper = new SearchHelper( -1, -1, ['*'], $filter );
        $totalStudent = $this->userObj->getListTotalCount( $searchHelper );

        /* Teacher */
        $filter['role_id'] = $this->_helperRoles->getTeacherRoleId();
        $searchHelper = new SearchHelper( -1, -1, ['*'], $filter );
        $totalTeacher = $this->userObj->getListTotalCount( $searchHelper );

        /* Parent */
        $filter['role_id'] = $this->_helperRoles->getParentRoleId();
        $searchHelper = new SearchHelper( -1, -1, ['*'], $filter );
        $totalParent = $this->userObj->getListTotalCount( $searchHelper );

        /* PTA members */
        $filter['role_id'] = $this->_helperRoles->getPTAMemberRoleId();
        $searchHelper = new SearchHelper( -1, -1, ['*'], $filter );
        $totalPtaMembers = $this->userObj->getListTotalCount( $searchHelper );

        /* Total user */
        $totalUser = $totalStudent + $totalParent + $totalTeacher + $totalPtaMembers;

        /* Recent Student */
        $filter['role_id'] = $this->_helperRoles->getStudentRoleId();
        $schoolSearchHelper = new SearchHelper( $page = 0, $perPage = 4, ['*'], $filter, $sortOrder = ['updated_at' => 'DESC'] );
        $recentUsers = $this->userObj->getList( $schoolSearchHelper );

        /* Small box list */
        $smallBox[1] = Common::setHomeSmallBoxArray('Users',$totalUser,'orange');
        $smallBox[2] = Common::setHomeSmallBoxArray('Students',$totalStudent,'gray',url( 'school/students' ));
        $smallBox[3] = Common::setHomeSmallBoxArray('Teachers',$totalTeacher,'blue',url( 'school/teachers' ));
        $smallBox[4] = Common::setHomeSmallBoxArray('Parents',$totalParent,'yellow',url( 'school/parents' ));
        ksort( $smallBox );

        /* Big box list */
        $bigBox[1] = Common::setHomeBixBoxArray( 'Students', $totalStudent, url( 'backend/images/studentsicon.png' ), 'brd-after', url( 'school/students' ) );
        $bigBox[2] = Common::setHomeBixBoxArray( 'Teachers', $totalTeacher, url( 'backend/images/teachericon1.png' ), '', url( 'school/teachers' ) );
        $bigBox[3] = Common::setHomeBixBoxArray( 'Parents', $totalParent, url( 'backend/images/parentsicon.png' ), 'brd-after', url( 'school/parents' ) );
        $bigBox[4] = Common::setHomeBixBoxArray( 'PTA members', $totalPtaMembers, url( 'backend/images/cms-ico-1.jpg' ), '', url( 'school/pta-members' ) );
        $bigBox[5] = Common::setHomeBixBoxArray( 'Clubs', $totalClub, url( 'backend/images/events.png' ), 'brd-after', url( 'school/clubs' ) );
        $bigBox[6] = Common::setHomeBixBoxArray( 'Announcements', $totalEvent, url( 'backend/images/announce.png' ), '', url( 'school/events' ) );
        ksort( $bigBox );

        return view( 'school.home', compact( 'loginUser', 'smallBox','bigBox','recentUsers' ) );
    }
}
