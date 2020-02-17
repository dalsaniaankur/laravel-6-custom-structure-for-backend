<?php

namespace App\Classes\Helpers\Events;

use App\Classes\Helpers\HelperCommon;
use App\Classes\Models\AdminConfiguration\AdminConfiguration;
class Helper extends HelperCommon
{
	protected $allEvents = ['' => 'Select Event Type',
										'1'=>'Principal\'s Message',
										'2'=>'Person of Month',
										'3'=>'Theme of Month',
										'4'=>'Club notice',
										'5'=>'Class Notice',
										'6'=>'Birthday notices',
										];

    protected $schoolEvents = ['' => 'Select Event Type',
										'1'=>'Principal\'s Message',
										'2'=>'Person of Month',
										'3'=>'Theme of Month',
										'4'=>'Club notice',
										];

	protected $image_path = 'images/events';

    public function __construct(){

        $this->adminConfigurationObj = new AdminConfiguration();
    }

    public function getConfigPerPageRecord()
    {
        $dbConfig = $this->adminConfigurationObj->getValueByKey('default_per_page_record');
        return (empty($dbConfig)) ?  (\Config::get('admin-configuration.default_per_page_record.value')) :  $dbConfig->value;
    }


    public function getSchoolEventDropDown()
    {
        return $this->schoolEvents;
    }

	public function getEventName($eventId) {
		return isset( $this->allEvents[$eventId] ) ? $this->allEvents[$eventId] : '';
	}

	public function getImagePath() {
        return $this->image_path;
    }
}
