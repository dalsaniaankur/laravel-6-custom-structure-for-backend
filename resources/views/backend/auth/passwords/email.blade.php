@extends('backend.layouts.auth')
@section('title', $roleName.' reset password | '.trans('admin.backend_title'))
@section('content')
    <div class="main_section">
        <div class="container-fluid n_success">
            <div class="btb-login-wrap">
                <div class="btb-login">
                    <h1 class="text-center mb-4">{{$roleName}} reset password</h1>

                    {!! Form::open(['method' => 'POST','data-parsley-validate','route' => [$roleBaseRoute.'.password.email']]) !!}

                    {!! Form::email('email', old('email'), ['class' => 'form-control mb-4', 'placeholder' => 'Email', 'required' => '', 'data-field-label' => 'Email']) !!}

                    {!! Form::Submit(trans('admin.admin_send_password_reset_link'), ['class' => 'btn btn_green mt-4']) !!}

                    {!! Form::close() !!}

                    <div id="forgot">
                        <a href="{{ route($roleBaseRoute.'_login')}}">@lang('admin.qa_login')</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
