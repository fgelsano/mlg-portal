@extends('layouts.admin')

@section('title', 'Instructors')
@section('menu-title', 'Instructors')

@section('styles')

@endsection

@section('contents')


    <!-- Begin Page Content -->
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                @include('admin.0-partials._messages')
            </div>
        </div>
        @include('admin.instructors.partials.sections.table')

        @include('admin.instructors.partials.sections.modal')

    </div>
    <!-- /.container-fluid -->

@endsection

@section('scripts')
    @include('admin.instructors.partials.scripts.datatables')
    @include('admin.instructors.partials.scripts.actions')
    @include('admin.instructors.partials.scripts.instructorSave')
@endsection