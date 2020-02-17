<?php

namespace App\Classes\Helpers\EventAndNotification;

use App\Classes\Helpers\HelperCommon;
use App\Classes\Models\AdminConfiguration\AdminConfiguration;

class Helper extends HelperCommon
{
    protected $image_path = 'images/event_and_notification';

    protected $notification_type = [''  => 'Notice type',
                                    '1' => 'Principal’s notice',
                                    '2' => 'Class notice',
                                    '3' => 'Theme of the month',
                                    '4' => 'Clubs notice',
                                    '5' => 'Person of the month (Student, teacher or parent)',
                                    '6' => 'P.T.A. notice'];

    protected $type = [''  => 'Type',
                       '1' => 'Event',
                       '2' => 'Notification',];


    public function __construct()
    {

        $this->adminConfigurationObj = new AdminConfiguration();
    }

    public function getImagePath()
    {
        return $this->image_path;
    }

    public function getNotificationTypeDropDown()
    {
        return $this->notification_type;
    }

    public function getTypeDropDown()
    {
        return $this->type;
    }

    public function getNotificationTypeById( $id )
    {
        return $this->notification_type[$id];
    }

    public function getTypeById( $id )
    {
        return $this->type[$id];
    }
}
