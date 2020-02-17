<?php

namespace App\Classes\Helpers\Message;

use App\Classes\Helpers\HelperCommon;
use App\Classes\Models\AdminConfiguration\AdminConfiguration;

class Helper extends HelperCommon
{
    protected $attachmentPath = 'images/message_attachment';

    public function __construct(){

        $this->adminConfigurationObj = new AdminConfiguration();
    }

    public function getAttachmentPath()
    {
        return $this->attachmentPath;
    }
}
