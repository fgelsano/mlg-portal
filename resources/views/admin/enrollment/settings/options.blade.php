@extends('layouts.admin')

@section('title', 'Admission Requests')
@section('menu-title', 'Admission Requests')

@section('styles')
<style>
    .hover-shadow:hover {
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        cursor: pointer;
    }
    .popover{
        max-width: 80% !important;
    }
</style>
@endsection

@section('contents')


    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        {{-- <div class="d-sm-flex align-items-center justify-content-between mb-4"> --}}
        {{-- <h1 class="h3 mb-0 text-gray-800">All Requests</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> --}}
        {{-- </div> --}}
        <div class="row">
            <div class="col-12">
                @include('admin.0-partials._messages')
            </div>
        </div>
        @include('admin.enrollment.settings.partials.sections.table')

        @include('admin.enrollment.settings.partials.sections.modal')

    </div>
    <!-- /.container-fluid -->

@endsection

@section('scripts')
    @include('admin.enrollment.settings.partials.scripts.datatables')
    @include('admin.enrollment.settings.partials.scripts.crud')
    @include('admin.enrollment.settings.partials.scripts.actions')
@endsection