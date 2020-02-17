<?php
namespace App\Classes\Helpers;

use App\Classes\Models\AdminConfiguration\AdminConfiguration;

class HelperCommon{

    public function __construct(){
       $this->adminConfigurationObj = new AdminConfiguration();
    }
	public function getConfigPerPageRecord(){
		$per_page=\Config::get('admin-configuration.default_per_page_record.value');
		return $per_page;
	}

    public function getCopyRight(){

        $dbConfig = $this->adminConfigurationObj->getValueByKey('copyright');
        return (empty($dbConfig)) ?  (\Config::get('admin-configuration.copyright.value')) :  $dbConfig->value;
    }

    public function getFacebookUrl(){

        $dbConfig = $this->adminConfigurationObj->getValueByKey('facebook_url');
        return (empty($dbConfig)) ?  (\Config::get('admin-configuration.facebook_url.value')) :  $dbConfig->value;
    }

    public function getTwitterUrl(){

        $dbConfig = $this->adminConfigurationObj->getValueByKey('twitter_url');
        return (empty($dbConfig)) ?  (\Config::get('admin-configuration.twitter_url.value')) :  $dbConfig->value;
    }

    public function getLinkedinUrl(){

        $dbConfig = $this->adminConfigurationObj->getValueByKey('linkedin_url');
        return (empty($dbConfig)) ?  (\Config::get('admin-configuration.linkedin_url.value')) :  $dbConfig->value;
    }

    public function getPhoneNumber(){
        $dbConfig = $this->adminConfigurationObj->getValueByKey('phone');
        return (empty($dbConfig)) ?  (\Config::get('admin-configuration.phone.value')) :  $dbConfig->value;
    }

    public function getMailJetPublicApiKey(){
        $dbConfig = $this->adminConfigurationObj->getValueByKey('mail_jet_public_api_key');
        return (empty($dbConfig)) ?  (\Config::get('admin-configuration.mail_jet_public_api_key.value')) :  $dbConfig->value;
    }
    public function getMailJetPrivateApiKey(){
        $dbConfig = $this->adminConfigurationObj->getValueByKey('mail_jet_private_api_key');
        return (empty($dbConfig)) ?  (\Config::get('admin-configuration.mail_jet_private_api_key.value')) :  $dbConfig->value;
    }
    public function getMailJetEmail(){
        $dbConfig = $this->adminConfigurationObj->getValueByKey('mail_jet_email');
        return (empty($dbConfig)) ?  (\Config::get('admin-configuration.mail_jet_email.value')) :  $dbConfig->value;
    }

    public function getMenuByKey($key){
        return \Config::get('menu-configuration.'.$key);
    }
    public function getIsShowLoginMenuByPageType($loadingPageType){
        $showLoginMenuInPageType = \Config::get('menu-configuration.show_login_menu_in_page_type');
        return in_array($loadingPageType,$showLoginMenuInPageType);
    }
    public function getIsShowForgotPasswordLinkByPageType($loadingPageType){
        $showForgotPassword = \Config::get('menu-configuration.show_forgot_password_link_in_page_type');
        return in_array($loadingPageType,$showForgotPassword);
    }
    public function getIsShowSideMenuByPageType($loadingPageType){
        $showSideMenuInPageType = \Config::get('menu-configuration.show_side_menu_in_page_type');
        return in_array($loadingPageType,$showSideMenuInPageType);
    }
    public function getIsShowBackendStyleAndScriptByPageType($loadingPageType){
        $showBackendStyleAndScriptInPageType = \Config::get('menu-configuration.show_backend_style_and_script_in_page_type');
        return in_array($loadingPageType,$showBackendStyleAndScriptInPageType);
    }

    public function getAppServerKey(){
        $dbConfig = $this->adminConfigurationObj->getValueByKey('app_server_key');
        return (empty($dbConfig)) ?  (\Config::get('admin-configuration.app_server_key.value')) :  $dbConfig->value;
    }
}


