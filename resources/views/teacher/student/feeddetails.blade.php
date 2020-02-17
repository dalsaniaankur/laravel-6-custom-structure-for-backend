@extends('backend.layouts.app')
@section('title', 'Feed Details | '.trans('admin.backend_title'))
@section('content')
    <div class="main_section">

		<div class="container n_success">
            <div class="details_tabs mt-3">
                <a href="{{ url('teacher/student/profile')}}/{{ Common::getEncryptId($student->user_id) }}">Profile</a>
                <a href="{{ url('teacher/student/academics')}}/{{ Common::getEncryptId($student->user_id) }}">Academics</a>
                <a href="javascript:void(0);" class="active">feed</a>
            </div>
			<div class="page-wrap bx-shadow mt-3 mb-5">
            <div class="row user-dt-wrap">
                <div class="col-lg-12 col-md-12 pb-5">
					<h1 class="admin_bigheading mb-5 inlinebtn">Student Feed&nbsp;({{ $studentFeedsCount }})</h1>
                    <button type="button" class="btn light_blue float-right newbtn" onclick="openAddModal('#feed_model')">New Entry</button>
                    <div class="clear-both"></div>
                 {!! Form::open(['method' => 'GET','name'=>'student-feed-search', 'id' =>'student_feed_search_form', 'class'=>'top-search-options form-row pb-4 border_bottom','url' => url('teacher/student/feed/').'/'.Common::getEncryptId($student->user_id)]) !!}
                    <div class="col-md-3 col-lg-2">
                        <a href="{{ url('teacher/student/feed/').'/'.Common::getEncryptId($student->user_id) }}">
                            <button type="button" class="btn btn_green resetbtn mb-3">Reset</button>
                        </a>
                    </div>
                    <div class="col-md-4 col-lg-2 offset-lg-4 offset-md-0">
                        {!! Form::text('feed_date', $feedDate, ['class' => 'form-control date-field mb-3', 'placeholder' => 'Date','autocomplete' => 'Off', 'data-toggle'=>'datepicker']) !!}
                    </div>
                    <div class="col-md-4 col-lg-2">
                        {!! Form::select('sorted_order', ['ASC' => 'ASC','DESC' => 'DESC'], $sortedOrder, ['class' => 'form-control mb-3']) !!}
                    </div>
                    <div class="col-md-3 col-lg-2">
                        {!! Form::Submit('Sort', ['class' => 'btn btn_green resetbtn']) !!}
                    </div>
                    {!! Form::close() !!}


                </div>
                 <div class="col-lg-12 col-md-12 pb-5">
                 	<div class="row">
						@if(!empty($studentFeeds) && count($studentFeeds) > 0)
							@foreach($studentFeeds as $studentFeedKey => $studentFeed)
								<div class="col-lg-6 col-md-6">
									<div class="Aca_recentscore brd-after">
										<p class="inactive"><span>{{ $studentFeedKey+1}})</span>{{ DateFacades::dateFormat($studentFeed->feed_date,'format-6') }}</p>
										<p><span>Attendance:</span>{{ $studentFeed->attendance_status }}</p>
										<p><span>General:</span>
                                            {!! $studentFeed->general !!}
										</p>
										<p><span>Behavior:</span>
											{!! $studentFeed->behavior !!}
										</p>
										<p><span>Food:</span>
											{!! $studentFeed->food !!}
										</p>
										<p><span>Health & medical:</span>
											{!! $studentFeed->health_medical !!}
										</p>
										<p><span>Extra curricular:</span>
											{!! $studentFeed->extra_curricular !!}
										</p>
										<div class="user_score mt-3 mb-4">
											<p><span>Entered:</span>{{ DateFacades::dateFormat($studentFeed->created_at,'format-2') }}</p>
											<p><span>By:</span>{{ $studentFeed->createdby->getNameAttribute() }}</p>
										</div>
										<div class="feedbtns">
											<a href="javascript:void(0);"  onclick="openEditModal('#feed_model',{{ $studentFeed->student_feed_id }})"
                                                   class="btn_green">Edit</a>
											{!! Form::open(array(
                                                        'method' => 'DELETE',
                                                         'onsubmit' => "return confirm('".trans("admin.qa_are_you_sure_delete")." feed?');",
                                                        'route' => ['teacher.student.feed.delete'])) !!}
													{!! Form::hidden('id',$studentFeed->student_feed_id ) !!}
													<input id="del-user" class="delete btn_green" type="submit" value="Delete">
                                                {!! Form::close() !!}
										</div>
									</div>
								</div>
							@endforeach
                        @else
                            <div class="col-lg-12 col-md-12">
                                <div class="Aca_recentscore">
                                    @lang('admin.qa_no_entries_in_table')
                                </div>
                            </div>
                        @endif
                    </div>
                 </div>
            </div>
        </div>
    </div>
	</div>
	@include('teacher.student.add_edit_feedmodel')
@endsection
@section('javascript')
    <script>

        var form = 'form#admin_grade_search_form';
		var formAddEditForm = 'form#add_edit_feed_model_form';
        window.addEditUrl = "{{ URL::to('teacher/student/feed/ajax_save') }}";
        window.getDataForEditUrl = "{{ URL::to('teacher/student/feed/get_data') }}";

        pageTitle = "Activity";
        addEditModelIdElement = $(formAddEditForm + " #add_edit_model_id");
        userIdElement = $(formAddEditForm + " #user_id");
        generalNameElement = $(formAddEditForm + " #general");
        behaviorNameElement = $(formAddEditForm + " #behavior");
        foodNameElement = $(formAddEditForm + " #food");
        healthMedicalNameElement = $(formAddEditForm + " #health_medical");
        extraCurricularNameElement = $(formAddEditForm + " #extra_curricular");
        feedDateNameElement = $(formAddEditForm + " #feed_date");

        customErrorMessageElement = $(formAddEditForm + " .custom-error-message");
        customSuccessMessageElement = $(formAddEditForm + " .custom-success-message");
        modelTitleElement = $(".modal-title");

        /* Reset Form */
        function ResetForm() {
            $(formAddEditForm).parsley().reset();

            addEditModelIdElement.val(0);
            generalNameElement.val("");
            foodNameElement.val("");
            healthMedicalNameElement.val("");
            extraCurricularNameElement.val("");
            feedDateNameElement.val("");
			tinymce.get('general').setContent("");
			tinymce.get('behavior').setContent("");
			tinymce.get('food').setContent("");
			tinymce.get('health_medical').setContent("");
			tinymce.get('extra_curricular').setContent("");
            jQuery("input[name='attendance'][value='1']").prop('checked', true);
        }

        /* Open Add Model */
        function openAddModal(modelSelector) {
            ResetForm();
            modelTitleElement.html("Add " + pageTitle);
            feedDateNameElement.prop("disabled", false);
            openModal(modelSelector);
        }

        /* Add Edit Ajax Call */
        $(formAddEditForm).submit(function (event) {

            if ($(formAddEditForm).parsley().validate()) {

                event.preventDefault();

                showLoader();

                if(tinymce.get("general").getContent() == undefined || tinymce.get("general").getContent() == ''){
                    customErrorMessageElement.html("General value is required");
                    customErrorMessageElement.show();
                    hideLoader();
                    return false;
                }

                if(tinymce.get("behavior").getContent() == undefined || tinymce.get("behavior").getContent() == ''){
                    customErrorMessageElement.html("Behavior value is required");
                    customErrorMessageElement.show();
                    hideLoader();
                    return false;
                }

                if(tinymce.get("food").getContent() == undefined || tinymce.get("food").getContent() == ''){
                    customErrorMessageElement.html("Food value is required");
                    customErrorMessageElement.show();
                    hideLoader();
                    return false;
                }

                if(tinymce.get("health_medical").getContent() == undefined || tinymce.get("health_medical").getContent() == ''){
                    customErrorMessageElement.html("Health medical value is required");
                    customErrorMessageElement.show();
                    hideLoader();
                    return false;
                }

                if(tinymce.get("extra_curricular").getContent() == undefined || tinymce.get("extra_curricular").getContent() == ''){
                    customErrorMessageElement.html("Extra curricular value is required");
                    customErrorMessageElement.show();
                    hideLoader();
                    return false;
                }

                jQuery.ajax({
                    url: window.addEditUrl,
                    method: 'post',
                    dataType: 'JSON',
                    data: {
                        '_token': window._token,
                        'student_feed_id': addEditModelIdElement.val(),
                        'user_id': userIdElement.val(),
                        'general': tinymce.get("general").getContent(),
                        'behavior': tinymce.get("behavior").getContent(),
                        'food': tinymce.get("food").getContent(),
                        'health_medical': tinymce.get("health_medical").getContent(),
                        'extra_curricular': tinymce.get("extra_curricular").getContent(),
                        'feed_date': feedDateNameElement.val(),
                        'attendance': jQuery("input[name='attendance']:checked").val(),
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

            addEditModelIdElement.val(data.student_feed_id);
            feedDateNameElement.val(data.feed_date);
            jQuery("input[name='attendance'][value='"+ data.attendance + "']").prop('checked', true);

            tinymce.get("general").setContent(data.general);
            tinymce.get("food").setContent(data.food);
            tinymce.get("behavior").setContent(data.behavior);
            tinymce.get("health_medical").setContent(data.health_medical);
            tinymce.get("extra_curricular").setContent(data.extra_curricular);

        }

        function openEditModal(modelSelector, id) {
            showLoader();
            jQuery.ajax({
                url: window.getDataForEditUrl,
                method: 'post',
                dataType: 'JSON',
                data: {
                    '_token': window._token,
                    'student_feed_id': id,
                },
                success: function (response) {
                    if (response.success == true) {
                        ResetForm();
                        modelTitleElement.html("Edit " + pageTitle);
                        FormDataBind(response.data);
                        feedDateNameElement.prop("disabled", true);
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

        /* Tinymce */
        tinymce.init({
            selector: '.tinymce-for-feed',
            height: 150,
            menubar: false,
            plugins: [
                'advlist autolink lists link image charmap print preview anchor textcolor',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime media table paste code help wordcount'
            ],
            toolbar: 'bullist outdent indent ',

        });

    </script>
@endsection
