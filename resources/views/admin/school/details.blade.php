@extends('backend.layouts.app')
@section('title', 'School Details | '.trans('admin.backend_title'))
@section('content')
<div class="main_section">
	<div class="container n_success">
    	<div class="page-wrap bx-shadow mt-5 mb-5">
            <div class="row user-dt-wrap">
                <div class="col-lg-12 col-md-12 pb-5 school_details">
                    <h1 class="admin_bigheading mb-5 w_100"> {{ $school->school_name }} &nbsp;(Lagos)</h1>
                    <div class="row dashboard-wrap fivecolums">
                        <div class="col-md-6 col-lg-2">
                            <div class="dash-col brd-after">
                                <div class="dash-stats mt-5 mb-5">
                                    <p>Grades</p>
                                    <h3>{{ $school->school_grade_count() }}</h3>
                                    <a href="{{ url('admin/grades?school_id='.$school->user_id)}}" class="btn-md viewbtn">View</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-2">
                            <div class="dash-col brd-after">
                                <div class="dash-stats mt-5 mb-5">
                                    <p>Classes</p>
                                    <h3>{{ $school->school_classes_count() }}</h3>
                                    <a href="{{ url('admin/classes?school_id='.$school->user_id)}}" class="btn-md viewbtn">View</a>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6 col-lg-2">
                            <div class="dash-col brd-after">
                                <div class="dash-stats mt-5 mb-5">
                                    <p>Teachers</p>
                                    <h3>{{ $totalTeachers }}</h3>
                                    <a href="{{ url('admin/teachers?school_id='.$school->user_id) }}" class="btn-md viewbtn">View</a>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6 col-lg-2">
                            <div class="dash-col brd-after">
                                <div class="dash-stats mt-5 mb-5">
                                    <p>Students</p>
                                    <h3>{{ $totalStudents }}</h3>
                                    <a href="{{ url('admin/students?school_id='.$school->user_id) }}" class="btn-md viewbtn">View</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-2">
                            <div class="dash-col">
                                <div class="dash-stats mt-5 mb-5">
                                    <p>Parents</p>
                                    <h3>{{ $totalParents }}</h3>
                                    <a href="{{ url('admin/parents?school_id='.$school->user_id) }}" class="btn-md viewbtn">View</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-2">
                            <div class="dash-col brd-after">
                                <div class="dash-stats mt-5 mb-5">
                                    <p>PTA Members</p>
                                    <h3>{{ $totalPTAMembers }}</h3>
                                    <a href="{{ url('admin/pta-members?school_id='.$school->user_id) }}" class="btn-md viewbtn">View</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-2">
                            <div class="dash-col brd-after">
                                <div class="dash-stats mt-5 mb-5">
                                    <p>Clubs</p>
                                    <h3>{{ $totalClubs }}</h3>
                                    <a href="{{ url('admin/clubs?school_id='.$school->user_id) }}" class="btn-md viewbtn">View</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-2">
                            <div class="dash-col brd-after">
                                <div class="dash-stats mt-5 mb-5">
                                    <p>Exams</p>
                                    <h3>{{ $totalExams }}</h3>
                                    <a href="{{ url('admin/exams?school_id='.$school->user_id) }}" class="btn-md viewbtn">View</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-2">
                            <div class="dash-col">
                                <div class="dash-stats mt-5 mb-5">
                                    <p>Messages</p>
                                    <h3>{{ $totalMessages }}</h3>
                                    <a href="{{ url('admin/messages?role_id=2&user_id='.$school->user_id) }}" class="btn-md viewbtn">View</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            	<div class="col-lg-12 col-md-12 pb-5 school_details">

                    <div class="row">
            		<div class="col-md-12 col-lg-6 pb-5 px-md-5 profile_border">
                        <h3 class="text-center mb-4 admin_inner_title">School info</h3>
                        <div class="row">
                            <div class="col-lg-9 user-dt">
                                <p><span>{{ $school->school_name }} </span>
                                 <span><b>Level:</b></span>{{ $school->getSchoolLevel->school_level_name }}
                                 <span><b>Address:</b></span>
									@if( !empty( $school->address ) )
										{{ $school->address }},
									@endif
									@if( !empty( $school->city_id ) )
										{{ $school->city->city_name }},
									@endif
									@if( !empty( $school->state_id ) )
										{{ $school->state->state_name }},
									@endif
									@if( !empty( $school->country_id ) )
										{{ $school->country->country_name }}
									@endif
									</p>
                                    <p class="mb-5">
                                        <span>Principal</span> {{ $school->getPrincipalNameAttribute() }}
										@if( !empty( $school->principal_phone ) )
                                        <br>+{{$school->principal_phone}}<br>
										@endif
                                        <a href="mailto:{{$school->principal_email}}">{{$school->principal_email}}</a>
									</p>
                                    <p class="mb-5">
                                        <span>Signed up on:</span>{{ DateFacades::dateFormat($school->created_at,'format-3') }}
                                        <br>{{ DateFacades::dateFormat($school->created_at,'time-format-1') }}<br>
									</p>
                                <p class="mb-5">
									<span> Account:</span> #{{ $school->user_id }} <br>
                                </p>

                            </div>
                            <div class="col-lg-3 user-dt-img">
                          		@if ( !empty($school->photo) && Common::isFileExists($school->photo) )
                                    <img src="{{ url($school->photo) }}" alt="">
								@endif
                             </div>
                        </div>
						<div class="user-actions-opt">
							<a href="javascript:void(0)" onclick="openContactModal('.contact-model',{{ $school->user_id }})" class="btn_green schooladminbtn">Contact school admin</a>
							{!! Form::open(array(
                            'method' => 'POST',
                            'onsubmit' => "return confirm('".($school->status == 1 ? trans("admin.qa_are_you_sure_ban_school") : trans("admin.qa_are_you_sure_reactive_school"))."');",
                            'route' => ['admin.school.ban_reactive'])) !!}
                                    {!! Form::hidden('user_id', Common::getEncryptId($school->user_id), array('id' => 'ban_user_id')) !!}
                                    {!! Form::hidden('status', ($school->status == 1 ? 0 : 1 ), array('id' => 'status')) !!}
                                    {!! Form::submit( ($school->status == 1 ? trans('admin.qa_ban_school'): trans('admin.qa_reactive_school') ), array('class'=>($school->status == 1 ? 'ban_account' : 'reactive-user-btn' ))) !!}
                                    {!! Form::close() !!}


                                    {!! Form::open(array('method' => 'DELETE',
                                                        'onclick' => "return schoolDelete()",
                                                        'route' => ['admin.school.delete'], 'id'=>'removeschool')) !!}
                                    {!! Form::hidden('id', $school->user_id, array('id' => 'delete_user_id')) !!}
                                    {!! Form::submit( trans('admin.qa_delete_school'), array('id'=>'del-user','class' => 'ban_account delete_account' )) !!}
                                    {!! Form::close() !!}
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 pb-5 px-md-5 label_blue">
                        <h3 class="text-center mb-5 admin_inner_title">Change password</h3>
                        <div class="row">
							<div class="col-lg-12 col-md-12">
								{!! Form::open(['method' => 'POST','enctype' => 'multipart/form-data','name'=>'admin-change-password-form', 'id' =>'admin_change_password_form', 'class'=>'login-form','data-parsley-validate','route' => ['admin.school.changepassword']]) !!}

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

                    </div>
                </div>

                <div class="col-lg-12 col-md-12 pb-5 school_details_Admin">
                	<div class="row">
                    	<div class="col-md-12 col-lg-6 pb-5 px-md-5 profile_border pl0 pr0">
                        	<h3 class="text-center mb-4 admin_inner_title">School admin</h3>
							{!! Form::open(['method' => 'POST','enctype' => 'multipart/form-data','name'=>'admin-edit-profile-form', 'id' =>'admin_edit_profile_form', 'class'=>'login-form','data-parsley-validate','route' => ['admin.school.saveprofile']]) !!}
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
									{!! Form::label('phone', 'Phone', ['class' => '']) !!}
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
                        	{!! Form::open(['method' => 'POST', 'name'=>'admin-edit-principal-profile-form', 'id' =>'admin_edit_principal_profile_form', 'class'=>'login-form','data-parsley-validate','route' => ['admin.school.saveprincipal']]) !!}
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
									{!! Form::label('principal_phone', 'Phone', ['class' => '']) !!}
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
                    {!! Form::open(['method' => 'POST','enctype' => 'multipart/form-data','name'=>'admin-edit-profile-form', 'id' =>'admin_edit_profile_form', 'class'=>'login-form','data-parsley-validate','route' => ['admin.school.updateschool']]) !!}
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
									{!! Form::select('city_id', $cityDropDown, $school->city_id, ['id' => 'city_id', 'class' => 'form-control mb-4', 'required' => '']) !!}
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
										<input type="file" style="display:none;" data-name="user-profile-file" name="photo"
										   id="profile_photo">
										<button type="button" class="btn btn-orange" id="select_photo">Select Photo</button>
									</div>
                                    <span class="user-profile-file" style="padding-left:10px;"></span>
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
@include('admin.school.contact_model')
@endsection
@section('javascript')
    <script>

        function schoolDelete() {
            var dynamicDialog = $('<div id="conformBox">' + 'Are you sure you want to delete this school?</div>');
            dynamicDialog.dialog({
                title: "Delete school",
                closeText: "",
                draggable: false,
                closeOnEscape: true,
                modal: true,
                minWidth: 450,
                dialogClass: 'customer-remove-dialog',
                open: function (event, ui) {
                    $('body').addClass('modal-open');
                },
                close: function (event, ui) {
                    $('body').removeClass('modal-open');
                },
                buttons:
                    [{
                        text: "Delete",
                        click: function () {
                            $(this).dialog("close");
                            schoolDeleteConfirm();
                        },
                        class: 'cutomer-remove-button',
                    },
                        {
                            text: "Cancel",
                            click: function () {
                                $(this).dialog("close");
                            },
                            class: 'cutomer-remove-cancel',
                        }]
            });
            return false;
        }

        function schoolDeleteConfirm() {
            var dynamicDialog2 = $('<div id="conformBox">' + 'Deleting school is permanent and cannot be undone?</div>');
            dynamicDialog2.dialog({
                title: "Delete school",
                closeOnEscape: true,
                modal: true,
                closeText: "",
                draggable: false,
                minWidth: 550,
                dialogClass: 'customer-remove-dialog',
                open: function (event, ui) {
                    $('body').addClass('modal-open');
                },
                close: function (event, ui) {
                    $('body').removeClass('modal-open');
                },
                buttons:
                    [{
                        text: "Delete",
                        click: function () {
                            $(this).dialog("close");
                            $('#removeschool').submit();
                        },
                        class: 'cutomer-remove-button',
                    },
                        {
                            text: "Cancel",
                            click: function () {
                                $(this).dialog("close");
                            },
                            class: 'cutomer-remove-cancel',
                        }]
            });
            return false;
        }

/* Contact form start */
        var contactForm = 'form#contact_form';
        window.sendContactMailUrl = "{{ URL::to('contact/send_mail') }}";
        contactModelUserIdElement = $(contactForm + " #contact_model_user_id");
        contactModelMessageElement = $(contactForm + " #contact_model_message");
        customErrorMessageElement = $(contactForm + " .custom-error-message");
        customSuccessMessageElement = $(contactForm + " .custom-success-message");

        /* Reset Contact Form */
        function resetContactForm() {
            $(contactForm).parsley().reset();

            contactModelUserIdElement.val("");
            contactModelMessageElement.val("");
        }

	/* Open Contact Model */
    function openContactModal(modelSelector, userId) {
        resetContactForm();
        contactModelUserIdElement.val(userId);
        openModal(modelSelector);
    }

	/* Send Message Ajax Call */
        jQuery(contactForm).submit(function (event) {
            if (jQuery(contactForm).parsley().validate()) {

                event.preventDefault();
                showLoader();

                /* Send Mail */
                jQuery.ajax({
                    url: window.sendContactMailUrl,
                    method: 'post',
                    dataType: 'JSON',
                    data: {
                        '_token': window._token,
                        'user_id': contactModelUserIdElement.val(),
                        'message': contactModelMessageElement.val(),
                    },
                    success: function (response) {
                        if (response.success == true) {
                            resetContactForm();
                            toastr.success(response.message);
                            hideLoader();
                        } else {
                            toastr.error(response.message);
                            hideLoader();
                        }
                    },
                    error: function (xhr, status) {
                        toastr.error(window._ajax_error_msg_common);
                        hideLoader();
                    }
                });
            }
        });
        /* Contact form end */
    </script>
@endsection
