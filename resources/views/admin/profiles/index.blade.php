@extends('layouts.admin')

@section('title', 'Profiles')
@section('menu-title', 'Profiles')

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

        @include('admin.profiles.partials.sections.datatables')
        @include('admin.profiles.partials.sections.modal')

    </div>
    <!-- /.container-fluid -->

@endsection

@section('scripts')
    
    @include('admin.profiles.partials.scripts.datatables')
    @include('admin.profiles.partials.scripts.actions')
    
@endsection