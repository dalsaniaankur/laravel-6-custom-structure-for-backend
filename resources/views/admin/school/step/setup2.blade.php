@extends('backend.layouts.app')
@section('title', 'Create Grade | '.trans('admin.backend_title'))
@section('content')
<div class="main_section">
	<div class="container">
    	<div class="page-wrap bx-shadow mt-5 mb-5">
            <div class="row user-dt-wrap">
            	<div class="col-lg-12 col-md-12 pb-5">
                	<h1 class="bigheading mt-2 mb-5"><span class="number_round">2</span>Create grades</h1>
            		<div class="col-lg-12 px-md-3">
                         {!! Form::open(['method' => 'POST','enctype' => 'multipart/form-data','name'=>'admin-school-create', 'id' =>'admin_school_create_form', 'class'=>'school-create-form','data-parsley-validate','route' => ['admin.grade.create', Common::getEncryptId($schoolId) ]]) !!}
							{{ csrf_field() }}
							{!! Form::hidden('school_id', Common::getEncryptId($schoolId), array('id' => 'school_id')) !!}
                        	<div class="form-edit-profile">
                                {!! Form::label('grade_name', 'Grade') !!}
								{!! Form::text('grade_name', '', ['class' => 'form-control mb-4', 'required' => '', 'placeholder'=>'E.g Grade 1']) !!}
								@include('backend.partials.message.field',['field_name' => 'grade_name'])
                            </div>
                            <div class="form-edit-profilebtn inlinesavebtn">
								{!! Form::Submit(trans('admin.qa_save'), ['class' => 'btn save_btn_green btn_green mt-3']) !!}
                            </div>
                        {!! Form::close() !!}
						@if( count($gradeList) > 0 )
							<div class="clear-both mb-4"></div>
                   			<div class="setup_details">
								<div class="col-lg-5 col-md-9">
									<div class="table-responsive EMT_table">
										<table class="table sorting data-table">
											<tbody>
											@foreach($gradeList as $gradeKey => $grade )
												<tr>
													<td>
														<div class="setup3_bullet">
															<p>{{ $grade->grade_name }}</p>
															<p class="lightfont"><span>-</span>
															{{ DateFacades::dateFormat($grade->updated_at,'format-13') }}
															</p>
														</div>
													</td>
													<td class="EMT_icon">
														<a href="javascript:void(0);" onclick="openEditModal('#grade_model',{{ $grade->grade_id }})">
															<img src="{{ url('backend/images/edit.png') }}">
														</a>
														{!! Form::open(array(
                                                                    'method' => 'DELETE',
                                                                    'onsubmit' => "return confirm('".trans("admin.qa_are_you_sure_delete")." grade?');",
                                                                    'route' => ['admin.grade.delete'])) !!}

                                                            {!! Form::hidden('id', $grade->grade_id) !!}

                                                            <button type="submit" value="Delete" class="delete_btn"><i
                                                                        class="far fa-times-circle"></i></button>
                                                            {!! Form::close() !!}
													</td>
												</tr>
											@endforeach
											</tbody>
                                    </table>
                                </div>
                            </div>
                    </div>
						<div class="form-edit-profilebtn nextstep mt-5">
								 <a class="btn btn_green blue_btn" href="{{ url('admin/class/create/').'/'.Common::getEncryptId($schoolId) }}">Proceed to next step</a>
						</div>
					@endif
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@include('admin.school.step.grade_edit_model')
@endsection
@section('javascript')
	<script>
		var addEditGradeForm = 'form#add_edit_grade_model_form';
		window.addEditGradeUrl = "{{ URL::to('admin/grade/save_ajax') }}";
		window.getGradeDataForEditUrl = "{{ URL::to('admin/grade/get_data') }}";

		pageTitle = "grade";
		addEditGradeModelIdElement = $(addEditGradeForm + " #add_edit_grade_model_id");
		gradeNameElement = $(addEditGradeForm + " #grade_name");
		schoolIdElement = $(addEditGradeForm + " #school_id");
		customErrorMessageElement = $(addEditGradeForm + " .custom-error-message");
		customSuccessMessageElement = $(addEditGradeForm + " .custom-success-message");
		modelTitleElement = $(".modal-title");

		/* Reset Form */
		function ResetForm() {
			$(addEditGradeForm).parsley().reset();

			addEditGradeModelIdElement.val(0);
			gradeNameElement.val("");
		}

		/* Add Edit Ajax Call */
		$(addEditGradeForm).submit(function (event) {

			if ($(addEditGradeForm).parsley().validate()) {

				event.preventDefault();

				showLoader();

				jQuery.ajax({
					url: window.addEditGradeUrl,
					method: 'post',
					dataType: 'JSON',
					data: {
						'_token': window._token,
						'grade_id': addEditGradeModelIdElement.val(),
						'grade_name': gradeNameElement.val(),
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

			addEditGradeModelIdElement.val(data.grade_id);
			gradeNameElement.val(data.grade_name);

		}

		function openEditModal(modelSelector, id) {
			showLoader();
			jQuery.ajax({
				url: window.getGradeDataForEditUrl,
				method: 'post',
				dataType: 'JSON',
				data: {
					'_token': window._token,
					'grade_id': id,
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
