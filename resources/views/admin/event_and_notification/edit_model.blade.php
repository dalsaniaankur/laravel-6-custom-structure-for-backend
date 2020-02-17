<div class="modal add-edit-model" id="event_and_notification_model">
    <div class="modal-dialog">

        {!! Form::open(['method' => 'POST','enctype' => 'multipart/form-data','name'=>'add-edit-event-model-form', 'id' =>'add_edit_event_model_form', 'class'=>'login-form px-md-4 add-edit-form-model','data-parsley-validate']) !!}

        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body modal_success">
                <h4 class="modal-title mb-5">Edit Event & Notice</h4>
                <div class="col-lg-12 col-lg-12">
                    <div class="row">
                        {!! Form::hidden('event_and_notification_id', 0, array('id' => 'add_edit_model_id')) !!}

                        <div class="col-lg-12 col-md-12">
                            {!! Form::label('notification_type', 'Notification type') !!}
                            {!! Form::select('notification_type', $notificationTypeDropDown, old('notification_type'), ['id' => 'notification_type_edit', 'class' => 'form-control mb-4', 'required' => '']) !!}
                        </div>

                        <div class="col-lg-12 col-md-12">
                            {!! Form::label('title', 'Title') !!}
                            {!! Form::text('title', old('title'), ['id' => 'title_edit', 'class' => 'form-control mb-4', 'required' => '']) !!}
                        </div>

						<div class="col-lg-12 col-md-12">
                            {!! Form::label('description', 'Description', ['class' => '']) !!}
                            {!! Form::textarea('description', old('description'), ['id' => 'description_edit', 'class' => 'form-control mb-4 text-area', 'required' => '']) !!}
                        </div>

						<div class="col-lg-6 col-md-6">
                            {!! Form::label('event_date', 'Event date') !!}
                            {!! Form::text('event_date', old('event_date'), ['id' => 'event_date_edit', 'class' => 'form-control date-field mb-4', 'autocomplete' => 'Off', 'data-toggle'=>'datepicker', 'required' => '']) !!}
						</div>

                        <div class="col-lg-6 col-md-6">
                            {!! Form::label('status', 'Status') !!}
                            {!! Form::select('status', ['' => 'Status','1' => 'Active','0' => 'Inactive'], old('status'), ['id' => 'status_edit', 'class' => 'form-control mb-4', 'required' => '']) !!}
                        </div>

						<div class="col-lg-6 col-md-6">
                            {!! Form::label('start_time', 'Start time') !!}
                            {!! Form::text('start_time', old('start_time'), ['id' => 'start_time_edit', 'class' => 'form-control mb-4', 'autocomplete' => 'Off', 'required' => '']) !!}
						</div>

						<div class="col-lg-6 col-md-6">
                            {!! Form::label('end_time', 'End time') !!}
                            {!! Form::text('end_time', old('end_time'), ['id' => 'end_time_edit', 'class' => 'form-control mb-4', 'autocomplete' => 'Off', 'required' => '']) !!}
                        </div>

						<div class="clear-both"></div>
                        <div class="col-lg-12 col-md-12">
                            <label>Photo</label>
                            <div id="photo-upload">
                                <div class="upload-btn-wrapper">
									<img src="" id="event_image" class="d-none" data-url="{{ url('/') }}">
                                    <input type="file" style="display:none;" data-name="notification-profile-file"
                                           name="photo"
                                           id="notification_photo">
                                    <button type="button" class="btn btn-orange" id="select_notification_photo">Select Photo
                                    </button>
                                </div>
                                <span class="notification-profile-file" style="padding-left:10px;"></span>
                            </div>
                        </div>
					 </div>
				</div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <div class="form-edit-profilebtn saveh1">
                    {!! Form::Submit(trans('admin.qa_save'), ['class' => 'btn btn_green mt-4 mb-5']) !!}
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>
</div>
