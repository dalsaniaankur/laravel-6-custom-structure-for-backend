<div class="modal add-member-model" id="add_member_model">
    <div class="modal-dialog">

        {!! Form::open(['method' => 'POST','enctype' => 'multipart/form-data','name'=>'add-member-model-form', 'id' =>'add_member_model_form', 'class'=>'login-form px-md-4 add-edit-form-model','data-parsley-validate']) !!}

        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body modal_success">
                @if(!empty($schoolName))
                    <h4 class="modal-title mb-0" >Add member</h4>
                    <div class="mb-5">
                        <span class="is-school-in">In</span>
                        <span class="is-school-name">({{ ucfirst($clubName) }})</span>
                    </div>
                @else
                    <h4 class="modal-title mb-5" >Add Club</h4>
                @endif
				<div class="col-lg-12 col-lg-12">
					<div class="row">
                        {!! Form::hidden('club_id', $clubId, ['id' => 'club_id']) !!}
                        <div class="col-lg-6 col-md-6 multiselect_checkbox">
                            {!! Form::select('student_id[]', $studentDropDown, old('student_id'), ['id' => 'student_id', 'multiple'=> '', 'class' => 'form-control mb-3 student_id']) !!}
                        </div>
                        <div class="col-lg-6 col-md-6 multiselect_checkbox mb-4">
                            {!! Form::select('teacher_id[]', $teacherDropDown, old('teacher_id'), ['id' => 'teacher_id', 'multiple'=> '', 'class' => 'form-control mb-3 teacher_id']) !!}
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

