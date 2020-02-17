@extends('backend.layouts.auth')
@section('title', $roleName.' reset password | '.trans('admin.backend_title'))
@section('content')
    <div class="main_section">
        <div class="container-fluid n_success">
            <div class="btb-login-wrap">
                <div class="btb-login">
                    <h1 class="text-center mb-4">{{$roleName}} reset password</h1>

                    {!! Form::open(['method' => 'POST','data-parsley-validate','route' => [$roleBaseRoute.'.password.reset']]) !!}

                    <input type="hidden" name="token" value="{{ $token }}">

                    {!! Form::email('email', old('email'), ['class' => 'form-control mb-4', 'placeholder' => 'Email', 'required' => '', 'data-field-label' => 'Email']) !!}

                    <div class="password-box">
                        {!! Form::password('password', ['id' => 'password', 'class' => 'form-control mb-4', 'placeholder' => 'Password',  'data-parsley-minlength' => '6', 'data-parsley-trigger'=>'keyup', 'required' => '', 'data-field-label' => 'Password']) !!}
                        <span toggle="#password"
                              class="fa fa-fw fa-eye field-icon toggle-password"></span>
                    </div>

                    <div class="password-box">
                        {!! Form::password('password_confirmation', ['id' => 'password_confirmation', 'class' => 'form-control mb-4', 'placeholder' => 'Confirm Password',  'data-parsley-minlength' => '6', 'data-parsley-trigger'=>'keyup', 'required' => '', 'data-parsley-equalto' =>'#password','data-parsley-equalto-message' => 'Password and confirm password should be same.', 'data-field-label' => 'Confirmation password ']) !!}
                        <span toggle="#password_confirmation"
                              class="fa fa-fw fa-eye field-icon toggle-password"></span>
                    </div>
                    {!! Form::Submit(trans('admin.qa_reset_password'), ['class' => 'btn btn_green mt-4']) !!}

                    {!! Form::close() !!}
                    <div id="forgot">
                        <a href="{{ route($roleBaseRoute.'_login')}}">@lang('admin.qa_login')</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
