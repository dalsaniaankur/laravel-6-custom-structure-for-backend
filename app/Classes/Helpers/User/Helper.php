<?php

namespace App\Classes\Helpers\User;

use App\Classes\Models\AdminConfiguration\AdminConfiguration;
use App\Classes\Helpers\HelperCommon;

class Helper extends HelperCommon
{
    protected $image_path = 'images/user';
    protected $status_with_all_option = ['-1' => 'Status',
                                         '1'  => 'Active',
                                         '0'  => 'Inactive'];

    protected $defaultDropdownTeacher = ['' => 'Select teacher'];

    public function __construct(){

        $this->adminConfigurationObj = new AdminConfiguration();
    }

    public function getStatusDropDownWithAllOption()
    {
        return $this->status_with_all_option;
    }
    public function getImagePath()
    {
        return $this->image_path;
    }
    public function getDefaultDropDownTeacher()
    {
        return $this->defaultDropdownTeacher;
    }
}
