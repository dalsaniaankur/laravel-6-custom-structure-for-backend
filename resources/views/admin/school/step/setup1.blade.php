@extends('backend.layouts.app')
@section('title', 'Create school | '.trans('admin.backend_title'))
@section('content')
    <div class="main_section">
        <div class="container n_success">
            <div class="page-wrap bx-shadow mt-5 mb-5">
                <h1 class="big-heading">Welcome to the kidrend Backend System</h1>
                <div class="setup1_banner">
                    <img src="{{ url('backend/images/welcome_banner.png') }}" class="img-fluid" alt="">
                    <div class="banner_title">
                        <h4>To help set things up,please carefully fill in the information requested on the next few
                            screens.</h4>
                    </div>
                </div>
                <div class="row user-dt-wrap">
                    <div class="col-lg-12 col-md-12">
                        <h1 class="bigheading mt-5 mb-5"><span class="number_round">1</span>School information</h1>
                        <div class="col-lg-12 pb-5 px-md-3">
                            {!! Form::open(['method' => 'POST','enctype' => 'multipart/form-data','name'=>'admin-school-create', 'id' =>'admin_school_create_form', 'class'=>'school-create-form','data-parsley-validate','route' => ['admin.school.create.save']]) !!}
                            {{ csrf_field() }}
                            <input id="user_id" name="user_id" type="hidden"
                                   value="{{ (!empty($school->user_id) ? $school->user_id : '') }}">
                            <div class="form-edit-profile">
                                {!! Form::label('school_name', 'What is the name of your school?') !!}
                                {!! Form::text('school_name', old('school_name', (!empty($school->school_name) ? $school->school_name : '') ), ['class' => 'form-control mb-4', 'required' => '']) !!}
                                @include('backend.partials.message.field',['field_name' => 'school_name'])
                            </div>

                            <div class="form-edit-profile">
                                {!! Form::label('school_level_id', 'School level') !!}
                                {!! Form::select('school_level_id', $schoollevelDropDown, old('school_level_id', (!empty($school->school_level_id) ? $school->school_level_id : '') ), ['id' => 'school_level_id', 'class' => 'form-control mb-4', 'required' => '']) !!}
                                @include('backend.partials.message.field',['field_name' => 'school_level_id'])
                            </div>
                            <div class="form-edit-profile">
                                {!! Form::label('address', 'School address') !!}
                                {!! Form::text('address', old('address', (!empty($school->address) ? $school->address : '') ), ['class' => 'form-control mb-4', 'required' => '']) !!}
                                @include('backend.partials.message.field',['field_name' => 'address'])
                            </div>

                            <div class="form-edit-profile">
                                {!! Form::label('country_id', 'Country', ['class' => '']) !!}
                                {!! Form::select('country_id', $countryDropDown, old('country_id', (!empty($school->country_id) ? $school->country_id : '') ), ['onchange' => "getStateDropDown(this,'#state_id')",'class' => 'form-control mb-4', 'required' => '']) !!}
                                @include('backend.partials.message.field',['field_name' => ' country_id '])
                            </div>

                            <div class="form-edit-profile">
                                {!! Form::label('state_id', 'State', ['class' => '']) !!}
                                {!! Form::select('state_id', $stateDropDown, old('state_id', (!empty($school->state_id) ? $school->state_id : '') ), ['onchange' => "getCityDropDown(this,'#city_id')",'class' => 'form-control mb-4', 'required' => '']) !!}
                                @include('backend.partials.message.field',['field_name' => ' state_id '])
                            </div>

                            <div class="form-edit-profile">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label for="email" class=""></label>
                                        {!! Form::label('city_id', 'City/Town') !!}
                                        {!! Form::select('city_id', $cityDropDown, old('city_id', (!empty($school->city_id) ? $school->city_id : '') ), ['id' => 'city_id', 'class' => 'form-control mb-4', 'required' => '']) !!}
                                        @include('backend.partials.message.field',['field_name' => 'city_id'])
                                    </div>
                                    <div class="col-lg-6">
                                        {!! Form::label('zipcode', 'Zip/Postal code') !!}
                                        {!! Form::text('zipcode', old('zipcode', (!empty($school->zipcode) ? $school->zipcode : '') ), ['class' => 'form-control mb-4', 'required' => '']) !!}
                                        @include('backend.partials.message.field',['field_name' => 'zipcode'])
                                    </div>
                                </div>
                            </div>
                            <div class="clear-both mb-4"></div>
                            <div class="form-edit-profile">
                                {!! Form::label('principal_first_name', 'Principal\'s first name') !!}
                                {!! Form::text('principal_first_name', old('principal_first_name', (!empty($school->principal_first_name) ? $school->principal_first_name : '') ), ['class' => 'form-control mb-4', 'required' => '']) !!}
                                @include('backend.partials.message.field',['field_name' => 'principal_first_name'])
                            </div>
                            <div class="form-edit-profile">
                                {!! Form::label('principal_last_name', 'Principal\'s last name') !!}
                                {!! Form::text('principal_last_name', old('principal_last_name', (!empty($school->principal_last_name) ? $school->principal_last_name : '') ), ['class' => 'form-control mb-4', 'required' => '']) !!}
                                @include('backend.partials.message.field',['field_name' => 'principal_last_name'])
                            </div>
                            <div class="form-edit-profile">
                                {!! Form::label('principal_email', 'Principal\'s email') !!}
                                {!! Form::email('principal_email', old('principal_email', (!empty($school->principal_email) ? $school->principal_email : '') ), ['class' => 'form-control mb-4', 'required' => '']) !!}
                                @include('backend.partials.message.field',['field_name' => 'principal_email'])
                            </div>
                            <div class="form-edit-profile">
                                {!! Form::label('principal_phone', 'Principal\'s full phone') !!}
                                {!! Form::text('principal_phone', old('principal_phone', (!empty($school->principal_phone) ? $school->principal_phone : '') ), ['class' => 'form-control mb-4 phone-format', 'required' => '']) !!}
                                @include('backend.partials.message.field',['field_name' => 'principal_phone'])
                            </div>
                            <div class="clear-both mb-4"></div>
                            <div class="form-edit-profile">
                                {!! Form::label('first_name', 'School admin first name') !!}
                                {!! Form::text('first_name', old('first_name', (!empty($school->first_name) ? $school->first_name : '') ), ['class' => 'form-control mb-4', 'required' => '']) !!}
                                @include('backend.partials.message.field',['field_name' => 'first_name'])
                            </div>
                            <div class="form-edit-profile">
                                {!! Form::label('last_name', 'School admin last name') !!}
                                {!! Form::text('last_name', old('last_name', (!empty($school->last_name) ? $school->last_name : '') ), ['class' => 'form-control mb-4', 'required' => '']) !!}
                                @include('backend.partials.message.field',['field_name' => 'last_name'])
                            </div>
                            <div class="form-edit-profile">
                                {!! Form::label('email', 'School admin email') !!}
                                {!! Form::email('email', old('email', (!empty($school->email) ? $school->email : '') ), ['class' => 'form-control mb-4', 'required' => '']) !!}
                                @include('backend.partials.message.field',['field_name' => 'email'])
                            </div>
                            <div class="form-edit-profile">
                                {!! Form::label('phone', 'School admin full phone') !!}
                                {!! Form::text('phone', old('phone', (!empty($school->phone) ? $school->phone : '') ), ['class' => 'form-control mb-4', 'required' => '']) !!}
                                @include('backend.partials.message.field',['field_name' => 'phone'])
                            </div>
                            <div class="clear-both mb-4"></div>
                            <div class="form-edit-profile textareawidth">
                                {!! Form::label('school_motto', 'School motto') !!}
                                <div class="words"><span class="word-count-school-motto">235</span>words</div>
                                {!! Form::textarea('school_motto', old('school_motto', (!empty($school->school_motto) ? $school->school_motto : '') ), ['class' => 'form-control-text-area mb-4', 'required' => '', 'cols'=>'50', 'rows'=>'5', 'data-count-validation'=>'word','data-total-word-accept'=> 235, 'data-counter-selector'=> '.word-count-school-motto' ]) !!}
                            </div>
                            <div class="form-edit-profile textareawidth">
                                {!! Form::label('core_values', 'Core values') !!}
                                <div class="words"><span class="word-count-core-values">235</span>words</div>
                                {!! Form::textarea('core_values', old('core_values', (!empty($school->core_values) ? $school->core_values : '') ), ['class' => 'form-control-text-area mb-4', 'required' => '', 'cols'=>'50', 'rows'=>'5','data-count-validation'=>'word','data-total-word-accept'=> 235, 'data-counter-selector'=> '.word-count-core-values' ]) !!}
                            </div>
                            <div class="form-edit-profile textareawidth">
                                <label for="achieve_amazing_result" class=""></label>
                                {!! Form::label('short_description', 'Short description about the school') !!}
                                <div class="words"><span class="word-count-short-description">235</span>words</div>
                                {!! Form::textarea('short_description', old('short_description', (!empty($school->short_description) ? $school->short_description : '') ), ['class' => 'form-control-text-area mb-4', 'required' => '', 'cols'=>'50', 'rows'=>'5','data-count-validation'=>'word','data-total-word-accept'=> 235, 'data-counter-selector'=> '.word-count-short-description' ]) !!}
                            </div>
                            <div class="clear-both"></div>
                            <div class="form-edit-profile1">
                                <label>School logo</label>
                                <div id="photo-upload">
                                    @if ( !empty($school->photo) && Common::isFileExists($school->photo) )
                                        <img src="{{ url($school->photo) }}" alt="">
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
                            <div class="form-edit-profilebtn saveh1">
                                {!! Form::Submit(trans('admin.qa_save'), ['class' => 'btn btn_green mt-4']) !!}
                            </div>
                            @if( isset( $school->user_id ) && $school->user_id > 0 )
                                <div class="form-edit-profilebtn nextstep mt-5">
                                    <a class="btn btn_green blue_btn"
                                       href="{{ url('admin/grade/create').'/'.Common::getEncryptId($school->user_id) }}">Proceed
                                        to next step</a>
                                </div>
                            @endif
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
