@inject('helper', 'App\Classes\Helpers\HelperCommon')
@php($headerTopMenu = $helper->getMenuByKey('header_top'))
@php($headerTopLoginMenu = $helper->getMenuByKey('header_top_login_menu'))
@php($isShowLoginMenu = false)
@if(!empty($loadingPageType))
    @php($isShowLoginMenu = $helper->getIsShowLoginMenuByPageType($loadingPageType))
@endif
@if(!empty($headerTopMenu))
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#btbMainMenu"
            aria-controls="btbMainMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon" style="color: #fff;"></span>
    </button>

    <div id="btbMainMenu" class="collapse navbar-collapse">
        <ul class="navbar-nav mr-auto">
            @foreach($headerTopMenu as $headerTopMenuKey => $headerTopMenuData)
                <li class="nav-item">
                    @php($headerMenuLink = !empty($headerTopMenuData['link']) ? url($headerTopMenuData['link']) : "javascript:void(0);")
                    <a href="{{ $headerMenuLink }}" aria-current="page" class="nav-link">{{ $headerTopMenuData['label'] }}</a>
                </li>
            @endforeach
            @if($isShowLoginMenu)
            <li class="nav-item logindropdown"><a
                    href="javascript:void(0);" class="nav-link dropdown-toggle" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="true">Login</a>
                <ul class="dropdown-menu user-login-menu">
                    @foreach($headerTopLoginMenu as $headerTopLoginMenuKey => $headerTopLoginMenuData)
                    @php($headerMenuTopLink = !empty($headerTopLoginMenuData['link']) ? url($headerTopLoginMenuData['link']) : "javascript:void(0);")
                    <li><a href="{{ $headerMenuTopLink }}">{{ $headerTopLoginMenuData['label'] }}</a></li>
                    @endforeach
                </ul>
            </li>
            @endif
        </ul>
    </div>

@endif
