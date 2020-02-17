<?php
namespace App\Classes\Helpers\CmsPage;

use App\Classes\Models\AdminConfiguration\AdminConfiguration;
use App\Classes\Helpers\HelperCommon;

class Helper extends HelperCommon
{
    protected $image_path = 'images/cms_page';

    public function __construct(){

        $this->adminConfigurationObj = new AdminConfiguration();
    }
    public function getImagePath()
    {
        return $this->image_path;
    }
}
