<?php

namespace App\Classes\Common;

use Illuminate\Http\Request;
use App\Classes\Helpers\HelperCommon;
use App\Classes\Helpers\User\Helper as HelperUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use App\Classes\Helpers\Roles\Helper as HelperRoles;
use Intervention\Image\ImageManagerStatic as Image;
use App\Classes\Models\EmailTemplate\EmailTemplate;

class Common
{

    public function __construct()
    {

    }

    public static function getPaginationBasePath( $searchableData )
    {
        $paginationBasePath = \Request::url() . '?';

        if ( ! empty( $searchableData ) ) {

            foreach ( $searchableData as $key => $value ) {
                $value = trim($value);
                if ( $value != '' && $value != '-1') {
                    $paginationBasePath .= $key . "=" . $value . "&";
                }
            }
        }
        return $paginationBasePath;
    }

    public static function checkEmptyDateTime( $dateTime )
    {
        if ( empty( $dateTime ) || $dateTime != '0000-00-00 00:00:00' ) {
            return false;
        }
        return true;
    }

    public static function getRecordStart( $page = -1, $perPage )
    {
        $recordStart = 0;
        if ( ! empty( $page ) && $page > 1 ) {
            return ($perPage * ($page - 1));
        }
        return $recordStart;
    }

    public static function getDefaultPassword( $length = 10 )
    {
        $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz' . '0123456789@';

        $password = '';
        $max = strlen( $chars ) - 1;
        for ( $i = 0; $i < $length; $i++ ) {
            $password .= $chars[mt_rand( 0, $max )];
        }
        return $password;
    }

    public static function generatePassword( $password )
    {
        $password = trim( $password );
        if ( empty( $password ) ) {
            return $password;
        }
        return Hash::make( $password );
    }

    public static function isFileExists( $path )
    {
        if ( ! empty( $path ) && file_exists( public_path() . '/' . $path ) ) {
            return true;
        }
        return false;
    }

    public static function getPhoneFormat( $phone )
    {
        return $phone;

        if ( ! empty( $phone ) ) {
            return preg_replace( '/^(\d{3})(\d{3})(\d{4})$/i', '$1-$2-$3', $phone );
        }
        return $phone;
    }

    public static function getMailPhoneFormat( $phone )
    {
        if ( ! empty( $phone ) ) {
            return preg_replace( '/^(\d{3})(\d{3})(\d{4})$/i', '$1-$2-$3', $phone );
        }
        return $phone;
    }

    public static function deleteFile( $filePath )
    {
        if ( ! empty( $filePath ) ) {
            File::delete( $filePath );
        }
    }

    public static function setPriceFormat( $price )
    {
        return number_format( $price, 2 );
    }

    public static function fileUpload( $filePath, $file, $width = 200, $height = null )
    {
        $fileName = $file->getClientOriginalName();
        $fileName = strtolower( str_replace( ' ', '-', $fileName ) );
        $fileName = str_replace( '.' . $file->getClientOriginalExtension(), '_' . time() . mt_rand() . '.' . $file->getClientOriginalExtension(), $fileName );

        if ( ! File::isDirectory( $filePath ) ) {
            File::makeDirectory( $filePath, 0777, true, true );
        }

        //        $file->move( public_path( '/' . $filePath ), $fileName );
        $aspectImage = Image::make( $file )
                            ->resize( $width, $height, function ( $constraint ) {
                                $constraint->aspectRatio();
                                $constraint->upsize();
                            } )
                            ->save( $filePath . '/' . $fileName );

        return $filePath . '/' . $fileName;
    }

    public static function getEncryptId( $string )
    {
        if ( empty( $string ) ) {
            return $string;
        }
        $encrypt_method = "AES-256-CBC";
        $secret_key = 'secret_key_test';
        $secret_iv = 'secret_iv_test';
        $key = hash( 'sha256', $secret_key );
        $iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );
        $output = openssl_encrypt( $string, $encrypt_method, $key, 0, $iv );
        $result = base64_encode( $output );
        return $result;
    }

    public static function getDecryptId( $string )
    {
        if ( empty( $string ) ) {
            return $string;
        }
        $encrypt_method = "AES-256-CBC";
        $secret_key = 'secret_key_test';
        $secret_iv = 'secret_iv_test';
        $key = hash( 'sha256', $secret_key );
        $iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );
        $result = openssl_decrypt( base64_decode( $string ), $encrypt_method, $key, 0, $iv );
        return $result;
    }

    public static function sendMailByMailJet( $htmlContent, $fromName, $fromEmail = '', $subject, $toName, $toEmail )
    {

        $_helper = new HelperCommon();
        $mailJetPublicApiKey = $_helper->getMailJetPublicApiKey();
        $mailJetPrivateApiKey = $_helper->getMailJetPrivateApiKey();
        if ( empty( $fromEmail ) ) {
            $fromEmail = $_helper->getMailJetEmail();
        }
        $mailJetPrivateKey = $mailJetPublicApiKey . ':' . $mailJetPrivateApiKey;

        $ch1 = curl_init();
        $data = [];
        $data['Messages'][0]['From']['Email'] = $fromEmail;
        $data['Messages'][0]['From']['Name'] = $fromName;
        $data['Messages'][0]['To'][0]['Email'] = $toEmail;
        $data['Messages'][0]['To'][0]['Name'] = $toName;
        $data['Messages'][0]['Subject'] = $subject;
        $data['Messages'][0]['HTMLPart'] = $htmlContent;

        curl_setopt( $ch1, CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch1, CURLOPT_POST, true );
        curl_setopt( $ch1, CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch1, CURLOPT_URL, "https://api.mailjet.com/v3.1/send" );
        curl_setopt( $ch1, CURLOPT_POST, true );
        curl_setopt( $ch1, CURLOPT_POSTFIELDS, json_encode( $data ) );
        curl_setopt( $ch1, CURLOPT_HTTPHEADER, ["Content-Type: application/json",
                                                "Authorization: Basic " . base64_encode( $mailJetPrivateKey )] );

        $response = curl_exec( $ch1 );
        return json_decode( $response );

    }

    public static function isStudent( $student )
    {
        $_helperRoles = new HelperRoles();
        $response = true;
        if ( empty( $student->user_id ) || $student->role_id != $_helperRoles->getStudentRoleId() ) {
            $response = false;
        }
        return $response;
    }

    public static function isTeacher( $teacher )
    {
        $_helperRoles = new HelperRoles();
        $response = true;
        if ( empty( $teacher->user_id ) || $teacher->role_id != $_helperRoles->getTeacherRoleId() ) {
            $response = false;
        }
        return $response;
    }

    public static function isPTAMember( $user )
    {
        $_helperRoles = new HelperRoles();
        $response = true;
        if ( empty( $user->user_id ) || $user->role_id != $_helperRoles->getPTAMemberRoleId() ) {
            $response = false;
        }
        return $response;
    }

    public static function isParent( $parent )
    {
        $_helperRoles = new HelperRoles();
        $response = true;
        if ( empty( $parent->user_id ) || $parent->role_id != $_helperRoles->getParentRoleId() ) {
            $response = false;
        }
        return $response;
    }

    public static function convertEmailTemplateContent( $templateFields, $templateContent, $templateFieldValues )
    {
        $templateFields = trim( $templateFields );

        if ( ! empty( $templateFields ) && ! empty( $templateFieldValues ) ) {
            $templateFieldNameArray = explode( ',', $templateFields );
        }
        $templateContent = nl2br( $templateContent );
        $templateContent = $templateContent;

        foreach ( $templateFieldNameArray as $templateFieldNameKey => $templateFieldName ) {
            if ( ! empty( $templateFieldValues[$templateFieldName] ) ) {
                $value = $templateFieldValues[$templateFieldName];
                $templateContent = str_replace( '%' . $templateFieldName . '%', $value, $templateContent );
            }
        }
        return $templateContent;
    }

    public static function setUserSessionForWordPress()
    {
        session_start();
        if ( Auth::guard( 'admin' )
                 ->check() ) {

            $_SESSION['user_type'] = 'admin';
            $_SESSION['user_id'] = Auth::guard( 'admin' )
                                       ->user()->user_id;

        } else if ( Auth::guard( 'school' )
                        ->check() ) {

            $_SESSION['user_type'] = 'school';
            $_SESSION['user_id'] = Auth::guard( 'school' )
                                       ->user()->user_id;

        } else if ( Auth::guard( 'teacher' )
                        ->check() ) {

            $_SESSION['user_type'] = 'teacher';
            $_SESSION['user_id'] = Auth::guard( 'teacher' )
                                       ->user()->user_id;

        } else {
            if ( ! empty( $_SESSION['user_type'] ) ) {
                unset( $_SESSION['user_type'] );
            }
            if ( ! empty( $_SESSION['user_id'] ) ) {
                unset( $_SESSION['user_id'] );
            }
        }
    }

    public static function setHomeSmallBoxArray( $name, $total, $colorClassName, $link = 'javascript:void(0);' )
    {
        return ['name'           => $name,
                'total'          => $total,
                'colorClassName' => $colorClassName,
                'link'           => $link,];

    }
    public static function setHomeBixBoxArray( $name, $total, $iconUrl, $className, $link = 'javascript:void(0);' )
    {
        return ['name'      => $name,
                'total'     => $total,
                'iconUrl'   => $iconUrl,
                'className' => $className,
                'link'      => $link,];

    }

    public static function setAjaxValidationMessage( $errorMessage )
    {
        $message = null;
        foreach ( $errorMessage as $key => $value ) {
            if ( empty( $message ) ) {
                $message = $errorMessage->{$key}[0];
                break;
            }
        }
        return $message;
    }

    public static function sendMailByMailJetWithEmailTemplate( $toName,$toEmail,$entity,$templateFieldValues = [],$fromName = "Kidrend" ){
        $emailTemplateObj = new EmailTemplate();
        $emailTemplate = $emailTemplateObj->getDateByEntity($entity);
        $templateFields = $emailTemplate->template_fields;
        $templateContent = $emailTemplate->template_content;
        $mailContent = Common::convertEmailTemplateContent($templateFields, $templateContent, $templateFieldValues);
        $subject = $emailTemplate->subject;
        $htmlContent = \View::make( 'backend.emails.common_template', ['mailContent' => $mailContent,
                                                                           'subject' => $subject] )->render();
        return Common::sendMailByMailJet( $htmlContent, $fromName, '', $subject, $toName, $toEmail );
    }
    public static function setFormFieldArray( $type, $name, $placeholder='', $value='', $option=[], $class='', $id='', $label='',$otherData =[], $parentClass ='' )
    {
        $array = ['type' => $type,'name'=>$name,'placeholder' => $placeholder,'value' => $value,'option' => $option,'class' => $class,'id' => $id, 'label' => $label, 'other_data' => $otherData, 'parent_class' => $parentClass];
        foreach ($array as $key => $data){
            if(empty($data)){ unset($array[$key]);}
        }
        return $array;
    }
    public static function setTHArray($label,$sortableField='',$class="",$id="" )
    {
        return ['label' => $label,'sortableField' => $sortableField,'class' => $class,'id' => $id];
    }
    public static function getFilterValue($data, $fieldName, $defaultValue = "")
    {
        if(isset($data[$fieldName])){
            return $data[$fieldName];
        }
        return $defaultValue;
    }
}
