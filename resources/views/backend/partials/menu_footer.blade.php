@inject('helper', 'App\Classes\Helpers\HelperCommon')
@php($footerMenu = $helper->getMenuByKey('footer'))
@if(!empty($footerMenu))
    <div class="footer_menu">
        <ul>
            @foreach($footerMenu as $footerMenuKey => $footerMenuData)
                @php($footerMenuLink = !empty($footerMenuData['link']) ? url($footerMenuData['link']) : "javascript:void(0);")
                <li><a href="{{ $footerMenuLink }}">{{ $footerMenuData['label'] }}</a></li>
            @endforeach
        </ul>
    </div>
@endif
