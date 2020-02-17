@extends('backend.layouts.app')
@section('title', 'Grades | '.trans('admin.backend_title'))
@section('content')
    <div class="main_section">
        <div class="container">
            <div class="page-wrap bx-shadow mt-5 mb-5">
                <div class="row user-dt-wrap">
                    <div class="col-lg-12 col-md-12 pb-5">
                        <h1 class="admin_bigheading mb-5 inlinebtn">Grades
                            @if($schoolId > 0 && !empty($schoolDropDownList) && count($schoolDropDownList) > 0)
                                @php($schoolName = strtolower($schoolDropDownList->toArray()[$schoolId]))
                              for {{ $schoolName }}
                            @endif
                            ({{ $totalRecordCount }})</h1>
                        <a href="javascript:void(0);" class="btn light_blue float-right newbtn" onclick="openAddModal('#grade_model')">New
                            grade</a>
                        <div class="clear-both"></div>
                        {!! Form::open(['method' => 'GET','name'=>'admin-grade-search', 'id' =>'admin_grade_search_form', 'class'=>'top-search-options form-row pb-4','route' => ['admin.grades']]) !!}
                        {!! Form::hidden('sorted_by', $sortedBy, array('id' => 'sortedBy')) !!}
                        {!! Form::hidden('sorted_order', $sortedOrder, array('id' => 'sortedOrder')) !!}
                        {!! Form::hidden('school_id', $schoolId, array('id' => 'school_id')) !!}

                        <div class="col-md-3 col-lg-2">
                            <a href="{{ url('admin/grades?school_id='.$schoolId)}}">
                                <button type="button" class="btn btn_green resetbtn mb-3">Reset</button>
                            </a>
                        </div>

                        <div class="col-md-5 col-lg-4">
                            {!! Form::text('grade_name', $gradeName, ['class' => 'form-control mb-3', 'placeholder' => 'Grade']) !!}
                        </div>

                        <div class="col-md-4  col-lg-3">
                            {!! Form::text('start_date', $createdStartDate, ['id' =>'start_date', 'class' => 'form-control date-field mb-3', 'placeholder' => 'Signed up from','autocomplete' => 'Off', 'data-toggle'=>'datepicker']) !!}
                        </div>

                        <div class="col-md-4  col-lg-3">
                            {!! Form::text('end_date', $createdEndDate, ['id' =>'end_date', 'class' => 'form-control date-field mb-3', 'placeholder' => 'Signed up to','autocomplete' => 'Off', 'data-toggle'=>'datepicker']) !!}
                        </div>

                        <div class="col-md-3 col-lg-2 offset-lg-10 offset-md-0">
                            {!! Form::Submit(trans('admin.qa_search'), ['class' => 'btn btn_green resetbtn']) !!}
                        </div>
                        {!! Form::close() !!}
						<div class="col-lg-11 col-md-12">
                        <div class="table-responsive mt-5">
                            <table class="table sorting data-table school" id="classes">
                                <thead>
                                <tr>
                                    @php($shortClass = ( strtolower($sortedOrder) == 'asc') ? 'up' : 'down' )
                                    @php($sortDefault = '<i class="fas fa-sort"></i>')
                                    @php($sorting = '<i class="fas fa-caret-'.$shortClass.'"></i>')

                                    <th class="updownicon"
                                        onclick="sortWithSearch('grade_id');">ID
                                        {!!  $sortedBy =='grade_id' ? $sorting : $sortDefault  !!}</th>
                                    <th class="updownicon"
                                        onclick="sortWithSearch('grade_name');">GRADE
                                        {!!  $sortedBy =='grade_name' ? $sorting : $sortDefault  !!}</th>
                                    <th>SCHOOL</th>
                                    <th>ADDED</th>
                                    <th class="actionwidth">@lang('admin.user.fields.action')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(!empty($grades) && count($grades) > 0)
                                    @foreach($grades as $gradeKey => $grade)
                                        <tr>
                                            <td class="data-id"><span>{{ ++$recordStart  }}</span></td>
                                            <td><b>{{ $grade->grade_name  }}</b></td>
                                            <td><b>{{ $grade->school->school_name  }}</b></td>
                                            <td>
                                                <b>{{ DateFacades::dateFormat($grade->created_at,'format-3') }}</b><br>
                                                {{ DateFacades::dateFormat($grade->created_at,'time-format-1') }}
                                            </td>
                                            <td class="action_div">
                                            	<div class="action_club">
                                                <a href="javascript:void(0);"  onclick="openEditModal('#grade_model',{{ $grade->grade_id }})"
                                                   class="viewbtn">view</a>
                                                {!! Form::open(array(
                                                        'method' => 'DELETE',
                                                         'onsubmit' => "return confirm('".trans("admin.qa_are_you_sure_delete")." grade?');",
                                                        'route' => ['admin.grade.delete'])) !!}
                                                {!! Form::hidden('id',$grade->grade_id ) !!}

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
                        </div>
                        {!! $paging !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
	@include('admin.grade.edit_model')
@endsection
@section('javascript')
    <script>
        var form = 'form#admin_grade_search_form';
		var formAddEditForm = 'form#add_edit_grade_model_form';
        window.addEditUrl = "{{ URL::to('admin/grade/ajax_save') }}";
        window.getDataForEditUrl = "{{ URL::to('admin/grade/get_data') }}";

        pageTitle = "grade";
        addEditModelIdElement = $(formAddEditForm + " #add_edit_model_id");
        gradeNameElement = $(formAddEditForm + " #grade_name");
        schoolIdElement = $(formAddEditForm + " #school_id");
        customErrorMessageElement = $(formAddEditForm + " .custom-error-message");
        customSuccessMessageElement = $(formAddEditForm + " .custom-success-message");
        modelTitleElement = $(".modal-title");

        /* Reset Form */
        function ResetForm() {
            $(formAddEditForm).parsley().reset();

            addEditModelIdElement.val(0);
            gradeNameElement.val("");
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
                        'grade_id': addEditModelIdElement.val(),
                        'grade_name': gradeNameElement.val(),
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

        function FormDataBind(data) {

            addEditModelIdElement.val(data.grade_id);
            gradeNameElement.val(data.grade_name);
            schoolIdElement.val(data.school_id);
        }

        function openEditModal(modelSelector, id) {
            showLoader();
            jQuery.ajax({
                url: window.getDataForEditUrl,
                method: 'post',
                dataType: 'JSON',
                data: {
                    '_token': window._token,
                    'grade_id': id,
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
