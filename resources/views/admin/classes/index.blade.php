@extends('backend.layouts.app')
@section('title', 'Classes | '.trans('admin.backend_title'))
@section('content')
    <div class="main_section">
        <div class="container">
            <div class="page-wrap bx-shadow mt-5 mb-5">
                <div class="row user-dt-wrap">
                    <div class="col-lg-12 col-md-12 pb-5">
                        <h1 class="admin_bigheading mb-5 inlinebtn">Classes
                            @if($schoolId > 0 && !empty($schoolDropDownList) && count($schoolDropDownList) > 0)
                                @php($schoolName = strtolower($schoolDropDownList->toArray()[$schoolId]))
                                for {{ $schoolName }}
                            @endif
                            ({{ $totalRecordCount }})</h1>
                        <a href="javascript:void(0);" class="btn light_blue float-right newbtn"
                           onclick="openAddModal('#class_model')">New
                            class</a>
                        <div class="clear-both"></div>

                        {!! Form::open(['method' => 'GET','name'=>'admin-class-search', 'id' =>'admin_class_search_form', 'class'=>'top-search-options form-row pb-4','route' => ['admin.classes']]) !!}

                        {!! Form::hidden('sorted_by', $sortedBy, array('id' => 'sortedBy')) !!}
                        {!! Form::hidden('sorted_order', $sortedOrder, array('id' => 'sortedOrder')) !!}
                        {!! Form::hidden('school_id', $schoolId, array('id' => 'school_id')) !!}

                        <div class="col-md-3 col-lg-2">
							<a href="{{ url('admin/classes?school_id='.$schoolId)}}">
                                <button type="button" class="btn btn_green resetbtn mb-3">Reset</button>
                            </a>
                        </div>

                        <div class="col-md-4 col-lg-3">
                            {!! Form::text('grade_name', $gradeName, ['class' => 'form-control mb-3', 'placeholder' => 'Grade']) !!}
                        </div>

                        <div class="col-md-5 col-lg-4">
                            {!! Form::text('class_name', $className, ['class' => 'form-control mb-3', 'placeholder' => 'Class']) !!}
                        </div>

                        <div class="col-md-4 col-lg-3">
                            {!! Form::select('status', $statusDropDown, $status, ['class' => 'form-control mb-3']) !!}
                        </div>

                        <div class="col-md-4 col-lg-3">
                            {!! Form::text('start_date', $createdStartDate, ['id' =>'start_date', 'class' => 'form-control date-field mb-3', 'placeholder' => 'Signed up from','autocomplete' => 'Off', 'data-toggle'=>'datepicker']) !!}
                        </div>

                        <div class="col-md-4 col-lg-3">
                            {!! Form::text('end_date', $createdEndDate, ['id' =>'end_date', 'class' => 'form-control date-field mb-3', 'placeholder' => 'Signed up to','autocomplete' => 'Off', 'data-toggle'=>'datepicker']) !!}
                        </div>

                        <div class="col-md-3 col-lg-2 offset-lg-4 offset-md-0">
                            {!! Form::Submit(trans('admin.qa_search'), ['class' => 'btn btn_green resetbtn']) !!}
                        </div>
                        {!! Form::close() !!}
						<div class="col-lg-11 col-md-12">
                        <div class="table-responsive mt-5">
                            <table class="table sorting data-table" id="classes">
                                <thead>
                                <tr>
                                    @php($shortClass = ( strtolower($sortedOrder) == 'asc') ? 'up' : 'down' )
                                    @php($sortDefault = '<i class="fas fa-sort"></i>')
                                    @php($sorting = '<i class="fas fa-caret-'.$shortClass.'"></i>')

                                    <th class="updownicon"
                                        onclick="sortWithSearch('class_id');">ID
                                        {!!  $sortedBy =='class_id' ? $sorting : $sortDefault  !!}</th>
                                    <th class="updownicon"
                                        onclick="sortWithSearch('{{ $gradeTableName }}.grade_name');">GRADE
                                        {!!  $sortedBy == $gradeTableName.'.grade_name' ? $sorting : $sortDefault  !!}</th>
                                    <th>CLASS</th>
                                    <th>ADDED</th>
                                    <th>STATUS</th>
                                    <th class="actionwidth">@lang('admin.user.fields.action')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(!empty($classes) && count($classes) > 0)
                                    @foreach($classes as $classKey => $class)
                                        <tr>
                                            <td class="data-id"><span>{{ ++$recordStart  }}</span></td>
                                            <td><b>{{ $class->grade->grade_name  }}</b></td>
                                            <td><b>{{ $class->class_name  }}</b></td>
                                            <td>
                                                <b>{{ DateFacades::dateFormat($class->created_at,'format-3') }}</b><br>
                                                {{ DateFacades::dateFormat($class->created_at,'time-format-1') }}
                                            </td>

                                            <td class="{{ $class->status ==1 ? 'green' : 'inactive' }}"><b>{{ $class->status_string }}</b></td>
                                            <td class="action_div">
                                            	<div class="action_club">
                                                <a href="javascript:void(0);" class="viewbtn" onclick="openEditModal('#class_model',{{ $class->class_id }})">view</a>
                                                {!! Form::open(array(
                                                        'method' => 'DELETE',
                                                         'onsubmit' => "return confirm('".trans("admin.qa_are_you_sure_delete")." class?');",
                                                        'route' => ['admin.class.delete'])) !!}
                                                {!! Form::hidden('id',$class->class_id ) !!}

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
    @include('admin.classes.edit_model')
@endsection
@section('javascript')
    <script>
        var form = 'form#admin_class_search_form';
        var AddEditClassForm = 'form#add_edit_class_model_form';
        window.addEditClassUrl = "{{ URL::to('admin/class/ajax_save') }}";
        window.getDataForClassEditUrl = "{{ URL::to('admin/class/get_data') }}";

        pageTitle = "class";
        addEditModelIdElement = $(AddEditClassForm + " #add_edit_model_id");
        classNameElement = $(AddEditClassForm + " #class_name");
        schoolIdElement = $(AddEditClassForm + " #school_id");
        gradeIdElement = $(AddEditClassForm + " #grade_id");
        statusElement = $(AddEditClassForm + " #status");
        customErrorMessageElement = $(AddEditClassForm + " .custom-error-message");
        customSuccessMessageElement = $(AddEditClassForm + " .custom-success-message");
        modelTitleElement = $(".modal-title");

        /* Reset Form */
        function ResetForm() {
            $(AddEditClassForm).parsley().reset();

            addEditModelIdElement.val(0);
            classNameElement.val("");
        }

		schoolIdElement.change(function(){
			getGradeDropDown();
		});

        /* Open Add Model */
        function openAddModal(modelSelector) {
            ResetForm();
            modelTitleElement.html("Add " + pageTitle);
            @if( !($schoolId > 0) )
			    getGradeDropDown();
			@endif
            openModal(modelSelector);
        }

        /* Add Edit Ajax Call */
        $(AddEditClassForm).submit(function (event) {

            if ($(AddEditClassForm).parsley().validate()) {

                event.preventDefault();

                showLoader();

                jQuery.ajax({
                    url: window.addEditClassUrl,
                    method: 'post',
                    dataType: 'JSON',
                    data: {
                        '_token': window._token,
                        'class_id': addEditModelIdElement.val(),
                        'class_name': classNameElement.val(),
                        'school_id': schoolIdElement.val(),
                        'grade_id': gradeIdElement.val(),
                        'status': statusElement.val(),
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
			addEditModelIdElement.val(data.class_id);
			schoolIdElement.val(data.school_id);
            classNameElement.val(data.class_name);
            statusElement.val(data.status);
            @if( !empty($schoolId) && $schoolId > 0 )
                gradeIdElement.val(data.grade_id);
            @else
                getGradeDropDown();
                setTimeout(function () {
                    gradeIdElement.val(data.grade_id);
                }, 300);
            @endif
        }

		function openEditModal(modelSelector, id) {
            showLoader();
            jQuery.ajax({
                url: window.getDataForClassEditUrl,
                method: 'post',
                dataType: 'JSON',
                data: {
                    '_token': window._token,
                    'class_id': id,
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
