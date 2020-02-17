<?php

namespace App\Http\Controllers\Admin\allergy;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Classes\Models\Allergy\Allergy;
use App\Classes\Helpers\Exam\Helper;
use App\Classes\Common\Common;
use App\Classes\Helpers\SearchHelper;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use App\Classes\Models\User\User;

class IndexController extends Controller
{
    protected $allergyObj;
    protected $_helper;

    public function __construct( Allergy $allergyModel )
    {
        $this->allergyObj = $allergyModel;
        $this->_helper = new Helper();
    }


    public function delete( Request $request )
    {
        $data = $request->all();
        if ( empty( $data['id'] ) ) {
            return abort( 404 );
        }
        $isDelete = $this->allergyObj->removed( $data['id'] );
        if ( $isDelete ) {
            $request->session()->flash( 'success', 'Allergy deleted successfully.' );
        } else {
            $request->session()->flash( 'error', 'Allergy is not deleted successfully.' );
        }
		$request->session()->flash( 'active_tab', 'allergies' );
        return Redirect::back();
    }

    public function saveAjax( Request $request )
    {
        $data = $request->all();
        $results = $this->allergyObj->saveRecord( $data );
		$request->session()->flash( 'active_tab', 'allergies' );
        if ( ! empty( $results['allergie_id'] ) && $results['allergie_id'] > 0 ) {
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
        $results = $this->allergyObj->getDateById( $data['allergie_id'] );
		$request->session()->flash( 'active_tab', 'allergies' );
        $response = [];
        $response['success'] = false;
        $response['message'] = '';

        if ( ! empty( $results['allergie_id'] ) && $results['allergie_id'] > 0 ) {
            $response['success'] = true;
            $response['message'] = '';
            $response['data'] = $results;
        }
        return response()->json( $response );
    }

}
