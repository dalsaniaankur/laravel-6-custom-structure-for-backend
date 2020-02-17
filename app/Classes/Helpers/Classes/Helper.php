<?php

namespace App\Classes\Helpers\Classes;

use App\Classes\Models\AdminConfiguration\AdminConfiguration;
use App\Classes\Helpers\HelperCommon;

class Helper extends HelperCommon
{
    protected $status_with_all_option = ['-1' => 'Status',
                                         '1'  => 'Active',
                                         '0'  => 'Inactive'];

	protected $status_with_specific_option = ['1'  => 'Active',
                                         '0'  => 'Inactive'];

    public function __construct(){

        $this->adminConfigurationObj = new AdminConfiguration();
    }

    public function getStatusDropDownWithAllOption()
    {
        return $this->status_with_all_option;
    }

	public function getStatusDropDownWithSpecificOption()
    {
        return $this->status_with_specific_option;
    }
}
