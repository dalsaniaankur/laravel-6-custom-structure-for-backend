@extends('backend.layouts.app')
@section('title', 'Schools | '.trans('admin.backend_title'))
@section('content')
    <div class="main_section">
       <div class="container">
            <div class="page-wrap bx-shadow mt-5 mb-5">
                <div class="row user-dt-wrap">
                    <div class="col-lg-12 col-md-12 pb-5">
                        <h1 class="admin_bigheading mb-5 inlinebtn">Schools ({{ $totalRecordCount }})</h1>
                        <a href="{{ url('admin/school/create') }}" class="btn light_blue float-right newbtn">New
                            School</a>
                        <div class="clear-both"></div>
                        {!! Form::open(['method' => 'GET','name'=>'admin-school-search', 'id' =>'admin_school_search_form', 'class'=>'top-search-options form-row pb-4','route' => ['admin.schools']]) !!}
                        {!! Form::hidden('sorted_by', $sortedBy, array('id' => 'sortedBy')) !!}
                        {!! Form::hidden('sorted_order', $sortedOrder, array('id' => 'sortedOrder')) !!}
                        <div class="col-md-3 col-lg-2">
                            <a href="{{ url('admin/schools') }}">
                                <button type="button" class="btn btn_green resetbtn mb-3">Reset</button>
                            </a>
                        </div>
                        <div class="col-md-5 col-lg-3">
                            {!! Form::text('name', $name, ['class' => 'form-control mb-3', 'placeholder' => 'School name']) !!}
                        </div>
                        <div class="col-md-4 col-lg-4">
                            {!! Form::text('city', $city, ['class' => 'form-control mb-3', 'placeholder' => 'City']) !!}
                        </div>
                        <div class="col-md-4 col-lg-3">
                            {!! Form::email('email', $email, ['class' => 'form-control mb-3', 'placeholder' => 'Email']) !!}
                        </div>
                        <div class="col-md-4 col-lg-2">
                            {!! Form::select('status', $statusDropDown, $status, ['class' => 'form-control mb-3']) !!}
                        </div>
                        <div class="col-md-4 col-lg-2">
                            {!! Form::select('school_level', $levelDropDown, $schoolLevel, ['class' => 'form-control mb-3']) !!}
                        </div>
                        <div class="col-md-3  col-lg-3">
                            {!! Form::text('start_date', $createdStartDate, ['id' =>'start_date', 'class' => 'form-control date-field mb-3', 'placeholder' => 'Signed up from','autocomplete' => 'Off', 'data-toggle'=>'datepicker']) !!}
                        </div>
                        <div class="col-md-3  col-lg-3">
                            {!! Form::text('end_date', $createdEndDate, ['id' =>'end_date', 'class' => 'form-control date-field mb-3', 'placeholder' => 'Signed up to','autocomplete' => 'Off', 'data-toggle'=>'datepicker']) !!}
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
                                    <th>@lang('admin.user.fields.name')</th>
                                    <th>@lang('admin.user.fields.principal')</th>
                                    <th>@lang('admin.user.fields.joined')</th>
                                    <th>@lang('admin.user.fields.classes')</th>
                                    <th>@lang('admin.user.fields.status')</th>
                                    <th class="actionwidth">@lang('admin.user.fields.action')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(!empty($schools) && count($schools) > 0)
                                    @foreach($schools as $schoolKey => $school)
                                        <tr>
                                            <td class="data-id"><span>{{ ++$recordStart  }}</span></td>
                                            <td><span><b> {{ $school->school_name }}</b></span></td>
                                            <td>
                                                <b>{{ $school->getPrincipalNameAttribute() }}</b><br>
                                                <a href="mailto:{{ $school->principal_email  }}"
                                                   class="mail">{{ $school->principal_email  }}</a> <br>
                                                {{ Common::getPhoneFormat($school->principal_phone)  }}
                                            </td>
                                            <td>
                                                <b>{{ DateFacades::dateFormat($school->created_at,'format-3') }}</b><br>
                                                {{ DateFacades::dateFormat($school->created_at,'time-format-1') }}
                                            </td>
                                            <td class="bigfonts"><b>{{ $school->school_classes_count() }}</b></td>
                                            <td class="{{ $school->status ==1 ? 'green' : 'inactive' }}">
                                                <b>{{ $school->status_string }}</b></td>
                                            <td class="action_div">
                                            	<div class="third_btn">
                                                <a href="javascript:void(0)"
                                                   onclick="openContactModal('.contact-model',{{ $school->user_id }})"
                                                   class="viewbtn contact">Contact</a>
                                                <a href="{{ url('admin/schools/')}}/{{ Common::getEncryptId($school->user_id) }}"
                                                   class="viewbtn">view</a>
                                                {!! Form::open(array(
                                                        'method' => 'DELETE',
                                                         'onsubmit' => "return confirm('".trans("admin.qa_are_you_sure_delete")." school?');",
                                                        'route' => ['admin.school.delete'])) !!}
                                                {!! Form::hidden('id',$school->user_id ) !!}

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
    @include('admin.school.contact_model')
@endsection
@section('javascript')
    <script>
        var form = 'form#admin_school_search_form';

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
