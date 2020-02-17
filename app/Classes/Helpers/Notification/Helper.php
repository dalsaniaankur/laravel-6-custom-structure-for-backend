<?php

namespace App\Classes\Helpers\Notification;

use App\Classes\Helpers\HelperCommon;
use App\Classes\Models\AdminConfiguration\AdminConfiguration;

class Helper extends HelperCommon
{
    protected $image_path = 'images/notification';

    public function __construct(){

        $this->adminConfigurationObj = new AdminConfiguration();
    }

    public function getImagePath()
    {
        return $this->image_path;
    }
}
