<?php

namespace App\Classes\Helpers\Roles;

use App\Classes\Helpers\HelperCommon;
use App\Classes\Models\AdminConfiguration\AdminConfiguration;

class Helper extends HelperCommon
{
    protected $adminRoleId = 1;
    protected $schoolRoleId = 2;
    protected $teacherRoleId = 3;
    protected $studentRoleId = 4;
    protected $parentRoleId = 5;
    protected $PTAMemberRoleId = 6;

    public function __construct()
    {
        $this->adminConfigurationObj = new AdminConfiguration();
    }

    public function getAdminRoleId()
    {
        return $this->adminRoleId;
    }

    public function getStudentRoleId()
    {
        return $this->studentRoleId;
    }

    public function getTeacherRoleId()
    {
        return $this->teacherRoleId;
    }

    public function getParentRoleId()
    {
        return $this->parentRoleId;
    }

    public function getSchoolRoleId()
    {
        return $this->schoolRoleId;
    }

    public function getPTAMemberRoleId()
    {
        return $this->PTAMemberRoleId;
    }
}
