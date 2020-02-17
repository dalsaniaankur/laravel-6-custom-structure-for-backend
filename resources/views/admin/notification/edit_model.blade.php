<div class="modal add-edit-model" id="notification_model">
    <div class="modal-dialog">

        {!! Form::open(['method' => 'POST','enctype' => 'multipart/form-data','name'=>'add-edit-notification-model-form', 'id' =>'add_edit_notification_model_form', 'class'=>'login-form px-md-4 add-edit-form-model','data-parsley-validate']) !!}

        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
				 <h4 class="modal-title" >Add Notification</h4>

                {!! Form::hidden('id', 0, array('id' => 'add_edit_model_id')) !!}

                <div class="row">

					@if( $isInsert )
						<div class="multi-select-check-box">
							{!! Form::label('user_id', 'Select Customer', ['class' => '']) !!}
							{!! Form::select('user_id', $userDropDownList, '', ['multiple' => 'multiple', 'id'=>'user_id']) !!}
						</div>
					@endif

					<div class="col-lg-12 mt-4">
					{!! Form::label('message', 'Message', ['class' => '']) !!} <br>
					{!! Form::textarea('description', '', ['id'=>'description', 'class' => 'form-control mb-4 popup_msghit', 'rows' => 9, 'required' => '']) !!}
					</div>

					@if( $isInsert )
						{!! Form::label('notification_type', 'Notification Type', ['class' => '']) !!}<br>

						{{ Form::radio('notification_type', 'instant' , true) }}
						<span class="mr-2">Instant</span>

						{{ Form::radio('notification_type', 'schedule' , false) }}
						<span>Schedule</span>
					@endif

					@php ($dateClass = $isInsert ? 'display-none' : '')
					<div class="display_date_parent {{$dateClass}} mt-4 col-lg-12">
						{!! Form::label('display_date', 'Display Date', ['class' => '']) !!}
						{!! Form::text('display_date', '', ['class' => 'form-control mb-4', 'data-toggle' => 'datetimepicker', 'autocomplete' => 'Off', 'data-parsley-trigger'=>'change' ]) !!}
					</div>
				</div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                {!! Form::Submit(trans('admin.qa_save'), ['class' => 'btn btn_green mt-4 mb-5']) !!}
            </div>

        </div>

        {!! Form::close() !!}
    </div>
</div>

