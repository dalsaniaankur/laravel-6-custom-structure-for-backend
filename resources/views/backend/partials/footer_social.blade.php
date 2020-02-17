@inject('helper', 'App\Classes\Helpers\HelperCommon')
@php($facebookUrl = $helper->getFacebookUrl())
@php($twitterUrl = $helper->getTwitterUrl())
@php($linkedinUrl = $helper->getLinkedinUrl())
<div class="social_icon">
    @if(!empty($facebookUrl))
        <a href="{{ $facebookUrl }}" class="fb" target="_blank"><i
                class="fab fa-facebook-f"></i></a>
    @endif
    @if(!empty($twitterUrl))
        <a href="{{ $twitterUrl }}" class="twitter" target="_blank"><i
                class="fab fa-twitter"></i></a>
    @endif
    @if(!empty($linkedinUrl))
        <a href="{{ $linkedinUrl }}" class="linkedin" target="_blank"><i
                class="fab fa-linkedin-in"></i></a>
    @endif
</div>
