<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
@include('backend.partials.head')
<body>
<div class="loader" id="loader"></div>
@include('backend.partials.header')
@yield('content')
@include('backend.partials.footer')
@include('backend.partials.javascripts')
</body>
</html>
