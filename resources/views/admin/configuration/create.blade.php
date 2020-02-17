@extends('backend.layouts.app')
@section('title', 'Settings | '.trans('admin.backend_title'))
@section('content')
    <main>
        <div class="main_section">
            <div class="container">

                <div class="page-wrap bx-shadow my-5 px-sm-5">

                    <h1 class="big-heading mb-5">Settings</h1>

                    <div class="row user-dt-wrap">

                        <div class="col-lg-12 pb-5 px-md-5">

                            <ul class="nav nav-tabs">
                                <li class="nav-item"><a class="nav-link {{ $currentTab =='general' ? 'active' : '' }}"
                                                        href="#general" data-toggle="tab">General</a></li>
                                <li class="nav-item"><a class="nav-link {{ $currentTab =='mailjet' ? 'active' : '' }}"
                                                        href="#mailjet" data-toggle="tab">Mailjet</a></li>
                                <li class="nav-item"><a class="nav-link {{ $currentTab =='social' ? 'active' : '' }}"
                                                        href="#social" data-toggle="tab">Social</a></li>
                                <li class="nav-item"><a class="nav-link {{ $currentTab =='allergies' ? 'active' : '' }}"
                                                        href="#allergies" data-toggle="tab">Allergies</a></li>
                                <li class="nav-item"><a
                                        class="nav-link {{ $currentTab =='school_level' ? 'active' : '' }}"
                                        href="#school_level" data-toggle="tab">School levels</a></li>
                            </ul>

                            <div class="tab-content">
                                <div class="tab-pane mt-4 {{ $currentTab=='general' ? 'active' : '' }}" id="general">
                                    {!! Form::open(['method' => 'POST','enctype' => 'multipart/form-data','name'=>'customer-edit-profile-form', 'id' =>'customer_edit_profile_form', 'class'=>'login-form px-md-4','data-parsley-validate','route' => ['admin.setting.save']]) !!}

                                    {{ csrf_field() }}
                                    @if(count($configurationList)>0)
                                        @foreach($configurationList as $key=>$value)
                                            @if( $value['group_type'] == 1 )
                                                <div class="form-edit-profile">
                                                    {!! Form::label($key,$value['label'], ['class' => '']) !!}
                                                    {!! Form::text($value['key'], $value['value'], ['class' => 'form-control mb-4', 'placeholder' => '']) !!}
                                                    @include('backend.partials.message.field',['field_name' => $value['key']])
                                                </div>
                                            @endif
                                        @endforeach
                                    @endif
                                    {!! Form::hidden( 'currenttab', 'general' ) !!}
                                    <div class="form-edit-profilebtn saveh1">
                                        {!! Form::Submit(trans('admin.qa_save'), ['class' => 'btn btn_green mt-4']) !!}
                                    </div>
                                    {!! Form::close() !!}
                                </div>

                                <div class="tab-pane mt-4 {{ $currentTab=='mailjet' ? 'active' : '' }}" id="mailjet">
                                    {!! Form::open(['method' => 'POST','enctype' => 'multipart/form-data','name'=>'customer-edit-profile-form', 'id' =>'customer_edit_profile_form', 'class'=>'login-form px-md-4','data-parsley-validate','route' => ['admin.setting.save']]) !!}

                                    {{ csrf_field() }}
                                    @if(count($configurationList)>0)
                                        @foreach($configurationList as $key=>$value)
                                            @if( $value['group_type'] == 2 )
                                                <div class="form-edit-profile">
                                                    {!! Form::label($key,$value['label'], ['class' => '']) !!}
                                                    {!! Form::text($value['key'], $value['value'], ['class' => 'form-control mb-4', 'placeholder' => '']) !!}
                                                    @include('backend.partials.message.field',['field_name' => $value['key']])
                                                </div>
                                            @endif
                                        @endforeach
                                    @endif
                                    {!! Form::hidden( 'currenttab', 'mailjet' ) !!}
                                    <div class="form-edit-profilebtn saveh1">
                                        {!! Form::Submit(trans('admin.qa_save'), ['class' => 'btn btn_green mt-4']) !!}
                                    </div>
                                    {!! Form::close() !!}
                                </div>


                                <div class="tab-pane mt-4 {{ $currentTab=='social' ? 'active' : '' }}" id="social">
                                    {!! Form::open(['method' => 'POST','enctype' => 'multipart/form-data','name'=>'customer-edit-profile-form', 'id' =>'customer_edit_profile_form', 'class'=>'login-form px-md-4','data-parsley-validate','route' => ['admin.setting.save']]) !!}

                                    {{ csrf_field() }}
                                    @if(count($configurationList)>0)
                                        @foreach($configurationList as $key=>$value)
                                            @if( $value['group_type'] == 3 )
                                                <div class="form-edit-profile">
                                                    {!! Form::label($key,$value['label'], ['class' => '']) !!}
                                                    {!! Form::text($value['key'], $value['value'], ['class' => 'form-control mb-4', 'placeholder' => '']) !!}
                                                    @include('backend.partials.message.field',['field_name' => $value['key']])
                                                </div>
                                            @endif
                                        @endforeach
                                    @endif
                                    {!! Form::hidden( 'currenttab', 'social' ) !!}
                                    <div class="form-edit-profilebtn saveh1">
                                        {!! Form::Submit(trans('admin.qa_save'), ['class' => 'btn btn_green mt-4']) !!}
                                    </div>
                                    {!! Form::close() !!}
                                </div>

                                <div class="tab-pane mt-4 {{ $currentTab=='allergies' ? 'active' : '' }}"
                                     id="allergies">

                                    <div class="mt-5">
                                        <h1 class="admin_bigheading inlinebtn">Allergies ({{ $totalRecordCount }})</h1>
                                        <button type="button" onclick="openAddModal('#allergy_model')"
                                                class="btn light_blue float-right newbtn">Add Allergies
                                        </button>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="mt-5 table sorting data-table" id="classes">
                                            <thead>
                                            <tr>
                                                <th>ID#</th>
                                                <th>Name</th>
                                                <th class="actionwidth action_btns_width">@lang('admin.qa_action')</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @if(!empty($allergyLists) && count($allergyLists) > 0)
                                                @foreach($allergyLists as $allergyListKey => $allergyList)
                                                    <tr>
                                                        <td class="data-id">
                                                            <span>{{ ++$recordStart  }}</span>
                                                        </td>
                                                        <td>
                                                            <div class="two_line_elips">
                                                                {{ $allergyList->allergy_name }}
                                                            </div>
                                                        </td>
                                                        <td class="action_div">
                                                            <div class="action_space">
                                                                <a href="javascript:void(0);"
                                                                   onclick="openEditModal('#allergy_model',{{ $allergyList->allergie_id }})"
                                                                   class="viewbtn">Edit</a>
                                                                {!! Form::open(array(
                                                                    'method' => 'DELETE',
                                                                    'onsubmit' => "return confirm('".trans("admin.qa_are_you_sure_delete")." allergy?');",
                                                                    'route'=>'admin.allergy.delete')) !!}
                                                                {!! Form::hidden('id', $allergyList->allergie_id) !!}
                                                                <button type="submit" value="Delete" class="delete_btn">
                                                                    <i
                                                                        class="far fa-trash-alt"></i></button>

                                                                {!! Form::close() !!}
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="10">@lang('admin.qa_no_entries_in_table')</td>
                                                </tr>
                                            @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane mt-4 {{ $currentTab=='school_level' ? 'active' : '' }}"
                                     id="school_level">

                                    <div class="mt-5">
                                        <h1 class="admin_bigheading inlinebtn">School levels
                                            ({{ $totalRecordCountForSchoolLevel }})</h1>
                                        <button type="button"
                                                onclick="openAddModalForSchoolLevel('#school_level_model')"
                                                class="btn light_blue float-right newbtn">Add school level
                                        </button>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="mt-5 table sorting data-table" id="classes">
                                            <thead>
                                            <tr>
                                                <th>ID#</th>
                                                <th>Lavel</th>
                                                <th class="actionwidth action_btns_width">@lang('admin.qa_action')</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @if(!empty($schoolLevelLists) && count($schoolLevelLists) > 0)
                                                @foreach($schoolLevelLists as $schoolLevelListKey => $schoolLevelList)
                                                    <tr>
                                                        <td class="data-id">
                                                            <span>{{ ++$recordStartForSchoolLevel  }}</span>
                                                        </td>
                                                        <td>
                                                            <div class="two_line_elips">
                                                                {{ $schoolLevelList->school_level_name }}
                                                            </div>
                                                        </td>
                                                        <td class="action_div">
                                                            <div class="action_space">
                                                                <a href="javascript:void(0);"
                                                                   onclick="openEditModalForSchoolLevel('#school_level_model',{{ $schoolLevelList->school_level_id }})"
                                                                   class="viewbtn">Edit</a>
                                                                {!! Form::open(array(
                                                                    'method' => 'DELETE',
                                                                    'onsubmit' => "return confirm('".trans("admin.qa_are_you_sure_delete")." school level?');",
                                                                    'route'=>'admin.school_level.delete')) !!}
                                                                {!! Form::hidden('id', $schoolLevelList->school_level_id) !!}
                                                                <button type="submit" value="Delete" class="delete_btn">
                                                                    <i class="far fa-trash-alt"></i></button>
                                                                {!! Form::close() !!}
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="10">@lang('admin.qa_no_entries_in_table')</td>
                                                </tr>
                                            @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    @include('admin.allergy.add_edit_model')
    @include('admin.school_level.add_edit_model')
@endsection
@section('javascript')
    <script>
        var formAddEditForm = 'form#add_edit_allergy_model_form';
        var addEditSchoolLevelForm = 'form#add_edit_school_level_model_form';

        window.addEditUrl = "{{ URL::to('admin/allergy/save_ajax') }}";
        window.getDataForEditUrl = "{{ URL::to('admin/allergy/get_data') }}";

        window.addEditSchoolLevelUrl = "{{ URL::to('admin/school-level/save_ajax') }}";
        window.getDataForEditSchoolLevelUrl = "{{ URL::to('admin/school-level/get_data') }}";

        customErrorMessageElement = $(formAddEditForm + " .custom-error-message");
        customSuccessMessageElement = $(formAddEditForm + " .custom-success-message");

        customErrorMessageElementForSchoolLevel = $(addEditSchoolLevelForm + " .custom-error-message");
        customSuccessMessageElementForSchoolLevel = $(addEditSchoolLevelForm + " .custom-success-message");

        allergyNameElement = $(formAddEditForm + " #allergy_name");
        allergyIdElement = $(formAddEditForm + " #add_edit_model_id");
        addEditpageTitle = "Allergy";
        modelTitleElement = $(".modal-title");

        schoolLevelNameElement = $(addEditSchoolLevelForm + " #school_level_name");
        schoolLevelIdElement = $(addEditSchoolLevelForm + " #add_edit_school_level_model_id");
        addEditpageTitleForSchoolLevel = "School level";
        modelTitleElement = $("#school_level_model .modal-title");

        /* Open Add Model */
        function openAddModal(modelSelector) {
            modelTitleElement.html("New " + addEditpageTitle);
            ResetForm();
            openModal(modelSelector);
        }

        function openAddModalForSchoolLevel(modelSelector) {
            modelTitleElement.html("New " + addEditpageTitleForSchoolLevel);
            ResetFormForSchoolLevel();
            openModal(modelSelector);
        }

        /* Reset Form */
        function ResetForm() {
            allergyNameElement.val('');
            allergyIdElement.val('0');

        }

        function ResetFormForSchoolLevel() {
            schoolLevelNameElement.val('');
            schoolLevelIdElement.val('0');
            customErrorMessageElementForSchoolLevel.hide();
            customSuccessMessageElementForSchoolLevel.hide();
        }

        /* Edit model open */
        function openEditModal(modelSelector, id) {
            showLoader();
            jQuery.ajax({
                url: window.getDataForEditUrl,
                method: 'post',
                dataType: 'JSON',
                data: {
                    '_token': window._token,
                    'allergie_id': id,
                },
                success: function (response) {
                    if (response.success == true) {
                        ResetForm();
                        modelTitleElement.html("Edit " + addEditpageTitle);
                        FormDataBind(response.data);
                        hideLoader();
                        openModal(modelSelector);
                    } else {
                        hideLoader();
                        ResetForm();
                    }
                },
                error: function (xhr, status) {
                    toastr.error(window._ajax_error_msg_common);
                    hideLoader();
                }
            });
        }

        function openEditModalForSchoolLevel(modelSelector, id) {
            showLoader();
            jQuery.ajax({
                url: window.getDataForEditSchoolLevelUrl,
                method: 'post',
                dataType: 'JSON',
                data: {
                    '_token': window._token,
                    'school_level_id': id,
                },
                success: function (response) {
                    if (response.success == true) {
                        ResetFormForSchoolLevel();
                        modelTitleElement.html("Edit " + addEditpageTitleForSchoolLevel);
                        FormDataBindForSchoolLevel(response.data);
                        hideLoader();
                        openModal(modelSelector);
                    } else {
                        hideLoader();
                        ResetFormForSchoolLevel();
                    }
                },
                error: function (xhr, status) {
                    customErrorMessageElementForSchoolLevel.html(window._ajax_error_msg_common);
                    customErrorMessageElementForSchoolLevel.show();
                    hideLoader();
                }
            });
        }

        function FormDataBind(data) {
            allergyIdElement.val(data.allergie_id);
            allergyNameElement.val(data.allergy_name);
        }

        function FormDataBindForSchoolLevel(data) {
            schoolLevelIdElement.val(data.school_level_id);
            schoolLevelNameElement.val(data.school_level_name);
        }

        $(formAddEditForm).submit(function (event) {

            if ($(formAddEditForm).parsley().validate()) {

                event.preventDefault();

                showLoader();

                jQuery.ajax({
                    url: window.addEditUrl,
                    method: 'post',
                    dataType: 'JSON',
                    data: {
                        '_token': window._token,
                        'allergie_id': allergyIdElement.val(),
                        'allergy_name': allergyNameElement.val(),
                    },
                    success: function (response) {
                        if (response.success == true) {
                            toastr.success(response.message);
                            hideLoader();
                            setTimeout(function () {
                                location.reload();
                            }, 2000);
                        } else {
                            toastr.error(response.message);
                            hideLoader();
                        }
                    },
                    error: function (xhr, status) {
                        toastr.error(window._ajax_error_msg_common);
                        hideLoader();
                    }
                });
            }
        });

        $(addEditSchoolLevelForm).submit(function (event) {

            if ($(addEditSchoolLevelForm).parsley().validate()) {

                event.preventDefault();
                customErrorMessageElementForSchoolLevel.hide();
                customSuccessMessageElementForSchoolLevel.hide();
                showLoader();

                jQuery.ajax({
                    url: window.addEditSchoolLevelUrl,
                    method: 'post',
                    dataType: 'JSON',
                    data: {
                        '_token': window._token,
                        'school_level_id': schoolLevelIdElement.val(),
                        'school_level_name': schoolLevelNameElement.val(),
                    },
                    success: function (response) {
                        if (response.success == true) {
                            customSuccessMessageElementForSchoolLevel.html(response.message);
                            customSuccessMessageElementForSchoolLevel.show();
                            hideLoader();
                            setTimeout(function () {
                                location.reload();
                            }, 2000);
                        } else {
                            customErrorMessageElementForSchoolLevel.html(response.message);
                            customErrorMessageElementForSchoolLevel.show();
                            hideLoader();
                        }
                    },
                    error: function (xhr, status) {
                        customErrorMessageElementForSchoolLevel.html(window._ajax_error_msg_common);
                        customErrorMessageElementForSchoolLevel.show();
                        hideLoader();
                    }
                });
            }
        });
    </script>
@endsection
