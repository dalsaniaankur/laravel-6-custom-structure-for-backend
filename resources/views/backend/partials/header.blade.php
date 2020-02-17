@inject('helper', 'App\Classes\Helpers\HelperCommon')
@php($isShowSideMenu = false)
@if(!empty($loadingPageType))
    @php($isShowSideMenu = $helper->getIsShowSideMenuByPageType($loadingPageType))
@endif
<header class="btb-header">
    <div class="container">
        <nav class="navbar navbar-expand-lg">
            <a href="{{ url('/')}}" class="navbar-brand">
                <img src="{{ url('backend/images/logo.png') }}" class="img-fluid" alt="">
            </a>
            @include('backend.partials.menu_header_top')
            @if($isShowSideMenu)
            @include('backend.partials.menu_header_side')
            @endif
        </nav>
    </div>
</header>
