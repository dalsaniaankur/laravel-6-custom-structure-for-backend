<div class="modal view-message-model" id="view_message_model">
    <div class="modal-dialog">

        {!! Form::open(['method' => 'POST','enctype' => 'multipart/form-data','name'=>'send-message-model-form', 'id' =>'send_message_model_form', 'class'=>'send-message-form-model','data-parsley-validate']) !!}

        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body modal_success">
                <h4 class="modal-title mb-5">Message</h4>

                <div class="col-lg-12 col-lg-12">

                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="view_message">
                                <div class="col-md-12">
                                    <h4 class="user-name">John Sanders</h4>
                                    <div class="received-message">
                                        <div class="texts">
                                            <div>Lorem Ipsum is simply dummy text of the printing and typesetting
                                                industry. Lorem Ipsum has been the industry's standard dummy text ever
                                                since the 1500s,
                                            </div>
                                            <span class="time_date">Aug 01, 2019 ( 06:39:32 AM )</span>
                                        </div>
                                        <div class="images">
                                            <img src="{{ url('backend/images/notification/jellyfish_1562932565.jpg') }}"/>
                                            <span class="time_date">Aug 01, 2019 ( 06:39:32 AM )</span>
                                        </div>
                                        <div class="title_images">
                                            <div class="img_layout">
                                                <h4>Images one</h4>
                                                <img src="{{ url('backend/images/notification/jellyfish_1562932565.jpg') }}"/>
                                            </div>
                                            <span class="time_date">Aug 01, 2019 ( 06:39:32 AM )</span>
                                        </div>
                                    </div>
                                    <div class="sent-message">
                                        <div class="texts">
                                            <div>Admin recived</div>
                                            <span class="time_date">Aug 01, 2019 ( 09:27:14 AM )</span>
                                        </div>

                                        <div class="images">
                                            <img src="{{ url('backend/images/notification/jellyfish_1562932565.jpg') }}"/>
                                            <span class="time_date">Aug 01, 2019 ( 06:39:32 AM )</span>
                                        </div>
                                        <div class="title_images">
                                            <div class="img_layout">
                                                <h4>Images one</h4>
                                                <img src="{{ url('backend/images/notification/jellyfish_1562932565.jpg') }}"/>
                                            </div>
                                            <span class="time_date">Aug 01, 2019 ( 06:39:32 AM )</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {!! Form::hidden('receiver_id[]', '', array('id' => 'receiver_id_message_model')) !!}
                            {!! Form::hidden('sender_id', '', array('id' => 'sender_id_message_model')) !!}
                            <div class="clear-both"></div>
                            <div class="col-lg-12 col-md-12">
                                {!! Form::label('message', 'Message', ['class' => '']) !!}
                                {!! Form::textarea('message', '', ['id' => 'message','class' => 'form-control mb-4 popup_msghit', 'rows' => 9]) !!}
                            </div>

                            <div class="clear-both"></div>
                            <div class="col-lg-12 col-md-12">
                                <label>Attachment</label>
                                <div id="photo-upload">
                                    <div class="upload-btn-wrapper">
                                        <input type="file" style="display:none;" data-name="send-message-attachment"
                                               name="attachment"
                                               id="attachment_file">
                                        <button type="button" class="btn btn-orange" id="select_attachment">Select
                                            Attachment
                                        </button>
                                    </div>
                                    <span class="send-message-attachment" style="padding-left:10px;"></span>
                                </div>
                            </div>
                            {!! Form::Submit('Reply', ['class' => 'btn btn_green mt-4 mb-5']) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
</div>
