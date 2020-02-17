@extends('backend.layouts.app')
@section('title', 'Teacher Profile | '.trans('admin.backend_title'))
@section('content')
    <div class="main_section">

        <div class="container n_success">
            <div class="page-wrap bx-shadow my-5 px-sm-5">
                <div class="row user-dt-wrap">

                    <div class="col-lg-12 col-md-12 pb-5">
                        <h1 class="big-heading mb-5">Teacher ({{ $teacher->name }})</h1>
                        <div class="row">
                            <div class="col-md-6 col-lg-6 pb-5 px-md-5 profile_border">
                                <h3 class="text-center mb-4 admin_inner_title">Contact details</h3>

                                <div class="row after_bottom_border">
                                    <div class="col-lg-9 user-dt">

                                        <p><span>{{ $teacher->name }}</span><a
                                                    href="mailto:{{ $teacher->email }}">{{ $teacher->email }}</a></p>

                                        @if(!empty($teacher->created_at) && $teacher->created_at != '0000-00-00 00:00:00')
                                            <p class="mb-5">
                                                <span>Signed up on:</span>{{ DateFacades::dateFormat($teacher->created_at,'format-3') }}
                                                <br> {{ DateFacades::dateFormat($teacher->created_at,'time-format-1') }}
                                                <br/></p>
                                        @endif

                                        <p class="mb-5">
                                            <span> Account:</span> #{{ $teacher->user_id }} <br>
                                        </p>

                                        <p class="mb-5">
                                            <span> Usertype:</span> Teacher <br>
                                        </p>
                                    </div>
                                    <div class="col-lg-3 user-dt-img">
                                        @if ( !empty($teacher->photo) && Common::isFileExists($teacher->photo) )
                                            <img src="{{ url($teacher->photo) }}" alt="">
                                        @else
                                            <img src="{{ url('backend/images/profile-default.png') }}" alt="">
                                        @endif
                                    </div>
                                </div>

                            </div>

                            <div class="col-lg-6 col-md-6 pb-5 px-md-5 label_blue pb0">
                                <h3 class="text-center mb-5 admin_inner_title">Change password</h3>
                                <div class="row after_bottom_border">
                                    <div class="col-lg-12 col-md-12">
                                        {!! Form::open(['method' => 'POST','enctype' => 'multipart/form-data','name'=>'admin-change-password-form', 'id' =>'admin_change_password_form', 'class'=>'login-form','data-parsley-validate','route' => ['teacher.change_password']]) !!}

                                        {{ csrf_field() }}

                                        {!! Form::hidden('user_id', $teacher->user_id, array('id' => 'change_password_user_id')) !!}

                                        {!! Form::label('password', 'New password', ['class' => '']) !!}
                                        <div class="password-box">
                                            {!! Form::password('password', ['id' => 'password', 'class' => 'form-control mb-4', 'placeholder' => 'Password', 'data-parsley-minlength' => '6', 'data-parsley-trigger'=>'keyup', 'required' => '']) !!}
                                            @include('backend.partials.message.field',['field_name' => 'password'])
                                            <span toggle="#password"
                                                  class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                        </div>

                                        {!! Form::label('Confirm Password', 'Confirm Password', ['class' => '']) !!}
                                        <div class="password-box">
                                            {!! Form::password('password_confirmation', ['id' => 'password_confirmation', 'class' => 'form-control mb-4', 'placeholder' => 'Confirm Password', 'data-parsley-equalto' => '#password', 'data-parsley-trigger'=>'keyup', 'data-parsley-minlength' => '6', 'required' => '']) !!}
                                            @include('backend.partials.message.field',['field_name' => 'password_confirmation'])
                                            <span toggle="#password_confirmation"
                                                  class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                        </div>

                                        {!! Form::Submit(trans('admin.qa_save'), ['class' => 'btn btn_green mt-1']) !!}

                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12 pb-5 px-md-5 mt-5 label_blue">
                                <div class="col-lg-6 proborder"></div>
                                <div class="col-lg-6 col-md-6 proborder_right"></div>
                                <h3 class="text-center mb-5 edittitle admin_inner_title">Edit profile</h3>

                                {!! Form::open(['method' => 'POST','enctype' => 'multipart/form-data','name'=>'admin-edit-profile-form', 'id' =>'admin_edit_profile_form', 'class'=>'login-form','data-parsley-validate','route' => ['teacher.profileview']]) !!}

                                {{ csrf_field() }}

                                {!! Form::hidden('user_id', $teacher->user_id, array('id' => 'edit_profile_user_id')) !!}
                                <div class="form-edit-profile">
                                    {!! Form::label('first_name', 'First name', ['class' => '']) !!}
                                    {!! Form::text('first_name', $teacher->first_name, ['class' => 'form-control mb-4', 'required' => '']) !!}

                                    @include('backend.partials.message.field',['field_name' => 'first_name'])
                                </div>
                                <div class="form-edit-profile">
                                    {!! Form::label('last_name', 'Last name', ['class' => '']) !!}
                                    {!! Form::text('last_name', $teacher->last_name, ['class' => 'form-control mb-4', 'required' => '']) !!}
                                    @include('backend.partials.message.field',['field_name' => 'last_name'])
                                </div>
                                <div class="form-edit-profile">
                                    {!! Form::label('email', 'Email', ['class' => '']) !!}
                                    {!! Form::email('email', $teacher->email, ['class' => 'form-control mb-4', 'required' => '']) !!}
                                    @include('backend.partials.message.field',['field_name' => 'email'])
                                </div>

                                <div class="form-edit-profile">
                                    {!! Form::label('country_id', 'Country') !!}
                                    {!! Form::select('country_id', $countryDropDown, $teacher->country_id, ['onchange' => "getStateDropDown(this,'#state_id')",'class' => 'form-control mb-4', 'required' => '']) !!}
                                    @include('backend.partials.message.field',['field_name' => 'country_id'])
                                </div>

                                <div class="form-edit-profile">
                                    {!! Form::label('state_id', 'State') !!}
                                    {!! Form::select('state_id', $stateDropDown, old('state_id'), ['onchange' => "getCityDropDown(this,'#city_id')",'class' => 'form-control mb-4', 'required' => '']) !!}
                                    @include('backend.partials.message.field',['field_name' => 'state_id'])
                                </div>

                                <div class="form-edit-profile">
                                    {!! Form::label('city_id', 'City') !!}
                                    {!! Form::select('city_id', $cityDropDown, old('city_id'), ['class' => 'form-control mb-4', 'required' => '']) !!}
                                    @include('backend.partials.message.field',['field_name' => 'city_id'])
                                </div>

                                <div class="form-edit-profile">
                                    {!! Form::label('gender', 'Gender') !!}
                                    {!! Form::select('gender', ['1' => 'Male','2' => 'Female'], $teacher->gender, ['class' => 'form-control mb-4', 'required' => '']) !!}
                                </div>

                                <div class="form-edit-profile">
                                    <label>Photo</label>
                                    <div id="photo-upload">
                                        @if ( !empty($teacher->photo) && Common::isFileExists($teacher->photo) )
                                            <img src="{{ url($teacher->photo) }}" alt="">
                                        @else
                                            <img src="{{ url('backend/images/profile-default.png') }}" alt="">
                                        @endif
                                        <div class="upload-btn-wrapper">
                                            <input type="file" style="display:none;" data-name="user-profile-file"
                                                   name="photo"
                                                   id="profile_photo">
                                            <button type="button" class="btn btn-orange" id="select_photo">Select Photo
                                            </button>
                                        </div>
                                        <span class="user-profile-file" style="padding-left:10px;"></span>
                                    </div>
                                </div>

                                <div class="form-edit-profilebtn saveh2">{!! Form::Submit(trans('admin.qa_save'), ['class' => 'btn btn_green save_btn_green mt-5']) !!}</div>

                                {!! Form::close() !!}
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
