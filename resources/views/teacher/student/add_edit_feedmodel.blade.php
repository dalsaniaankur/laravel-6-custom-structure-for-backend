<div class="modal add-edit-feed-model" id="feed_model">
    <div class="modal-dialog">

        {!! Form::open(['method' => 'POST','enctype' => 'multipart/form-data','name'=>'add-edit-feed-model-form', 'id' =>'add_edit_feed_model_form', 'class'=>'add-edit-feed-form-model','data-parsley-validate']) !!}

        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body modal_success">
                <h4 class="modal-title mb-5">Add Activity <span class="activity-date"></span></h4>



                <div class="col-lg-12 col-lg-12">
                    <div class="row">

                        {!! Form::hidden('student_feed_id', 0, array('id' => 'add_edit_model_id')) !!}
                        {!! Form::hidden('user_id', $studentId, array('id' => 'user_id')) !!}

						<div class="col-lg-12 col-md-12 mb-4">
                            {!! Form::label('feed_date', 'Date') !!}
							{!! Form::text('feed_date', '', ['class'=>"form-control", 'id' => 'feed_date', 'required' => '', 'data-toggle' => "datepicker"]) !!}
						</div>

                        <div class="col-lg-12 col-md-12 mb-4">
                            {!! Form::radio('attendance', 1 , true,['id' => 'present']) !!}
                            {!! Form::label('present', 'Present') !!}

                            {!! Form::radio('attendance', 2 , false,['id' => 'absent']) !!}
                            {!! Form::label('absent', 'Absent') !!}

                            {!! Form::radio('attendance', 3 , false,['id' => 'absent_with_request']) !!}
                            {!! Form::label('absent_with_request', 'Absent with request') !!}
                        </div>

                        <div class="col-lg-12 col-md-12 mb-4">
                            {!! Form::label('general', 'General') !!}
                            {!! Form::textarea('general', '', ['class'=>"form-control tinymce-for-feed", 'id' => 'general',  'cols'=>'50', 'rows'=>'5']) !!}
                        </div>

						<div class="col-lg-12 col-md-12 mb-4">
                            {!! Form::label('behavior', 'Behaviour') !!}
                            {!! Form::textarea('behavior', '', ['class'=>"form-control tinymce-for-feed", 'id' => 'behavior',  'cols'=>'50', 'rows'=>'5']) !!}
                        </div>

						<div class="col-lg-12 col-md-12 mb-4">
                            {!! Form::label('food', 'Food') !!}
                            {!! Form::textarea('food', '', ['class'=>"form-control tinymce-for-feed", 'id' => 'food', 'cols'=>'50', 'rows'=>'5']) !!}
                        </div>

						<div class="col-lg-12 col-md-12 mb-4">
                            {!! Form::label('health_medical', 'Health & Medical') !!}
                            {!! Form::textarea('health_medical', '', ['class'=>"form-control tinymce-for-feed", 'id' => 'health_medical',  'cols'=>'50', 'rows'=>'5']) !!}
                        </div>

						<div class="col-lg-12 col-md-12 mb-4">
                            {!! Form::label('extra_curricular', 'Extra curricular') !!}
                            {!! Form::textarea('extra_curricular', '', ['class'=>"form-control tinymce-for-feed", 'id' => 'extra_curricular', 'cols'=>'50', 'rows'=>'5']) !!}
                        </div>

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
