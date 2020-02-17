@extends('backend.layouts.app')
@section('title', 'Profile | '.trans('admin.backend_title'))
@section('content')
    <div class="main_section">

        <div class="container n_success">
            <div class="page-wrap bx-shadow my-5 px-sm-5 ">
                <div class="row user-dt-wrap">

                    <div class="col-lg-12 col-md-12 pb-5 school_details">
                        <h1 class="big-heading mb-5">Parent ({{ $parent->name }})</h1>
                        <div class="row">
                            <div class="col-md-6 col-lg-6 pb-5 px-md-5 profile_border">
                                <h3 class="text-center mb-4 admin_inner_title">Contact details</h3>

                                <div class="row after_bottom_border">
                                    <div class="col-lg-9 user-dt">

                                        <p><span>{{ $parent->name }}</span><a
                                                    href="mailto:{{ $parent->email }}">{{ $parent->email }}</a></p>

                                        @if(!empty($parent->created_at) && $parent->created_at != '0000-00-00 00:00:00')
                                            <p class="mb-5">
                                                <span>Signed up on:</span>{{ DateFacades::dateFormat($parent->created_at,'format-3') }}
                                                <br> {{ DateFacades::dateFormat($parent->created_at,'time-format-1') }}
                                                <br/></p>
                                        @endif

                                        <p class="mb-5">
                                            <span> Account:</span> #{{ $parent->user_id }} <br>
                                        </p>

                                        <p class="mb-5">
                                            <span> Usertype:</span> Parent <br>
                                        </p>
                                    </div>
                                    <div class="col-lg-3 user-dt-img">
                                        @if ( !empty($parent->photo) && Common::isFileExists($parent->photo) )
                                            <img src="{{ url($parent->photo) }}" alt="">
                                        @else
                                            <img src="{{ url('backend/images/profile-default.png') }}" alt="">
                                        @endif
                                    </div>
                                </div>

                                <div class="user-actions-opt">
                                    {!! Form::open(array(
                            'method' => 'POST',
                            'onsubmit' => "return confirm('".($parent->status == 1 ? trans("admin.qa_are_you_sure_ban_user") : trans("admin.qa_are_you_sure_reactive_user"))."');",
                            'route' => ['teacher.parent.ban_reactive'])) !!}
                                    {!! Form::hidden('user_id', Common::getEncryptId($parent->user_id), array('id' => 'ban_user_id')) !!}
                                    {!! Form::hidden('status', ($parent->status == 1 ? 0 : 1 ), array('id' => 'status')) !!}
                                    {!! Form::submit( ($parent->status == 1 ? trans('admin.qa_ban_user'): trans('admin.qa_reactive_user') ), array('class'=>($parent->status == 1 ? 'ban_account' : 'reactive-user-btn' ))) !!}
                                    {!! Form::close() !!}


                                    {!! Form::open(array('method' => 'DELETE',
                                                        'onclick' => "return parentDelete()",
                                                        'route' => ['teacher.parent.delete'], 'id'=>'removeparent')) !!}
                                    {!! Form::hidden('id', $parent->user_id, array('id' => 'delete_user_id')) !!}
                                    {!! Form::submit( trans('admin.qa_delete_user'), array('id'=>'del-user','class' => 'ban_account delete_account' )) !!}
                                    {!! Form::close() !!}

                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 pb-5 px-md-5 label_blue pb0">
                                <h3 class="text-center mb-5 admin_inner_title">Change password</h3>
                                <div class="row after_bottom_border">
                                    <div class="col-lg-12 col-md-12">
                                        {!! Form::open(['method' => 'POST','enctype' => 'multipart/form-data','name'=>'admin-change-password-form', 'id' =>'admin_change_password_form', 'class'=>'login-form','data-parsley-validate','route' => ['teacher.parent.change_password']]) !!}

                                        {{ csrf_field() }}

                                        {!! Form::hidden('user_id', $parent->user_id, array('id' => 'change_password_user_id')) !!}

                                        {!! Form::label('password', 'New password', ['class' => '']) !!}
                                        <div class="password-box">
                                            {!! Form::password('password', ['id' => 'password', 'class' => 'form-control mb-4', 'placeholder' => 'Password', 'data-parsley-minlength' => '6', 'data-parsley-trigger'=>'keyup', 'required' => '']) !!}
                                            @include('backend.partials.message.field',['field_name' => 'password'])
                                            <span toggle="#password"
                                                  class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                        </div>

                                        {!! Form::label('Confirm Password', 'Confirm Password', ['class' => '']) !!}
                                        <div class="password-box">
                                            {!! Form::password('password_confirmation', ['id' => 'password_confirmation', 'class' => 'form-control mb-4', 'placeholder' => 'Confirm Password', 'data-parsley-equalto' => '#password', 'data-parsley-trigger'=>'keyup', 'data-parsley-minlength' => '6', 'required' => '']) !!}
                                            @include('backend.partials.message.field',['field_name' => 'password_confirmation'])
                                            <span toggle="#password_confirmation"
                                                  class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                        </div>

                                        {!! Form::Submit(trans('admin.qa_save'), ['class' => 'btn btn_green mt-1']) !!}

                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12 pb-5 px-md-5 mt-5 label_blue">
                                <div class="col-lg-6 proborder"></div>
                                <div class="col-lg-6 col-md-6 proborder_right"></div>
                                <h3 class="text-center mb-5 edittitle admin_inner_title">Edit profile</h3>

                                {!! Form::open(['method' => 'POST','enctype' => 'multipart/form-data','name'=>'admin-edit-profile-form', 'id' =>'admin_edit_profile_form', 'class'=>'login-form','data-parsley-validate','route' => ['teacher.parent.profile.save']]) !!}

                                {{ csrf_field() }}

                                {!! Form::hidden('user_id', $parent->user_id, array('id' => 'edit_profile_user_id')) !!}
                                <div class="form-edit-profile">
                                    {!! Form::label('first_name', 'First name', ['class' => '']) !!}
                                    {!! Form::text('first_name', $parent->first_name, ['class' => 'form-control mb-4', 'required' => '']) !!}

                                    @include('backend.partials.message.field',['field_name' => 'first_name'])
                                </div>
                                <div class="form-edit-profile">
                                    {!! Form::label('last_name', 'Last name', ['class' => '']) !!}
                                    {!! Form::text('last_name', $parent->last_name, ['class' => 'form-control mb-4', 'required' => '']) !!}
                                    @include('backend.partials.message.field',['field_name' => 'last_name'])
                                </div>
                                <div class="form-edit-profile">
                                    {!! Form::label('email', 'Email', ['class' => '']) !!}
                                    {!! Form::email('email', $parent->email, ['class' => 'form-control mb-4', 'required' => '']) !!}
                                    @include('backend.partials.message.field',['field_name' => 'email'])
                                </div>


                                <div class="form-edit-profile">
                                    <label>Photo</label>
                                    <div id="photo-upload">
                                        @if ( !empty($parent->photo) && Common::isFileExists($parent->photo) )
                                            <img src="{{ url($parent->photo) }}" alt="">
                                        @else
                                            <img src="{{ url('backend/images/profile-default.png') }}" alt="">
                                        @endif
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

                                <div class="form-edit-profile multiselect_checkbox">
                                    {{--
                                    {!! Form::label('student_id', 'Student') !!}
                                    {!! Form::select('student_id[]', $studentDropDown, $selectedStudent, ['id' =>'student_id', 'multiple'=> '', 'class' => 'form-control mb-4 student_id', 'required' => '']) !!}
                                    --}}
                                    <a href="{{ url('teacher/students?parent_id='.$parent->user_id) }}" class="viewbtn">View student</a>
                                </div>

                                <div class="form-edit-profilebtn saveh2">{!! Form::Submit(trans('admin.qa_save'), ['class' => 'btn btn_green save_btn_green mt-5']) !!}</div>

                                {!! Form::close() !!}
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('javascript')
    <script>

        jQuery("#student_id").multiselect({
            columns: 1,
            search: true,
            selectAll: true,
            placeholder: 'Select student',
        });

        function parentDelete() {
            var dynamicDialog = $('<div id="conformBox">' + 'Are you sure you want to delete this parent?</div>');
            dynamicDialog.dialog({
                title: "Delete parent",
                closeText: "",
                draggable: false,
                closeOnEscape: true,
                modal: true,
                minWidth: 450,
                dialogClass: 'customer-remove-dialog',
                open: function (event, ui) {
                    $('body').addClass('modal-open');
                },
                close: function (event, ui) {
                    $('body').removeClass('modal-open');
                },
                buttons:
                    [{
                        text: "Delete",
                        click: function () {
                            $(this).dialog("close");
                            parentDeleteConfirm();
                        },
                        class: 'cutomer-remove-button',
                    },
                        {
                            text: "Cancel",
                            click: function () {
                                $(this).dialog("close");
                            },
                            class: 'cutomer-remove-cancel',
                        }]
            });
            return false;
        }

        function parentDeleteConfirm() {
            var dynamicDialog2 = $('<div id="conformBox">' + 'Deleting parent is permanent and cannot be undone?</div>');
            dynamicDialog2.dialog({
                title: "Delete parent",
                closeOnEscape: true,
                modal: true,
                closeText: "",
                draggable: false,
                minWidth: 550,
                dialogClass: 'customer-remove-dialog',
                open: function (event, ui) {
                    $('body').addClass('modal-open');
                },
                close: function (event, ui) {
                    $('body').removeClass('modal-open');
                },
                buttons:
                    [{
                        text: "Delete",
                        click: function () {
                            $(this).dialog("close");
                            $('#removeparent').submit();
                        },
                        class: 'cutomer-remove-button',
                    },
                        {
                            text: "Cancel",
                            click: function () {
                                $(this).dialog("close");
                            },
                            class: 'cutomer-remove-cancel',
                        }]
            });
            return false;
        }
    </script>
@endsection
