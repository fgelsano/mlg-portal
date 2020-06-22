@extends('layouts.admin')

@section('title', 'Students')
@section('menu-title', 'Students')

@section('styles')
<style>
    
</style>
@endsection

@section('contents')


    <!-- Begin Page Content -->
    <div class="container-fluid">

        @include('admin.students.partials.sections.table')

    </div>
    <!-- /.container-fluid -->

@endsection

@section('scripts')
    @include('admin.students.partials.scripts.datatables')
@endsection