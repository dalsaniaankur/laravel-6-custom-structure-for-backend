<?php

namespace App\Http\Controllers\Admin\Configuration;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use App\Classes\Models\AdminConfiguration\AdminConfiguration;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Classes\Helpers\SearchHelper;
use App\Classes\Models\Allergy\Allergy;
use App\Classes\Common\Common;
use App\Classes\Models\SchoolLevel\SchoolLevel;

class IndexController extends Controller
{

    protected $allergyObj;
    protected $schoolLevelObj;

    public function __construct()
    {
        $this->allergyObj = new Allergy();
        $this->schoolLevelObj = new SchoolLevel();
    }

    public function index( Request $request )
    {
        $allKey = Config::get( 'admin-configuration' );
        $configurationList = [];

        foreach ( $allKey as $key => $value ) {

            $configurations = AdminConfiguration::where( 'key', $key )
                                                ->first();

            if ( $configurations === null ) {

                $returnArray['key'] = $key;
                $returnArray['value'] = $value['value'];
                $returnArray['label'] = $value['label'];
                $returnArray['group_type'] = $value['group_type'];

            } else {

                $returnArray['key'] = $configurations->key;
                $returnArray['value'] = $configurations->value;
                $returnArray['label'] = $configurations->label;
                $returnArray['group_type'] = $configurations->group_type;
            }

            $configurationList[] = $returnArray;
        }
        $currentTab = 'general';
        if ( Session::has( 'active_tab' ) ) {
            $currentTab = Session::get( 'active_tab' );
        }

        $sortedBy = ! empty( $request->get( 'sorted_by' ) ) ? $request->get( 'sorted_by' ) : 'updated_at';
        $sortedOrder = ! empty( $request->get( 'sorted_order' ) ) ? $request->get( 'sorted_order' ) : 'DESC';

        $searchHelper = new SearchHelper( $page = -1, $perPage = -1, $selectColumns = ['*'], $filter = [], $sortOrder = [$sortedBy => $sortedOrder] );
        $allergyLists = $this->allergyObj->getList( $searchHelper );
        $totalRecordCount = $this->allergyObj->getListTotalCount( $searchHelper );
        $recordStart = common::getRecordStart( $page, $perPage );

        $searchHelper = new SearchHelper( $page = -1, $perPage = -1, $selectColumns = ['*'], [], $sortOrder = [$sortedBy => $sortedOrder] );
        $schoolLevelLists = $this->schoolLevelObj->getList( $searchHelper );
        $totalRecordCountForSchoolLevel = $this->schoolLevelObj->getListTotalCount( $searchHelper );
        $recordStartForSchoolLevel = common::getRecordStart( $page, $perPage );

        return view( 'admin.configuration.create', compact( 'configurationList', 'currentTab', 'allergyLists', 'totalRecordCount', 'recordStart', 'totalRecordCount', 'totalRecordCountForSchoolLevel', 'schoolLevelLists', 'recordStartForSchoolLevel' ) );
    }

    public function save( Request $request )
    {
        if ( $request->isMethod( 'post' ) ) {

            $data = $request->except( ['_token',
                                       'currenttab'] );

            $currentSelection = $request->only( 'currenttab' );

            $currentTab = isset( $currentSelection['currenttab'] ) ? $currentSelection['currenttab'] : 'general';

            $admin = Auth::guard( 'admin' )
                         ->getUser();
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
        Session::put( 'active_tab', $currentTab );
        return Redirect::back();

    }
}
