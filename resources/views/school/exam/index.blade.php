@extends('backend.layouts.app')
@section('title', 'Exams | '.trans('admin.backend_title'))
@section('content')
    <div class="main_section">
        <div class="container">
            <div class="page-wrap bx-shadow mt-5 mb-5">
                <div class="row user-dt-wrap">
                    <div class="col-lg-12 col-md-12">
                        <div class="page-heading">
                            <h1 class="admin_bigheading">Exams ({{ $totalRecordCount }})</h1>
                            <a href="javascript:void(0);" class="btn btn-primary btn-lg" onclick="openAddModal()">New exam</a>
                        </div>
                        @include('backend.partials.filter.form_field')
                        @include('school.exam.partials.table_with_sorting')
                    </div>
                </div>
            </div>
        </div>
    </div>
	@include('school.exam.add_edit_model')
@endsection
@section('javascript')
    <script>
        /* Save Ajax Call */
        jQuery(window._add_edit_model_element + ' form').submit(function (event) {
            event.preventDefault();
            if (jQuery(this).parsley().validate()) {
                var ajax_data = new FormData(jQuery(this)[0]);
                AjaxCall({
                    _url : "{{ URL::to('school/exam/ajax_save') }}",
                    _data : ajax_data,
                    _is_show_msg : true,
                    _is_page_reload : true,
                });
            }
        });

        /* Open Edit Model */
        function openEditModal(id, model_selector = ".add-edit-model") {
            if(model_selector == undefined || model_selector == '') {
                model_selector = window._add_edit_model_element;
            }
            openModal(model_selector,'',"Edit");
            var ajax_data = new FormData();
                ajax_data.append('exam_id', id);
            AjaxCall({
                _url : "{{ URL::to('school/exam/get_data') }}",
                _data : ajax_data,
                _callback_func : function(response){
                    if(response != undefined){
                        response.data.exam_date = moment(response.data.exam_date).format('MM/DD/YYYY');
                        FormDataBind(model_selector+' form', response.data);
                    }else{
                        toastr.error(window._ajax_error_msg_common);
                    }
                }
            });
        }
    </script>
@endsection
