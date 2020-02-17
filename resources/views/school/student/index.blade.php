@extends('backend.layouts.app')
@section('title', 'Students | '.trans('admin.backend_title'))
@section('content')
    <div class="main_section">
        <div class="container">
            <div class="page-wrap bx-shadow mt-5 mb-5">
                <div class="row user-dt-wrap">
                    <div class="col-sm-12">
                        <div class="page-heading">
                            <h1 class="admin_bigheading">Students ({{ $totalRecordCount }})</h1>
                            <a href="javascript:void(0)" onclick="openStudentModal('#student_model')"
                               class="btn btn-primary btn-lg">New student</a>
                        </div>
                        @include('backend.partials.filter.form_field')
                        @include('school.student.partials.table_with_sorting')
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('backend.partials.model.contact')
@endsection
@section('javascript')
    @include('backend.partials.model.contact_javascript')
@endsection

