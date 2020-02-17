<?php

namespace App\Http\Controllers\School\Configuration;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use App\Classes\Models\AdminConfiguration\AdminConfiguration;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{

    public function index( Request $request )
    {
        $allKey = Config::get( 'admin-configuration' );
        $configurationList = [];
        
        foreach ( $allKey as $key => $value ) {

            $configurations = AdminConfiguration::where( 'key', $key )->first();

            if ( $configurations === null ) {

                $returnArray['key'] = $key;
                $returnArray['value'] = $value['value'];
                $returnArray['label'] = $value['label'];

            } else {

                $returnArray['key'] = $configurations->key;
                $returnArray['value'] = $configurations->value;
                $returnArray['label'] = $configurations->label;
            }

            $configurationList[] = $returnArray;
        }
        
        return view( 'school.configuration.create', compact( 'configurationList' ) );
    }

    public function save( Request $request )
    {
        if ( $request->isMethod( 'post' ) ) {

            $data = $request->except( '_token' );

            $admin = Auth::guard( 'admin' )->getUser();
            $userId = $admin->user_id;
            foreach ( $data as $key => $value ) {

                $settingObj = AdminConfiguration::where( 'key', $key )
                                                ->first();

                if ( $settingObj === null ) {
                    $row = ['user_id' => $userId,
                            'key'     => $key,
                            'label'   => Config::get( 'admin-configuration.' . $key . '.label' ),
                            'value'   => $value];

                    AdminConfiguration::create( $row );

                } else {
                    $row = ['user_id' => $userId,
                            'value'   => $value];

                    $settingObj->update( $row );
                }
            }
        }
        $request->session()
                ->flash( 'success', 'Setting updated successfully.' );
        return Redirect::back();

    }
}