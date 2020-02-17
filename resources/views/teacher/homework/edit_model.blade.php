<div class="modal add-edit-model" id="homework_model">
    <div class="modal-dialog">

        {!! Form::open(['method' => 'POST','enctype' => 'multipart/form-data','name'=>'add-edit-homework-model-form', 'id' =>'add_edit_homework_model_form', 'class'=>'login-form px-md-4 add-edit-form-model','data-parsley-validate']) !!}

        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body modal_success">
                <h4 class="modal-title mb-5">Add Homework</h4>

                <div class="col-lg-12 col-lg-12">
                    <div class="row">
                        {!! Form::hidden('homework_id', 0, array('id' => 'add_edit_model_id')) !!}

						<div class="col-lg-12 col-md-12 mb-4">
                            {!! Form::label('homework_date', 'Date') !!}
                            {!! Form::text('homework_date', '', ['class'=>"form-control", 'id' => 'homework_date', 'required' => '', 'data-toggle' => "datepicker"]) !!}
                        </div>

                        <div class="col-lg-12 col-md-12">
                            {!! Form::label('content', 'Homework', ['class' => '']) !!}
                            {!! Form::textarea('content', old('content'), ['id'=>'homework_content', 'class' => 'form-control mb-4 text-area', 'required' => '']) !!}
                        </div>

						<div class="col-lg-12 col-md-12">
                            <label>Photo</label>
                            <div id="photo-upload">
								<img src="" class="d-none" id="homework-image">
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
                    {!! Form::Submit(trans('admin.qa_save'), ['class' => 'btn btn_green mt-4 mb-5']) !!}
                </div>
            </div>

        </div>

        {!! Form::close() !!}
    </div>
</div>

