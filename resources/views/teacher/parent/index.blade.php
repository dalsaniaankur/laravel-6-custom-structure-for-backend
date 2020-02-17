@extends('backend.layouts.app')
@section('title', 'Parents | '.trans('admin.backend_title'))
@section('content')
    <div class="main_section">

        <div class="container">
            <div class="page-wrap bx-shadow mt-5 mb-5">
                <div class="row user-dt-wrap">
                    <div class="col-lg-12 col-md-12 pb-5">
                        <h1 class="admin_bigheading mb-5 inlinebtn">Parents ({{ $totalRecordCount }})</h1>
                        <a href="javascript:void(0);" class="btn light_blue float-right newbtn" onclick="openParentModal('#parent_model')">New
                            Parent</a>
                        <div class="clear-both"></div>

                        {!! Form::open(['method' => 'GET','name'=>'admin-parent-search', 'id' =>'admin_parent_search_form', 'class'=>'top-search-options form-row pb-4','route' => ['teacher.parents']]) !!}
                        {!! Form::hidden('sorted_by', $sortedBy, array('id' => 'sortedBy')) !!}
                        {!! Form::hidden('sorted_order', $sortedOrder, array('id' => 'sortedOrder')) !!}

                        <div class="col-md-3 col-lg-2">
                            <a href="{{ url('teacher/parents') }}">
                                <button type="button" class="btn btn_green resetbtn mb-3">Reset</button>
                            </a>
                        </div>

                        <div class="col-md-4 col-lg-3">
                            {!! Form::text('name', $name, ['class' => 'form-control mb-3', 'placeholder' => 'Names']) !!}
                        </div>

                        <div class="col-md-5 col-lg-4">
                            {!! Form::email('email', $email, ['class' => 'form-control mb-3', 'placeholder' => 'Email']) !!}
                        </div>

                        <div class="col-md-4 col-lg-3">
                            {!! Form::select('city_id', $cityDropDown, $cityId, ['class' => 'form-control mb-3']) !!}
                        </div>

                        <div class="col-md-4  col-lg-3">
                            {!! Form::text('start_date', $createdStartDate, ['id' =>'start_date', 'class' => 'form-control date-field mb-3', 'placeholder' => 'Signed up from','autocomplete' => 'Off', 'data-toggle'=>'datepicker']) !!}
                        </div>

                        <div class="col-md-4  col-lg-3">
                            {!! Form::text('end_date', $createdEndDate, ['id' =>'end_date', 'class' => 'form-control date-field mb-3', 'placeholder' => 'Signed up to','autocomplete' => 'Off', 'data-toggle'=>'datepicker']) !!}
                        </div>

						 <div class="col-md-4 col-lg-4">
                            {!! Form::select('status', $statusDropDown, $status, ['class' => 'form-control mb-3']) !!}
                        </div>

                        <div class="col-md-3 col-lg-2">
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
                                    <th>CITY</th>
                                    <th>STATE/PROV</th>
                                    <th>STATUS</th>
                                    <th class="actionwidth">@lang('admin.user.fields.action')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(!empty($parents) && count($parents) > 0)
                                    @foreach($parents as $parentKey => $parent)
                                        <tr>
                                            <td class="data-id"><span>{{ ++$recordStart  }}</span></td>
                                            <td>
                                                <b>{{ $parent->name }}</b><br>
                                                <a href="mailto:{{ $parent->email  }}"
                                                   class="mail">{{ $parent->email  }}</a> <br>
                                                {{ Common:: getPhoneFormat($parent->phone)  }}
                                            </td>
                                            <td>
                                                <b>{{ DateFacades::dateFormat($parent->created_at,'format-3') }}</b><br>
                                                {{ DateFacades::dateFormat($parent->created_at,'time-format-1') }}
                                            </td>
                                            <td><b>{{ $parent->city->city_name ?? ''}}</b></td>
                                            <td><b>{{ $parent->state->state_name ?? ''}}</b></td>
                                            <td class="{{ $parent->status ==1 ? 'green' : 'inactive' }}">
                                                <b>{{ $parent->status_string }}</b></td>
                                            <td class="action_div">
                                            	<div class="third_btn">
                                                <a href="javascript:void(0)" onclick="openContactModal('.contact-model',{{ $parent->user_id }})" class="viewbtn contact">Contact</a>
                                                <a href="{{ url('teacher/parent/profile/')}}/{{ Common::getEncryptId($parent->user_id) }}"
                                                   class="viewbtn">view</a>
                                                {!! Form::open(array(
                                                        'method' => 'DELETE',
                                                         'onsubmit' => "return confirm('".trans("admin.qa_are_you_sure_delete")." parent?');",
                                                        'route' => ['teacher.parent.delete'])) !!}
                                                {!! Form::hidden('id',$parent->user_id ) !!}

                                                <button type="submit" value="Delete" class="delete_btn"><i
                                                            class="far fa-trash-alt"></i></button>

                                                {!! Form::close() !!}</div>
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
@include('teacher.parent.add_edit_model')
@endsection
@section('javascript')
    <script>
        var form = 'form#admin_parent_search_form';

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

		/* Add Parent */
		var addEditParentForm = 'form#add_edit_parent_model_form';
        window.addEditParentUrl = "{{ URL::to('teacher/parent/save_ajax') }}";

        addEditStudentModelIdElement = $(addEditParentForm + " #add_edit_parent_model_id");
        firstNameElement = $(addEditParentForm + " #first_name");
        lastNameElement = $(addEditParentForm + " #last_name");
        emailElement = $(addEditParentForm + " #email");
        phoneElement = $(addEditParentForm + " #phone");
        genderElement = $(addEditParentForm + " #gender");
        countryIdElement = $(addEditParentForm + " #country_id");
        stateIdElement = $(addEditParentForm + " #state_id");
        cityIdElement = $(addEditParentForm + " #city_id");
        studentIdElement = $(addEditParentForm + " #student_id");
        customParentErrorMessageElement = $(addEditParentForm + " .custom-error-message");
        customParentSuccessMessageElement = $(addEditParentForm + " .custom-success-message");

        studentIdElement.multiselect({
            columns: 1,
            search: true,
            selectAll: true,
            placeholder: 'Select student',
        });

        /* Reset Contact Form */
        function resetParentForm() {
            $(addEditParentForm).parsley().reset();
            customParentErrorMessageElement.hide();
            customParentSuccessMessageElement.hide();
            addEditStudentModelIdElement.val("");
            firstNameElement.val("");
            lastNameElement.val("");
            emailElement.val("");
            phoneElement.val("");
            studentIdElement.val([]);
            studentIdElement.multiselect('reload');
            //countryIdElement.val("");
            //jQuery(countryIdElement).trigger('change');

        }

        function openParentModal(modelSelector) {
            resetParentForm();
            openModal(modelSelector);
        }

		/* Add Edit Ajax Call */
        $(addEditParentForm).submit(function (event) {

            if ($(addEditParentForm).parsley().validate()) {

                event.preventDefault();
                customParentErrorMessageElement.hide();
                customParentSuccessMessageElement.hide();
                showLoader();

                var formData = new FormData($(this)[0]);
                jQuery.ajax({
                    url: window.addEditParentUrl,
                    enctype: 'multipart/form-data',
                    method: 'post',
                    dataType: 'JSON',
                    processData: false,
                    contentType: false,
                    cache: false,
                    data : formData,
                    success: function (response) {
                        if (response.success == true) {
                            customParentSuccessMessageElement.html(response.message);
                            customParentSuccessMessageElement.show();
                            hideLoader();
                            setTimeout(function () {
                                location.reload();
                            }, 2000);
                        } else {
                            customParentErrorMessageElement.html(response.message);
                            customParentErrorMessageElement.show();
                            hideLoader();
                        }
                    },
                    error: function (xhr, status) {
                        customParentErrorMessageElement.html(window._ajax_error_msg_common);
                        customParentErrorMessageElement.show();
                        hideLoader();
                    }
                });
            }
        });
    </script>
@endsection
