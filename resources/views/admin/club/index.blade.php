@extends('backend.layouts.app')
@section('title', 'Clubs | '.trans('admin.backend_title'))
@section('content')
    <div class="main_section">
        <div class="container">
            <div class="page-wrap bx-shadow mt-5 mb-5">
                <div class="row user-dt-wrap">
                    <div class="col-lg-12 col-md-12 pb-5">
                        <h1 class="admin_bigheading mb-5 inlinebtn">Clubs
                            @if($schoolId > 0 && !empty($schoolDropDownList) && count($schoolDropDownList) > 0)
                                @php($schoolName = strtolower($schoolDropDownList->toArray()[$schoolId]))
                                for {{ $schoolName }}
                            @endif
                            ({{ $totalRecordCount }})</h1>
                        <a href="javascript:void(0);" class="btn light_blue float-right newbtn"
                           onclick="openAddModal('#club_model')">New
                            club</a>
                        <div class="clear-both"></div>

                        {!! Form::open(['method' => 'GET','name'=>'admin-club-search', 'id' =>'admin_club_search_form', 'class'=>'top-search-options form-row pb-4','route' => ['admin.clubs']]) !!}
                        {!! Form::hidden('sorted_by', $sortedBy, array('id' => 'sortedBy')) !!}
                        {!! Form::hidden('sorted_order', $sortedOrder, array('id' => 'sortedOrder')) !!}
                        {!! Form::hidden('school_id', $schoolId, array('id' => 'school_id')) !!}

                        <div class="col-md-3 col-lg-2">
                            <a href="{{ url('admin/clubs?school_id='.$schoolId) }}">
                                <button type="button" class="btn btn_green resetbtn mb-3">Reset</button>
                            </a>
                        </div>

                        <div class="col-md-5 col-lg-4">
                            {!! Form::text('club_name', $clubName, ['class' => 'form-control mb-3', 'placeholder' => 'Club name']) !!}
                        </div>

                        <div class="col-md-4  col-lg-3">
                            {!! Form::text('start_date', $createdStartDate, ['id' =>'start_date', 'class' => 'form-control date-field mb-3', 'placeholder' => 'Signed up from','autocomplete' => 'Off', 'data-toggle'=>'datepicker']) !!}
                        </div>

                        <div class="col-md-4 col-lg-3">
                            {!! Form::text('end_date', $createdEndDate, ['id' =>'end_date', 'class' => 'form-control date-field mb-3', 'placeholder' => 'Signed up to','autocomplete' => 'Off', 'data-toggle'=>'datepicker']) !!}
                        </div>

                        <div class="col-md-3 col-lg-2 offset-lg-10">
                            {!! Form::Submit(trans('admin.qa_search'), ['class' => 'btn btn_green resetbtn']) !!}
                        </div>
                        {!! Form::close() !!}
                        <div class="col-lg-10 col-md-12">
                            <div class="table-responsive mt-5">
                                <table class="table sorting data-table school" id="classes">
                                    <thead>
                                    <tr>
                                        @php($shortClass = ( strtolower($sortedOrder) == 'asc') ? 'up' : 'down' )
                                        @php($sortDefault = '<i class="fas fa-sort"></i>')
                                        @php($sorting = '<i class="fas fa-caret-'.$shortClass.'"></i>')

                                        <th class="updownicon"
                                            onclick="sortWithSearch('club_id');">ID
                                            {!!  $sortedBy =='club_id' ? $sorting : $sortDefault  !!}</th>
                                        <th class="updownicon"
                                            onclick="sortWithSearch('club_name');">CLUB
                                            {!!  $sortedBy =='club_name' ? $sorting : $sortDefault  !!}</th>
                                        <th>ADDED</th>
                                        <th>MEMBERS</th>
                                        <th class="actionwidth">@lang('admin.user.fields.action')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(!empty($clubs) && count($clubs) > 0)
                                        @foreach($clubs as $clubKey => $club)
                                            <tr>
                                                <td class="data-id"><span>{{ ++$recordStart  }}</span></td>
                                                <td><b>{{ $club->club_name  }}</b></td>
                                                <td>
                                                    <b>{{ DateFacades::dateFormat($club->created_at,'format-3') }}</b><br>
                                                    {{ DateFacades::dateFormat($club->created_at,'time-format-1') }}
                                                </td>
                                                <td>
                                                    <a href="{{ url("/admin/club/member/".Common::getEncryptId($club->club_id)) }}"
                                                       class="members_count"><b>{{ $club->club_members_count($club->club_id) }}</b></a>
                                                </td>
                                                <td class="action_div">
                                                    <div class="action_club">
                                                        <a href="javascript:void(0);"
                                                           onclick="openEditModal('#club_model',{{ $club->club_id }})"
                                                          class="viewbtn">view</a>

                                                        {!! Form::open(array(
                                                                'method' => 'DELETE',
                                                                 'onsubmit' => "return confirm('".trans("admin.qa_are_you_sure_delete")." club?');",
                                                                'route' => ['admin.club.delete'])) !!}
                                                        {!! Form::hidden('id',$club->club_id ) !!}

                                                        <button type="submit" value="Delete" class="delete_btn"><i
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
                        {!! $paging !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.club.edit_model')
@endsection
@section('javascript')
    <script>
        var form = 'form#admin_club_search_form';
        var formAddEditForm = 'form#add_edit_club_model_form';
        window.add_edit_url = "{{ URL::to('admin/club/save') }}";
        window.get_data_for_edit_url = "{{ URL::to('admin/club/get_data') }}";

        pageTitle = "club";
        addEditModelIdElement = $(formAddEditForm + " #add_edit_model_id");
        clubNameElement = $(formAddEditForm + " #club_name");
        schoolIdElement = $(formAddEditForm + " #school_id");
        customErrorMessageElement = $(formAddEditForm + " .custom-error-message");
        customSuccessMessageElement = $(formAddEditForm + " .custom-success-message");
        modelTitleElement = $(".modal-title");

        /* Reset Form */
        function ResetForm() {
            $(formAddEditForm).parsley().reset();

            addEditModelIdElement.val(0);
            clubNameElement.val("");
        }


        /* Open Add Model */
        function openAddModal(modelSelector) {
            ResetForm();
            modelTitleElement.html("Add " + pageTitle);
            openModal(modelSelector);
        }

        /* Add Edit Ajax Call */
        $(formAddEditForm).submit(function (event) {

            if ($(formAddEditForm).parsley().validate()) {

                event.preventDefault();

                showLoader();

                jQuery.ajax({
                    url: window.add_edit_url,
                    method: 'post',
                    dataType: 'JSON',
                    data: {
                        '_token': window._token,
                        'club_id': addEditModelIdElement.val(),
                        'club_name': clubNameElement.val(),
                        'school_id': schoolIdElement.val(),
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

        function FormDataBind(data) {

            addEditModelIdElement.val(data.club_id);
            clubNameElement.val(data.club_name);
            schoolIdElement.val(data.school_id);
        }

        function openEditModal(modelSelector, id) {
            showLoader();
            jQuery.ajax({
                url: window.get_data_for_edit_url,
                method: 'post',
                dataType: 'JSON',
                data: {
                    '_token': window._token,
                    'club_id': id,
                },
                success: function (response) {
                    if (response.success == true) {
                        ResetForm();
                        modelTitleElement.html("Edit " + pageTitle);
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

    </script>
@endsection
