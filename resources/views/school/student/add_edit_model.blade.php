<div class="modal add-edit-student-model" id="student_model">
    <div class="modal-dialog">

        {!! Form::open(['method' => 'POST','enctype' => 'multipart/form-data','name'=>'add-edit-student-model-form', 'id' =>'add_edit_student_model_form', 'class'=>'add-edit-student-form-model','data-parsley-validate']) !!}

        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body modal_success">
                <h4 class="modal-title mb-0" >Add student</h4>
                <div class="mb-5">
                    <span class="is-school-in">In</span>
                    <span class="is-school-name">({{ ucfirst(Auth::guard('school')->user()->school_name) }})</span>
                </div>
                <div class="col-lg-12 col-lg-12">
                    <div class="row">

                        {!! Form::hidden('user_id', 0, array('id' => 'add_edit_student_model_id')) !!}
                        {!! Form::hidden('school_id', $schoolId,  ['class' => 'form-control mb-3', 'id'=>'school_id']) !!}

                        <div class="col-lg-6 col-md-6">
                            @include('backend.partials.form_field.generate_label',['f_name' =>'Parent','f_for' => 'parent_id'])
                            @include('backend.partials.form_field.generate_drop_down_box',['f_name' =>'parent_id','f_value' => '','f_option'=> $parentDropDown,'f_class' => 'mb-4','f_extra' => ['id'=>'parent_id', 'required' => '', 'data-field-label' => 'Parent']])
                        </div>
                        <div class="col-lg-6 col-md-6">
                            @include('backend.partials.form_field.generate_label',['f_name' =>'First name','f_for' => 'first_name'])
                            @include('backend.partials.form_field.generate_text_box',['f_name' =>'first_name','f_value' => '','f_class' => 'mb-4','f_extra' => ['id'=>'first_name', 'required' => '', 'data-field-label' => 'First name']])
                        </div>
                        <div class="col-lg-6 col-md-6">
                            @include('backend.partials.form_field.generate_label',['f_name' =>'Last name','f_for' => 'last_name'])
                            @include('backend.partials.form_field.generate_text_box',['f_name' =>'last_name','f_value' => '','f_class' => 'mb-4','f_extra' => ['id'=>'last_name', 'required' => '', 'data-field-label' => 'Last name']])
                        </div>
                        <div class="col-lg-6 col-md-6">
                            @include('backend.partials.form_field.generate_label',['f_name' =>'Email','f_for' => 'email'])
                            @include('backend.partials.form_field.generate_email_box',['f_name' =>'email','f_value' => '','f_class' => 'mb-4','f_extra' => ['id'=>'email', 'required' => '', 'data-field-label' => 'Email']])
                        </div>
                        <div class="col-lg-6 col-md-6">
                            @include('backend.partials.form_field.generate_label',['f_name' =>'Phone','f_for' => 'phone'])
                            @include('backend.partials.form_field.generate_text_box',['f_name' =>'phone','f_value' => '','f_class' => 'mb-4','f_extra' => ['id'=>'phone', 'required' => '', 'data-field-label' => 'Phone']])
                        </div>
                        <div class="col-lg-6 col-md-6">
                            @include('backend.partials.form_field.generate_label',['f_name' =>'Gender','f_for' => 'gender'])
                            @include('backend.partials.form_field.generate_drop_down_box',['f_name' =>'gender','f_value' => '','f_option'=> ['1' => 'Male','2' => 'Female'],'f_class' => 'mb-4','f_extra' => ['id'=>'gender_id', 'required' => '', 'data-field-label' => 'Gender']])
                        </div>

                        <div class="col-lg-6 col-md-6">
                            @include('backend.partials.form_field.generate_label',['f_name' =>'Grade','f_for' => 'grade_id'])
                            @include('backend.partials.form_field.generate_drop_down_box',['f_name' =>'grade_id','f_value' => '','f_option'=> $gradeDropDown,'f_class' => 'mb-4','f_extra' => ['onchange' => "getClassDropDown(this,'#class_id','#school_id')",'id'=>'grade_id', 'required' => '', 'data-field-label' => 'Grade']])
                        </div>
                        <div class="col-lg-6 col-md-6">
                            @include('backend.partials.form_field.generate_label',['f_name' =>'Class','f_for' => 'class_id'])
                            @include('backend.partials.form_field.generate_drop_down_box',['f_name' =>'class_id','f_value' => '','f_option'=> $classesDropDown,'f_class' => 'mb-4','f_extra' => ['id'=>'class_id', 'required' => '', 'data-field-label' => 'Class']])
                        </div>
                        <!-- <div class="col-lg-6 col-md-6">
                            @include('backend.partials.form_field.generate_label',['f_name' =>'Club','f_for' => 'club_id'])
                            {!! Form::select('club_id', $clubDropDownForAddEdit, old('club_id'), ['class' => 'form-control mb-4', 'required' => '']) !!}
                        </div> -->

                        <div class="clear-both"></div>
                        <div class="col-lg-12 col-md-12">
                            <label>Photo</label>
                            <div id="photo-upload">
                                <div class="upload-btn-wrapper">
                                    <input type="file" style="display:none;" data-name="user-profile-file" name="photo" id="profile_photo">
                                    <button type="button" class="btn btn-orange" id="select_photo">Select Photo</button>
                                </div>
                                <span class="user-profile-file" style="padding-left:10px;"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <div class="form-edit-profilebtn saveh1">
                    @include('backend.partials.form_field.generate_submit_button',['f_name' => 'Save','f_class' => 'mt-4 mb-5'])
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>
