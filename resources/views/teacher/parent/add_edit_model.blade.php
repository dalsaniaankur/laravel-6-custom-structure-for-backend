<div class="modal add-edit-parent-model" id="parent_model">
    <div class="modal-dialog">

        {!! Form::open(['method' => 'POST','enctype' => 'multipart/form-data','name'=>'add-edit-parent-model-form', 'id' =>'add_edit_parent_model_form', 'class'=>'add-edit-parent-form-model','data-parsley-validate']) !!}

        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body modal_success">
                <h4 class="modal-title mb-0" >Add parent</h4>
                <div class="mb-5">
                    <span class="is-school-in">In</span>
                    <span class="is-school-name">({{ ucfirst(Auth::guard('teacher')->user()->school->school_name) }})</span>
                </div>



                <div class="col-lg-12 col-lg-12">
                    <div class="row">

                        {!! Form::hidden('user_id', 0, array('id' => 'add_edit_parent_model_id')) !!}

                        <div class="col-lg-6 col-md-6 multiselect_checkbox">
                            {!! Form::label('student_id', 'Student') !!}
                            {!! Form::select('student_id[]', $studentDropDown, old('student_id'), ['id' =>'student_id', 'multiple'=> '', 'class' => 'form-control mb-4 student_id', 'required' => '']) !!}
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

                        <div class="col-lg-6 col-md-6 display-none">
                            {!! Form::label('country_id', 'Country') !!}
                            {!! Form::select('country_id', $countryDropDown, 1, ['onchange' => "getStateDropDown(this,'#state_id')",'class' => 'form-control mb-4', 'required' => '']) !!}
                        </div>

                        <div class="col-lg-6 col-md-6">
                            {!! Form::label('state_id', 'State') !!}
                            {!! Form::select('state_id', $stateDropDown, old('state_id'), ['onchange' => "getCityDropDown(this,'#city_id')",'class' => 'form-control mb-4', 'required' => '']) !!}
                        </div>

                        <div class="col-lg-6 col-md-6">
                            {!! Form::label('city_id', 'City') !!}
                            {!! Form::select('city_id', ['' => 'Select city'], old('city_id'), ['class' => 'form-control mb-4', 'required' => '']) !!}
                        </div>

                        <div class="col-lg-6 col-md-6">
                            {!! Form::label('gender', 'Gender') !!}
                            {!! Form::select('gender', ['1' => 'Male','2' => 'Female'], old('gender'), ['class' => 'form-control mb-4', 'required' => '']) !!}
                        </div>


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
