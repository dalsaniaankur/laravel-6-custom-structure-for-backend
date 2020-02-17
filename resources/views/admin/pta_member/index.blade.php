@extends('backend.layouts.app')
@section('title', 'PTA Members | '.trans('admin.backend_title'))
@section('content')
    <div class="main_section">
        <div class="container">
            <div class="page-wrap bx-shadow mt-5 mb-5">
                <div class="row user-dt-wrap">
                    <div class="col-lg-12 col-md-12 pb-5">
                        <h1 class="admin_bigheading mb-5 inlinebtn">PTA Members
                            @if($schoolId > 0 && !empty($schoolDropDownList) && count($schoolDropDownList) > 0)
                                @php($schoolName = strtolower($schoolDropDownList->toArray()[$schoolId]))
                                for {{ $schoolName }}
                            @endif
                            ({{ $totalRecordCount }})</h1>

                        <a href="javascript:void(0)" onclick="openPTAMemberModal('#pta_member_model')" class="btn light_blue float-right newbtn">New PTA Member</a>
                        <div class="clear-both"></div>

                        {!! Form::open(['method' => 'GET','name'=>'admin-pta-member-search', 'id' =>'admin_pta_member_search_form', 'class'=>'top-search-options form-row pb-4','route' => ['admin.pta_members']]) !!}
                        {!! Form::hidden('sorted_by', $sortedBy, array('id' => 'sortedBy')) !!}
                        {!! Form::hidden('sorted_order', $sortedOrder, array('id' => 'sortedOrder')) !!}
                        {!! Form::hidden('school_id', $schoolId, array('id' => 'school_id')) !!}

                        <div class="col-md-3 col-lg-2">
                            <a href="{{ url('admin/pta-members?school_id='.$schoolId) }}">
                                <button type="button" class="btn btn_green resetbtn mb-3">Reset</button>
                            </a>
                        </div>

                        <div class="col-md-5 col-lg-3">
                            {!! Form::text('name', $name, ['class' => 'form-control mb-3', 'placeholder' => 'Names']) !!}
                        </div>

                        <div class="col-md-4 col-lg-4">
                            {!! Form::email('email', $email, ['class' => 'form-control mb-3', 'placeholder' => 'Email']) !!}
                        </div>

                        <div class="col-md-4 col-lg-3">
                            {!! Form::select('status', $statusDropDown, $status, ['class' => 'form-control mb-3']) !!}
                        </div>

                        <div class="col-md-4 col-lg-3">
                            {!! Form::select('gender', ['' => 'Gender','1' => 'Male','2' => 'Female'], $gender, ['class' => 'form-control mb-3']) !!}
                        </div>

                        <div class="col-md-4  col-lg-3">
                            {!! Form::text('start_date', $createdStartDate, ['id' =>'start_date', 'class' => 'form-control date-field mb-3', 'placeholder' => 'Signed up from','autocomplete' => 'Off', 'data-toggle'=>'datepicker']) !!}
                        </div>

                        <div class="col-md-4  col-lg-3">
                            {!! Form::text('end_date', $createdEndDate, ['id' =>'end_date', 'class' => 'form-control date-field mb-3', 'placeholder' => 'Signed up to','autocomplete' => 'Off', 'data-toggle'=>'datepicker']) !!}
                        </div>
                        <div class="col-md-3 col-lg-2 offset-lg-1">
                            {!! Form::Submit(trans('admin.qa_search'), ['class' => 'btn btn_green resetbtn']) !!}
                        </div>
                        {!! Form::close() !!}

                        <div class="table-responsive mt-5">
                            <table class="table sorting data-table school" id="classes">
                                <thead>
                                <tr>
                                    @php($shortClass = ( strtolower($sortedOrder) == 'asc') ? 'up' : 'down' )
                                    @php($sortDefault = '<i class="fas fa-sort"></i>')
                                    @php($sorting = '<i class="fas fa-caret-'.$shortClass.'"></i>')

                                    <th class="updownicon"
                                        onclick="sortWithSearch('user_id');">@lang('admin.user.fields.id')
                                        {!!  $sortedBy =='user_id' ? $sorting : $sortDefault  !!}</th>
                                    <th class="updownicon"
                                        onclick="sortWithSearch('first_name');">NAMES
                                        {!!  $sortedBy =='first_name' ? $sorting : $sortDefault  !!}</th>
                                    <th>JOINED</th>
                                    <th>GENDER</th>
                                    <th>STATUS</th>
                                    <th class="actionwidth">@lang('admin.user.fields.action')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(!empty($ptaMembers) && count($ptaMembers) > 0)
                                    @foreach($ptaMembers as $ptaMemberKey => $ptaMember)
                                        <tr>
                                            <td class="data-id"><span>{{ ++$recordStart  }}</span></td>
                                            <td>
                                                <b>{{ $ptaMember->name }}</b><br>
                                                <a href="mailto:{{ $ptaMember->email  }}"
                                                   class="mail">{{ $ptaMember->email  }}</a> <br>
                                                {{ Common:: getPhoneFormat($ptaMember->phone)  }}
                                            </td>
                                            <td>
                                                <b>{{ DateFacades::dateFormat($ptaMember->created_at,'format-3') }}</b><br>
                                                {{ DateFacades::dateFormat($ptaMember->created_at,'time-format-1') }}
                                            </td>
                                            <td class="bigfonts"><b>{{ $ptaMember->gender_type  }}</b></td>
                                            <td class="{{ $ptaMember->status ==1 ? 'green' : 'inactive' }}">
                                                <b>{{ $ptaMember->status_string }}</b></td>
                                            <td class="action_div">
                                                <a href="javascript:void(0)"
                                                   onclick="openContactModal('.contact-model',{{ $ptaMember->user_id }})"
                                                   class="viewbtn contact">Contact</a>
                                                <a href="{{ url('admin/pta-member/profile/')}}/{{ Common::getEncryptId($ptaMember->user_id) }}"
                                                   class="viewbtn">view</a>
                                                {!! Form::open(array(
                                                        'method' => 'DELETE',
                                                         'onsubmit' => "return confirm('".trans("admin.qa_are_you_sure_delete")." pta member?');",
                                                        'route' => ['admin.pta_member.delete'])) !!}
                                                {!! Form::hidden('id',$ptaMember->user_id ) !!}
                                                {!! Form::hidden('school_id',$ptaMember->school_id ) !!}

                                                <button type="submit" value="Delete" class="delete_btn"><i
                                                            class="far fa-trash-alt"></i></button>

                                                {!! Form::close() !!}
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
                        {!! $paging !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@include('school.school.contact_model')
@include('admin.pta_member.add_edit_model')
@endsection
@section('javascript')
    <script>
        var form = 'form#admin_pta_member_search_form';

        /*----------------------------------  PTA Member -----------------------------------*/

        var addEditPTAMemberForm = 'form#add_edit_pta_member_model_form';
        window.addEditPTAMemberUrl = "{{ URL::to('admin/pta_member/save_ajax') }}";

        addEditPTAMemberModelIdElement = $(addEditPTAMemberForm + " #add_edit_pta_member_model_id");
        firstNameElement = $(addEditPTAMemberForm + " #first_name");
        lastNameElement = $(addEditPTAMemberForm + " #last_name");
        emailElement = $(addEditPTAMemberForm + " #email");
        phoneElement = $(addEditPTAMemberForm + " #phone");
        genderElement = $(addEditPTAMemberForm + " #gender");
        schoolIdElement = $(addEditPTAMemberForm + " #school_id");
        customPTAMemberErrorMessageElement = $(addEditPTAMemberForm + " .custom-error-message");
        customPTAMemberSuccessMessageElement = $(addEditPTAMemberForm + " .custom-success-message");

        /* PTA Member Reset Form */
        function resetPTAMemberForm() {
            $(addEditPTAMemberForm).parsley().reset();
            customPTAMemberErrorMessageElement.hide();
            customPTAMemberSuccessMessageElement.hide();
            addEditPTAMemberModelIdElement.val(0);
            firstNameElement.val("");
            lastNameElement.val("");
            emailElement.val("");
            phoneElement.val("");
            genderElement.val("1");
            @if( !(!empty($schoolId) && $schoolId > 0) )
            schoolIdElement.val("");
            @endif
        }

        /* Add Edit Ajax Call */
        $(addEditPTAMemberForm).submit(function (event) {

            if ($(addEditPTAMemberForm).parsley().validate()) {

                event.preventDefault();
                customPTAMemberErrorMessageElement.hide();
                customPTAMemberSuccessMessageElement.hide();
                showLoader();

                var formData = new FormData($(this)[0]);
                jQuery.ajax({
                    url: window.addEditPTAMemberUrl,
                    enctype: 'multipart/form-data',
                    method: 'post',
                    dataType: 'JSON',
                    processData: false,
                    contentType: false,
                    cache: false,
                    data : formData,
                    success: function (response) {
                        if (response.success == true) {
                            customPTAMemberSuccessMessageElement.html(response.message);
                            customPTAMemberSuccessMessageElement.show();
                            hideLoader();
                            setTimeout(function () {
                                location.reload();
                            }, 2000);
                        } else {
                            customPTAMemberErrorMessageElement.html(response.message);
                            customPTAMemberErrorMessageElement.show();
                            hideLoader();
                        }
                    },
                    error: function (xhr, status) {
                        customPTAMemberErrorMessageElement.html(window._ajax_error_msg_common);
                        customPTAMemberErrorMessageElement.show();
                        hideLoader();
                    }
                });
            }
        });


        /* Open PTA Member Model */
        function openPTAMemberModal(modelSelector) {
            resetPTAMemberForm();
            openModal(modelSelector);
        }

        /*----------------------------------  Contact  -----------------------------------*/

        /* Contact form start */
        var contactForm = 'form#contact_form';
        window.sendContactMailUrl = "{{ URL::to('contact/send_mail') }}";
        contactModelUserIdElement = $(contactForm + " #contact_model_user_id");
        contactModelMessageElement = $(contactForm + " #contact_model_message");
        customErrorMessageElement = $(contactForm + " .custom-error-message");
        customSuccessMessageElement = $(contactForm + " .custom-success-message");

        /* Reset Contact Form */
        function resetContactForm() {
            $(contactForm).parsley().reset();

            contactModelUserIdElement.val("");
            contactModelMessageElement.val("");
        }

        /* Open Contact Model */
        function openContactModal(modelSelector, userId) {
            resetContactForm();
            contactModelUserIdElement.val(userId);
            openModal(modelSelector);
        }

        /* Send Message Ajax Call */
        jQuery(contactForm).submit(function (event) {
            if (jQuery(contactForm).parsley().validate()) {

                event.preventDefault();
                showLoader();

                /* Send Mail */
                jQuery.ajax({
                    url: window.sendContactMailUrl,
                    method: 'post',
                    dataType: 'JSON',
                    data: {
                        '_token': window._token,
                        'user_id': contactModelUserIdElement.val(),
                        'message': contactModelMessageElement.val(),
                    },
                    success: function (response) {
                        if (response.success == true) {
                            resetContactForm();
                            toastr.success(response.message);
                            hideLoader();
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
        /* Contact form end */
    </script>
@endsection
