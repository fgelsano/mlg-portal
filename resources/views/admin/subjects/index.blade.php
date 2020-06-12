@extends('layouts.admin')

@section('title', 'Subjects')
@section('menu-title', 'Subjects')

@section('styles')
<style>
    .hover-shadow:hover {
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        cursor: pointer;
    }
    .popover{
        max-width: 80% !important;
    }
</style>
@endsection

@section('contents')


    <!-- Begin Page Content -->
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                @include('admin.0-partials._messages')
            </div>
        </div>
        @include('admin.subjects.partials.sections.table')

        @include('admin.subjects.partials.sections.modal')

    </div>
    <!-- /.container-fluid -->

@endsection

@section('scripts')
    @include('admin.subjects.partials.scripts.datatables')
    @include('admin.subjects.partials.scripts.actions')
    @include('admin.subjects.partials.scripts.subjectSave')
@endsection