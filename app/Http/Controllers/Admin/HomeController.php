<?php

namespace App\Http\Controllers\Admin;

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

        $loginUser = Auth::guard( 'admin' )
                         ->user();

        /* School */
        $filter = ['role_id' => $this->_helperRoles->getSchoolRoleId()];
        $searchHelper = new SearchHelper( -1, -1, ['*'], $filter );
        $totalSchool = $this->userObj->getListTotalCount( $searchHelper );

        /* Student */
        $filter = ['role_id' => $this->_helperRoles->getStudentRoleId()];
        $searchHelper = new SearchHelper( -1, -1, ['*'], $filter );
        $totalStudent = $this->userObj->getListTotalCount( $searchHelper );

        /* Teacher */
        $filter = ['role_id' => $this->_helperRoles->getTeacherRoleId()];
        $searchHelper = new SearchHelper( -1, -1, ['*'], $filter );
        $totalTeacher = $this->userObj->getListTotalCount( $searchHelper );

        /* Parent */
        $filter = ['role_id' => $this->_helperRoles->getParentRoleId()];
        $searchHelper = new SearchHelper( -1, -1, ['*'], $filter );
        $totalParent = $this->userObj->getListTotalCount( $searchHelper );

        /* PTA members */
        $filter = ['role_id' => $this->_helperRoles->getPTAMemberRoleId()];
        $searchHelper = new SearchHelper( -1, -1, ['*'], $filter );
        $totalPtaMembers = $this->userObj->getListTotalCount( $searchHelper );

        /* Total user */ //$totalUser = $totalStudent + $totalParent + $totalTeacher + $totalPtaMembers;

        /* Recent School */
        $filter = ['role_id' => $this->_helperRoles->getschoolRoleId()];
        $schoolSearchHelper = new SearchHelper( 0, 4, ['*'], $filter, ['updated_at' => 'DESC'] );
        $recentUsers = $this->userObj->getList( $schoolSearchHelper );

        /* Event */
        $searchHelper = new SearchHelper( -1, -1 );
        $totalEvent = $this->eventsObj->getListTotalCount( $searchHelper );

        /* Club */
        $searchHelper = new SearchHelper( -1, -1 );
        $totalClub = $this->clubObj->getListTotalCount( $searchHelper );

        /* Small box list */
        $smallBox[1] = Common::setHomeSmallBoxArray('Schools',$totalSchool,'orange',url('admin/schools'));
        $smallBox[2] = Common::setHomeSmallBoxArray('Students',$totalStudent,'gray',url( 'admin/students' ));
        $smallBox[3] = Common::setHomeSmallBoxArray('Teachers',$totalTeacher,'blue',url( 'admin/teachers' ));
        $smallBox[4] = Common::setHomeSmallBoxArray('Parents',$totalParent,'yellow',url( 'admin/parents' ));
        ksort( $smallBox );

        /* Big box list */
        $bigBox[1] = Common::setHomeBixBoxArray( 'Schools', $totalSchool, url( 'backend/images/schoolicon1.png' ), 'brd-after', url( 'admin/schools' ) );
        $bigBox[2] = Common::setHomeBixBoxArray( 'Teachers', $totalTeacher, url( 'backend/images/teachericon1.png' ), '', url( 'admin/teachers' ) );
        $bigBox[3] = Common::setHomeBixBoxArray( 'Parents', $totalParent, url( 'backend/images/parentsicon.png' ), 'brd-after', url( 'admin/parents' ) );
        $bigBox[4] = Common::setHomeBixBoxArray( 'Students', $totalStudent, url( 'backend/images/studentsicon.png' ), '', url( 'admin/students' ) );
        $bigBox[5] = Common::setHomeBixBoxArray( 'Clubs', $totalClub, url( 'backend/images/events.png' ), 'brd-after', url( 'admin/clubs' ) );
        $bigBox[6] = Common::setHomeBixBoxArray( 'Announcements', $totalEvent, url( 'backend/images/announce.png' ), '');
        ksort( $bigBox );

        return view( 'admin.home', compact( 'loginUser', 'smallBox', 'bigBox', 'recentUsers' ) );
    }
}
