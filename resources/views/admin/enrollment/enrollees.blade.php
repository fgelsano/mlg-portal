@extends('layouts.admin')

@section('title', 'Enrollees')
@section('menu-title', 'Enrollees')

@section('styles')
<style>

</style>
@endsection

@section('contents')


    <!-- Begin Page Content -->
    <div class="container-fluid">

        @include('admin.enrollment.enrollees-partials.sections.table')

    </div>
    <!-- /.container-fluid -->

@endsection

@section('scripts')
    @include('admin.enrollment.enrollees-partials.scripts.datatables')
@endsection