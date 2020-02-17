@extends('backend.layouts.app')
@section('title', 'Homework | '.trans('admin.backend_title'))
@section('content')
    <div class="main_section">

        <div class="container">
            <div class="page-wrap bx-shadow mt-5 mb-5">
                <div class="row user-dt-wrap">
                    <div class="col-lg-12 col-md-12 pb-5">
                        <h1 class="admin_bigheading mb-5 inlinebtn">Homework ({{ $totalRecordCount }})</h1>
                        <a href="javascript:void(0);" class="btn light_blue float-right newbtn" onclick="openAddModal('#homework_model')">New
                            Homework</a>
                        <div class="clear-both"></div>

                        {!! Form::open(['method' => 'GET','name'=>'admin-exam-search', 'id' =>'admin_homework_search_form', 'class'=>'top-search-options form-row pb-4','route' => ['teacher.homework']]) !!}
                        {!! Form::hidden('sorted_by', $sortedBy, array('id' => 'sortedBy')) !!}
                        {!! Form::hidden('sorted_order', $sortedOrder, array('id' => 'sortedOrder')) !!}

                        <div class="col-md-3 col-lg-2">
                            <a href="{{ url('teacher/homework/')}}">
                                <button type="button" class="btn btn_green resetbtn mb-3">Reset</button>
                            </a>
                       </div>

                        <div class="col-md-5 col-lg-4">
                            {!! Form::text('content', $content, ['class' => 'form-control mb-3', 'placeholder' => 'Homework']) !!}
                        </div>

                        <div class="col-md-4  col-lg-3">
                            {!! Form::text('start_date', $createdStartDate, ['id' =>'start_date', 'class' => 'form-control date-field mb-3', 'placeholder' => 'Start date','autocomplete' => 'Off', 'data-toggle'=>'datepicker']) !!}
                        </div>

                        <div class="col-md-4  col-lg-3">
                            {!! Form::text('end_date', $createdEndDate, ['id' =>'end_date', 'class' => 'form-control date-field mb-3', 'placeholder' => 'End date','autocomplete' => 'Off', 'data-toggle'=>'datepicker']) !!}
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
                                        onclick="sortWithSearch('homework_id');">ID
                                        {!!  $sortedBy =='homework_id' ? $sorting : $sortDefault  !!}</th>
                                    <th class="updownicon"
                                        onclick="sortWithSearch('content');">content
                                        {!!  $sortedBy =='content' ? $sorting : $sortDefault  !!}</th>
                                    <th>Date</th>
                                    <th class="actionwidth">@lang('admin.user.fields.action')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(!empty($homework) && count($homework) > 0)
                                    @foreach($homework as $homeworkKey => $hwork)
                                        <tr>
                                            <td class="data-id"><span>{{ ++$recordStart  }}</span></td>
                                            <td><b>{{ $hwork->content  }}</b></td>
                                            <td><b>{{ DateFacades::dateFormat($hwork->homework_date,'format-3') }}</b></td>
                                            <td class="action_div">
                                            		<div class="action_club">
                                                <a href="javascript:void(0);"  onclick="openEditModal('#homework_model',{{ $hwork->homework_id }})"
                                                   class="viewbtn">view</a>
                                                {!! Form::open(array(
                                                        'method' => 'DELETE',
                                                         'onsubmit' => "return confirm('".trans("admin.qa_are_you_sure_delete")." homework?');",
                                                        'route' => ['teacher.homework.delete'])) !!}
                                                {!! Form::hidden('id',$hwork->homework_id ) !!}

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
	@include('teacher.homework.edit_model')
@endsection
@section('javascript')
    <script>
        var form = 'form#admin_homework_search_form';
		var formAddEditForm = 'form#add_edit_homework_model_form';
        window.addEditUrl = "{{ URL::to('teacher/homework/ajax_save') }}";
        window.getDataForEditUrl = "{{ URL::to('teacher/homework/get_data') }}";

        pageTitle = "Homework";
        addEditModelIdElement = $(formAddEditForm + " #add_edit_model_id");
        homeworkNameElement = $(formAddEditForm + " #homework_content");
        homeworkDateElement = $(formAddEditForm + " #homework_date");
        homeworkImageElement = $(formAddEditForm + " #homework-image");
        customErrorMessageElement = $(formAddEditForm + " .custom-error-message");
        customSuccessMessageElement = $(formAddEditForm + " .custom-success-message");
        modelTitleElement = $(".modal-title");

        /* Reset Form */
        function ResetForm() {
            $(formAddEditForm).parsley().reset();

            addEditModelIdElement.val(0);
            homeworkNameElement.val("");
            homeworkDateElement.val("");
            homeworkImageElement.addClass("d-none");
            homeworkDateElement.prop("disabled", false);
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
				var formData = new FormData($(this)[0]);
                jQuery.ajax({
                    url: window.addEditUrl,
                    enctype: 'multipart/form-data',
                    method: 'post',
                    dataType: 'JSON',
                    processData: false,
                    contentType: false,
                    cache: false,
                    data : formData,
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
            addEditModelIdElement.val(data.homework_id);
            homeworkNameElement.val(data.content);
            homeworkDateElement.val(data.homework_date);
			if( data.photo != '' ){
				homeworkImageElement.removeClass("d-none");
				homeworkImageElement.attr( "src",data.photo );
			}
        }

        function openEditModal(modelSelector, id) {
            showLoader();
            jQuery.ajax({
                url: window.getDataForEditUrl,
                method: 'post',
                dataType: 'JSON',
                data: {
                    '_token': window._token,
                    'homework_id': id,
                },
                success: function (response) {
                    if (response.success == true) {
                        ResetForm();
                        modelTitleElement.html("Edit " + pageTitle);
                        FormDataBind(response.data);
                        homeworkDateElement.prop("disabled", true);
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
