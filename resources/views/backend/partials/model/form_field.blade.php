@if(!empty($addFormFieldList))
    @foreach($addFormFieldList as $formFieldKey => $formField)



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

        @if(! isset($formField['id']))
            @php($formField['id'] = '')
        @endif

        @if(empty($formField['parent_class']))
            @php($formField['parent_class'] = "col-lg-6 col-md-6")
        @endif

        @if($formField['type'] == 'hidden')
            {!! Form::hidden($formField['name'], $formField['value'], $dataArray) !!}
        @endif

        @if($formField['type'] == 'text')
            <div class="{{ $formField['parent_class'] }}">
                {!! Form::label($formField['id'], $formField['label']) !!}
                {!! Form::text($formField['name'], $formField['value'], $dataArray) !!}
            </div>
        @endif
        @if($formField['type'] == 'email')
            <div class="{{ $formField['parent_class'] }}">
                {!! Form::label($formField['id'], $formField['label']) !!}
                {!! Form::email($formField['name'], $formField['value'], $dataArray) !!}
            </div>
        @endif
        @if($formField['type'] == 'dropdown')
            <div class="{{ $formField['parent_class'] }}">
                {!! Form::label($formField['id'], $formField['label']) !!}
                {!! Form::select($formField['name'], $formField['option'], $formField['value'], $dataArray) !!}
            </div>
        @endif
        @if($formField['type'] == 'datepicker')
            @php($dataArray['class'] = $dataArray['class'].' date-field')
            @php($dataArray['autocomplete'] = 'Off')
            @php($dataArray['data-toggle'] = 'datepicker')
            <div class="{{ $formField['parent_class'] }}">
                {!! Form::label($formField['id'], $formField['label']) !!}
                {!! Form::text($formField['name'], $formField['value'], $dataArray) !!}
            </div>
        @endif
    @endforeach
@endif
