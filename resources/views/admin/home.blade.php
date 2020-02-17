@extends('backend.layouts.app')
@section('title', 'Admin Home | '.trans('admin.backend_title'))
@section('content')
    <div class="main_section">
        <div class="container">
            <div class="page-wrap bx-shadow mt-5 mb-5">
                <div class="row">
                    @include('backend.partials.home.total_small_box')
                </div>
                <div class="row">
                    @include('backend.partials.home.dashboard_box')
                    <div class="col-lg-6 pt-3">
                        <h2 class="pr-box-heading">Recent schools</h2>
                        @include('backend.partials.home.recent_user_table')
                    </div>
                </div>
                <div class="row dashboard-wrap mt-4 clear-both">
                    @include('backend.partials.home.total_big_box')
                </div>
            </div>
        </div>
    </div>
@endsection
