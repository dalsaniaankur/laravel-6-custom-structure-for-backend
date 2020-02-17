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
                @if(!empty($schoolName))
                    <h4 class="modal-title mb-0" >Add student</h4>
                    <div class="mb-5">
                        <span class="is-school-in">In</span>
                        <span class="is-school-name">({{ ucfirst($schoolName) }})</span>
                    </div>
                @else
                    <h4 class="modal-title mb-5" >Add student</h4>
                @endif

                <div class="col-lg-12 col-lg-12">
                    <div class="row">

                        {!! Form::hidden('user_id', 0, array('id' => 'add_edit_student_model_id')) !!}

                        <div class="col-lg-6 col-md-6">
                            {!! Form::label('parent_id', 'Parent') !!}
                            {!! Form::select('parent_id', $parentDropDown, old('parent_id'), ['class' => 'form-control mb-4', 'required' => '']) !!}
                        </div>

                        <div class="col-lg-6 col-md-6">
                            {!! Form::label('first_name', 'First name') !!}
                            {!! Form::text('first_name', old('first_name'), ['class' => 'form-control mb-4', 'required' => '']) !!}
                        </div>
                        <div class="col-lg-6 col-md-6">
                            {!! Form::label('last_name', 'Last name') !!}
                            {!! Form::text('last_name', old('last_name'), ['class' => 'form-control mb-4', 'required' => '']) !!}
                            @include('backend.partials.message.field',['field_name' => 'last_name'])
                        </div>
                        <div class="col-lg-6 col-md-6">
                            {!! Form::label('email', 'Email') !!}
                            {!! Form::email('email', old('email'), ['class' => 'form-control mb-4', 'required' => '']) !!}
                            @include('backend.partials.message.field',['field_name' => 'email'])
                        </div>
                        <div class="col-lg-6 col-md-6">
                            {!! Form::label('phone', 'Phone') !!}
                            {!! Form::text('phone', old('phone'), ['class' => 'form-control mb-4', 'required' => '']) !!}
                            @include('backend.partials.message.field',['field_name' => 'phone'])
                        </div>
                        <div class="col-lg-6 col-md-6">
                            {!! Form::label('gender', 'Gender') !!}
                            {!! Form::select('gender', ['1' => 'Male','2' => 'Female'], old('gender'), ['class' => 'form-control mb-4', 'required' => '']) !!}
                        </div>
						@if( $schoolId > 0 )
							{!! Form::hidden('school_id', $schoolId,  ['class' => 'form-control mb-3', 'id'=>'school_id']) !!}
						@else
							<div class="col-lg-6 col-md-6">
								{!! Form::label('school_id', 'School') !!}
								{!! Form::select('school_id', $schoolDropDown, old('school_id'), ['onchange' => "getGradeDropDown(this,'#grade_id')",'class' => 'form-control mb-4', 'required' => '']) !!}
							</div>
						@endif
                        <div class="col-lg-6 col-md-6">
                            {!! Form::label('grade_id', 'Grade') !!}
                            {!! Form::select('grade_id', $gradeDropDown, old('grade_id'), ['onchange' => "getClassDropDown(this,'#class_id','#school_id')",'class' => 'form-control mb-4', 'required' => '']) !!}
                        </div>
                        <div class="col-lg-6 col-md-6">
                            {!! Form::label('class_id', 'Class') !!}
                            {!! Form::select('class_id', $classesDropDown, old('class_id'), ['class' => 'form-control mb-4', 'required' => '']) !!}
                        </div>
                        <!-- <div class="col-lg-6 col-md-6">
                            {!! Form::label('club_id', 'Club') !!}
                            {!! Form::select('club_id', $clubDropDownForAddEdit, old('club_id'), ['class' => 'form-control mb-4', 'required' => '']) !!}
                        </div> -->

                        <div class="clear-both"></div>
                        <div class="col-lg-12 col-md-12">
                            <label>Photo</label>
                            <div id="photo-upload">
                                <div class="upload-btn-wrapper">
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
