@extends('layouts.admin')

@section('title', 'Billing Account')
@section('menu-title', 'Billing Account')

@section('contents')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                @include('admin.student-view.billing-account.sections.profile-contents')
                @include('admin.student-view.billing-account.sections.billing-profile')
            </div>
        </div>
    </div>
@endsection