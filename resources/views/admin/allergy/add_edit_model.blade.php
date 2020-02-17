<div class="modal add-edit-model" id="allergy_model">
	<div class="modal-dialog">
		{!! Form::open(['method' => 'POST','enctype' => 'multipart/form-data','name'=>'add-edit-allergy-model-form', 'id' =>'add_edit_allergy_model_form', 'class'=>'login-form px-md-4 add-edit-form-model','data-parsley-validate']) !!}
		<div class="modal-content">
			<!-- Modal Header -->
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<!-- Modal body -->
			<div class="modal-body modal_success">
				<h4 class="modal-title mb-5">Add Allergy</h4>

				<div class="col-lg-12 col-lg-12">
					<div class="row">
						{!! Form::hidden('allergie_id', 0, array('id' => 'add_edit_model_id')) !!}
						<div class="col-lg-12 col-md-12">
							{!! Form::label('allergy_name', 'Allergy Name', ['class' => '']) !!}
							{!! Form::text('allergy_name', old('allergy_name'), ['class' => 'form-control mb-4', 'required' => '']) !!}
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

