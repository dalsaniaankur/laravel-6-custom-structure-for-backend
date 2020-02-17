@extends('backend.layouts.app')
@section('title', 'School Profile | '.trans('admin.backend_title'))
@section('content')
    <div class="main_section">

        <div class="container n_success">
            <div class="page-wrap bx-shadow my-5 px-sm-5">
                <div class="row user-dt-wrap">

                    <div class="col-lg-12 col-md-12 pb-5">
                        <h1 class="big-heading mb-5">School ({{ $school->name }})</h1>
                        <div class="row">
                            <div class="col-md-6 col-lg-6 pb-5 px-md-5 profile_border">
                                <h3 class="text-center mb-4 admin_inner_title">Contact details</h3>

                                <div class="row after_bottom_border">
                                    <div class="col-lg-9 user-dt">

                                        <p><span>{{ $school->name }}</span><a
                                                    href="mailto:{{ $school->email }}">{{ $school->email }}</a></p>

                                        @if(!empty($school->created_at) && $school->created_at != '0000-00-00 00:00:00')
                                            <p class="mb-5">
                                                <span>Signed up on:</span>{{ DateFacades::dateFormat($school->created_at,'format-3') }}
                                                <br> {{ DateFacades::dateFormat($school->created_at,'time-format-1') }}
                                                <br/></p>
                                        @endif

                                        <p class="mb-5">
                                            <span> Account:</span> #{{ $school->user_id }} <br>
                                        </p>

                                        <p class="mb-5">
                                            <span> Usertype:</span> School <br>
                                        </p>
                                    </div>
                                    <div class="col-lg-3 user-dt-img">
                                        @if ( !empty($school->photo) && Common::isFileExists($school->photo) )
                                            <img src="{{ url($school->photo) }}" alt="">
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
                                        {!! Form::open(['method' => 'POST','enctype' => 'multipart/form-data','name'=>'school-change-password-form', 'id' =>'school_change_password_form', 'class'=>'login-form','data-parsley-validate','route' => ['school.change_password']]) !!}

                                        {{ csrf_field() }}

                                        {!! Form::hidden('user_id', $school->user_id, array('id' => 'change_password_user_id')) !!}

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

                            <div class="col-lg-12 col-md-12 pb-5 mt1-5 school_details_Admin">
                                <div class="row">
                                    <div class="col-md-12 col-lg-6 pb-5 px-md-5 profile_border pl0 pr0">
                                        <h3 class="text-center mb-4 admin_inner_title">School admin</h3>
                                        {!! Form::open(['method' => 'POST','enctype' => 'multipart/form-data','name'=>'admin-edit-profile-form', 'id' =>'school_edit_profile_form', 'class'=>'login-form','data-parsley-validate','route' => ['school.profile']]) !!}
                                        {{ csrf_field() }}
                                        {!! Form::hidden('user_id', $school->user_id, array('id' => 'edit_profile_user_id')) !!}
                                        <div class="form-edit-profile">
                                            {!! Form::label('first_name', 'First name', ['class' => '']) !!}
                                            {!! Form::text('first_name', $school->first_name, ['class' => 'form-control mb-4', 'required' => '']) !!}

                                            @include('backend.partials.message.field',['field_name' => 'first_name'])
                                        </div>
                                        <div class="form-edit-profile">
                                            {!! Form::label('last_name', 'Last name', ['class' => '']) !!}
                                            {!! Form::text('last_name', $school->last_name, ['class' => 'form-control mb-4', 'required' => '']) !!}
                                            @include('backend.partials.message.field',['field_name' => 'last_name'])
                                        </div>
                                        <div class="form-edit-profile">
                                            {!! Form::label('email', 'Email', ['class' => '']) !!}
                                            {!! Form::email('email', $school->email, ['class' => 'form-control mb-4', 'required' => '']) !!}
                                            @include('backend.partials.message.field',['field_name' => 'email'])
                                        </div>

                                        <div class="form-edit-profile">
                                            {!! Form::label('phone', 'phone', ['class' => '']) !!}
                                            {!! Form::text('phone', $school->phone, ['class' => 'form-control mb-4', 'required' => '']) !!}
                                            @include('backend.partials.message.field',['field_name' => 'phone'])
                                        </div>
                                        <div class="form-edit-profilebtn saveh2">
                                            {!! Form::Submit(trans('admin.qa_save'), ['class' => 'btn btn_green mt-4']) !!}
                                        </div>
                                        {!! Form::close() !!}
                                    </div>
                                    <div class="col-md-12 col-lg-6 pb-5 px-md-5 pl0 pr0">
                                        <h3 class="text-center mb-4 admin_inner_title">Principal</h3>
                                        {!! Form::open(['method' => 'POST', 'name'=>'admin-edit-principal-profile-form', 'id' =>'admin_edit_principal_profile_form', 'class'=>'login-form','data-parsley-validate','route' => ['school.save_principal']]) !!}
                                        {{ csrf_field() }}
                                        {!! Form::hidden('user_id', $school->user_id, array('id' => 'edit_profile_user_id')) !!}
                                        <div class="form-edit-profile">
                                            {!! Form::label('principal_first_name', 'First name', ['class' => '']) !!}
                                            {!! Form::text('principal_first_name', $school->principal_first_name, ['class' => 'form-control mb-4', 'required' => '']) !!}

                                            @include('backend.partials.message.field',['field_name' => 'principal_first_name'])
                                        </div>
                                        <div class="form-edit-profile">
                                            {!! Form::label('principal_last_name', 'Last name', ['class' => '']) !!}
                                            {!! Form::text('principal_last_name', $school->principal_last_name, ['class' => 'form-control mb-4', 'required' => '']) !!}
                                            @include('backend.partials.message.field',['field_name' => 'principal_last_name'])
                                        </div>
                                        <div class="form-edit-profile">
                                            {!! Form::label('principal_email', 'Email', ['class' => '']) !!}
                                            {!! Form::email('principal_email', $school->principal_email , ['class' => 'form-control mb-4', 'required' => '']) !!}
                                            @include('backend.partials.message.field',['field_name' => 'principal_email '])
                                        </div>

                                        <div class="form-edit-profile">
                                            {!! Form::label('principal_phone', 'phone', ['class' => '']) !!}
                                            {!! Form::text('principal_phone', $school->principal_phone, ['class' => 'phone-format form-control mb-4', 'required' => '']) !!}
                                            @include('backend.partials.message.field',['field_name' => 'principal_phone'])
                                        </div>
                                        <div class="form-edit-profilebtn saveh2">
                                            {!! Form::Submit(trans('admin.qa_save'), ['class' => 'btn btn_green mt-4']) !!}
                                        </div>
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 pb-5 px-md-5">
                                <div class="">
                                    <h3 class="w-100 mb-4 admin_inner_title">School information</h3>
                                    {!! Form::open(['method' => 'POST','enctype' => 'multipart/form-data','name'=>'admin-edit-profile-form', 'id' =>'admin_edit_profile_form', 'class'=>'login-form','data-parsley-validate','route' => ['school.save_school']]) !!}
                                    {{ csrf_field() }}
                                    {!! Form::hidden('user_id', $school->user_id, array('id' => 'edit_profile_user_id')) !!}
                                    <div class="form-edit-profile">
                                        {!! Form::label('school_name', 'What is the name of your school?', ['class' => '']) !!}
                                        {!! Form::text('school_name', $school->school_name, ['class' => 'form-control mb-4', 'required' => '']) !!}
                                        @include('backend.partials.message.field',['field_name' => 'school_name'])
                                    </div>

                                    <div class="form-edit-profile">
                                        {!! Form::label(' school_level_id', 'School level', ['class' => '']) !!}
                                        {!! Form::select('school_level_id', $schoollevelDropDown, old('school_level_id', (!empty($school->school_level_id) ? $school->school_level_id : '') ), ['id' => 'school_level_id', 'class' => 'form-control mb-4', 'required' => '']) !!}
                                    </div>

                                    <div class="form-edit-profile">
                                        {!! Form::label('address', 'School address', ['class' => '']) !!}
                                        {!! Form::text('address', $school->address , ['class' => 'form-control mb-4', 'required' => '']) !!}
                                        @include('backend.partials.message.field',['field_name' => ' address '])
                                    </div>

                                    <div class="form-edit-profile">
                                        {!! Form::label('country_id', 'Country', ['class' => '']) !!}
                                        {!! Form::select('country_id', $countryDropDown, $school->country_id, ['onchange' => "getStateDropDown(this,'#state_id')",'class' => 'form-control mb-4', 'required' => '']) !!}
                                        @include('backend.partials.message.field',['field_name' => ' country_id '])
                                    </div>

                                    <div class="form-edit-profile">
                                        {!! Form::label('state_id', 'State', ['class' => '']) !!}
                                        {!! Form::select('state_id', $stateDropDown, $school->state_id, ['onchange' => "getCityDropDown(this,'#city_id')",'class' => 'form-control mb-4', 'required' => '']) !!}
                                        @include('backend.partials.message.field',['field_name' => ' state_id '])
                                    </div>

                                    <div class="form-edit-profile">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                {!! Form::label('city_id ', 'City/Town', ['class' => '']) !!}
                                                {!! Form::select('city_id', $cityDropDown, old('city_id', (!empty($school->city_id) ? $school->city_id : '') ), ['id' => 'city_id', 'class' => 'form-control mb-4', 'required' => '']) !!}
                                                @include('backend.partials.message.field',['field_name' => ' city_id '])
                                            </div>

                                            <div class="col-lg-6">
                                                {!! Form::label('zipcode', 'Zip/Postal code', ['class' => '']) !!}
                                                {!! Form::text('zipcode', $school->zipcode , ['class' => 'form-control mb-4', 'required' => '']) !!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="clear-both mb-4"></div>
                                    <div class="form-edit-profile textareawidth">
                                        <label for="achieve_amazing_result" class=""></label>
                                        {!! Form::label('school_motto', 'School motto', ['class' => '']) !!}
                                        <div class="words"><span class="word-count-school-motto">235</span>words</div>
                                        {!! Form::textarea('school_motto', $school->school_motto , ['class' => 'mb-4 form-control-text-area', 'required' => '', 'cols'=>50, 'rows'=>5, 'data-count-validation'=>'word','data-total-word-accept'=> 235, 'data-counter-selector'=> '.word-count-school-motto' ]) !!}
                                    </div>
                                    <div class="form-edit-profile textareawidth">
                                        <label for="achieve_amazing_result" class=""></label>
                                        {!! Form::label('core_values', 'Core values', ['class' => '']) !!}
                                        <div class="words"><span class="word-count-school-core-values">235</span>words</div>
                                        {!! Form::textarea('core_values', $school->core_values , ['class' => 'mb-4 form-control-text-area', 'required' => '', 'cols'=>50, 'rows'=>5 ,'data-count-validation'=>'word','data-total-word-accept'=> 235, 'data-counter-selector'=> '.word-count-school-core-values' ]) !!}
                                    </div>
                                    <div class="form-edit-profile textareawidth">
                                        <label for="achieve_amazing_result" class=""></label>
                                        {!! Form::label('short_description', 'Short description about the school', ['class' => '']) !!}
                                        <div class="words"><span class="school_short_description">235</span>words</div>
                                        {!! Form::textarea('short_description', $school->short_description , ['class' => 'mb-4 form-control-text-area', 'required' => '', 'cols'=>50, 'rows'=>5, 'data-count-validation'=>'word','data-total-word-accept'=> 235, 'data-counter-selector'=> '.school_short_description' ]) !!}
                                    </div>

                                    <div class="clear-both"></div>
                                    <div class="form-edit-profile1">
                                        {!! Form::label('photo', 'School logo', ['class' => '']) !!}
                                        <div id="photo-upload">
                                            @if ( !empty($school->photo) && Common::isFileExists($school->photo) )
                                                <img src="{{ url($school->photo) }}" alt="">
                                            @else
                                                <img src="{{ url('backend/images/profile-default.png') }}" alt="">
                                            @endif

                                            <div class="upload-btn-wrapper">
                                                <input type="file" class="file-select display-none" data-name="file-name" name="photo">
                                                <button type="button" class="btn btn-orange select-file-btn">Select Photo</button>
                                            </div>
                                            <span class="file-name" style="padding-left:10px;"></span>
                                        </div>
                                    </div>

                                    <div class="form-edit-profilebtn saveh1">
                                        {!! Form::Submit(trans('admin.qa_save'), ['class' => 'btn btn_green mt-4']) !!}
                                    </div>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
