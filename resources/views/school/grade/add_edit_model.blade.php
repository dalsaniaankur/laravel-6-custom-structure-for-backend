<div class="modal add-edit-model">
    <div class="modal-dialog">

        {!! Form::open(['method' => 'POST','enctype' => 'multipart/form-data','name'=>'add-edit-form', 'class'=>'px-md-4','data-parsley-validate']) !!}

        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body modal_success">
                <h4 class="modal-title mb-0" ><span class="title">Add</span> Grade</h4>
                <div class="mb-5">
                    <span class="is-school-in">In</span>
                    <span class="is-school-name">({{ ucfirst(Auth::guard('school')->user()->school_name) }})</span>
                </div>
                <div class="col-lg-12 col-lg-12">
                    <div class="row">
                        @include('backend.partials.model.form_field')
                    </div>
                </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <div class="form-edit-profilebtn saveh1">
                    {!! Form::Submit(trans('admin.qa_save'), ['class' => 'btn btn_green mt-4 mb-5']) !!}
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>

