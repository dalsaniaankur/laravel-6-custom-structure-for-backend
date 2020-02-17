@extends('backend.layouts.app')
@section('title', 'Students | '.trans('admin.backend_title'))
@section('content')
    <div class="main_section">

        <div class="container">
            <div class="page-wrap bx-shadow mt-5 mb-5">
                <div class="row user-dt-wrap">
                    <div class="col-lg-12 col-md-12 pb-5">
                        <h1 class="admin_bigheading mb-5 inlinebtn">Students ({{ $totalRecordCount }})</h1>
                        <a href="javascript:void(0)" onclick="openStudentModal('#student_model')" class="btn light_blue float-right newbtn">New student</a>
                        <div class="clear-both"></div>

                        {!! Form::open(['method' => 'GET','name'=>'admin-student-search', 'id' =>'admin_student_search_form', 'class'=>'top-search-options form-row pb-4','route' => ['teacher.students']]) !!}
                        {!! Form::hidden('sorted_by', $sortedBy, array('id' => 'sortedBy')) !!}
                        {!! Form::hidden('sorted_order', $sortedOrder, array('id' => 'sortedOrder')) !!}
						{!! Form::hidden('school_id', $schoolId, array('id' => 'schoolId')) !!}
                        {!! Form::hidden('parent_id', $parentId, array('id' => 'parent_id')) !!}
                        <div class="col-md-3 col-lg-2">
                            <a href="{{ url('teacher/students') }}">
                                <button type="button" class="btn btn_green resetbtn mb-3">Reset</button>
                            </a>
                        </div>

                        <div class="col-md-5 col-lg-2">
                            {!! Form::text('name', $name, ['class' => 'form-control mb-3', 'placeholder' => 'Names']) !!}
                        </div>

                        <div class="col-md-4 col-lg-2">
                            {!! Form::email('email', $email, ['class' => 'form-control mb-3', 'placeholder' => 'Email']) !!}
                        </div>

                        <div class="col-md-4 col-lg-2">
                            {!! Form::select('club_id', $clubDropDown, $clubId, ['class' => 'form-control mb-3']) !!}
                        </div>

                        <div class="col-md-4 col-lg-2">
                            {!! Form::select('allergie_id', $allergyDropDown, $allergieId, ['class' => 'form-control mb-3']) !!}
                        </div>

                        <div class="col-md-4 col-lg-2">
                            {!! Form::select('gender', ['' => 'Gender','1' => 'Male','2' => 'Female'], $gender, ['class' => 'form-control mb-3']) !!}
                        </div>

                        <div class="col-md-4 col-lg-2">
                            {!! Form::select('status', $statusDropDown, $status, ['class' => 'form-control mb-3']) !!}
                        </div>

                        <div class="col-md-3  col-lg-3">
                            {!! Form::text('start_date', $createdStartDate, ['id' =>'start_date', 'class' => 'form-control date-field mb-3', 'placeholder' => 'Signed up from','autocomplete' => 'Off', 'data-toggle'=>'datepicker']) !!}
                        </div>

                        <div class="col-md-3  col-lg-3">
                            {!! Form::text('end_date', $createdEndDate, ['id' =>'end_date', 'class' => 'form-control date-field mb-3', 'placeholder' => 'Signed up to','autocomplete' => 'Off', 'data-toggle'=>'datepicker']) !!}
                        </div>

                        <div class="col-md-3 col-lg-2 offset-lg-2">
                            {!! Form::Submit(trans('admin.qa_search'), ['class' => 'btn btn_green resetbtn']) !!}
                        </div>
                        {!! Form::close() !!}

                        <div class="table-responsive mt-5">
                            <table class="table sorting data-table school" id="classes">
                                <thead>
                                <tr>
                                    @php($shortClass = ( strtolower($sortedOrder) == 'asc') ? 'up' : 'down' )
                                    @php($sortDefault = '<i class="fas fa-sort"></i>')
                                    @php($sorting = '<i class="fas fa-caret-'.$shortClass.'"></i>')

                                    <th class="updownicon"
                                        onclick="sortWithSearch('user_id');">@lang('admin.user.fields.id')
                                        {!!  $sortedBy =='user_id' ? $sorting : $sortDefault  !!}</th>
                                    <th class="updownicon"
                                        onclick="sortWithSearch('first_name');">NAMES
                                        {!!  $sortedBy =='first_name' ? $sorting : $sortDefault  !!}</th>
                                    <th>JOINED</th>
                                    <th>GENDER</th>
                                    <th>STATUS</th>
                                    <th class="actionwidth">@lang('admin.user.fields.action')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(!empty($students) && count($students) > 0)
                                    @foreach($students as $studentKey => $student)
                                        <tr>
                                            <td class="data-id"><span>{{ ++$recordStart  }}</span></td>
                                            <td>
                                                <b>{{ $student->name }}</b><br>
                                                <a href="mailto:{{ $student->email  }}"
                                                   class="mail">{{ $student->email  }}</a> <br>
                                                {{ Common:: getPhoneFormat($student->phone)  }}
                                            </td>
                                            <td>
                                                <b>{{ DateFacades::dateFormat($student->created_at,'format-3') }}</b><br>
                                                {{ DateFacades::dateFormat($student->created_at,'time-format-1') }}
                                            </td>
                                            <td class="bigfonts"><b>{{ $student->gender_type  }}</b></td>
                                            <td class="{{ $student->status ==1 ? 'green' : 'inactive' }}">
                                                <b>{{ $student->status_string }}</b></td>
                                            <td class="action_div">
                                            	<div class="third_btn">
                                                <a href="javascript:void(0)" onclick="openContactModal('.contact-model',{{ $student->user_id }})" class="viewbtn contact">Contact</a>
                                                <a href="{{ url('teacher/student/profile')}}/{{ Common::getEncryptId($student->user_id) }}"
                                                   class="viewbtn">view</a>
                                                {!! Form::open(array(
                                                        'method' => 'DELETE',
                                                         'onsubmit' => "return confirm('".trans("admin.qa_are_you_sure_delete")." student?');",
                                                        'route' => ['teacher.student.delete'])) !!}
                                                {!! Form::hidden('id',$student->user_id ) !!}

                                                <button type="submit" value="Delete" class="delete_btn"><i
                                                            class="far fa-trash-alt"></i></button>

                                                {!! Form::close() !!}</div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="10">@lang('admin.qa_no_entries_in_table')</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                        {!! $paging !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('school.school.contact_model')
    @include('teacher.student.add_edit_model')
@endsection
@section('javascript')
    <script>
        var form = 'form#admin_student_search_form';

        /*----------------------------------  Student  -----------------------------------*/

        var addEditStudentForm = 'form#add_edit_student_model_form';
        window.addEditStudentUrl = "{{ URL::to('teacher/student/save_ajax') }}";
        window.getStudentDataForEditUrl = "{{ URL::to('teacher/student/get_data') }}";

        addEditStudentModelIdElement = $(addEditStudentForm + " #add_edit_student_model_id");
        firstNameElement = $(addEditStudentForm + " #first_name");
        lastNameElement = $(addEditStudentForm + " #last_name");
        emailElement = $(addEditStudentForm + " #email");
        phoneElement = $(addEditStudentForm + " #phone");
        genderElement = $(addEditStudentForm + " #gender");
        schoolIdElement = $(addEditStudentForm + " #school_id");
        gradeIdElement = $(addEditStudentForm + " #grade_id");
        classIdElement = $(addEditStudentForm + " #class_id");
        customStudentErrorMessageElement = $(addEditStudentForm + " .custom-error-message");
        customStudentSuccessMessageElement = $(addEditStudentForm + " .custom-success-message");

        /* Student Reset Form */
        function resetStudentForm() {
            $(addEditStudentForm).parsley().reset();
            customStudentErrorMessageElement.hide();
            customStudentSuccessMessageElement.hide();
            addEditStudentModelIdElement.val(0);
            firstNameElement.val("");
            lastNameElement.val("");
            emailElement.val("");
            phoneElement.val("");
            genderElement.val("1");
        }

        /* Add Edit Ajax Call */
        $(addEditStudentForm).submit(function (event) {

            if ($(addEditStudentForm).parsley().validate()) {

                event.preventDefault();
                customStudentErrorMessageElement.hide();
                customStudentSuccessMessageElement.hide();
                showLoader();

                phoneElement.unmask();
                var formData = new FormData($(this)[0]);
                jQuery.ajax({
                    url: window.addEditStudentUrl,
                    enctype: 'multipart/form-data',
                    method: 'post',
                    dataType: 'JSON',
                    processData: false,
                    contentType: false,
                    cache: false,
                    data : formData,
                    success: function (response) {
                        if (response.success == true) {
                            customStudentSuccessMessageElement.html(response.message);
                            customStudentSuccessMessageElement.show();
                            hideLoader();
                            setTimeout(function () {
                                location.reload();
                            }, 2000);
                        } else {
                            customStudentErrorMessageElement.html(response.message);
                            customStudentErrorMessageElement.show();
                            hideLoader();
                        }
                    },
                    error: function (xhr, status) {
                        customStudentErrorMessageElement.html(window._ajax_error_msg_common);
                        customStudentErrorMessageElement.show();
                        hideLoader();
                    }
                });
            }
        });

        /* Open Student Model */
        function openStudentModal(modelSelector) {
            resetStudentForm();
           // getGradeDropDown(selfEle = '#school_id', classEle = '#grade_id')
            openModal(modelSelector);
        }

        /*----------------------------------  Contact  -----------------------------------*/

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
