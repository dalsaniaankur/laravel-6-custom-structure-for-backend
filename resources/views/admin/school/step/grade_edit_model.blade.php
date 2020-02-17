<div class="modal add-edit-grade-model" id="grade_model">
    <div class="modal-dialog">

        {!! Form::open(['method' => 'POST','enctype' => 'multipart/form-data','name'=>'add-edit-grade-model-form', 'id' =>'add_edit_grade_model_form', 'class'=>'add-edit-form-model','data-parsley-validate']) !!}

        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body modal_success">
                <h4 class="modal-title mb-5" >Edit grade</h4>

                <div class="col-lg-12 col-lg-12">
                    <div class="row">

                        {!! Form::hidden('id', 0, array('id' => 'add_edit_grade_model_id')) !!}
                        {!! Form::hidden('school_id', $schoolId, array('id' => 'school_id')) !!}

                        <div class="col-lg-12 col-md-12">
                            {!! Form::label('grade_name', 'Grade', ['class' => '']) !!}
                            {!! Form::text('grade_name', old('grade_name'), ['class' => 'form-control mb-4', 'required' => '']) !!}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <div class="form-edit-profilebtn saveh1">
                    {!! Form::Submit('Update', ['class' => 'btn btn_green mt-4 mb-5']) !!}
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>
