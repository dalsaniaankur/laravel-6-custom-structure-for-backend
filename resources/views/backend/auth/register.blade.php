@extends('backend.layouts.auth')
@section('title', $roleName.' | '.trans('admin.backend_title'))
@section('content')
    <main>
        <div class="container">
            <div class="row login-top mb-4">
                <div class="col-md-12 text-center wow fadeInUp">
                    <h1>{{ $roleName }} Register</h1>
                </div>
            </div>
            {!! Form::open(['method' => 'POST','enctype' => 'multipart/form-data','data-parsley-validate','route' => [$roleBaseRoute.'_register']]) !!}

            {!! Form::text('first_name', old('first_name'), ['class' => 'form-control mb-4', 'placeholder' => trans('admin.user.fields.first_name'), 'required' => '']) !!}

            {!! Form::text('last_name', old('last_name'), ['class' => 'form-control mb-4', 'placeholder' => trans('admin.user.fields.last_name'), 'required' => '']) !!}

            {!! Form::text('phone', old('phone'), ['id' => 'phone','class' => 'form-control mb-4', 'placeholder' => trans('admin.user.fields.phone'),'required' => '']) !!}

            {!! Form::email('email', old('email'), ['class' => 'form-control mb-4', 'placeholder' => trans('admin.user.fields.email'), 'required' => '']) !!}

            <div class="password-box">
                {!! Form::password('password', ['id' => 'password', 'class' => 'form-control mb-4', 'placeholder' => 'Password', 'data-parsley-minlength' => '6', 'data-parsley-trigger'=>'keyup', 'required' => '']) !!}
                <span toggle="#password"
                      class="fa fa-fw fa-eye field-icon toggle-password"></span>
            </div>
            <div class="password-box">
                {!! Form::password('password_confirmation', ['id' => 'password_confirmation', 'class' => 'form-control mb-4', 'placeholder' => 'Confirm Password', 'data-parsley-equalto' => '#password', 'data-parsley-trigger'=>'keyup', 'data-parsley-minlength' => '6', 'required' => '']) !!}
                <span toggle="#password_confirmation"
                      class="fa fa-fw fa-eye field-icon toggle-password"></span>
            </div>
            <input type="file" style="display:none;" data-name="user-profile-file" name="photo" id="profile_photo">
            <button type="button" class="btn btn-orange select_photo" id="select_photo">Select Photo</button>
            <span class="user-profile-file" style="padding-left:10px;"></span>

            {!! Form::Submit(trans('admin.qa_register'), ['class' => 'btn btn-pink btn-block']) !!}

            {!! Form::close() !!}

            <p id="forgot-link" class="wow fadeInUp"><a href="{{ route($roleBaseRoute.'.password.reset')}}">@lang('admin.qa_forgot_password')</a></p>
        </div>

    </main>
@endsection
