@inject('helper', 'App\Classes\Helpers\HelperCommon')
@php($isShowForgotPasswordLink = false)
@if(!empty($loadingPageType))
    @php($isShowForgotPasswordLink = $helper->getIsShowForgotPasswordLinkByPageType($loadingPageType))
@endif
@extends('backend.layouts.auth')
@section('title', $roleName.' login | '.trans('admin.backend_title'))
@section('content')
    <div class="main_section">
        <div class="container-fluid">
            <div class="btb-login-wrap">
                <div class="btb-login">
                    <h1 class="text-center mb-4">{{ $roleName }} login</h1>
                    {!! Form::open(['method' => 'POST','data-parsley-validate','route' => [$roleBaseRoute.'_login']]) !!}

                    {!! Form::email('email', old('email'), ['class' => 'form-control mb-4', 'placeholder' => 'Email', 'required' => '', 'data-field-label' => 'Email']) !!}

                    <div class="password-box">
                        {!! Form::password('password', ['id' => 'password', 'class' => 'form-control mb-4 icon', 'placeholder' => 'Password', 'data-parsley-trigger'=>'keyup', 'data-parsley-minlength' => '6', 'required' => '', 'data-field-label' => 'Password']) !!}
                        <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                    </div>

                    <div class="form-edit-profilebtn">
                        {!! Form::Submit(trans('admin.qa_login'), ['class' => 'btn btn_green mt-4']) !!}
                    </div>
                    {!! Form::close() !!}

                    @if($isShowForgotPasswordLink)
                        <div id="forgot">
                            <a href="{{ route($roleBaseRoute.'.password.reset')}}">@lang('admin.qa_forgot_password')</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
