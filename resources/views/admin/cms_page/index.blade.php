@extends('backend.layouts.app')
@section('title', 'Cms pages | '.trans('admin.backend_title'))
@section('content')
    <div class="main_section">
        <div class="container">
            <div class="page-wrap bx-shadow mt-5 mb-5">
                <div class="row user-dt-wrap">
                    <div class="col-lg-12 col-md-12 pb-5">
                        <h1 class="admin_bigheading">Cms pages ({{ $totalRecordCount }})</h1>

                        <div class="clear-both"></div>

						<div class="col-lg-11 col-md-12">
                        <div class="table-responsive mt-5">
                            <table class="table sorting data-table messages" id="classes">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>PAGE CONTENT</th>
                                    <th>IMAGE</th>
                                    <th>UPDATED</th>
                                    <th class="actionwidth">ACTION</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(!empty($cmsPages) && count($cmsPages) > 0)
                                    @foreach($cmsPages as $cmsPageKey => $cmsPage)
                                        <tr>
                                            <td class="data-id"><span>{{ ++$recordStart  }}</span></td>
                                            <td><div class="elips"><b>{{ $cmsPage->content  }}</b></div></td>
                                            <td>
                                                @if ( !empty($cmsPage->image_path) && Common::isFileExists($cmsPage->image_path) )
                                                    <div><img src="{{ url($cmsPage->image_path) }}" alt="Image" width="100"></div>
                                                    <div class="action_div">
                                                        {!! Form::open(array(
                                                        'method' => 'DELETE',
                                                         'onsubmit' => "return confirm('".trans("admin.qa_are_you_sure_delete")." image?');",
                                                        'route' => ['admin.cms_page.delete_image'])) !!}
                                                        {!! Form::hidden('id',$cmsPage->page_id ) !!}
                                                        <button type="submit" value="Delete" class="delete_btn"><i
                                                                class="far fa-trash-alt"></i></button>

                                                        {!! Form::close() !!}
                                                    </div>
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>
                                                <b>{{ DateFacades::dateFormat($cmsPage->updated_at,'format-3') }}</b><br>
                                                {{ DateFacades::dateFormat($cmsPage->updated_at,'time-format-1') }}
                                            </td>
                                            <td class="action_div">
                                            	<div class="action_club edit_center">
                                                <a href="javascript:void(0);"  onclick="openEditModal('#cms_page_model',{{ $cmsPage->page_id }})"
                                                   class="viewbtn">EDIT</a>
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
	@include('admin.cms_page.edit_model')
@endsection
@section('javascript')
    <script>
        var form = 'form#admin_cms_page_search_form';
		var formAddEditForm = 'form#add_edit_cms_page_model_form';
        window.addEditUrl = "{{ URL::to('admin/cms-page/save_ajax') }}";
        window.getDataForEditUrl = "{{ URL::to('admin/cms-page/get_data') }}";

        pageTitle = "cms page";
        addEditModelIdElement = $(formAddEditForm + " #add_edit_model_id");
        contentElement = $(formAddEditForm + " #content");
        customErrorMessageElement = $(formAddEditForm + " .custom-error-message");
        customSuccessMessageElement = $(formAddEditForm + " .custom-success-message");
        modelTitleElement = $(".modal-title");

        /* Reset Form */
        function ResetForm() {
            $(formAddEditForm).parsley().reset();

            addEditModelIdElement.val(0);
            contentElement.val("");
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

                var formData = new FormData($(this)[0]);
                jQuery.ajax({
                    url: window.addEditUrl,
                    enctype: 'multipart/form-data',
                    method: 'post',
                    dataType: 'JSON',
                    processData: false,
                    contentType: false,
                    cache: false,
                    data : formData,
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

            addEditModelIdElement.val(data.page_id);
            contentElement.val(data.content);
        }

        function openEditModal(modelSelector, id) {
            showLoader();
            jQuery.ajax({
                url: window.getDataForEditUrl,
                method: 'post',
                dataType: 'JSON',
                data: {
                    '_token': window._token,
                    'page_id': id,
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
