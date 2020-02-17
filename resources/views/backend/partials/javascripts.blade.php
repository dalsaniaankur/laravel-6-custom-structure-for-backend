@inject('helper', 'App\Classes\Helpers\HelperCommon')
@php($isShowBackendScript = false)
@if(!empty($loadingPageType))
@php($isShowBackendScript = $helper->getIsShowBackendStyleAndScriptByPageType($loadingPageType))
@endif
<script type="text/javascript" src="{{url('backend/js/all.js')}}"></script>
<!-- Backend Script -->
@if($isShowBackendScript)
    @include('backend.partials.only_backend_javascripts')
@endif
<!-- Backend Script -->
<script>
    @include('backend.partials.message.toastr')
    window.baseURI = "{{ url('/') }}";
    window._token = "{{ csrf_token() }}";
    @if($isShowBackendScript)
    window.getGradeDropDownUrl = "{{ url('/getgradedropdown') }}";
    window.getClassDropDownUrl = "{{ url('/getclassdropdown') }}";
    window.getStudentDropDownUrl = "{{ url('/getstudentdropdown') }}";
    window.getStateDropDownUrl = "{{ url('/getstatedropdown') }}";
    window.getCityDropDownUrl = "{{ url('/getcitydropdown') }}";
    window.getUserDropDownBySchoolIdUrl = "{{ url('/getuserdropdownbyschoolid') }}";
    window.getUserDropDownByRoleTypeUrl = "{{ url('/getuserdropdownbyroletype') }}";
    window.getStudentMultipleDropDownUrl = "{{ url('/getstudentmultipledropdown') }}";
    window.sendContactMailUrl = "{{ URL::to('contact/send_mail') }}";
    @endif
</script>
<!--Common Js-->
<script type="text/javascript" src="{{url('backend/js/common.js')}}"></script>
@yield('javascript')
