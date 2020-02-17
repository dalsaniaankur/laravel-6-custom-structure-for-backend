<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
@include('backend.partials.head')
<body>
<div class="loader" id="loader"></div>
@include('backend.partials.header')
@yield('content')
@include('backend.partials.footer')
{!! Form::open(['route' => $loadingPageType.'_logout', 'style' => 'display:none;', 'id' => 'logout']) !!}
<button type="submit">Logout</button>
{!! Form::close() !!}
@include('backend.partials.javascripts')
</body>
</html>
