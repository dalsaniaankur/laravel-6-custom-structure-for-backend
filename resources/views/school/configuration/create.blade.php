@extends('backend.layouts.app')
@section('title', 'Settings | '.trans('admin.backend_title'))
@section('content')
    <main>
        <div class="container">

            <div class="page-wrap bx-shadow my-5 px-sm-5">

                <h1 class="big-heading mb-5">Settings</h1>

                <div class="row user-dt-wrap">

                    <div class="col-lg-12 pb-5 px-md-5">

                        {!! Form::open(['method' => 'POST','enctype' => 'multipart/form-data','name'=>'customer-edit-profile-form', 'id' =>'customer_edit_profile_form', 'class'=>'login-form px-md-4','data-parsley-validate','route' => ['school.setting.save']]) !!}

                        {{ csrf_field() }}

                        @if(count($configurationList)>0)

                            @foreach($configurationList as $key=>$value)

                                <div class="form-edit-profile">
                                    {!! Form::label($key,$value['label'], ['class' => '']) !!}
                                    {!! Form::text($value['key'], $value['value'], ['class' => 'form-control mb-4', 'placeholder' => '', 'required' => '']) !!}
                                    @include('backend.partials.message.field',['field_name' => $value['key']])
                                </div>
                            @endforeach

                        @endif

                        <div class="form-edit-profilebtn saveh1">
                            {!! Form::Submit(trans('admin.qa_save'), ['class' => 'btn btn_green mt-4']) !!}
                        </div>

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
