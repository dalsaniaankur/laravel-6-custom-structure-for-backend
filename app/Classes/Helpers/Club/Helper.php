<?php

namespace App\Classes\Helpers\Club;

use App\Classes\Models\AdminConfiguration\AdminConfiguration;
use App\Classes\Helpers\HelperCommon;

class Helper extends HelperCommon
{
    public function __construct(){

        $this->adminConfigurationObj = new AdminConfiguration();
    }
}
