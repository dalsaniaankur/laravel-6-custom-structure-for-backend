@extends('backend.layouts.app')
@section('title', 'Club Details | '.trans('admin.backend_title'))
@section('content')
    <div class="main_section club-member-page">
        <div class="container">
            <div class="page-wrap bx-shadow mt-5 mb-5">
                <div class="row user-dt-wrap">
                    <div class="col-lg-12 col-md-12 pb-5">

                        <h1 class="admin_bigheading mb-5 inlinebtn">{{ ucfirst($clubName) }} club members ({{ $totalRecordCountForStudent + $totalRecordCountForTeacher }})</h1>
                        <a href="javascript:void(0)" onclick="openAddMemberModal('#add_member_model')" class="btn light_blue float-right newbtn">Add Member</a>

                        <div class="clearfix"></div>
                        @if( $totalRecordCountForStudent > 0)
                            <div class="user-dt-wrap">
                                <div class="col-md-12">
                                    <h3 class="text-center mb-5 mt-3"> Students ({{$totalRecordCountForStudent}})</h3>
                                    <div class="row">
                                        @foreach($students as $studentKey => $student )
                                            <div
                                                class="col-lg-4 col-md-6 notification-user-list schedule_notification_list mb-3">
                                                <div class="f-left">
                                                    {{ $student->user->name ?? '-'}} <br/>
                                                    {{ $student->user->email ?? '-'}}
                                                </div>
                                                <div class="f-right deletediv">
                                                    {!! Form::open(array(
                                                        'method' => 'DELETE',
                                                        'onsubmit' => "return confirm('".trans("admin.qa_are_you_sure_delete")." student?');",
                                                        'route' => ['admin.user_club.delete'])) !!}
                                                    {!! Form::hidden('id', $student->user_club_id) !!}

                                                    <button type="submit" value="Delete" class="deletebtn"><i
                                                            class="far fa-trash-alt"></i></button>

                                                    {!! Form::close() !!}
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if( $totalRecordCountForStudent > 0)
                            <div class="user-dt-wrap">
                                <div class="col-md-12">
                                    <h3 class="text-center mb-5 mt-3"> Teachers ({{$totalRecordCountForTeacher}})</h3>
                                    <div class="row">
                                        @foreach($teachers as $teacherKey => $teacher )
                                            <div
                                                class="col-lg-4 col-md-6 notification-user-list schedule_notification_list mb-3">
                                                <div class="f-left">
                                                    {{ $teacher->user->name ?? '-'}} <br/>
                                                    {{ $teacher->user->email ?? '-'}}
                                                </div>
                                                <div class="f-right deletediv">
                                                    {!! Form::open(array(
                                                        'method' => 'DELETE',
                                                        'onsubmit' => "return confirm('".trans("admin.qa_are_you_sure_delete")." teacher?');",
                                                        'route' => ['admin.user_club.delete'])) !!}
                                                    {!! Form::hidden('id', $teacher->user_club_id) !!}

                                                    <button type="submit" value="Delete" class="deletebtn"><i
                                                            class="far fa-trash-alt"></i></button>

                                                    {!! Form::close() !!}
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.club.add_member_model')
@endsection
@section('javascript')
    <script>
    /*----------------------------------  Add Member  -----------------------------------*/

        studentIdElement = $("#student_id");
        teacherIdElement = $("#teacher_id");

        studentIdElement.multiselect({
            columns: 1,
            search: true,
            selectAll: true,
            placeholder: 'Select student',
        });

        teacherIdElement.multiselect({
            columns: 1,
            search: true,
            selectAll: true,
            placeholder: 'Select teacher',
        });

        var addMemberForm = 'form#add_member_model_form';
        window.addMemberUrl = "{{ URL::to('admin/club_member/save_ajax') }}";

        /*firstNameElement = $(addMemberForm + " #first_name");*/
        customAddMemberErrorMessageElement = $(addMemberForm + " .custom-error-message");
        customAddMemberSuccessMessageElement = $(addMemberForm + " .custom-success-message");

        /* Teacher Reset Form */
        function resetAddMemberForm() {
            $(addMemberForm).parsley().reset();
            customAddMemberErrorMessageElement.hide();
            customAddMemberSuccessMessageElement.hide();
            /*firstNameElement.val("");*/
        }

        /* Add Edit Ajax Call */
        $(addMemberForm).submit(function (event) {

            if ($(addMemberForm).parsley().validate()) {
                event.preventDefault();

                customAddMemberErrorMessageElement.hide();
                customAddMemberSuccessMessageElement.hide();
                showLoader();
                var formData = new FormData($(this)[0]);

                jQuery.ajax({
                    url: window.addMemberUrl,
                    enctype: 'multipart/form-data',
                    method: 'post',
                    dataType: 'JSON',
                    processData: false,
                    contentType: false,
                    cache: false,
                    data : formData,
                    success: function (response) {
                        if (response.success == true) {
                            customAddMemberSuccessMessageElement.html(response.message);
                            customAddMemberSuccessMessageElement.show();
                            hideLoader();
                            setTimeout(function () {
                                location.reload();
                            }, 2000);
                        } else {
                            customAddMemberErrorMessageElement.html(response.message);
                            customAddMemberErrorMessageElement.show();
                            hideLoader();
                        }
                    },
                    error: function (xhr, status) {
                        customAddMemberErrorMessageElement.html(window._ajax_error_msg_common);
                        customAddMemberErrorMessageElement.show();
                        hideLoader();
                    }
                });
            }
        });

        /* Open Add Member Model */
        function openAddMemberModal(modelSelector) {
            resetAddMemberForm();
            openModal(modelSelector);
        }
    </script>
@endsection
