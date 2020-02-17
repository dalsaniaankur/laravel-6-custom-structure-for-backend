@extends('backend.layouts.app')
@section('title', 'Exams | '.trans('admin.backend_title'))
@section('content')
    <div class="main_section">

        <div class="container-fluid">
            <div class="page-wrap bx-shadow mt-5 mb-5">
                <div class="row user-dt-wrap">
                    <div class="col-lg-12 col-md-12 pb-5">
                        <h1 class="admin_bigheading mb-5 inlinebtn">Exams ({{ $totalRecordCount }})</h1>
                        <a href="javascript:void(0);" class="btn light_blue float-right newbtn" onclick="openAddModal('#exam_model')">New
                            exam</a>
                        <div class="clear-both"></div>

                        {!! Form::open(['method' => 'GET','name'=>'admin-exam-search', 'id' =>'admin_exam_search_form', 'class'=>'top-search-options form-row pb-4','route' => ['teacher.exams']]) !!}
                        {!! Form::hidden('sorted_by', $sortedBy, array('id' => 'sortedBy')) !!}
                        {!! Form::hidden('sorted_order', $sortedOrder, array('id' => 'sortedOrder')) !!}

                        <div class="col-md-3 col-lg-2">
                            <a href="{{ url('teacher/exams/')}}">
                                <button type="button" class="btn btn_green resetbtn mb-3">Reset</button>
                            </a>
                       </div>

                        <div class="col-md-5 col-lg-4">
                            {!! Form::text('exam_name', $examName, ['class' => 'form-control mb-3', 'placeholder' => 'Exam']) !!}
                        </div>

                        <div class="col-md-4  col-lg-3">
                            {!! Form::text('start_date', $examStartDate, ['id' =>'start_date', 'class' => 'form-control date-field mb-3', 'placeholder' => 'Start date','autocomplete' => 'Off', 'data-toggle'=>'datepicker']) !!}
                        </div>

                        <div class="col-md-4  col-lg-3">
                            {!! Form::text('end_date', $examEndDate, ['id' =>'end_date', 'class' => 'form-control date-field mb-3', 'placeholder' => 'End date','autocomplete' => 'Off', 'data-toggle'=>'datepicker']) !!}
                        </div>

                        <div class="col-md-3 col-lg-2 offset-lg-10 offset-md-0">
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
                                        onclick="sortWithSearch('exam_id');">ID
                                        {!!  $sortedBy =='exam_id' ? $sorting : $sortDefault  !!}</th>
                                    <th class="updownicon"
                                        onclick="sortWithSearch('exam_name');">Exam
                                        {!!  $sortedBy =='exam_name' ? $sorting : $sortDefault  !!}</th>
                                    <th>SCHOOL</th>
                                    <th>EXAM DATE</th>
                                    <th>ADDED</th>
                                    <th class="actionwidth">@lang('admin.user.fields.action')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(!empty($exams) && count($exams) > 0)
                                    @foreach($exams as $examKey => $exam)
                                        <tr>
                                            <td class="data-id"><span>{{ ++$recordStart  }}</span></td>
                                            <td>{{ $exam->exam_name  }}</td>
                                            <td>{{ $exam->school->school_name  }}</td>
                                            <td>
                                                <b>{{ DateFacades::dateFormat($exam->exam_date,'format-3') }}</b>
                                            </td>
                                            <td>
                                                <b>{{ DateFacades::dateFormat($exam->created_at,'format-3') }}</b><br>
                                                {{ DateFacades::dateFormat($exam->created_at,'time-format-1') }}
                                            </td>
                                            <td class="action_div">
                                            		<div class="action_club">
                                                <a href="javascript:void(0);"  onclick="openEditModal('#exam_model',{{ $exam->exam_id }})"
                                                   class="viewbtn">view</a>
                                                {!! Form::open(array(
                                                        'method' => 'DELETE',
                                                         'onsubmit' => "return confirm('".trans("admin.qa_are_you_sure_delete")." exam?');",
                                                        'route' => ['teacher.exam.delete'])) !!}
                                                {!! Form::hidden('id',$exam->exam_id ) !!}

                                                <button type="submit" value="Delete" class="delete_btn"><i
                                                            class="far fa-trash-alt"></i></button>

                                                {!! Form::close() !!}
                                                </div>
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
	@include('teacher.exam.edit_model')
@endsection
@section('javascript')
    <script>
        var form = 'form#admin_exam_search_form';
		var formAddEditForm = 'form#add_edit_exam_model_form';
        window.addEditUrl = "{{ URL::to('teacher/exam/ajax_save') }}";
        window.getDataForEditUrl = "{{ URL::to('teacher/exam/get_data') }}";

        pageTitle = "Exam";
        addEditModelIdElement = $(formAddEditForm + " #add_edit_model_id");
        examNameElement = $(formAddEditForm + " #exam_name");
        examDateElement = $(formAddEditForm + " #exam_date");
        customErrorMessageElement = $(formAddEditForm + " .custom-error-message");
        customSuccessMessageElement = $(formAddEditForm + " .custom-success-message");
        modelTitleElement = $(".modal-title");

        /* Reset Form */
        function ResetForm() {
            $(formAddEditForm).parsley().reset();

            addEditModelIdElement.val(0);
            examNameElement.val("");
            examDateElement.val("");
        }

        /* Open Add Model */
        function openAddModal(modelSelector) {
            ResetForm();
            modelTitleElement.html("Add " + pageTitle);
            openModal(modelSelector);
        }

        /* Add Edit Ajax Call */
        $(formAddEditForm).submit(function (event) {

            if ($(formAddEditForm).parsley().validate()) {

                event.preventDefault();

                showLoader();

                jQuery.ajax({
                    url: window.addEditUrl,
                    method: 'post',
                    dataType: 'JSON',
                    data: {
                        '_token': window._token,
                        'exam_id': addEditModelIdElement.val(),
                        'exam_name': examNameElement.val(),
                        'exam_date': examDateElement.val(),
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
            addEditModelIdElement.val(data.exam_id);
            examNameElement.val(data.exam_name);
            examDateElement.val(moment(data.exam_date).format('MM/DD/YYYY'));
        }

        function openEditModal(modelSelector, id) {
            showLoader();
            jQuery.ajax({
                url: window.getDataForEditUrl,
                method: 'post',
                dataType: 'JSON',
                data: {
                    '_token': window._token,
                    'exam_id': id,
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
