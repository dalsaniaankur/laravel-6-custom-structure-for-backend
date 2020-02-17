<div class="modal add-notification-model" id="notification_model">
    <div class="modal-dialog">

        {!! Form::open(['method' => 'POST','enctype' => 'multipart/form-data','name'=>'add-notification-model-form', 'id' =>'add_notification_model_form', 'class'=>'add-notification-form-model','data-parsley-validate']) !!}

        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body modal_success">
                <h4 class="modal-title mb-5">Add notification</h4>

                <div class="col-lg-12 col-lg-12">
                    <div class="row">

                        {!! Form::hidden('notification_id', 0, array('id' => 'add_notification_model_id')) !!}

                        <div class="col-lg-12 col-md-12">
                            {!! Form::label('type', 'Type') !!}
                            {!! Form::select('type', ['' => 'Select type','1' => 'Class','2' => 'Club'], old('type'), ['class' => 'form-control mb-4 type', 'required' => '','onchange' => "changeNotificationType()"]) !!}
                        </div>

                        <div class="col-lg-12 col-md-12 club-part display-none">
                            {!! Form::label('club_id', 'Club') !!}
                            {!! Form::select('club_id', ['' => 'Select club'], old('club_id'), ['class' => 'form-control mb-4 club_id', 'onchange' => "getUserByClub()"]) !!}
                        </div>

                        <div class="col-lg-12 col-md-12 school-part display-none">
                            {!! Form::label('school_id', 'School') !!}
                            {!! Form::select('school_id', $schoolDropDown, old('school_id'), ['class' => 'form-control mb-4 school_id', 'onchange' => "getGradeDropDown()"]) !!}
                        </div>

                        <div class="col-lg-12 col-md-12 grade-part display-none">
                            {!! Form::label('grade_id', 'Grade') !!}
                            {!! Form::select('grade_id', ['' => 'Select club'], old('grade_id'), ['class' => 'form-control mb-4 grade_id', 'onchange' => "getClassByGradeId()"]) !!}
                        </div>

                        <div class="col-lg-12 col-md-12 class-part display-none">
                            {!! Form::label('class_id', 'Class') !!}
                            {!! Form::select('class_id', ['' => 'Select class'], old('class_id'), ['class' => 'form-control mb-4 class_id', 'onchange' => "getUserByClassId()"]) !!}
                        </div>

                        <div class="col-lg-12 col-md-12 multiselect_checkbox">
                            {!! Form::label('user_id', 'User') !!}
                            {!! Form::select('user_id[]', [], old('user_id'), ['multiple'=> '', 'class' => 'form-control mb-4 user_id', 'required' => '']) !!}
                        </div>

                        <div class="col-lg-12 col-md-12">
                            {!! Form::label('description', 'Message', ['class' => '']) !!}
                            {!! Form::textarea('description', '', ['id' => 'description','class' => 'form-control mb-4 popup_msghit', 'rows' => 9]) !!}
                        </div>

                        <div class="col-lg-12 col-md-12">
                            {!! Form::label('notification_type', 'Notification Type', ['class' => '']) !!}<br>
                            {{ Form::radio('notification_type', 'instant' , false, ['id' => 'notification_type_instant']) }}
                            <label for="notification_type_instant" class="mr-2">Instant</label>
                            {{ Form::radio('notification_type', 'schedule' , true, ['id' => 'notification_type_schedule']) }}
                            <label for="notification_type_schedule">Schedule</label>
                        </div>

                        <div class="col-lg-12 col-md-12 display_date_parent mt-4">
                            {!! Form::label('display_date', 'Display Date', ['class' => '']) !!}
                            {!! Form::text('display_date', '', ['class' => 'form-control mb-4 date-field', 'data-toggle' => 'datetimepicker', 'autocomplete' => 'Off', 'data-parsley-trigger'=>'change' ]) !!}
                        </div>

                        <div class="clear-both"></div>
                    </div>
                </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <div class="form-edit-profilebtn saveh1">
                    {!! Form::Submit('Save', ['class' => 'btn btn_green mt-4 mb-5']) !!}
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>
