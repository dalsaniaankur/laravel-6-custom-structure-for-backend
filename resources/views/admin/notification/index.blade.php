@extends('backend.layouts.app')
@section('title', 'Notifications | '.trans('admin.backend_title'))
@section('content')
    <div class="main_section">
        <div class="container">
            <div class="page-wrap bx-shadow mt-5 mb-5">
                <div class="row user-dt-wrap">
                    <div class="col-lg-12 col-md-12 pb-5">
                        <h1 class="admin_bigheading mb-5 inlinebtn">Notifications ({{ $totalRecordCount }})</h1>
                        <a href="javascript:void(0);" class="btn light_blue float-right newbtn" onclick="openNotificationModal('#notification_model')">New Notification</a>
                        <div class="clear-both"></div>
                        {!! Form::open(['method' => 'GET','name'=>'admin-grade-search', 'id' =>'admin_notification_search_form', 'class'=>'top-search-options form-row pb-4','route' => ['admin.notifications']]) !!}
                        {!! Form::hidden('sorted_by', $sortedBy, array('id' => 'sortedBy')) !!}
                        {!! Form::hidden('sorted_order', $sortedOrder, array('id' => 'sortedOrder')) !!}

                        <div class="col-md-3 col-lg-3">
                            <a href="{{ url('admin/notifications')}}">
                                <button type="button" class="btn btn_green resetbtn mb-3">Reset</button>
                            </a>
                        </div>
                        <div class="col-md-3  col-lg-3">
                            {!! Form::text('display_start_date', $displayStartDate, ['id' =>'start_date', 'class' => 'form-control date-field mb-3', 'placeholder' => 'Display up from','autocomplete' => 'Off', 'data-toggle'=>'datepicker']) !!}
                        </div>

                        <div class="col-md-3  col-lg-3">
                            {!! Form::text('display_end_date', $displayEndDate, ['id' =>'end_date', 'class' => 'form-control date-field mb-3', 'placeholder' => 'Display up to','autocomplete' => 'Off', 'data-toggle'=>'datepicker']) !!}
                        </div>

                        <div class="col-md-3 col-lg-3">
                            {!! Form::Submit(trans('admin.qa_search'), ['class' => 'btn btn_green resetbtn']) !!}
                        </div>
                        {!! Form::close() !!}
						<div class="col-lg-12 col-md-12">
                        <div class="table-responsive mt-5">
                            <table class="table sorting data-table" id="classes">
                                <thead>
                                <tr>
                                    @php($shortClass = ( strtolower($sortedOrder) == 'asc') ? 'up' : 'down' )
                                    @php($sortDefault = '<i class="fas fa-sort"></i>')
                                    @php($sorting = '<i class="fas fa-caret-'.$shortClass.'"></i>')
                                    <th>ID#</th>
                                    <th>Message</th>
                                    <th>Display Date</th>
                                    <th class="actionwidth">@lang('admin.user.fields.action')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(!empty($notifications) && count($notifications) > 0)
                                    @foreach($notifications as $notificationKey => $notification)
                                        <tr>
                                            <td class="data-id">
                                                <span>{{ ++$recordStart  }}</span>
                                            </td>
                                            <td class="elips_des"><p>{{ strlen($notification->description)>100 ? substr($notification->description,0,100).'...' : $notification->description }}</p></td>
                                            <td> {{ DateFacades::dateFormat($notification->display_date,'format-3') }} <br/>
                                                {{ DateFacades::dateFormat($notification->display_date,'time-format-1') }}
                                            </td>
                                            <td class="action_div">
                                                <div class="action_club">
                                                <a href="{{ url('admin/notification/details/'.$notification->unique_group_id) }}" class="viewbtn">View</a>
                                                {!! Form::open(array(
                                                    'method' => 'DELETE',
                                                    'onsubmit' => "return confirm('".trans("admin.qa_are_you_sure_delete_notification")."');",
                                                    'route' => ['admin.notification.delete'])) !!}
                                                {!! Form::hidden('unique_group_id', $notification->unique_group_id) !!}
                                                {!! Form::hidden('id', Common::getEncryptId($notification->notification_id)) !!}
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
@include('admin.notification.add_model')
@endsection
@section('javascript')
    <script>
        var form = 'form#admin_notification_search_form';

        /*----------------------------------  Add Notification  -----------------------------------*/

        var addNotificationForm = 'form#add_notification_model_form';

        window.addNotificationUrl = "{{ URL::to('admin/notification/create') }}";
        window.getClubDropDownUrl = "{{ URL::to('get_club_dropdown') }}";
        window.getUserDropDownByClubIdUrl = "{{ URL::to('get_user_dropdown_by_club_id_for_notification') }}";
        window.getGradeDropDownUrl = "{{ URL::to('getgradedropdown') }}";
        window.getClassDropDownByGradeIdUrl = "{{ URL::to('get_class_dropdown_by_grade_id') }}";
        window.getUserDropDownByClassIdUrl = "{{ URL::to('get_user_dropdown_by_class_id_for_notification') }}";

        addNotificationModelIdElement = $(addNotificationForm + " #add_notification_model_id");
        typeElement = $(addNotificationForm + " .type");
        userIdElement = $(addNotificationForm + " .user_id");
        descriptionElement = $(addNotificationForm + " #description");
        displayDateElement = $(addNotificationForm + " #display_date");
        clubIdElement = $(addNotificationForm + " #club_id");
        gradeIdElement = $(addNotificationForm + " #grade_id");
        classIdElement = $(addNotificationForm + " #class_id");
        schoolIdElement = $(addNotificationForm + " #school_id");
        customMessageErrorMessageElement = $(addNotificationForm + " .custom-error-message");
        customMessageSuccessMessageElement = $(addNotificationForm + " .custom-success-message");

        userIdElement.multiselect({
            columns: 1,
            search: true,
            selectAll: true,
            placeholder: 'Select user',
        });

        jQuery('input[type=radio][name=notification_type]').change(function() {
            if( this.value == 'instant' ){
                jQuery('.display_date_parent').addClass('display-none');
                displayDateElement.val('');
            } else {
                jQuery('.display_date_parent').removeClass('display-none');

            }
        });

        /* Notification Reset Form */
        function resetMessageForm() {
            $(addNotificationForm).parsley().reset();
            customMessageErrorMessageElement.hide();
            customMessageSuccessMessageElement.hide();
            addNotificationModelIdElement.val(0);
            userIdElement.val("");
            descriptionElement.val("");
        }

        /* Open Notification Model */
        function openNotificationModal(modelSelector) {
            resetMessageForm();
            openModal(modelSelector);
        }

        /* Add Edit Ajax Call */
        $(addNotificationForm).submit(function (event) {

            if ($(addNotificationForm).parsley().validate()) {

                event.preventDefault();
                customMessageErrorMessageElement.hide();
                customMessageSuccessMessageElement.hide();
                showLoader();

                var formData = new FormData($(this)[0]);
                jQuery.ajax({
                    url: window.addEditMessageUrl,
                    enctype: 'multipart/form-data',
                    method: 'post',
                    dataType: 'JSON',
                    processData: false,
                    contentType: false,
                    cache: false,
                    data : formData,
                    success: function (response) {
                        if (response.success == true) {
                            customMessageSuccessMessageElement.html(response.message);
                            customMessageSuccessMessageElement.show();
                            hideLoader();
                            setTimeout(function () {
                                location.reload();
                            }, 2000);
                        } else {
                            customMessageErrorMessageElement.html(response.message);
                            customMessageErrorMessageElement.show();
                            hideLoader();
                        }
                    },
                    error: function (xhr, status) {
                        customMessageErrorMessageElement.html(window._ajax_error_msg_common);
                        customMessageErrorMessageElement.show();
                        hideLoader();
                    }
                });
            }
        });

        /* changeNotificationType */
        function changeNotificationType() {
            window.type = typeElement.val();
			schoolIdElement.prop('selectedIndex',0);
            /* Reset */
            if(window.type == undefined || window.type == '' || window.type == null){

                /* Club reset */
                clubDropDownReset();
                jQuery('.club-part').hide();

                /* Class reset */
                jQuery('.school-part').hide();
                jQuery('.grade-part').hide();
                jQuery('.class-part').hide();
                //schoolDropDownReset();
                gradeDropDownReset();
                //classDropDownReset();

                userDropDownReset();

            }

            /* Class */
            if(window.type == 1){

                /* Club reset */
                clubDropDownReset();
                jQuery('.club-part').hide();
                userDropDownReset();
				jQuery('.school-part').show();
				jQuery('.grade-part').hide();
               // getGradeDropDown();
            }
            /* Club */
            if(window.type == 2){

                /* Class reset */
                //schoolDropDownReset();
                gradeDropDownReset();
                //classDropDownReset();
                userDropDownReset();
                jQuery('.school-part').hide();
                jQuery('.grade-part').hide();
                jQuery('.class-part').hide();

                /* Club */
                getClubDropDown();
            }
        }

        function getUserByClassId(){
            userDropDownReset();
            if(classIdElement.val() > 0) {
                showLoader();
                jQuery.ajax({
                    url: window.getUserDropDownByClassIdUrl,
                    method: 'post',
                    dataType: 'JSON',
                    data: {
                        '_token': window._token,
                        'class_id': classIdElement.val(),
                    },
                    success: function (response) {
                        if (response != '') {
                            jQuery.each(response, function (key, value) {
                                jQuery(userIdElement).append('<option value="' + key + '">' + value + '</option>');
                            });
                        }
                        jQuery(userIdElement).multiselect('reload');
                        hideLoader();
                    }
                });
            }
        }

        function getClassByGradeId(){
            userDropDownReset();
			classDropDownReset();
            if(gradeIdElement.val() > 0) {
                showLoader();
                jQuery.ajax({
                    url: window.getClassDropDownByGradeIdUrl,
                    method: 'post',
                    dataType: 'JSON',
                    data: {
                        '_token': window._token,
                        'grade_id': gradeIdElement.val(),
                    },
                    success: function (response) {
                        if (response != '') {
                            jQuery.each(response, function (key, value) {
                                jQuery(classIdElement).append('<option value="' + key + '">' + value + '</option>');
                            });
                        }
                        jQuery(userIdElement).multiselect('reload');
                        hideLoader();
                        jQuery('.class-part').show();
                    }
                });
            }
        }

        function gradeDropDownReset(){
            gradeIdElement.empty();
            gradeIdElement.append('<option value="">Select grade</option>');
        }

		function classDropDownReset(){
            classIdElement.empty();
            classIdElement.append('<option value="">Select class</option>');
        }

        function getGradeDropDown() {
            gradeDropDownReset();
            classDropDownReset();
            if(typeElement.val() == 1) {
                showLoader();
                jQuery.ajax({
                    url: window.getGradeDropDownUrl,
                    method: 'post',
                    dataType: 'JSON',
                    data: {
                        '_token': window._token,
                        'school_id': schoolIdElement.val(),
                    },
                    success: function (response) {
                        if (response != '') {
                            jQuery.each(response, function (key, value) {
                                gradeIdElement.append('<option value="' + key + '">' + value + '</option>');
                            });
                        }
                        hideLoader();
                        jQuery('.grade-part').show();
                    }
                });
            }
        }

        function clubDropDownReset(){
            clubIdElement.empty();
            clubIdElement.append('<option value="">Select club</option>');
        }
        function getClubDropDown(){
            clubDropDownReset();
            if(typeElement.val() == 2) {
                showLoader();
                jQuery.ajax({
                    url: window.getClubDropDownUrl,
                    method: 'post',
                    dataType: 'JSON',
                    data: {
                        '_token': window._token,
                    },
                    success: function (response) {
                        if (response != '') {
                            jQuery.each(response, function (key, value) {
                                clubIdElement.append('<option value="' + key + '">' + value + '</option>');
                            });
                        }
                        hideLoader();
                        jQuery('.club-part').show();
                    }
                });
            }
        }

        function userDropDownReset(){
            jQuery(userIdElement).empty();
            jQuery(userIdElement).multiselect('reload');
        }
        function getUserByClub(){
            userDropDownReset();
            if(clubIdElement.val() > 0) {
                showLoader();
                jQuery.ajax({
                    url: window.getUserDropDownByClubIdUrl,
                    method: 'post',
                    dataType: 'JSON',
                    data: {
                        '_token': window._token,
                        'club_id': clubIdElement.val(),
                    },
                    success: function (response) {
                        if (response != '') {
                            jQuery.each(response, function (key, value) {
                                jQuery(userIdElement).append('<option value="' + key + '">' + value + '</option>');
                            });
                        }
                        jQuery(userIdElement).multiselect('reload');
                        hideLoader();
                    }
                });
            }
        }

        /* Add Ajax Call */
        jQuery(addNotificationForm).submit(function (event) {
            if (jQuery(addNotificationForm).parsley().validate()) {

                event.preventDefault();
                customMessageErrorMessageElement.hide();
                customMessageSuccessMessageElement.hide();
                showLoader();
                if( jQuery("input[name='notification_type']:checked").val()=='schedule' && displayDateElement.val()==''){
                    jQuery('.display_date_parent').removeClass('display-none');
                    customMessageErrorMessageElement.html("Please select display date");
                    customMessageErrorMessageElement.show();
                    hideLoader();
                } else if( userIdElement.val() == '' && coachIdElement.val()=='' && groupIdElement.val() =='' ) {
                    customMessageErrorMessageElement.html("Please select at least one user");
                    customMessageErrorMessageElement.show();
                    hideLoader();
                } else {
                    jQuery.ajax({
                        url: window.addNotificationUrl,
                        method: 'post',
                        dataType: 'JSON',
                        data: {
                            '_token': window._token,
                            'notification_id': 0,
                            'user_id': userIdElement.val(),
                            'description': descriptionElement.val(),
                            'display_date': displayDateElement.val(),
                            'notificationsendtype' : jQuery("input[name='notification_type']:checked").val(),
                            'notification_type' : typeElement.val()
                        },
                        success: function (response) {
                            if (response.success == true) {
                                customMessageSuccessMessageElement.html(response.message);
                                customMessageSuccessMessageElement.show();
								customMessageErrorMessageElement.hide();
                                hideLoader();
                                setTimeout(function () {
                                    location.reload();
                                }, 2000);
                            } else {
                                customMessageErrorMessageElement.html(response.message);
                                customMessageErrorMessageElement.show();
                                hideLoader();
                            }
                        },
                        error: function (xhr, status) {
                            customMessageErrorMessageElement.html(window._ajax_error_msg_common);
                            customMessageErrorMessageElement.show();
                            hideLoader();
                        }
                    });
                }
            }
        });
    </script>
@endsection
