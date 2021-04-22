@extends('layouts.admin')

@section('title', 'Billing Account of '.$profile->first_name.' '.$profile->last_name)
@section('menu-title', 'Billing Account of '.$profile->first_name.' '.$profile->last_name)

@section('contents')
    <div class="container-fluid">
        @include('admin.cashier-view.billing-accounts.view-billing-account.sections.profile')
        @include('admin.cashier-view.billing-accounts.view-billing-account.sections.billing-profile')
        @include('admin.cashier-view.billing-accounts.view-billing-account.sections.add-billing-modal')
    </div>
@endsection
@section('scripts')
    @include('admin.cashier-view.billing-accounts.view-billing-account.scripts.actions')
@endsection