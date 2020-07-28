@extends('layouts.admin')

@section('title', 'User Emails')
@section('menu-title', 'User Emails')

@section('styles')
<style>
    
</style>
@endsection

@section('contents')


    <!-- Begin Page Content -->
    <div class="container-fluid">
        @include('admin.user-emails.partials.section.table')
    </div>
    <!-- /.container-fluid -->

@endsection

@section('scripts')
    @include('admin.user-emails.partials.scripts.datatables')
@endsection