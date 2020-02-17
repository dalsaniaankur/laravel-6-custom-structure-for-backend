<div class="modal add-edit-teacher-model" id="teacher_model">
    <div class="modal-dialog">

        {!! Form::open(['method' => 'POST','enctype' => 'multipart/form-data','name'=>'add-edit-teacher-model-form', 'id' =>'add_edit_teacher_model_form', 'class'=>'add-edit-form-model','data-parsley-validate']) !!}

        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body modal_success">
                <h4 class="modal-title mb-5" >Edit teacher</h4>

                <div class="col-lg-12 col-lg-12">
                    <div class="row">

                        {!! Form::hidden('id', 0, array('id' => 'add_edit_teacher_model_id')) !!}
                        {!! Form::hidden('school_id', $schoolId, array('id' => 'school_id_for_edit')) !!}

                        <div class="col-lg-6 col-md-6">
                            {!! Form::label('first_name', 'First name', ['class' => '']) !!}
                            {!! Form::text('first_name', old('first_name'), ['id' => 'first_name_for_edit', 'class' => 'form-control mb-4', 'required' => '']) !!}
                        </div>

                        <div class="col-lg-6 col-md-6">
                            {!! Form::label('last_name', 'Last name', ['class' => '']) !!}
                            {!! Form::text('last_name', old('last_name'), ['id' => 'last_name_for_edit', 'class' => 'form-control mb-4', 'required' => '']) !!}
                        </div>

                        <div class="col-lg-6 col-md-6">
                            {!! Form::label('email', 'Email', ['class' => '']) !!}
                            {!! Form::email('email', old('email'), ['id' => 'email_for_edit', 'class' => 'form-control mb-4', 'required' => '']) !!}
                        </div>

                        <div class="col-lg-6 col-md-6">
                            {!! Form::label('phone', 'Phone', ['class' => '']) !!}
                            {!! Form::text('phone', old('phone'), ['id' => 'phone_for_edit', 'class' => 'form-control mb-4', 'required' => '']) !!}
                        </div>

                        <div class="col-lg-6 col-md-6">
                            {!! Form::label('gender', 'Gender', ['class' => '']) !!}
                            {!! Form::select('gender', ['1' => 'Male','2' => 'Female'], old('gender'), ['id' => 'gender_for_edit', 'class' => 'form-control mb-4', 'required' => '']) !!}
                        </div>

                        <div class="col-lg-6 col-md-6">
                            {!! Form::label('grade_id', 'Grade') !!}
                            {!! Form::select('grade_id', $gradeDropDown, old('grade_id'), ['onchange' => "getClassDropDown(this,'#class_id_for_edit','#school_id')",'id' => 'grade_id_for_edit', 'class' => 'form-control mb-4', 'required' => '']) !!}
                        </div>

                        <div class="col-lg-6 col-md-6">
                            {!! Form::label('class_id', 'Class') !!}
                            {!! Form::select('class_id', $classesDropDown, old('class_id'), ['id' => 'class_id_for_edit', 'class' => 'form-control mb-4', 'required' => '']) !!}
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
