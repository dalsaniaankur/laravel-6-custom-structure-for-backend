@extends('backend.layouts.app')
@section('title', 'Notification Details | '.trans('admin.backend_title'))
@section('content')
    <div class="main_section">
        <div class="container">
            <div class="page-wrap bx-shadow mt-5 mb-5">
                <h1 class="admin_bigheading mb-2 inlinebtn">Notification Details</h1>

				@if ( !\DateFacades::isDateExpired($notificationStatus->display_date) )
					<button type="button" class="btn light_blue float-right newbtn"
							onclick="openEditModal('#notification_model', '{{ $notificationStatus->unique_group_id }}', '{{ $notificationStatus->description }}','{{ $notificationStatus->display_date }}')">Edit Notification
					</button>
				@endif
				<div class="clearfix"></div>
				<label>Message:</label> {{ $notificationStatus->description }}<br>
				<label>Display Date:</label> {{ DateFacades::dateFormat($notificationStatus->display_date,'format-3') }}
                                        {{ DateFacades::dateFormat($notificationStatus->display_date,'time-format-1') }}


                <div class="clearfix"></div>
				<div class="user-dt-wrap">

					@if(!empty($notificationScheduled) && count($notificationScheduled) > 0)
						<div class="col-md-12">
							<h3 class="text-center mb-5 mt-3"> Scheduled User Lists </h3>
                            <div class="row">
								@foreach($notificationScheduled as $notificationKey => $notification )
									<div class="col-lg-4 col-md-6 notification-user-list schedule_notification_list mb-3">
											<div class="f-left">
												{{ $notification->user->name ?? '-'}} <br/>
												{{ $notification->user->email ?? '-'}}
											</div>
											<div class="f-right deletediv">
												{!! Form::open(array(
													'method' => 'DELETE',
													'onsubmit' => "return confirm('".trans("admin.qa_are_you_sure_delete_notification")."');",
													'route' => ['admin.notification.delete'])) !!}
												{!! Form::hidden('id', Common::getEncryptId($notification->notification_id)) !!}

												<button type="submit" value="Delete" class="deletebtn"><i class="far fa-trash-alt"></i></button>

												{!! Form::close() !!}
											</div>
									</div>
								@endforeach
                            </div>
						</div>
					@endif

					@if( !empty( $notificationSents ) && count( $notificationSents ) > 0 ||
							!empty( $notificationViews ) && count( $notificationViews ) > 0 )
							<div class="col-md-12">
							<h3 class="text-center mb-5 mt-3">Sended User Lists </h3>
							<div class="row">
							@if(!empty($notificationSents) && count($notificationSents) > 0 )
								@foreach($notificationSents as $notificationKey => $notification )
									<div class="col-lg-4 col-md-6 notification-user-list schedule_notification_list mb-3">
										{{ $notification->user->name ?? '-'}} <br/>
										{{ $notification->user->email ?? '-'}}
									</div>
								@endforeach
							@endif

							@if(!empty($notificationViews) && count($notificationViews) > 0 )
								@foreach($notificationViews as $notificationKey => $notification )
									<div class="col-lg-4 col-md-6 notification-user-list schedule_notification_list mb-3">
										{{ $notification->user->name ?? '-'}} <br/>
										{{ $notification->user->email ?? '-'}}
									</div>
								@endforeach
							@endif
                            </div>
						</div>
					@endif

					@if( !empty($notificationFailed) && count($notificationFailed) > 0 )
						<div class="col-md-12">
						<h3 class="text-center mb-5 mt-3">Failed User Lists</h3>
                        	<div class="row">
							@foreach($notificationFailed as $notificationKey => $notification )
								<div class="col-lg-4 col-md-6 notification-user-list schedule_notification_list mb-3">
                                	<div class="notifydiv">
										{{ $notification->user->name ?? '-'}} <br/>
										{{ $notification->user->email ?? '-'}}
										<button type="submit" value="Send Notification" class="btn notificationsend" onclick="sendNotification({{ $notification->notification_id }})">
											<i class="far fa-bell"></i></button>
                                         </div>
									</div>
							@endforeach
                            </div>
						</div>
					@endif

				</div>
            </div>
        </div>
	</div>
@include('admin.notification.edit_model')
@endsection
@section('javascript')
    <script>
        var form = 'form#notification_form';
        var formAddEditForm = 'form#add_edit_notification_model_form';
        window.add_edit_url = "{{ URL::to('admin/notification/update') }}";
		window.send_notification_url = "{{ URL::to('admin/notification/send_notification') }}";

        pageTitle = "Notification";
        addEditModelIdElement = $(formAddEditForm + " #add_edit_model_id");
        descriptionElement = $(formAddEditForm + " #description");
        displayDateElement = $(formAddEditForm + " #display_date");
		customErrorMessageElement = $(formAddEditForm + " .custom-error-message");
        customSuccessMessageElement = $(formAddEditForm + " .custom-success-message");
        modelTitleElement = $(".modal-title");
        window.current_user_id = 0;
		userIdElement = $(formAddEditForm + " #user_id");
        coachIdElement = $(formAddEditForm + " #coach_id");
        viewUserTypeElement = $(".view-user-type");
        viewMessageElement = $(".view-message");
        viewDisplayDateElement = $(".view-display-date");


		userIdElement.multiselect({
            columns: 1,
            search: true,
            selectAll: true,
            placeholder: 'Select Customer',
        });


		coachIdElement.multiselect({
            columns: 1,
            search: true,
            selectAll: true,
            placeholder: 'Select Coach',
        });

        /* Add Edit Ajax Call */
        $(formAddEditForm).submit(function (event) {
            if ($(formAddEditForm).parsley().validate()) {

                event.preventDefault();

                showLoader();
                    jQuery.ajax({
                        url: window.add_edit_url,
                        method: 'post',
                        dataType: 'JSON',
                        data: {
                            '_token': window._token,
                            'unique_group_id': addEditModelIdElement.val(),
                            'description': descriptionElement.val(),
                            'display_date': displayDateElement.val(),
							'user_id': userIdElement.val(),
                            'coach_id': coachIdElement.val(),
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


        /* Send Notification */
		function sendNotification(id) {
			showLoader();
			jQuery.ajax({
                url: window.send_notification_url,
                method: 'post',
                dataType: 'JSON',
                data: {
                    '_token': window._token,
                    'id': id,
                },
                success: function (response) {
                    alert(response.message);
					hideLoader();
					if( response.status ) {
						setTimeout(function () {
							location.reload();
						}, 2000);
					}
                },
                error: function (xhr, status) {
                    alert('Issue in sending notification, Please try again later');
					hideLoader();
                }
            });
		}

        function openEditModal( modelSelector, unique_group_id, message, display_date ) {
            showLoader();
			modelTitleElement.html("Edit " + pageTitle);
			setTimeout(function(){
                openModal(modelSelector);
                hideLoader();
				descriptionElement.val(message);
				addEditModelIdElement.val(unique_group_id);
				displayDateElement.val(moment(display_date).format('MM/DD/YYYY hh:mm:00 A'));
			}, 1000);
        }
    </script>
@endsection
