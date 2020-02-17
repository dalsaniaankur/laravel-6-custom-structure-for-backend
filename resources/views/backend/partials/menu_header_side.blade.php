@inject('helper', 'App\Classes\Helpers\HelperCommon')
@php($headerTopSideMenu = $helper->getMenuByKey('header_top_side_menu_'.$loadingPageType))
<div class="dropdown account-dropdown div_newdropdownmenu">
    <button class="account-btn dropdown-toggle" type="button" id="account-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        @if ( !empty(Auth::guard($loadingPageType)->user()->photo) && Common::isFileExists(Auth::guard($loadingPageType)->user()->photo) )
            <img src="{{ url(Auth::guard($loadingPageType)->user()->photo) }}" alt="">
        @else
            <img src="{{ url('backend/images/profile-default.png') }}" alt="">
        @endif
        <i class="fas fa-bars"></i>
    </button>
    <div class="dropdown-menu" aria-labelledby="account-btn">
        @foreach($headerTopSideMenu as $headerTopSideMenuKey => $headerTopSideMenuData)
            <li class="nav-item">
                @php($headerMenuLink = !empty($headerTopSideMenuData['link']) ? url($loadingPageType.'/'.$headerTopSideMenuData['link']) : "javascript:void(0);")
                <a class="dropdown-item" href="{{ $headerMenuLink }}">{{ $headerTopSideMenuData['label'] }}</a>
            </li>
        @endforeach
        <a class="dropdown-item" href="javascript:void(0)" onclick="$('#logout').submit();">Logout</a>
    </div>
</div>
