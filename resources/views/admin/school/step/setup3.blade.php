@extends('backend.layouts.app')
@section('title', 'Create school | '.trans('admin.backend_title'))
@section('content')
    <div class="main_section">
        <div class="container n_success">
            <div class="page-wrap bx-shadow mt-5 mb-5">
                <div class="row user-dt-wrap">
                    <div class="col-lg-12 col-md-12 pb-5">
                        <h1 class="bigheading mt-2 mb-5"><span class="number_round">3</span>Create classes</h1>

                        <div class="col-lg-12 px-md-3 pl0 pr0">

                            {!! Form::open(['method' => 'POST','enctype' => 'multipart/form-data','name'=>'add-grade-form', 'id' =>'add_grade_form', 'class'=>'','data-parsley-validate','route' => ['admin.class.save']]) !!}

                            {!! Form::hidden('school_id', $schoolId, array('id' => 'school_id')) !!}
                            {!! Form::hidden('status', 1, array('id' => 'status')) !!}

                            <div class="form-edit-profile">
                                {!! Form::label('grade_id', 'Grade') !!}
                                {!! Form::select('grade_id', $gradeDropDown, old('grade_id'), ['id' => 'grade_id', 'class' => 'form-control mb-4', 'required' => '']) !!}
                                @include('backend.partials.message.field',['field_name' => 'grade_id'])
                            </div>

                            <div class="form-edit-profile">
                                {!! Form::label('class_name', 'Class') !!}
                                {!! Form::text('class_name', old('class_name'), ['class' => 'form-control mb-4', 'required' => '','placeholder' => 'E.g 1 East']) !!}
                                @include('backend.partials.message.field',['field_name' => 'class_name'])
                            </div>

                            <div class="form-edit-profilebtn inlinesavebtn saveright">
                                {!! Form::Submit(trans('admin.qa_save'), ['class' => 'btn save_btn_green btn_green']) !!}
                            </div>

                            {!! Form::close() !!}

                            <div class="clear-both mb-4"></div>
                            <div class="setup_details">
                                <div class="col-lg-5 col-md-9">
                                    <div class="table-responsive EMT_table">
                                        <table class="table sorting data-table">
                                            <tbody>
                                            @if(!empty($classes) && count($classes) > 0)
                                                @foreach($classes as $classKey => $class)
                                                    <tr>
                                                        <td>
                                                            <div class="setup3_bullet">
                                                                <p>{{ $class->grade->grade_name }}
                                                                    <span>-</span>{{ $class->class_name }}</p>
                                                                <p class="lightfont">
                                                                    <span>-</span>{{ DateFacades::dateFormat($class->updated_at,'format-13') }}
                                                                </p>
                                                            </div>
                                                        </td>
                                                        <td class="EMT_icon">
                                                            {!! Form::open(array(
                                                                    'method' => 'DELETE',
                                                                    'onsubmit' => "return confirm('".trans("admin.qa_are_you_sure_delete")." class?');",
                                                                    'route' => ['admin.class.delete'])) !!}

                                                            {!! Form::hidden('id', $class->class_id) !!}

                                                            <button type="submit" value="Delete" class="delete_btn"><i
                                                                        class="far fa-times-circle"></i></button>
                                                            {!! Form::close() !!}
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
                            </div>

                            <div class="form-edit-profilebtn nextstep mt-5">
                                <a class="btn btn_green blue_btn" href="{{ url('admin/teacher/create/').'/'.Common::getEncryptId($schoolId) }}">Proceed to next step</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
