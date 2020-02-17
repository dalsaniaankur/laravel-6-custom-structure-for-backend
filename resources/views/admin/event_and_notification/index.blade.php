@extends('backend.layouts.app')
@section('title', 'Events & Notices | '.trans('admin.backend_title'))
@section('content')
    <div class="main_section">
        <div class="container">
            <div class="page-wrap bx-shadow mt-5 mb-5">
                <div class="row user-dt-wrap">
                    <div class="col-lg-12 col-md-12 pb-5">
                        <h1 class="admin_bigheading mb-5 w_100">Events & Notices</h1>
                        <div class="row">
                            <div class="col-md-12 col-lg-12 pb-5 px-md-5 pb0">
                                <h3 class="mb-4 admin_inner_title">Create</h3>

                                {!! Form::open(['method' => 'POST','enctype' => 'multipart/form-data','name'=>'admin-notification-create', 'id' =>'admin_notification_create_form', 'class'=>'notification-create-form','data-parsley-validate','route' => ['admin.event_and_notification.save']]) !!}

                                <div class="notification_dispatch">

                                    <div class="form-edit-profile">
                                        {!! Form::label('title', 'Title') !!}
                                        {!! Form::text('title', old('title'), ['class' => 'form-control mb-4', 'required' => '']) !!}
                                    </div>

                                    <div class="form-edit-profile">
                                        {!! Form::label('event_date', 'Event date') !!}
                                        {!! Form::text('event_date', old('event_date'), ['class' => 'form-control date-field mb-4', 'autocomplete' => 'Off', 'data-toggle'=>'datepicker', 'required' => '']) !!}
                                    </div>

                                    <div class="form-edit-profile">
                                        {!! Form::label('start_time', 'Start time') !!}
                                        {!! Form::text('start_time', old('start_time'), ['class' => 'form-control mb-4', 'autocomplete' => 'Off', 'data-toggle' => 'timepicker', 'required' => '']) !!}
                                    </div>

                                    <div class="form-edit-profile">
                                        {!! Form::label('end_time', 'End time') !!}
                                        {!! Form::text('end_time', old('end_time'), ['class' => 'form-control mb-4', 'autocomplete' => 'Off', 'data-toggle' => 'timepicker', 'required' => '']) !!}
                                    </div>


                                </div>
                                <div class="notification_dispatch">

                                    <div class="form-edit-profile">
                                        {!! Form::label('notification_type', 'Notice type') !!}
                                        {!! Form::select('notification_type', $notificationTypeDropDown, old('notification_type'), ['class' => 'form-control mb-4', 'required' => '']) !!}
                                    </div>

                                    <div class="form-edit-profile width100">
                                        {!! Form::label('description', 'Description') !!}
                                        {!! Form::textarea('description', '', ['class' => 'mb-4 form-control-text-area', 'required' => '',]) !!}
                                    </div>

                                    <div class="form-edit-profile">
                                        <label class="bluecolor">Upload photo</label>
                                        <div id="photo-upload">
                                            <div class="upload-btn-wrapper">
                                                <input type="file" style="display:none;" data-name="user-profile-file"
                                                       name="photo"
                                                       id="profile_photo">
                                                <button type="button" class="btn btn-orange" id="select_photo">Select
                                                    Photo
                                                </button>
                                            </div>
                                            <span class="user-profile-file" style="padding-left:10px;"></span>
                                        </div>
                                    </div>

                                </div>

                                <div class="form-edit-profilebtn saveh1">
                                    {!! Form::Submit('Save', ['class' => 'btn btn_green save_btn_green mt-5 mt0']) !!}
                                </div>
                                {!! Form::close() !!}
                            </div>
                            <div class="clear-both"></div>
                            <div class="col-lg-12 col-md-12 mt-5 px-md-5">
                                <h3 class="mb-4 admin_inner_title">Events & Notices ({{ $totalRecordCount }})</h3>

                                <div class="clear-both"></div>
                                <div class="table-responsive">
                                    <table class="table sorting data-table messages" id="classes">
                                        <thead>
                                        <tr>
                                            @php($shortClass = ( strtolower($sortedOrder) == 'asc') ? 'up' : 'down' )
                                            @php($sortDefault = '<i class="fas fa-sort"></i>')
                                            @php($sorting = '<i class="fas fa-caret-'.$shortClass.'"></i>')

                                            <th>@lang('admin.user.fields.id')</th>
                                            <th>TITLE</th>
                                            <th class="msgwidth">DESCRIPTION</th>
                                            <th>SENDER</th>
                                            <th>DATE & TIME</th>
                                            <th>TYPE</th>
                                            <th>NOTICE TYPE</th>
                                            <th class="actionwidth">ACTION</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(!empty($eventAndNotifications) && count($eventAndNotifications) > 0)
                                            @foreach($eventAndNotifications as $eventAndNotificationKey => $eventAndNotification)
                                                <tr>
                                                    <td class="data-id"><span>{{ ++$recordStart  }}</span></td>
                                                    <td><b>{{ $eventAndNotification->title }}</b></td>
                                                    <td><b>{!! $eventAndNotification->description  !!}</b></td>
                                                    <td><b>{{ $eventAndNotification->sender->name }}</b></td>
                                                    <td>
                                                        <b>{{ DateFacades::dateFormat($eventAndNotification->event_date,'format-3') }}</b>
                                                        <br/>
                                                        <b>{{ DateFacades::dateFormat($eventAndNotification->start_time,'time-format-1') }}
                                                            - {{ DateFacades::dateFormat($eventAndNotification->end_time,'time-format-1') }} </b>
                                                    </td>
                                                    <td><b>{{ $eventAndNotification->type_string }}</b></td>
                                                    <td><b>{{ $eventAndNotification->notification_type_string }}</b>
                                                    </td>
                                                    <td class="action_div">
                                                        <a href="javascript:void(0);"  onclick="openEditModal('#event_and_notification_model',{{ $eventAndNotification->event_and_notification_id }})" class="viewbtn">view</a>
                                                        {!! Form::open(array(
                                                                'method' => 'DELETE',
                                                                 'onsubmit' => "return confirm('".trans("admin.qa_are_you_sure_delete")." event & notification?');",
                                                                'route' => ['admin.event_and_notification.delete'])) !!}
                                                        {!! Form::hidden('id',$eventAndNotification->event_and_notification_id ) !!}

                                                        <button type="submit" value="Delete" class="delete_btn"><i
                                                                class="far fa-trash-alt"></i></button>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.event_and_notification.edit_model')
@endsection
@section('javascript')
    <script>
        /*var form = 'form#admin_event_search_form';*/
        var formAddEditForm = 'form#add_edit_event_model_form';
        window.addEditUrl = "{{ URL::to('admin/event-and-notification/ajax_save') }}";
        window.getDataForEditUrl = "{{ URL::to('admin/event-and-notification/get_data') }}";

        pageTitle = "event & notification";
        addEditModelIdElement = $(formAddEditForm + " #add_edit_model_id");
        notificationTypeElement = $(formAddEditForm + " #notification_type_edit");
        titleElement = $(formAddEditForm + " #title_edit");
        descriptionElement = $(formAddEditForm + " #description_edit");
        eventDateElement = $(formAddEditForm + " #event_date_edit");
            startTimeElement = $(formAddEditForm + " #start_time_edit");
        endTimeElement = $(formAddEditForm + " #end_time_edit");
        eventImageElement = $(formAddEditForm + " #event_image");
        statusElement = $(formAddEditForm + " #status_edit");
        eventImageNameElement = $(formAddEditForm + " .notification-profile-file");

        customErrorMessageElement = $(formAddEditForm + " .custom-error-message");
        customSuccessMessageElement = $(formAddEditForm + " .custom-success-message");
        modelTitleElement = $(".modal-title");

        /* Reset Form */
        function ResetForm() {
            $(formAddEditForm).parsley().reset();

            addEditModelIdElement.val(0);
            notificationTypeElement.val("");
            titleElement.val("");
            descriptionElement.val("");
            eventDateElement.val("");
            startTimeElement.val("");
            endTimeElement.val("");
            eventImageElement.addClass('d-none');
            eventImageNameElement.html("");
            statusElement.val("");
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

            addEditModelIdElement.val(data.event_and_notification_id);
            notificationTypeElement.val(data.notification_type);
            titleElement.val(data.title);
            descriptionElement.val(data.description);
            statusElement.val(data.status);
            eventDateElement.val(data.event_date_picker_format);

            startTimeElement.off('blur focus').removeData().removeAttr('data-timepicki-tim data-timepicki-mini data-timepicki-meri');
            endTimeElement.off('blur focus').removeData().removeAttr('data-timepicki-tim data-timepicki-mini data-timepicki-meri');
            startTimeElement.val(data.start_time_twelve_format);
            endTimeElement.val(data.end_time_twelve_format);

            var startTime = data.start_time_twelve_format.split(new RegExp('[-+()*/:? ]'));
            startTimeElement.timepicki({
                increase_direction:'up',
                start_time: [startTime[0], startTime[1], startTime[2]],
            });

            var endTime = data.end_time_twelve_format.split(new RegExp('[-+()*/:? ]'));
            endTimeElement.timepicki({
                increase_direction:'up',
                start_time: [endTime[0], endTime[1], endTime[2]],
            });

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
                    'event_and_notification_id': id,
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
