@extends('layouts.admin')

@section('title', 'Cashier\'s Hold')
@section('menu-title', 'Cashier\'s Hold')

@section('styles')
<style>
    #profile-pic,
    #enroll-profile-pic{
        /* height: 250px; */
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
        @include('admin.enrollment.cashier.partials.sections.table')
    </div>
    <!-- /.container-fluid -->

    @include('admin.enrollment.cashier.partials.sections.student-modal')

@endsection

@section('scripts')
    @include('admin.enrollment.cashier.partials.scripts.datatables')
    @include('admin.enrollment.cashier.partials.scripts.actions')
@endsection