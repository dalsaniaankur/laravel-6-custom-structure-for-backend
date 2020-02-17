@inject('helper', 'App\Classes\Helpers\HelperCommon')
<div class="footer">
    <div class="container">
        <div class="row no-gutters">
            <div class="col-lg-3 col-md-12">
                <img src="{{ url('backend/images/footer_logo.png') }}" class="img-fluid" alt="">
            </div>
            <div class="col-lg-7 col-md-12 d-flex align-items-center">
                @include('backend.partials.menu_footer')
            </div>
            <div class="col-lg-2 col-md-12 d-flex align-items-center">
                @include('backend.partials.footer_social')
            </div>
        </div>
    </div>
    <hr>
    <div class="copyright">
        <small>@ {{ date('Y') }} {!! $helper->getCopyRight() !!}</small>
    </div>
</div>
