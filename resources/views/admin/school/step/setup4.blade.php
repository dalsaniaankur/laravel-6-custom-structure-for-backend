@extends('backend.layouts.app')
@section('title', 'Create Teacher | '.trans('admin.backend_title'))
@section('content')
    <div class="main_section">
        <div class="container n_success">
            <div class="page-wrap bx-shadow mt-5 mb-5">
                <div class="row user-dt-wrap">
                    <div class="col-lg-12 col-md-12 pb-5">
                        <h1 class="bigheading mt-2 mb-5"><span class="number_round">4</span>Create teachers</h1>
                        <div class="col-lg-12 mb-5 px-md-3 pl0 pr0">
                            {!! Form::open(['method' => 'POST','enctype' => 'multipart/form-data','name'=>'admin-teacher-create', 'id' =>'admin_teacher_create_form', 'class'=>'teacher-create-form','data-parsley-validate','route' => ['admin.teacher.create']]) !!}

                            {!! Form::hidden('school_id', $schoolId, array('id' => 'school_id')) !!}

                            <div class="form-edit-profile">
                                {!! Form::label('first_name', 'First name') !!}
                                {!! Form::text('first_name', old('first_name'), ['class' => 'form-control mb-4', 'required' => '']) !!}
                                @include('backend.partials.message.field',['field_name' => 'first_name'])
                            </div>
                            <div class="form-edit-profile">
                                {!! Form::label('last_name', 'Last name') !!}
                                {!! Form::text('last_name', old('last_name'), ['class' => 'form-control mb-4', 'required' => '']) !!}
                                @include('backend.partials.message.field',['field_name' => 'last_name'])
                            </div>
                            <div class="form-edit-profile">
                                {!! Form::label('email', 'Email') !!}
                                {!! Form::email('email', old('email'), ['class' => 'form-control mb-4', 'required' => '']) !!}
                                @include('backend.partials.message.field',['field_name' => 'email'])
                            </div>
                            <div class="form-edit-profile">
                                {!! Form::label('phone', 'Phone') !!}
                                {!! Form::text('phone', old('phone'), ['class' => 'form-control mb-4', 'required' => '']) !!}
                                @include('backend.partials.message.field',['field_name' => 'phone'])
                            </div>
                            <div class="form-edit-profile">
                                {!! Form::label('gender', 'Gender') !!}
                                {!! Form::select('gender', ['1' => 'Male','2' => 'Female'], old('gender'), ['class' => 'form-control mb-4', 'required' => '']) !!}
                            </div>
                            <div class="form-edit-profile">
                                {!! Form::label('grade_id', 'Grade') !!}
                                {!! Form::select('grade_id', $gradeDropDown, old('grade_id'), ['onchange' => "getClassDropDown(this,'#class_id','#school_id')",'class' => 'form-control mb-4', 'required' => '']) !!}
                            </div>
                            <div class="form-edit-profile">
                                {!! Form::label('class_id', 'Class') !!}
                                {!! Form::select('class_id', $classesDropDown, old('class_id'), ['class' => 'form-control mb-4', 'required' => '']) !!}
                            </div>

                            <div class="clear-both mb-4"></div>
                            <div class="form-edit-profile textareawidth">
                                {!! Form::label('bio', "Teacher's bio") !!}
                                <div class="words"><span class="word-count">235</span>words</div>
                                {!! Form::textarea('bio', '', ['class' => ' mb-4 form-control-text-area', 'rows' => 5, 'required' => '','cols' => '50','data-count-validation'=>'word','data-total-word-accept'=> 235, 'data-counter-selector'=> '.word-count']) !!}
                            </div>
                            <div class="clear-both"></div>
                            <div class="form-edit-profile1">
                                <label>Photo</label>
                                <div id="photo-upload">
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
                                {!! Form::Submit(trans('admin.qa_save'), ['class' => 'btn btn_green mt-4 mb-5']) !!}
                            </div>
                            {!! Form::close() !!}
                        </div>
                        <div class="setup_details">
                            <div class="col-lg-7 col-md-9">
                                <div class="table-responsive EMT_table setup4">
                                    <table class="table sorting data-table">
                                        <tbody>
                                        @if(!empty($teacherList) && count($teacherList) > 0)
                                            @foreach($teacherList as $teacherKey => $teacher)
                                                <tr>
                                                    <td style="width:230px;">
                                                        <div class="s_detail1">
                                                            <h4>{{ $teacher->name }}</h4><a
                                                                    href="mailto:{{ $teacher->email }}">{{ $teacher->email }}</a>
                                                            <h4>{{ Common::getPhoneFormat( $teacher->phone )}}</h4>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <span>-</span>{{ $teacher->grade->grade_name }} {{ $teacher->classes->class_name }}
                                                    </td>
                                                    <td class="EMT_icon">
                                                        <a href="javascript:void(0);"
                                                           onclick="openEditModal('#teacher_model',{{ $teacher->user_id }})">
                                                            <img src="{{ url('backend/images/edit.png') }}">
                                                        </a>
                                                        {!! Form::open(array(
                                                                        'method' => 'DELETE',
                                                                        'onsubmit' => "return confirm('".trans("admin.qa_are_you_sure_delete")." teacher?');",
                                                                        'route' => ['admin.teacher.delete'])) !!}

                                                        {!! Form::hidden('id', $teacher->user_id) !!}

                                                        <button type="submit" value="Delete" class="delete_btn"><i
                                                                    class="far fa-times-circle"></i></button>
                                                        {!! Form::close() !!}

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
                            </div>
                        </div>
                        <div class="form-edit-profilebtn nextstep mt-5">
                            <a class="btn btn_green blue_btn" href="{{ url('admin/schools/').'/'.Common::getEncryptId($schoolId) }}">View school</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    @include('admin.school.step.teacher_edit_model')
@endsection
@section('javascript')
    <script>
        var addEditTeacherForm = 'form#add_edit_teacher_model_form';
        window.addEditTeacherUrl = "{{ URL::to('admin/teacher/save_ajax') }}";
        window.getTeacherDataForEditUrl = "{{ URL::to('admin/teacher/get_data') }}";

        pageTitle = "teacher";
        addEditTeacherModelIdElement = $(addEditTeacherForm + " #add_edit_teacher_model_id");
        firstNameElement = $(addEditTeacherForm + " #first_name_for_edit");
        lastNameElement = $(addEditTeacherForm + " #last_name_for_edit");
        emailElement = $(addEditTeacherForm + " #email_for_edit");
        phoneElement = $(addEditTeacherForm + " #phone_for_edit");
        genderElement = $(addEditTeacherForm + " #gender_for_edit");
        classIdElement = $(addEditTeacherForm + " #class_id_for_edit");
        gradeIdElement = $(addEditTeacherForm + " #grade_id_for_edit");
        schoolIdElement = $(addEditTeacherForm + " #school_id_for_edit");
        window.classIdElementForAjaxTime = $(addEditTeacherForm + " #class_id_for_edit");
        window.currentClassIdElementForAjaxTime = 0;
        customErrorMessageElement = $(addEditTeacherForm + " .custom-error-message");
        customSuccessMessageElement = $(addEditTeacherForm + " .custom-success-message");
        modelTitleElement = $(".modal-title");

        /* Reset Form */
        function ResetForm() {
            $(addEditTeacherForm).parsley().reset();

            addEditTeacherModelIdElement.val(0);
            firstNameElement.val("");
            lastNameElement.val("");
            emailElement.val("");
            phoneElement.val("");
        }

        /* Add Edit Ajax Call */
        $(addEditTeacherForm).submit(function (event) {

            if ($(addEditTeacherForm).parsley().validate()) {

                event.preventDefault();

                showLoader();

                jQuery.ajax({
                    url: window.addEditTeacherUrl,
                    method: 'post',
                    dataType: 'JSON',
                    data: {
                        '_token': window._token,
                        'user_id': addEditTeacherModelIdElement.val(),
                        'first_name': firstNameElement.val(),
                        'last_name': lastNameElement.val(),
                        'email': emailElement.val(),
                        'phone': phoneElement.unmask().val(),
                        'gender': genderElement.val(),
                        'class_id': classIdElement.val(),
                        'grade_id': gradeIdElement.val(),
                        'school_id': schoolIdElement.val(),
                    },
                    success: function (response) {
                        if (response.success == true) {
                            toastr.success(response.message);
                            hideLoader();
                            setTimeout(function () {
                                location.reload();
                            }, 2000);
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

        function gradeDropDownTrigger(){
            getClassDropDown('#grade_id_for_edit','#class_id_for_edit','#school_id')
        }

        function FormDataBind(data) {

            addEditTeacherModelIdElement.val(data.user_id);
            firstNameElement.val(data.first_name);
            lastNameElement.val(data.last_name);
            emailElement.val(data.email);
            phoneElement.val(data.phone);
            genderElement.val(data.gender);
            gradeIdElement.val(data.grade_id);
            phoneElement.change();
            gradeDropDownTrigger();
            classIdElement.val(data.class_id);
            window.currentClassIdElementForAjaxTime = data.class_id;
        }

        function openEditModal(modelSelector, id) {
            showLoader();
            jQuery.ajax({
                url: window.getTeacherDataForEditUrl,
                method: 'post',
                dataType: 'JSON',
                data: {
                    '_token': window._token,
                    'id': id,
                },
                success: function (response) {
                    if (response.success == true) {
                        ResetForm();
                        modelTitleElement.html("Edit " + pageTitle);
                        FormDataBind(response.data);
                        hideLoader();
                        openModal(modelSelector);
                    } else {
                        hideLoader();
                        ResetForm();
                    }
                },
                error: function (xhr, status) {
                    toastr.error(window._ajax_error_msg_common);
                    hideLoader();
                }
            });
        }
    </script>
@endsection
