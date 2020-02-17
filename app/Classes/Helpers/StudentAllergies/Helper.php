<?php

namespace App\Classes\Helpers\StudentAllergies;

use App\Classes\Helpers\HelperCommon;
use App\Classes\Models\AdminConfiguration\AdminConfiguration;

class Helper extends HelperCommon
{
    public function __construct(){

        $this->adminConfigurationObj = new AdminConfiguration();
    }
}
