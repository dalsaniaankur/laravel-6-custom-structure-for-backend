@if(!empty($formFilterList))

{!! Form::open(['method' => 'GET','name'=>'search-form', 'id' =>'', 'class'=>'form-row','url' => url($filterUrl)]) !!}
@foreach($formFilterList as $formFieldKey => $formField)

    @php($dataArray = [])

    @if(!empty($formField['other_data']))
        @php($dataArray = $formField['other_data'])
    @endif

    @if(empty($dataArray['class']))
        @php($dataArray['class'] = "form-control mb-4")
        @if(isset($formField['class']))
            @php($dataArray['class'] = "form-control mb-4 ".$formField['class'])
        @endif
    @endif

    @if(empty($dataArray['placeholder']))
        @if(isset($formField['placeholder']))
            @php($dataArray['placeholder'] = $formField['placeholder'])
        @endif
    @endif

    @if(empty($dataArray['id']))
        @if(isset($formField['id']))
            @php($dataArray['id'] = $formField['id'])
        @endif
    @endif

    @if( empty($formField['value']) )
        @php($formField['value'] = old($formField['name']))
    @endif

    @if($formField['type'] == 'hidden')
        {!! Form::hidden($formField['name'], $formField['value'], $dataArray) !!}
    @endif

    @if($formField['type'] == 'text')
        <div class="col-md-4 col-sm-6">
            {!! Form::text($formField['name'], $formField['value'], $dataArray) !!}
        </div>
    @endif
    @if($formField['type'] == 'email')
        <div class="col-md-4 col-sm-6">
            {!! Form::email($formField['name'], $formField['value'], $dataArray) !!}
        </div>
    @endif
    @if($formField['type'] == 'dropdown')
        @if( empty($formField['option']) )
            @php($formField['option'] = [])
        @endif
        <div class="col-md-4 col-sm-6">
            {!! Form::select($formField['name'], $formField['option'], $formField['value'], $dataArray) !!}
        </div>
    @endif
    @if($formField['type'] == 'datepicker')
        @php($dataArray['class'] = 'form-control date-field mb-3')
        @php($dataArray['autocomplete'] = 'Off')
        @php($dataArray['data-toggle'] = 'datepicker')
        <div class="col-md-4 col-sm-6">
            {!! Form::text($formField['name'], $formField['value'], $dataArray) !!}
        </div>
    @endif
@endforeach
    <div class="col-md-4 col-sm-3">
        {!! Form::Submit(trans('admin.qa_search'), ['class'=>'btn btn-success filter-bar-btn mb-3']) !!}
    </div>
    <div class="col-md-4 col-sm-3">
        <a href="{{ url($filterUrl) }}"><button type="button" class="btn btn-danger filter-bar-btn">Reset</button></a>
    </div>
{!! Form::close() !!}
@endif
