@extends('backend.layouts.app')
@section('title', 'Student Profile | '.trans('admin.backend_title'))
@section('content')
    <div class="main_section">

        <div class="container n_success">
            <div class="details_tabs mt-3">
                <a href="javascript:void(0);" class="active">Profile</a>
                <a href="{{ url('school/student/academics')}}/{{ Common::getEncryptId($student->user_id) }}">Academics</a>
                <a href="{{ url('school/student/feed')}}/{{ Common::getEncryptId($student->user_id) }}">feed</a>
            </div>
            <div class="page-wrap bx-shadow mt-3 mb-5">
                <div class="row user-dt-wrap">
                    <div class="col-lg-12 col-md-12 pb-5 school_details profile_details">
                        <h1 class="admin_bigheading mb-5 w_100">Profile: Princess Adaku</h1>
                        <div class="row">
                            <div class="col-md-6 col-lg-6 pb-5 px-md-5 profile_border">
                                <h3 class="text-center mb-4 admin_inner_title">Account Info</h3>
                                <div class="row">
                                    <div class="col-lg-9 user-dt">
                                        <p><span>{{ $student->name }}</span>
                                            <span
                                                style="font-weight:normal;"><b>Grade:</b></span>{{ $student->grade->grade_name }}
                                            <br><br>
                                            <span
                                                style="font-weight:normal;"><b>Gender:</b></span>{{ $student->gender == 1 ? "Male" : "Female" }}
                                        </p>
                                        @if($studentParents->count() > 0)
                                            <p class="mb-5">
                                                <span>Parent:</span>
                                                @foreach($studentParents as $studentParentKey => $studentParent )
                                                    {{ $studentParent->parent->name }}<br>
                                                    @if(!empty($studentParent->parent->phone))
                                                        {{ Common::getPhoneFormat( $studentParent->parent->phone ) }}
                                                        <br>
                                                    @endif
                                                    <a href="{{ $studentParent->parent->email }}">{{ $studentParent->parent->email }}</a>
                                                    <br><br>
                                                @endforeach
                                            </p>
                                        @endif
                                        <p class="mb-5">
                                            <span>Signed up on:</span>{{ DateFacades::dateFormat($student->created_at,'format-3') }}
                                            <br>{{ DateFacades::dateFormat($student->created_at,'time-format-1') }}<br>
                                        </p>
                                    </div>
                                    <div class="col-lg-3 user-dt-img">
                                        @if ( !empty($student->photo) && Common::isFileExists($student->photo) )
                                            <img src="{{ url($student->photo) }}" alt="">
                                        @else
                                            <img src="{{ url('backend/images/profile-default.png') }}" alt="">
                                        @endif
                                    </div>
                                    {!! Form::hidden('contact_user_type', '', array('id' => 'contact_user_type')) !!}
                                </div>
                                <div class="user-actions-opt">
                                <!-- <a href="#" class="btn_green schooladminbtn" onclick="openContactModal('.contact-model',{{ $student->user_id }})">Contact parent</a> -->
                                    <input class="btn_green schooladminbtn" type="button" value="Contact parent"
                                           onclick="openContactModal('.contact-model',{{ $student->user_id }}, '1' )">

                                    {!! Form::open(array(
                            'method' => 'POST',
                            'onsubmit' => "return confirm('".($student->status == 1 ? trans("admin.qa_are_you_sure_ban_user") : trans("admin.qa_are_you_sure_reactive_user"))."');",
                            'route' => ['school.student.ban_reactive'])) !!}
                                    {!! Form::hidden('user_id', Common::getEncryptId($student->user_id), array('id' => 'ban_user_id')) !!}
                                    {!! Form::hidden('status', ($student->status == 1 ? 0 : 1 ), array('id' => 'status')) !!}
                                    {!! Form::submit( ($student->status == 1 ? trans('admin.qa_ban_user'): trans('admin.qa_reactive_user') ), array('class'=>($student->status == 1 ? 'ban_account' : 'reactive-user-btn' ))) !!}
                                    {!! Form::close() !!}


                                    {!! Form::open(array('method' => 'DELETE',
                                                        'onclick' => "return studentDelete()",
                                                        'route' => ['school.student.delete'], 'id'=>'removecustomer')) !!}
                                    {!! Form::hidden('id', $student->user_id, array('id' => 'delete_user_id')) !!}
                                    {!! Form::submit( trans('admin.qa_delete_user'), array('id'=>'del-user','class' => 'ban_account delete_account' )) !!}
                                    {!! Form::close() !!}

                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 pb-5 px-md-5 label_blue">
                                <h3 class="text-center mb-5 admin_inner_title">Change password</h3>
                                <div class="row">
                                    <div class="col-lg-12 col-md-12">

                                        {!! Form::open(['method' => 'POST','enctype' => 'multipart/form-data','name'=>'student-change-password-form', 'id' =>'student_change_password_form', 'class'=>'mb-5','data-parsley-validate','route' => ['school.student.change_password']]) !!}

                                        {!! Form::hidden('user_id', $student->user_id, array('id' => 'change_password_user_id')) !!}

                                        {!! Form::label('password', 'New password', ['class' => 'bluecolor']) !!}
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

                                        <div class="saveh2">
                                            {!! Form::Submit(trans('admin.qa_save'), ['class' => 'btn btn_green mt-1']) !!}
                                        </div>

                                        {!! Form::close() !!}

                                        @if($studentTeacher->count() > 0)

                                            <div class="teacher-details-contacts">
                                                <span>Teacher:</span>
                                                @foreach($studentTeacher as $studentTeacherKey => $studentTeacher )
                                                    <div class="row mb-3">
                                                        <div class="float-left col-lg-6">
                                                            {{ $studentTeacher->name }}
                                                            <br>{{ Common::getPhoneFormat( $studentTeacher->phone ) }}
                                                            <br>
                                                            <a href="{{ $studentTeacher->email }}">{{ $studentTeacher->email }}</a>
                                                        </div>
                                                        <div class="user-actions-opt float-right col-lg-6">
                                                            <input class="btn btn_green" type="button"
                                                                   value="Contact teacher"
                                                                   onclick="openContactModal('.contact-model',{{ $studentTeacher->user_id }}, '2')">
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif

                                        <div class="school_details user-dt">
                                            <p class="mb-5">
                                                <span> Account:</span> #{{ $student->user_id }}
                                            </p>
                                            <p class="mb-5">
                                                <span> Usertype:</span> Student
                                            </p>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 pb-5 px-md-5 editspace">
                        <div class="row">
                            <h3 class="w-100 text-center mb-4 admin_inner_title">Edit Profile</h3>

                            {!! Form::open(['method' => 'POST','enctype' => 'multipart/form-data','name'=>'student-edit-profile-form', 'id' =>'student_edit_profile_form', 'class'=>'w-100','data-parsley-validate','route' => ['school.student.profile.save']]) !!}

                            {!! Form::hidden('user_id', $student->user_id, array('id' => 'edit_profile_user_id')) !!}
                            {!! Form::hidden('student_parent_id', $studentParentId, array('id' => 'student_parent_id')) !!}

                            <div class="form-edit-profile">
                                {!! Form::label('parent_id', 'Parent') !!}
                                {!! Form::select('parent_id', $parentDropDown, $parentId, ['class' => 'form-control mb-4', 'required' => '']) !!}
                                @include('backend.partials.message.field',['field_name' => 'parent_id'])
                            </div>

                            <div class="form-edit-profile">
                                {!! Form::label('first_name', 'First name', ['class' => '']) !!}
                                {!! Form::text('first_name', $student->first_name, ['class' => 'form-control mb-4', 'required' => '']) !!}
                                @include('backend.partials.message.field',['field_name' => 'first_name'])
                            </div>

                            <div class="form-edit-profile">
                                {!! Form::label('last_name', 'Last name', ['class' => '']) !!}
                                {!! Form::text('last_name', $student->last_name, ['class' => 'form-control mb-4', 'required' => '']) !!}
                                @include('backend.partials.message.field',['field_name' => 'last_name'])
                            </div>

                            <div class="form-edit-profile">
                                {!! Form::label('email', 'Email', ['class' => '']) !!}
                                {!! Form::email('email', $student->email, ['class' => 'form-control mb-4', 'required' => '']) !!}
                                @include('backend.partials.message.field',['field_name' => 'email'])
                            </div>

                            <div class="form-edit-profile">
                                {!! Form::label('date_of_birth', 'Date of birth ') !!}
                                {!! Form::text('date_of_birth', $student->date_of_birth_datepicker_format, ['class' => 'form-control mb-4 date-field', 'data-toggle'=>'datepicker']) !!}
                                @include('backend.partials.message.field',['field_name' => 'date_of_birth'])
                            </div>

                            {!! Form::hidden('school_id', $student->school_id, array('id' => 'school_id')) !!}

                            <div class="form-edit-profile">
                                {!! Form::label('grade_id', 'Grade') !!}
                                {!! Form::select('grade_id', $gradeDropDown, $student->grade_id, ['onchange' => "getClassDropDown(this,'#class_id','#school_id')",'class' => 'form-control mb-4', 'required' => '']) !!}
                                @include('backend.partials.message.field',['field_name' => 'grade_id'])
                            </div>
                            <div class="form-edit-profile">
                                {!! Form::label('class_id', 'Class') !!}
                                {!! Form::select('class_id', $classesDropDown, $student->class_id, ['class' => 'form-control mb-4', 'required' => '']) !!}
                                @include('backend.partials.message.field',['field_name' => 'grade_id'])
                            </div>

                            <div class="form-edit-profile">
                                {!! Form::label('gender', 'Gender') !!}
                                {!! Form::select('gender', ['1' => 'Male','2' => 'Female'], $student->gender, ['class' => 'form-control mb-4', 'required' => '']) !!}
                            </div>

                            <div class="form-edit-profile">
                                {!! Form::label('eye_color', 'Eye Color', ['class' => '']) !!}
                                {!! Form::text('eye_color', $student->eye_color, ['class' => 'form-control mb-4']) !!}
                                @include('backend.partials.message.field',['field_name' => 'eye_color'])
                            </div>

                            <div class="form-edit-profile">
                                {!! Form::label('hair_color', 'Hair Color', ['class' => '']) !!}
                                {!! Form::text('hair_color', $student->hair_color, ['class' => 'form-control mb-4']) !!}
                                @include('backend.partials.message.field',['field_name' => 'hair_color'])
                            </div>

                            <div class="form-edit-profile inches">
                                <div class="row">
                                    <div class="col-lg-12">
                                        {!! Form::label('height', 'Height (Feet and inches)', ['class' => '']) !!}
                                        {!! Form::text('height_in_meter', $student->height_in_meter, ['class' => 'form-control mb-4 meters']) !!}
                                        {!! Form::text('height_in_inche', $student->height_in_inche, ['class' => 'form-control mb-4']) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="form-edit-profile">
                                {!! Form::label('weight', 'Weight (in kilos)', ['class' => '']) !!}
                                {!! Form::text('weight', $student->weight, ['class' => 'form-control mb-4', 'placeholder' =>'Weight in Kilos']) !!}
                                @include('backend.partials.message.field',['field_name' => 'weight'])
                            </div>

                            <div class="form-edit-profile profiletextarea">
                                <label for="achieve_amazing_result" class="">Comment</label>
                                {!! Form::textarea('comment', $student->comment, ['class' => 'form-control-text-area mb-4', 'rows' => 5]) !!}
                            </div>

                            <div class="form-edit-profile1">
                                <label>Photo</label>
                                <div id="photo-upload">
                                    @if ( !empty($student->photo) && Common::isFileExists($student->photo) )
                                        <img src="{{ url($student->photo) }}" alt="">
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
                            {!! Form::close() !!}
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 pb-0 pt-5 pb0 Profilecategory">
                        <div class="row">
                            <div class="col-md-6 col-lg-6 pb-5 px-md-5 profile_border">
                                <h3 class="text-center mb-4 admin_inner_title">Allergies({{count($allergies)}})</h3>

                                {!! Form::open(['method' => 'POST','enctype' => 'multipart/form-data','name'=>'student-allergy-form', 'id' =>'student_allergy_form', 'class'=>'w-100','data-parsley-validate','route' => ['school.student.allergy.save']]) !!}

                                {!! Form::hidden('user_id', $student->user_id, array('id' => 'allergy_user_id')) !!}

                                <div class="form-edit-profile">
                                    {!! Form::label('allergie_id', 'Allergy') !!}
                                    {!! Form::select('allergie_id', $allergyDropDown, '', ['class' => 'form-control mb-4', 'required' => '']) !!}

                                    <div class="form-edit-profilebtn saveh3">
                                        {!! Form::Submit('Add', ['class' => 'btn btn_green mt-1']) !!}
                                    </div>
                                </div>

                                {!! Form::close() !!}
                            </div>
                            <div class="col-md-6 col-lg-6 pb-5 px-md-5">
                                <h3 class="text-center mb-4 admin_inner_title">Clubs({{ count($clubs) }})</h3>

                                {!! Form::open(['method' => 'POST','enctype' => 'multipart/form-data','name'=>'student-club-form', 'id' =>'student_club_form', 'class'=>'w-100','data-parsley-validate','route' => ['school.student.club.save']]) !!}

                                {!! Form::hidden('user_id', $student->user_id, array('id' => 'club_user_id')) !!}

                                <div class="form-edit-profile">
                                    {!! Form::label('club_id', 'Club') !!}
                                    {!! Form::select('club_id', $clubDropDown, '', ['class' => 'form-control mb-4', 'required' => '']) !!}

                                    <div class="form-edit-profilebtn saveh3">
                                        {!! Form::Submit('Add', ['class' => 'btn btn_green mt-1']) !!}
                                    </div>
                                </div>

                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                    @if((!empty($allergies) && count($allergies) > 0) || (!empty($clubs) && count($clubs) > 0))
                        <div class="col-lg-12 col-md-12 pb-0 pt-0 pb0 pt0 Profilecategory">
                            <div class="row">
                                <div class="col-md-6 col-lg-6 pb-0 pb0 px-md-5">
                                    <div class="table-responsive EMT_table">
                                        <table class="table sorting data-table">
                                            <tbody>
                                            @if(!empty($allergies) && count($allergies) > 0)
                                                @foreach($allergies as $allergyKey => $allergy)
                                                    <tr>
                                                        <td>
                                                            <div class="setup3_bullet">
                                                                <p>{{ $allergy->allergy->allergy_name }}</p>
                                                                <p class="lightfont">
                                                                    <span>-</span>{{ DateFacades::dateFormat($allergy->created_at,'format-13') }}
                                                                </p>
                                                            </div>
                                                        </td>
                                                        <td class="EMT_icon">
                                                            {!! Form::open(array(
                                                                'method' => 'DELETE',
                                                                'onsubmit' => "return confirm('".trans("admin.qa_are_you_sure_delete")." allergy?');",
                                                                'route' => ['school.student.allergy.delete'])) !!}
                                                            {!! Form::hidden('id',$allergy->student_allergie_id ) !!}

                                                            <button type="submit" value="Delete" class="delete_btn">
                                                                <i class="far fa-times-circle"></i>
                                                            </button>

                                                            {!! Form::close() !!}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6 pb-0 px-md-5">
                                    <div class="table-responsive EMT_table">
                                        <table class="table sorting data-table">
                                            <tbody>
                                            @if(!empty($clubs) && count($clubs) > 0)
                                                @foreach($clubs as $clubKey => $club)
                                                    <tr>
                                                        <td>
                                                            <div class="setup3_bullet">
                                                                <p>{{ $club->club->club_name }}</p>
                                                                <p class="lightfont">
                                                                    <span>-</span>{{ DateFacades::dateFormat($club->created_at,'format-13') }}
                                                                </p>
                                                            </div>
                                                        </td>
                                                        <td class="EMT_icon">
                                                            {!! Form::open(array(
                                                                'method' => 'DELETE',
                                                                'onsubmit' => "return confirm('".trans("admin.qa_are_you_sure_delete")." club?');",
                                                                'route' => ['school.student.club.delete'])) !!}
                                                            {!! Form::hidden('id',$club->user_club_id ) !!}

                                                            <button type="submit" value="Delete" class="delete_btn">
                                                                <i class="far fa-times-circle"></i>
                                                            </button>

                                                            {!! Form::close() !!}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @include('school.school.contact_model')
@endsection
@section('javascript')
    <script>

        function studentDelete() {
            var dynamicDialog = $('<div id="conformBox">' + 'Are you sure you want to delete this user?</div>');
            dynamicDialog.dialog({
                title: "Delete student",
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
                            studentDeleteConfirm();
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

        function studentDeleteConfirm() {
            var dynamicDialog2 = $('<div id="conformBox">' + 'Deleting users is permanent and cannot be undone?</div>');
            dynamicDialog2.dialog({
                title: "Delete student",
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
                            $('#removecustomer').submit();
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
        window.sendContactMailUrl = "{{ URL::to('contact/send_mail_parent') }}";
        contactModelUserIdElement = $(contactForm + " #contact_model_user_id");
        contactModelMessageElement = $(contactForm + " #contact_model_message");
        customErrorMessageElement = $(contactForm + " .custom-error-message");
        customSuccessMessageElement = $(contactForm + " .custom-success-message");
		window.sendContactMailTeacherUrl = "{{ URL::to('contact/send_mail') }}";

        /* Reset Contact Form */
        function resetContactForm() {
            $(contactForm).parsley().reset();

            contactModelUserIdElement.val("");
            contactModelMessageElement.val("");
        }

	contactUserTypeElement	=	$('#contact_user_type');
	/* Open Contact Model */
    function openContactModal(modelSelector, userId, contactUserType ) {
        resetContactForm();
        contactModelUserIdElement.val(userId);
        openModal(modelSelector);
		contactUserTypeElement.val( contactUserType );
    }

	/* Send Message Ajax Call */
        jQuery(contactForm).submit(function (event) {
            if (jQuery(contactForm).parsley().validate()) {

                event.preventDefault();
                showLoader();

                /* Send Mail */
                jQuery.ajax({
					url: contactUserTypeElement.val()==1 ? window.sendContactMailUrl : window.sendContactMailTeacherUrl,
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
