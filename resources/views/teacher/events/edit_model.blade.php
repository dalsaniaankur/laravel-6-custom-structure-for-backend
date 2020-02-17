<div class="modal add-edit-model" id="event_model">
    <div class="modal-dialog">

        {!! Form::open(['method' => 'POST','enctype' => 'multipart/form-data','name'=>'add-edit-event-model-form', 'id' =>'add_edit_event_model_form', 'class'=>'login-form px-md-4 add-edit-form-model','data-parsley-validate']) !!}

        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body modal_success">
                <h4 class="modal-title mb-5">Add Event</h4>

                <div class="col-lg-12 col-lg-12">
                    <div class="row">
                        {!! Form::hidden('event_id', 0, array('id' => 'add_edit_model_id')) !!}

                        <div class="col-lg-12 col-md-12">
                            {!! Form::label('event_title', 'Event Title', ['class' => '']) !!}
                            {!! Form::text('event_title', old('event_title'), ['class' => 'form-control mb-4', 'required' => '']) !!}
                        </div>

						<div class="col-lg-12 col-md-12">
                            {!! Form::label('description', 'Description', ['class' => '']) !!}
                            {!! Form::textarea('description', old('description'), ['class' => 'form-control mb-4 text-area', 'required' => '']) !!}
                        </div>

						<div class="col-lg-6 col-md-6">
							{!! Form::label('start_date', 'Event start date') !!}
							{!! Form::text('start_date', old('start_date'), ['id' =>'event_start_date', 'class' => 'form-control date-field mb-3', 'placeholder' => 'Event Start Date','autocomplete' => 'Off', 'data-toggle'=>'datepicker', 'required' => '']) !!}
						</div>

						<div class="col-lg-6 col-md-6">
							{!! Form::label('end_date', 'Event end date') !!}
							{!! Form::text('end_date', old('end_date'), ['id' =>'event_end_date', 'class' => 'form-control date-field mb-3', 'placeholder' => 'Event End Date','autocomplete' => 'Off', 'data-toggle'=>'datepicker', 'required' => '']) !!}
						</div>

						<div class="col-lg-6 col-md-6">
							{!! Form::label('start_time', 'Event start time') !!}
							{!! Form::text('start_time', old('start_time'), ['id' =>'event_start_time', 'class' => 'form-control mb-3', 'placeholder' => 'Event Start Time', 'data-toggle' => 'timepicker', 'required' => '']) !!}
                        </div>

						<div class="col-lg-6 col-md-6">
							{!! Form::label('end_time', 'Event end time') !!}
							{!! Form::text('end_time', old('end_time'), ['id' =>'event_end_time','class' => 'form-control mb-3', 'placeholder' => 'Event End Time', 'data-toggle' => 'timepicker', 'required' => '']) !!}
                        </div>

						<div class="clear-both"></div>
                        <div class="col-lg-12 col-md-12">
                            <label>Photo</label>
                            <div id="photo-upload">
                                <div class="upload-btn-wrapper">
									<img src="" id="event_image" class="d-none" data-url="{{ url('/') }}">
                                    <input type="file" style="display:none;" data-name="user-profile-file"
                                           name="photo"
                                           id="profile_photo">
                                    <button type="button" class="btn btn-orange" id="select_photo">Select Photo
                                    </button>
                                </div>
                                <span class="user-profile-file" style="padding-left:10px;"></span>
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

