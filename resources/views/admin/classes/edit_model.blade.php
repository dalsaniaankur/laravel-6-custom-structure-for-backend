<div class="modal add-edit-model" id="class_model">
  <div class="modal-dialog">
		{!! Form::open(['method' => 'POST','enctype' => 'multipart/form-data','name'=>'add-edit-class-model-form', 'id' =>'add_edit_class_model_form', 'class'=>'login-form px-md-4 add-edit-form-model','data-parsley-validate']) !!}
			<div class="modal-content">
				<!-- Modal Header -->
				<div class="modal-header"><button type="button" class="close" data-dismiss="modal">&times;</button></div>

				<!-- Modal body -->
				<div class="modal-body modal_success">
					@if(!empty($schoolName))
						<h4 class="modal-title mb-0" >Add class</h4>
						<div class="mb-5">
							<span class="is-school-in">In</span>
							<span class="is-school-name">({{ ucfirst($schoolName) }})</span>
						</div>
					@else
						<h4 class="modal-title mb-5" >Add Class</h4>
					@endif

					<div class="col-lg-12 col-lg-12">
						<div class="row">
							{!! Form::hidden('id', 0, array('id' => 'add_edit_model_id')) !!}
							@if( $schoolId > 0 )
								{!! Form::hidden('school_id', $schoolId,  ['class' => 'form-control mb-3', 'id'=>'school_id']) !!}
							@else
							<div class="col-lg-6 col-md-6">
								{!! Form::label('school_name', 'School Name', ['class' => '']) !!}
								{!! Form::select('school_id', $schoolDropDownList, '', ['class' => 'form-control mb-3', 'id'=>'school_id']) !!}
							</div>
							@endif
							<div class="col-lg-6 col-md-6">
								{!! Form::label('grade_id', 'Grade', ['class' => '']) !!}
								{!! Form::select('grade_id', $gradeDropDownList, '', ['class' => 'form-control mb-3', 'id'=>'grade_id']) !!}
							</div>
							<div class="col-lg-6 col-md-6">
								{!! Form::label('class_name', 'Class name', ['class' => '']) !!}
								{!! Form::text('class_name', '', ['class' => 'form-control mb-4', 'required' => '', 'id'=>'class_name']) !!}
							</div>
							<div class="col-lg-6 col-md-6">
								{!! Form::label('status', 'Status', ['class' => '']) !!}
								{!! Form::select('status', $statusDropDownOption, '', ['class' => 'form-control mb-3', 'id'=>'status', 'required' => '']) !!}
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

