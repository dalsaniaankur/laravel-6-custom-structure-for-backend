<?php

namespace App\Classes\Helpers\ExamResult;

use App\Classes\Helpers\HelperCommon;
use App\Classes\Models\AdminConfiguration\AdminConfiguration;

class Helper extends HelperCommon
{
    public function __construct(){

        $this->adminConfigurationObj = new AdminConfiguration();
    }

    public function getConfigPerPageRecord()
    {
        $dbConfig = $this->adminConfigurationObj->getValueByKey('default_per_page_record');
        return (empty($dbConfig)) ?  (\Config::get('admin-configuration.default_per_page_record.value')) :  $dbConfig->value;
    }
}
