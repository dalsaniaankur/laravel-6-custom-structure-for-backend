<div class="modal add-edit-message-model" id="message_model">
    <div class="modal-dialog">

        {!! Form::open(['method' => 'POST','enctype' => 'multipart/form-data','name'=>'add-edit-message-model-form', 'id' =>'add_edit_message_model_form', 'class'=>'add-edit-message-form-model','data-parsley-validate']) !!}


        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body modal_success">
                <h4 class="modal-title mb-0">Add message</h4>
                <div class="mb-5">
                    <span class="is-school-in">In</span>
                    <span class="is-school-name">({{ ucfirst(Auth::guard('teacher')->user()->name) }})</span>
                </div>



                <div class="col-lg-12 col-lg-12">
                    <div class="row">

                        {!! Form::hidden('message_id', 0, array('id' => 'add_edit_message_model_id')) !!}

                        <div class="col-lg-12 col-md-12">
                            {!! Form::label('role_id', 'User Type') !!}
                            {!! Form::select('role_id', ['' => 'Select user type','1' => 'Admin','4' => 'Student','5' => 'Parent','6' => 'PTA Member'], old('role_id'), ['class' => 'form-control mb-4 role_id', 'required' => '','onchange' => "getUserDropDownBySchoolId(this,'#receiver_id',$schoolId)"]) !!}
                        </div>

                        <div class="col-lg-12 col-md-12 multiselect_checkbox">
                            {!! Form::label('receiver_id', 'Receiver') !!}
                            {!! Form::select('receiver_id[]', [], old('receiver_id'), ['multiple'=> '', 'class' => 'form-control mb-4', 'required' => '', 'id'=>'receiver_id']) !!}
                        </div>

                        <div class="col-lg-12 col-md-12">
                            {!! Form::label('message', 'Message', ['class' => '']) !!}
                            {!! Form::textarea('message', '', ['id' => 'message','class' => 'form-control mb-4 popup_msghit', 'rows' => 9, 'required' => '']) !!}
                        </div>

                        <div class="clear-both"></div>
                        <div class="col-lg-12 col-md-12">
                            <label>Attachment</label>
                            <div id="photo-upload">
                                <div class="upload-btn-wrapper">
                                    <input type="file" style="display:none;" data-name="user-profile-file"
                                           name="attachment"
                                           id="profile_photo">
                                    <button type="button" class="btn btn-orange" id="select_photo">Select Attachment
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
                    {!! Form::Submit('Send', ['class' => 'btn btn_green mt-4 mb-5']) !!}
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>
