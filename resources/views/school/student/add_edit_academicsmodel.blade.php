<div class="modal add-edit-academic-model" id="academic_model">
    <div class="modal-dialog">
        {!! Form::open(['method' => 'POST','enctype' => 'multipart/form-data','name'=>'add-edit-academic-model-form', 'id' =>'add_edit_academic_model_form', 'class'=>'add-edit-academic-form-model','data-parsley-validate']) !!}
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body modal_success">
                <h4 class="modal-title mb-5">New Exam/Test <span class="activity-date"></span></h4>
                <div class="academic_scroll">
                <div class="col-lg-12 col-lg-12">
                    <div class="row">
                        {!! Form::hidden('user_id', $studentId, array('id' => 'user_id')) !!}
						{!! Form::hidden('add_edit_model_id', 0, array('id' => 'add_edit_model_id')) !!}
						<div class="col-lg-12 col-md-12 mb-4">
                            {!! Form::label('exam_id', 'Exam Name') !!}
							{!! Form::select('exam_id', $examsList, '', ['class'=>"form-control mb-3", 'id' => 'exam_id', 'required' => '']) !!}
						</div>

                        <div class="col-lg-12 col-md-12 mb-4">
                            {!! Form::label('exam_date', 'Date') !!}
                            {!! Form::text('exam_date', '', ['class'=>"form-control", 'id' => 'exam_date', 'required' => '', 'data-toggle' => "datepicker"]) !!}
                        </div>
					</div>

						<div class="row add_exam_subject_original exam_subject_list">
							<div class="col-lg-6 col-md-6">
								{!! Form::label('subject', 'Subject') !!}
								{!! Form::text('subject[]', '', ['class'=>"form-control mb-4 subject", 'required' => '']) !!}
							</div>

							<div class="col-lg-6 col-md-6">
								{!! Form::label('percent', 'Percent score') !!}
								{!! Form::text('percent[]', '', ['class'=>"form-control mb-4 percent digitonly", 'required' => '']) !!}
						   </div>
					   </div>

					   <div class="add_exam_subject_clone">

					   </div>
					   <a href="javascript:void(0);" class="newsub float-left" id="add_exam_subject">New Subject<i class="fas fa-plus"></i></a>
                    </div>

					<div class="form-edit-profilebtn saveh3 mt-3 addbtn">
						<input class="btn btn_green mt-1" type="button" value="Add" id="add_exam_sujects">
					</div>

					<div class="sub_testlist">
                    	<div class="table-responsive EMT_table">
                                    <table class="table sorting data-table">
                                        <tbody class="exam_lists">
                                       </tbody>
                                    </table>
                                </div>
                    </div>
                    </div>
                </div>

					<!-- Modal footer -->
				<div class="modal-footer">
					<div class="form-edit-profilebtn saveh1">
						{!! Form::Submit('Save Exam', ['class' => 'btn btn_green mt-4 mb-5']) !!}
					</div>
				</div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>
