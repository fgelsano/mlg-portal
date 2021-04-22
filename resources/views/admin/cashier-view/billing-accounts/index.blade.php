@extends('layouts.admin')

@section('title', 'Billing Accounts')
@section('menu-title', 'Billing Accounts')

@section('contents')
    <div class="container-fluid">
        @include('admin.cashier-view.billing-accounts.partials.sections.table')
    </div>
@endsection
@section('scripts')
    @include('admin.cashier-view.billing-accounts.partials.scripts.datatable')
@endsection