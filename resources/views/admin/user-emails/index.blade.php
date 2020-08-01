@extends('layouts.admin')

@section('title', 'User Emails')
@section('menu-title', 'User Emails')

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
        @include('admin.user-emails.partials.sections.table')
    </div>
    <!-- /.container-fluid -->
    @include('admin.user-emails.partials.sections.actions-modal')
@endsection

@section('scripts')
    @include('admin.user-emails.partials.scripts.datatables')
    @include('admin.user-emails.partials.scripts.actions')
@endsection