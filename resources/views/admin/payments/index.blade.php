@extends('layouts.admin')

@section('title', 'Payment')
@section('menu-title', 'Payments')

@section('styles')
<style>
</style>
@endsection

@section('contents')


    <!-- Begin Page Content -->
    <div class="container-fluid">

        @include('admin.payments.partials.sections._table')
        @include('admin.payments.partials.sections._payment-modal')
    </div>
    <!-- /.container-fluid -->

@endsection

@section('scripts')
    
    @include('admin.payments.partials.scripts._datatables')
    @include('admin.payments.partials.scripts._actions')
    
@endsection