@extends('backend.layouts.app')
@section('title', 'Notification | '.trans('admin.backend_title'))
@section('content')
    <div class="main_section">

        <div class="container">
            <div class="page-wrap bx-shadow mt-5 mb-5">
                <div class="row user-dt-wrap">
                    <div class="col-lg-12 col-md-12 pb-5">
                        <h1 class="admin_bigheading mb-5 w_100">Dispatch notification</h1>
                        <div class="row">
                            <div class="col-md-12 col-lg-12 pb-5 px-md-5 pb0">
                                <h3 class="mb-4 admin_inner_title">Create notification</h3>

                                {!! Form::open(['method' => 'POST','enctype' => 'multipart/form-data','name'=>'admin-notification-create', 'id' =>'admin_notification_create_form', 'class'=>'notification-create-form','data-parsley-validate','route' => ['school.notification.save']]) !!}
                                @php($schoolId = Auth::guard('school')->user()->user_id)
                                {!! Form::hidden('sender_id', Auth::guard('school')->user()->user_id, array('id' => 'sender_id')) !!}

                                <div class="notification_dispatch">

                                    <div class="form-edit-profile">
                                        {!! Form::label('role_id', 'User type') !!}
                                        {!! Form::select('role_id', ['' => 'Select user type','3' => 'Teacher','4' => 'Student','5' => 'Parent'], old('role_id'), ['onchange' => "getUserDropDownBySchoolId(this,'#receiver_id',$schoolId)",'class' => 'form-control mb-4', 'required' => '']) !!}
                                    </div>

                                    <div class="form-edit-profile">
                                        {!! Form::label('club_id', 'select club') !!}
                                        {!! Form::select('club_id', $clubDropDown, '', ['class' => 'form-control mb-4', 'disabled'=>'']) !!}
                                    </div>

                                    <div class="form-edit-profile multiselect_checkbox">
                                        {!! Form::label('receiver_id', 'Selected users') !!}
										{!! Form::select('receiver_id[]', [], old('receiver_id'), ['class' => 'form-control mb-4', 'required' => '', 'multiple'=>'true', 'id'=>'receiver_id']) !!}
                                    </div>

                                    <div class="form-edit-profile">
                                        <label class="bluecolor">upload photo</label>
                                        <div id="photo-upload">
                                            <div class="upload-btn-wrapper">
                                                <input type="file" style="display:none;" data-name="user-profile-file" name="photo"
                                                       id="profile_photo">
                                                <button type="button" class="btn btn-orange" id="select_photo">Select Photo
                                                </button>
                                            </div>
                                            <span class="user-profile-file" style="padding-left:10px;"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="notification_dispatch">
                                    <div class="form-edit-profile">
                                        {!! Form::label('dispatch_time', 'Select dispatch date & time') !!}
                                        {!! Form::text('dispatch_time', '', ['id' =>'dispatch_time', 'class' => 'form-control date-field mb-4', 'placeholder' => 'Select date & time','autocomplete' => 'Off', 'data-toggle'=>'datetimepicker']) !!}
                                        <div class="form-edit-profile width100">
                                            {!! Form::label('message', 'Enter message') !!}
                                            {!! Form::textarea('message', '', ['class' => 'mb-4 form-control-text-area', 'required' => '']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="form-edit-profilebtn saveh1">
                                    {!! Form::Submit('dispatch', ['class' => 'btn btn_green save_btn_green mt-5 mt0']) !!}
                                </div>
                                {!! Form::close() !!}
                            </div>
                            <div class="clear-both"></div>
                            <div class="col-lg-12 col-md-12 mt-5 px-md-5">
                                <h3 class="mb-4 admin_inner_title">Dispatched ({{ $totalRecordCount }})</h3>

                                <div class="clear-both"></div>
                                <div class="table-responsive">
                                    <table class="table sorting data-table messages" id="classes">
                                        <thead>
                                        <tr>
                                            @php($shortClass = ( strtolower($sortedOrder) == 'asc') ? 'up' : 'down' )
                                            @php($sortDefault = '<i class="fas fa-sort"></i>')
                                            @php($sorting = '<i class="fas fa-caret-'.$shortClass.'"></i>')

                                            <th class="updownicon"
                                                onclick="sortWithSearch('notification_id');">@lang('admin.user.fields.id')
                                                {!!  $sortedBy =='notification_id' ? $sorting : $sortDefault  !!}</th>
                                            <th>TO</th>
                                            <th>DISPATCH DATE</th>
                                            <th class="msgwidth">MESSAGE</th>
                                            <th class="actionwidth">ACTION</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(!empty($notifications) && count($notifications) > 0)
                                            @foreach($notifications as $notificationKey => $notification)
                                                <tr>
                                                    <td class="data-id"><span>{{ ++$recordStart  }}</span></td>
                                                    <td>{{ $notification->receiver->name }}</td>
                                                    <td>
                                                        <b>{{ DateFacades::dateFormat($notification->created_at,'format-3') }}</b><br>
                                                        {{ DateFacades::dateFormat($notification->created_at,'time-format-1') }}
                                                    </td>
                                                    <td>{!! $notification->message  !!}</td>
                                                    <td class="action_div">
                                                        {!! Form::open(array(
                                                                'method' => 'DELETE',
                                                                 'onsubmit' => "return confirm('".trans("admin.qa_are_you_sure_delete")." notification?');",
                                                                'route' => ['school.notification.delete'])) !!}
                                                        {!! Form::hidden('id',$notification->notification_id ) !!}

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
    </div>
@endsection
@section('javascript')
    <script>
        var form = 'form#admin_notification_search_form';
		window.getUserDropDownByClubIdUrl = "{{ url('/getuserdropdownbyclubid') }}";

		clubIdElement = $("#club_id");
		roleIdElement = $("#role_id");
		receiverIdElement = $("#receiver_id");

		roleIdElement.change(function() {
			clubIdElement.attr( 'disabled', 'disabled' );
			if( $(this).val() == 3 || $(this).val() == 4 ){
				clubIdElement.removeAttr( 'disabled' );
			}
		});

        receiverIdElement.multiselect({
            columns: 1,
            search: true,
            selectAll: true,
            placeholder: 'Select user',
        });

		clubIdElement.change(function() {
			jQuery(receiverIdElement).empty().trigger('change');
			showLoader();
			if( jQuery(receiverIdElement).attr('multiple')) {
				jQuery(receiverIdElement).multiselect({
					columns: 1,
					search: true,
					selectAll: true,
					placeholder: 'Select user',
				});
			}
			jQuery.ajax({
				url: window.getUserDropDownByClubIdUrl,
				method: 'post',
				dataType: 'JSON',
				data: {
					'_token': window._token,
					'role_id': roleIdElement.val(),
					'club_id': clubIdElement.val(),
				},
				success: function (response) {
					hideLoader();
					if(response != '') {
						jQuery.each(response, function(key, value) {
							jQuery(receiverIdElement).append('<option value="'+ key +'">'+ value +'</option>');
						});
					}
					if( jQuery(receiverIdElement).attr('multiple')) {
						jQuery(receiverIdElement).multiselect('reload');
					}
					hideLoader();
				}
			});
		});
    </script>
@endsection
