@extends('backend.layouts.app')
@section('title', 'Student Academics | '.trans('admin.backend_title'))
@section('content')
    <div class="main_section">

        <div class="container n_success">
            <div class="details_tabs mt-3">
                <a href="{{ url('school/student/profile')}}/{{ Common::getEncryptId($student->user_id) }}">Profile</a>
                <a href="javascript:void(0);" class="active">Academics</a>
                <a href="{{ url('school/student/feed')}}/{{ Common::getEncryptId($student->user_id) }}">feed</a>
            </div>
            <div class="page-wrap bx-shadow mt-3 mb-5">
                <div class="row user-dt-wrap">
                    <div class="col-lg-12 col-md-12 pb-5 Academic_details pb0">
                        <h1 class="admin_bigheading mb-5 w_100">Academics: {{ $student->name }}</h1>
                        {!! Form::open(['method' => 'POST','enctype' => 'multipart/form-data','name'=>'admin-student-bio-create', 'id' =>'admin_student_bio_create_form', 'class'=>'teacher-create-form','data-parsley-validate','route' => ['school.student.bio.update']]) !!}

                        {!! Form::hidden('user_id', $student->user_id, array('id' => 'user_id')) !!}

                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <div class="">
                                    {!! Form::label('bio', 'Intellectual description', ['class' => 'w-100']) !!}
                                    {!! Form::textarea('bio', $student->bio, ['class' => 'mb-4 form-control-text-area w-100', "placeholder" => "General comment/note about this student's intellectual skills"]) !!}
                                    <div class="form-edit-profilebtn saveh2">
                                        {!! Form::Submit('Save', ['class' => 'btn btn_green mt-1']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                    <div class="col-lg-12 col-md-12 pb-5">
                        <button type="button" class="btn light_blue float-right newbtn"
                                onclick="openAddModal('#academic_model')">New Exam
                        </button>
                        <div class="clear-both"></div>
                        <h1 class="admin_bigheading mb-5">Recent exams & test scores&nbsp;({{count($exams)}})</h1>
                        {!! Form::open(['method' => 'GET','name'=>'student-academics-search', 'id' =>'student_academics_search_form', 'class'=>'top-search-options form-row pb-4 border_bottom','url' => url('school/student/academics/').'/'.Common::getEncryptId($student->user_id)]) !!}
                        <div class="col-md-3 col-lg-2">
                            <a href="{{ url('school/student/academics/').'/'.Common::getEncryptId($student->user_id) }}">
                                <button type="button" class="btn btn_green resetbtn mb-3">Reset</button>
                            </a>
                        </div>
                        <div class="col-md-4 col-lg-2 offset-lg-6 offset-md-0">
                            {!! Form::select('sorted_order', ['ASC' => 'ASC','DESC' => 'DESC'], $sortedOrder, ['class' => 'form-control mb-3']) !!}
                        </div>
                        <div class="col-md-3 col-lg-2">
                            {!! Form::Submit('Sort', ['class' => 'btn btn_green resetbtn']) !!}
                        </div>
                        {!! Form::close() !!}
                    </div>
                    <div class="col-lg-12 col-md-12 pb-5">
                        <div class="row">
                            @if(!empty($exams) && count($exams) > 0)
                                @foreach($exams as $examKey => $exam)
                                    <div class="col-lg-4 col-md-6">
                                        <div class="Aca_recentscore brd-after">
                                            <p class="inactive">{{ $examKey+1 }})</p>
                                            <p><span>Exam:</span>{{ $exam->exam->exam_name }}</p>
                                            <p>
                                                <span>Date:</span>{{ DateFacades::dateFormat($exam->exam_date,'format-3') }}
                                            </p>

                                            @php($subjectList = $exam->getExamList($exam->exam_id,$exam->user_id,$exam->exam_date))
                                            @foreach($subjectList as $subjectKey => $subject)
                                                <p><span>{{ $subject->subject }}:</span>{{ $subject->percent }}%</p>
                                            @endforeach

                                            <div class="user_score mt-3 mb-4">
                                                <p>
                                                    <span>Entered:</span>{{ DateFacades::dateFormat($exam->created_at,'format-3') }}
                                                    ({{ DateFacades::dateFormat($exam->created_at,'time-format-1') }})
                                                </p>
                                                <p><span>By:</span>{{ $exam->created_user->name }}</p>
                                            </div>
                                            <a href="javascript:void(0);" class="btn_green aca_view_edit"
                                               onclick="openEditModal('#academic_model',{{ $studentId }}, {{ $exam->exam_id }}, '{{ $exam->exam_date}}' )">Edit</a>
                                            <!--<a href="#" class="delete btn_green">Delete</a>-->
                                            {!! Form::open(array(
                                                        'method' => 'DELETE',
                                                         'onsubmit' => "return confirm('".trans("admin.qa_are_you_sure_delete")." exam result?');",
                                                        'route' => ['school.student.exam_result.delete'])) !!}

                                            {!! Form::hidden('exam_id',$exam->exam_id ) !!}
                                            {!! Form::hidden('user_id',$exam->user_id ) !!}
                                            {!! Form::hidden('exam_date',$exam->exam_date ) !!}

                                            <button type="submit" value="Delete" class="delete btn_green">Delete
                                            </button>

                                            {!! Form::close() !!}

                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="10">@lang('admin.qa_no_entries_in_table')</td>
                                </tr>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('school.student.add_edit_academicsmodel')
@endsection
@section('javascript')
    <script>
        var formAddEditForm = 'form#add_edit_academic_model_form';
        window.addEditUrl = "{{ URL::to('school/student/academic/ajax_save') }}";
        window.getDataForEditUrl = "{{ URL::to('school/student/academic/get_data') }}";
        window.addDeleteUrl = "{{ URL::to('school/student/academic/delete') }}";

        pageTitle = "Exam";
        addEditModelIdElement = $(formAddEditForm + " #add_edit_model_id");
        userIdElement = $(formAddEditForm + " #user_id");
        examIdElement = $(formAddEditForm + " #exam_id");
        examDateElement = $(formAddEditForm + " #exam_date");
        examListsElement = $(formAddEditForm + " .exam_lists");
        examSubjectElement = $(formAddEditForm + " .subject");
        examPercentageElement = $(formAddEditForm + " .percent");

        customErrorMessageElement = $(formAddEditForm + " .custom-error-message");
        customSuccessMessageElement = $(formAddEditForm + " .custom-success-message");
        modelTitleElement = $(".modal-title");

        /* Reset Form */
        function ResetForm() {
            $(formAddEditForm).parsley().reset();

            addEditModelIdElement.val(0);
            examSubjectElement.val("");
            examPercentageElement.val("");
        }

        /* Open Add Model */
        function openAddModal(modelSelector) {
            ResetForm();
            modelTitleElement.html("Add " + pageTitle);
            examListsElement.html('');
            openModal(modelSelector);
            examIdElement.prop('disabled', false);
            examDateElement.prop('disabled', false);
        }

        /* Add Edit Ajax Call */
        $(formAddEditForm).submit(function (event) {

            if ($(formAddEditForm).parsley().validate()) {

                event.preventDefault();

                showLoader();

                window.examList = [];
                $(".exam_subject_list").each(function (index) {
                    var subject = $(this).find('.subject').val();
                    var percentage = $(this).find('.percent').val();
                    window.examList.push({'subject': subject, 'percentage': percentage});
                });

                jQuery.ajax({
                    url: window.addEditUrl,
                    method: 'post',
                    dataType: 'JSON',
                    data: {
                        '_token': window._token,
                        'user_id': userIdElement.val(),
                        'exam_id': examIdElement.val(),
                        'exam_date': examDateElement.val(),
                        'examList': window.examList,

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

        function FormDataBind(data) {
            examIdElement.val(data.exam_id);
            examDateElement.val(data.exam_date);
            var DropDownDataAdmin = '';
            DropDownDataAdmin = data.examLists;
            examListsElement.html('');
            $('.add_exam_subject_clone').html('');
            bindExamSubjects(DropDownDataAdmin, 'editExam');
            examIdElement.prop('disabled', 'disabled');
            examDateElement.prop('disabled', 'disabled');
            addEditModelIdElement.val(1);
            examSubjectElement.val("");
            examPercentageElement.val("");
        }

        function openEditModal(modelSelector, userid, examid, examdate) {
            showLoader();
            jQuery.ajax({
                url: window.getDataForEditUrl,
                method: 'post',
                dataType: 'JSON',
                data: {
                    '_token': window._token,
                    'exam_id': examid,
                    'user_id': userid,
                    'exam_date': examdate,
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

        jQuery('#add_exam_subject').click(function () {
            var clone = $('.add_exam_subject_original').clone().removeClass('add_exam_subject_original');
            clone.find("input").val("");
            clone.appendTo(".add_exam_subject_clone:last");
        });

        jQuery('#add_exam_sujects').click(function () {
            var examList = [];
            $(".exam_subject_list").each(function (index) {
                var subject = $(this).find('.subject').val();
                var percentage = $(this).find('.percent').val();
                examList[index] = [];
                examList[index]['subject'] = subject;
                examList[index]['percentage'] = percentage;
            });
            bindExamSubjects(examList, 'addExam');
        });

        function bindExamSubjects(examLists, examType) {
            var examListsHtml = '';
            $.each(examLists, function (key, value) {
                if (examLists[key]['subject'] != '' && examLists[key]['percentage'] != '') {
                    examListsHtml += '<tr><td><div class="setup3_bullet"><p>' + examLists[key]['subject'] + '</p><p class="lightfont"><span>-</span>' + examLists[key]['percentage'] + '%</p>';
                    examListsHtml += '</div></td><td class="EMT_icon"><button type="button" data-id="' + key + '" class="delete_btn ' + examType + '"><i class="far fa-times-circle"></i></td></tr>';
                }
            });
            if (addEditModelIdElement.val() == 0)
                examListsElement.html(examListsHtml);
            else
                examListsElement.append(examListsHtml);
        }

        $(document).on("click", '.delete_btn', function () {
            var currentObject = $(this);
            if ($(this).hasClass('editExam')) {
                var examId = $(this).attr('data-id');

                showLoader();
                jQuery.ajax({
                    url: window.addDeleteUrl,
                    method: 'post',
                    data: {
                        '_token': window._token,
                        'id': examId
                    },
                    success: function (response) {
                        if (response.success == true) {
                            toastr.success(response.message);
                            hideLoader();
                            currentObject.closest('tr').remove();
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
            } else {
                $(this).closest('tr').remove();
            }
        });
    </script>
@endsection
