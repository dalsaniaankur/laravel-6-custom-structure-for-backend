@extends('backend.layouts.app')
@section('title', 'Events & Announcements | '.trans('admin.backend_title'))
@section('content')
    <div class="main_section">

        <div class="container">
            <div class="page-wrap bx-shadow mt-5 mb-5">
                <div class="row user-dt-wrap">
                    <div class="col-lg-12 col-md-12 pb-5">
                        <h1 class="admin_bigheading mb-5 inlinebtn">Events & Announcements ({{ $totalRecordCount }})</h1>
                        <a href="javascript:void(0);" class="btn light_blue float-right newbtn" onclick="openAddModal('#event_model')">New
                            event</a>
                        <div class="clear-both"></div>

                        {!! Form::open(['method' => 'GET','name'=>'admin-event-search', 'id' =>'admin_event_search_form', 'class'=>'top-search-options form-row pb-4','route' => ['teacher.events']]) !!}
                        {!! Form::hidden('sorted_by', $sortedBy, array('id' => 'sortedBy')) !!}
                        {!! Form::hidden('sorted_order', $sortedOrder, array('id' => 'sortedOrder')) !!}

                        <div class="col-md-3 col-lg-2">
                            <a href="{{ url('teacher/events/')}}">
                                <button type="button" class="btn btn_green resetbtn mb-3">Reset</button>
                            </a>
                       </div>

                        <div class="col-md-5 col-lg-4">
                            {!! Form::text('event_title', $eventTitle, ['class' => 'form-control mb-3', 'placeholder' => 'Title']) !!}
                        </div>

						<div class="col-md-5 col-lg-6">
                            {!! Form::text('description', $description, ['class' => 'form-control mb-3', 'placeholder' => 'Description']) !!}
                        </div>

                        <div class="col-md-4  col-lg-3">
                            {!! Form::text('start_date', $createdStartDate, ['id' =>'start_date', 'class' => 'form-control date-field mb-3', 'placeholder' => 'Start date','autocomplete' => 'Off', 'data-toggle'=>'datepicker']) !!}
                        </div>

                        <div class="col-md-4  col-lg-3">
                            {!! Form::text('end_date', $createdEndDate, ['id' =>'end_date', 'class' => 'form-control date-field mb-3', 'placeholder' => 'End date','autocomplete' => 'Off', 'data-toggle'=>'datepicker']) !!}
                        </div>

                        <div class="col-md-3 col-lg-2 offset-lg-4 offset-md-0">
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
                                        onclick="sortWithSearch('event_id');">ID
                                        {!!  $sortedBy =='event_id' ? $sorting : $sortDefault  !!}</th>
                                    <th class="updownicon"
                                        onclick="sortWithSearch('event_name');">Title
                                        {!!  $sortedBy =='event_name' ? $sorting : $sortDefault  !!}</th>
                                    <th>Description</th>
                                    <th>Date</th>
                                    <th class="actionwidth">@lang('admin.user.fields.action')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(!empty($events) && count($events) > 0)
                                    @foreach($events as $eventKey => $event)
                                        <tr>
                                            <td class="data-id"><span>{{ ++$recordStart  }}</span></td>
                                            <td><b>{{ $event->event_title  }}</b></td>
                                            <td><b>{{ $event->event_short_description  }}</b></td>
                                            <td><b>
                                                {{ DateFacades::dateFormat($event->start_date,'format-3') }}
                                                {{ DateFacades::dateFormat($event->start_time,'time-format-1') }} <br>
												{{ DateFacades::dateFormat($event->end_date,'format-3') }}
                                                {{ DateFacades::dateFormat($event->end_time,'time-format-1') }}
                                                </b>
                                            </td>
                                            <td class="action_div">
                                            		<div class="action_club">
                                                <a href="javascript:void(0);"  onclick="openEditModal('#event_model',{{ $event->event_id }})"
                                                   class="viewbtn">view</a>
                                                {!! Form::open(array(
                                                        'method' => 'DELETE',
                                                         'onsubmit' => "return confirm('".trans("admin.qa_are_you_sure_delete")." event?');",
                                                        'route' => ['teacher.event.delete'])) !!}
                                                {!! Form::hidden('id',$event->event_id ) !!}

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
	@include('teacher.events.edit_model')
@endsection
@section('javascript')
    <script>
        var form = 'form#admin_event_search_form';
		var formAddEditForm = 'form#add_edit_event_model_form';
        window.addEditUrl = "{{ URL::to('teacher/event/ajax_save') }}";
        window.getDataForEditUrl = "{{ URL::to('teacher/event/get_data') }}";

        pageTitle = "Event/Announcement";
        addEditModelIdElement = $(formAddEditForm + " #add_edit_model_id");
        eventTitleElement = $(formAddEditForm + " #event_title");
        eventDescriptionElement = $(formAddEditForm + " #description");
        eventStartDateElement = $(formAddEditForm + " #event_start_date");
        eventStartTimeElement = $(formAddEditForm + " #event_start_time");

		eventEndDateElement = $(formAddEditForm + " #event_end_date");
        eventEndTimeElement = $(formAddEditForm + " #event_end_time");
		eventImageElement = $(formAddEditForm + " #event_image");

        customErrorMessageElement = $(formAddEditForm + " .custom-error-message");
        customSuccessMessageElement = $(formAddEditForm + " .custom-success-message");
        modelTitleElement = $(".modal-title");

        /* Reset Form */
        function ResetForm() {
            $(formAddEditForm).parsley().reset();

            addEditModelIdElement.val(0);
            eventTitleElement.val("");
            eventDescriptionElement.val("");
			eventStartDateElement.val("");
			eventStartTimeElement.val("");
			eventEndDateElement.val("");
			eventEndTimeElement.val("");
			eventImageElement.addClass('d-none');
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
            addEditModelIdElement.val(data.event_id);
            eventTitleElement.val(data.event_title);
            eventDescriptionElement.val(data.description);
            eventStartDateElement.val(data.start_date);
            eventStartTimeElement.val(data.start_time_twelve_format);
            eventEndDateElement.val(data.end_date);
            eventEndTimeElement.val(data.end_time_twelve_format);
			if ( data.photo == '' || data.photo == null ) {
				eventImageElement.addClass('d-none');
			} else {
				var site_url = eventImageElement.attr( 'data-url' );
				eventImageElement.attr( 'src', site_url+'/'+data.photo );
				eventImageElement.removeClass('d-none');
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
                    'event_id': id,
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
