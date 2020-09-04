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
    /* .datatables-container {
        height: 250px !important;
        overflow: auto !important;
    } */
    #enroll-subjects{
        width: 100%!important;
    }

    .uploaded-doc{
        height: 300px;
        position: relative;
        background-size: cover;
        background-repeat: no-repeat;
        border: 15px solid #fff;
    }

    .uploaded-doc p{
        position: absolute;
        bottom: 5px;
        width: 90%;
    }

    #profile-pic,
    #enroll-profile-pic{
        height: 250px;
        position: relative;
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
    }

    #profile-pic p,
    #enroll-profile-pic p{
        position: absolute;
        bottom: 5px;
        width: 90%;
    }

    #reject-reason{
        width: 100%;
    }

    #course{
        font-size: 2em;
    }

    #request-loading{
        z-index: 999;
        position: fixed;
        top: 45%;
        left: 45%;
        background: rgba(255, 255, 255, .5);
    }
</style>
@endsection

@section('contents')

    <img src="{{ asset('admin/img/loading-ellipsis.gif') }}" alt="request-loading" id="request-loading" class="d-none">

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
        @include('admin.enrollment.requests.partials.sections.table')

        @include('admin.enrollment.requests.partials.sections.request-modal')

    </div>
    <!-- /.container-fluid -->

@endsection

@section('scripts')
    @include('admin.enrollment.requests.partials.scripts.datatables')

    @include('admin.enrollment.requests.partials.scripts.evaluate')

    @include('admin.enrollment.requests.partials.scripts.reject')

    @include('admin.enrollment.requests.partials.scripts.registrarAccept')
@endsection