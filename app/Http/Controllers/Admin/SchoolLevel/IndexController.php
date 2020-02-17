<?php

namespace App\Http\Controllers\Admin\SchoolLevel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Classes\Models\SchoolLevel\SchoolLevel;
use App\Classes\Helpers\SchoolLevel\Helper;
use App\Classes\Common\Common;
use App\Classes\Helpers\SearchHelper;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use App\Classes\Models\User\User;

class IndexController extends Controller
{
    protected $schoolLevelObj;
    protected $_helper;

    public function __construct( SchoolLevel $schoolLevelModel )
    {
        $this->schoolLevelObj = $schoolLevelModel;
        $this->_helper = new Helper();
    }

    public function delete( Request $request )
    {
        $data = $request->all();
        if ( empty( $data['id'] ) ) {
            return abort( 404 );
        }
        $isDelete = $this->schoolLevelObj->removed( $data['id'] );
        if ( $isDelete ) {
            $request->session()->flash( 'success', 'School level deleted successfully.' );
        } else {
            $request->session()->flash( 'error', 'School level is not deleted successfully.' );
        }
		$request->session()->flash( 'active_tab', 'school_level' );
        return Redirect::back();
    }

    public function saveAjax( Request $request )
    {
        $data = $request->all();
        $results = $this->schoolLevelObj->saveRecord( $data );
        $request->session()->flash( 'active_tab', 'school_level' );
        if ( ! empty( $results['school_level_id'] ) && $results['school_level_id'] > 0 ) {
            return response()->json( $results );
        } else {
            /* Set Validation Message */
            $message = null;
            foreach ( $results['message'] as $key => $value ) {
                if ( empty( $message ) ) {
                    $message = $results['message']->{$key}[0];
                    break;
                }
            }
            $response = [];
            $response['success'] = false;
            $response['message'] = $message;
            return response()->json( $response );
        }
    }

    public function getDataForEditModel( Request $request )
    {
        $data = $request->all();
        $results = $this->schoolLevelObj->getDateById( $data['school_level_id'] );
        $request->session()->flash( 'active_tab', 'school_level' );
        $response = [];
        $response['success'] = false;
        $response['message'] = '';

        if ( ! empty( $results['school_level_id'] ) && $results['school_level_id'] > 0 ) {
            $response['success'] = true;
            $response['message'] = '';
            $response['data'] = $results;
        }
        return response()->json( $response );
    }

}
