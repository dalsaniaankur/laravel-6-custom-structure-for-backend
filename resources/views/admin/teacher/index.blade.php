@extends('backend.layouts.app')
@section('title', 'Teachers | '.trans('admin.backend_title'))
@section('content')
    <div class="main_section">
        <div class="container">
            <div class="page-wrap bx-shadow mt-5 mb-5">
                <div class="row user-dt-wrap">
                    <div class="col-lg-12 col-md-12 pb-5">
                        <h1 class="admin_bigheading mb-5 inlinebtn">Teachers
                            @if($schoolId > 0 && !empty($schoolDropDownList) && count($schoolDropDownList) > 0)
                                @php($schoolName = strtolower($schoolDropDownList->toArray()[$schoolId]))
                                for {{ $schoolName }}
                            @endif
                            ({{ $totalRecordCount }})</h1>
                        <a href="javascript:void(0)" onclick="openTeacherModal('#teacher_model')" class="btn light_blue float-right newbtn">New Teacher</a>
                        <div class="clear-both"></div>

                        {!! Form::open(['method' => 'GET','name'=>'admin-teacher-search', 'id' =>'admin_teacher_search_form', 'class'=>'top-search-options form-row pb-4','route' => ['admin.teachers']]) !!}
                        {!! Form::hidden('sorted_by', $sortedBy, array('id' => 'sortedBy')) !!}
                        {!! Form::hidden('sorted_order', $sortedOrder, array('id' => 'sortedOrder')) !!}
                        {!! Form::hidden('school_id', $schoolId, array('id' => 'school_id')) !!}

                        <div class="col-md-3 col-lg-2">
                            <a href="{{ url('admin/teachers?school_id='.$schoolId) }}">
                                <button type="button" class="btn btn_green resetbtn mb-3">Reset</button>
                            </a>
                        </div>

                        <div class="col-md-5 col-lg-3">
                            {!! Form::text('name', $name, ['class' => 'form-control mb-3', 'placeholder' => 'Names']) !!}
                        </div>

                        <div class="col-md-4 col-lg-4">
                            {!! Form::email('email', $email, ['class' => 'form-control mb-3', 'placeholder' => 'Email']) !!}
                        </div>

                        <div class="col-md-4 col-lg-3">
                            {!! Form::select('status', $statusDropDown, $status, ['class' => 'form-control mb-3']) !!}
                        </div>

                        <div class="col-md-4 col-lg-3">
                            {!! Form::select('gender', ['' => 'Gender','1' => 'Male','2' => 'Female'], $gender, ['class' => 'form-control mb-3']) !!}
                        </div>

                        <div class="col-md-4  col-lg-3">
                            {!! Form::text('start_date', $createdStartDate, ['id' =>'start_date', 'class' => 'form-control date-field mb-3', 'placeholder' => 'Signed up from','autocomplete' => 'Off', 'data-toggle'=>'datepicker']) !!}
                        </div>

                        <div class="col-md-4  col-lg-3">
                            {!! Form::text('end_date', $createdEndDate, ['id' =>'end_date', 'class' => 'form-control date-field mb-3', 'placeholder' => 'Signed up to','autocomplete' => 'Off', 'data-toggle'=>'datepicker']) !!}
                        </div>

                        <div class="col-md-3 col-lg-2 offset-lg-1">
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
                                    <th>STUDENTS</th>
                                    <th>GENDER</th>
                                    <th>STATUS</th>
                                    <th class="actionwidth">@lang('admin.user.fields.action')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(!empty($teachers) && count($teachers) > 0)
                                    @foreach($teachers as $teacherKey => $teacher)
                                        <tr>
                                            <td class="data-id"><span>{{ ++$recordStart  }}</span></td>
                                            <td>
                                                <b>{{ $teacher->name }}</b><br>
                                                <a href="mailto:{{ $teacher->email  }}"
                                                   class="mail">{{ $teacher->email  }}</a> <br>
                                                {{ Common:: getPhoneFormat($teacher->phone)  }}
                                            </td>
                                            <td>
                                                <b>{{ DateFacades::dateFormat($teacher->created_at,'format-3') }}</b><br>
                                                {{ DateFacades::dateFormat($teacher->created_at,'time-format-1') }}
                                            </td>
                                            <td>
                                                <b>{{ $teacher->getTeacherStudent($teacher->school_id, $teacher->class_id)->count()  }}</b>
                                            </td>
                                            <td class="bigfonts"><b>{{ $teacher->gender_type  }}</b></td>
                                            <td class="{{ $teacher->status ==1 ? 'green' : 'inactive' }}">
                                                <b>{{ $teacher->status_string }}</b></td>
                                            <td class="action_div">
                                            	<div class="third_btn">
                                                <a href="javascript:void(0)"
                                                   onclick="openContactModal('.contact-model',{{ $teacher->user_id }})"
                                                   class="viewbtn contact">Contact</a>
                                                <a href="{{ url('admin/teacher/profile/')}}/{{ Common::getEncryptId($teacher->user_id) }}"
                                                   class="viewbtn">view</a>
                                                {!! Form::open(array(
                                                        'method' => 'DELETE',
                                                         'onsubmit' => "return confirm('".trans("admin.qa_are_you_sure_delete")." teacher?');",
                                                        'route' => ['admin.teacher.delete'])) !!}
                                                {!! Form::hidden('id',$teacher->user_id ) !!}
                                                {!! Form::hidden('school_id',$teacher->school_id ) !!}

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
@include('admin.school.contact_model')
@include('admin.teacher.add_edit_model')
@endsection
@section('javascript')
    <script>
        var form = 'form#admin_teacher_search_form';

        /*----------------------------------  Teacher  -----------------------------------*/

        var addEditTeacherForm = 'form#add_edit_teacher_model_form';
        window.addEditTeacherUrl = "{{ URL::to('admin/teacher_module/save_ajax') }}";
        window.getTeacherDataForEditUrl = "{{ URL::to('admin/teacher/get_data') }}";

        addEditTeacherModelIdElement = $(addEditTeacherForm + " #add_edit_teacher_model_id");
        firstNameElement = $(addEditTeacherForm + " #first_name");
        lastNameElement = $(addEditTeacherForm + " #last_name");
        emailElement = $(addEditTeacherForm + " #email");
        phoneElement = $(addEditTeacherForm + " #phone");
        genderElement = $(addEditTeacherForm + " #gender");
        schoolIdElement = $(addEditTeacherForm + " #school_id");
        gradeIdElement = $(addEditTeacherForm + " #grade_id");
        classIdElement = $(addEditTeacherForm + " #class_id");
        bioElement = $(addEditTeacherForm + " #bio");
        customTeacherErrorMessageElement = $(addEditTeacherForm + " .custom-error-message");
        customTeacherSuccessMessageElement = $(addEditTeacherForm + " .custom-success-message");

        /* Teacher Reset Form */
        function resetTeacherForm() {
            $(addEditTeacherForm).parsley().reset();
            customTeacherErrorMessageElement.hide();
            customTeacherSuccessMessageElement.hide();
            addEditTeacherModelIdElement.val(0);
            firstNameElement.val("");
            lastNameElement.val("");
            emailElement.val("");
            phoneElement.val("");
            genderElement.val("1");
            bioElement.val("");
        }

        function gradeDropDownTrigger(){
            getClassDropDown('#grade_id','#class_id','#school_id')
        }

        /* Add Edit Ajax Call */
        $(addEditTeacherForm).submit(function (event) {

            if ($(addEditTeacherForm).parsley().validate()) {

                event.preventDefault();
                customTeacherErrorMessageElement.hide();
                customTeacherSuccessMessageElement.hide();
                showLoader();

                phoneElement.unmask();
                var formData = new FormData($(this)[0]);

                jQuery.ajax({
                    url: window.addEditTeacherUrl,
                    enctype: 'multipart/form-data',
                    method: 'post',
                    dataType: 'JSON',
                    processData: false,
                    contentType: false,
                    cache: false,
                    data : formData,
                    success: function (response) {
                        if (response.success == true) {
                            customTeacherSuccessMessageElement.html(response.message);
                            customTeacherSuccessMessageElement.show();
                            hideLoader();
                            setTimeout(function () {
                                location.reload();
                            }, 2000);
                        } else {
                            customTeacherErrorMessageElement.html(response.message);
                            customTeacherErrorMessageElement.show();
                            hideLoader();
                        }
                    },
                    error: function (xhr, status) {
                        customTeacherErrorMessageElement.html(window._ajax_error_msg_common);
                        customTeacherErrorMessageElement.show();
                        hideLoader();
                    }
                });
            }
        });

        function teacherFormDataBind(data) {
            addEditTeacherModelIdElement.val(data.grade_id);
            gradeNameElement.val(data.grade_name);

        }

        /* Open Teacher Model */
        function openTeacherModal(modelSelector) {
            resetTeacherForm();
            //getGradeDropDown(selfEle = '#school_id', classEle = '#grade_id')
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
