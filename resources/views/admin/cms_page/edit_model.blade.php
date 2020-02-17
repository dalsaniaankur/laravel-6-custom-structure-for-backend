<div class="modal add-edit-model" id="cms_page_model">
    <div class="modal-dialog">

        {!! Form::open(['method' => 'POST','enctype' => 'multipart/form-data','name'=>'add-edit-cms-page-model-form', 'id' =>'add_edit_cms_page_model_form', 'class'=>'login-form px-md-4 add-edit-form-model','data-parsley-validate']) !!}

        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body modal_success">
                <h4 class="modal-title mb-5">Edit cms page</h4>
                <div class="col-lg-12 col-lg-12">
                    <div class="row">
                        {!! Form::hidden('page_id', 0, array('id' => 'add_edit_model_id')) !!}

                        <div class="col-lg-12 col-md-12">
                            {!! Form::label('content', 'Page content', ['class' => '']) !!}
                            {!! Form::textarea('content', '', ['class' => 'mb-4 form-control popup_msghit', 'rows' => '5', 'required' => '']) !!}
                        </div>

                        <div class="clear-both"></div>
                        <div class="col-lg-12 col-md-12">
                            <label>Image</label>
                            <div id="photo-upload">
                                <div class="upload-btn-wrapper">
                                    <input type="file" style="display:none;" data-name="image-file"
                                           name="image"
                                           id="profile_photo">
                                    <button type="button" class="btn btn-orange" id="select_photo">Select Photo
                                    </button>
                                </div>
                                <span class="image-file" style="padding-left:10px;"></span>
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
