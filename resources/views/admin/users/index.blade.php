@extends('layouts.admin')

@section('title', 'Users')
@section('menu-title', 'Users')

@section('styles')
<style>
    .profile-pic{
        width: 100px;
        height: 100px;
        background-size: cover;
        border-radius: 100px;
        background-position: center;
        margin: 0 auto;
    }
</style>
@endsection

@section('contents')


    <!-- Begin Page Content -->
    <div class="container-fluid">

        @include('admin.users.partials.sections.table')

        @include('admin.users.partials.sections.modal')

    </div>
    <!-- /.container-fluid -->

@endsection

@section('scripts')
    @include('admin.users.partials.scripts.datatables')
    @include('admin.users.partials.scripts.actions')
@endsection