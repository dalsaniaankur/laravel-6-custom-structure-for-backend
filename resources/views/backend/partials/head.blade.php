@inject('helper', 'App\Classes\Helpers\HelperCommon')
@php($isShowBackendStyle = false)
@if(!empty($loadingPageType))
    @php($isShowBackendStyle = $helper->getIsShowBackendStyleAndScriptByPageType($loadingPageType))
@endif
<head>
    <title>@yield('title', trans('admin.backend_title'))</title>

    @include('backend.partials.meta-tags')

    @yield('meta')

    <link rel="shortcut icon" href="{{ url('favicon.ico') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css" media="all">
    <link rel="stylesheet" href="{{ url('backend/css/font-awesome-all.css')}}"
          integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp"
          crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Karla:400,700|Poppins:400,500,600,700&display=swap"
          rel="stylesheet">
    <link rel="stylesheet" href="{{ url('backend/css/all.css')}}">

    <!-- Backend Style -->
    @if($isShowBackendStyle)
    @include('backend.partials.only_backend_style')
    @endif
    <!-- Backend Style -->
    <!--common-->
    <link type="text/css" rel="stylesheet" href="{{ url('backend/css/common.css')}}">
    @yield('stylesheet')
</head>
