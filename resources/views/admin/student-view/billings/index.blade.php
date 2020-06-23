@extends('layouts.admin')

@section('title', 'Billing')
@section('menu-title', 'Billing')

@section('styles')
<style>
    
</style>
@endsection

@section('contents')


    <!-- Begin Page Content -->
    <div class="container-fluid">

        {{-- @include('admin.students.partials.sections.table') --}}
        <div class="alert alert-danger">
            <strong>Sorry</strong> this module is not yet ready.
        </div>

    </div>
    <!-- /.container-fluid -->

@endsection

@section('scripts')
    @include('admin.students.partials.scripts.datatables')
@endsection