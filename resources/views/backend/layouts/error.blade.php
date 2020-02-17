<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
@include('backend.partials.head')
<body>
@include('backend.partials.header')
<main>
    <div class="main_section">
        <div class="container">
            <div class="msg_section">
                <h1> @yield('code', __('Oh no'))</h1>
                <div class="msgborder"></div>
                <p>
                    @yield('message')
                </p>
                <a href="{{ app('router')->has('home') ? route('home') : url('/') }}">
                    <button class="">
                        {{ __('Go Home') }}
                    </button>
                </a>
            </div>
        </div>
    </div>
</main>
@include('backend.partials.footer')
@include('backend.partials.javascripts')
</body>
</html>
