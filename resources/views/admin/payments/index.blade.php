@extends('layouts.admin')

@section('title', 'Payments')
@section('menu-title', 'Payments')

@section('styles')
<style>
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

        @include('admin.payments.partials.sections._table')
        @include('admin.payments.partials.sections._payment-modal')
        @include('admin.payments.partials.sections._billing-modal')

    </div>
    <!-- /.container-fluid -->

@endsection

@section('scripts')
    
    @include('admin.payments.partials.scripts._datatables')
    @include('admin.payments.partials.scripts._actions')
    
@endsection