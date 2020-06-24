@extends('layouts.admin')

@section('title', 'Students')
@section('menu-title', 'Students')

@section('styles')
<style>
    .uploaded-doc{
        height: 300px;
        position: relative;
        background-size: cover;
        background-repeat: no-repeat;
        border: 15px solid #fff;
    }

    .uploaded-doc p{
        position: absolute;
        bottom: 5px;
        width: 90%;
    }

    #profile-pic,
    #enroll-profile-pic{
        height: 250px;
        position: relative;
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
    }

    #profile-pic p,
    #enroll-profile-pic p{
        position: absolute;
        bottom: 5px;
        width: 90%;
    }

    #reject-reason{
        width: 100%;
    }

    #course{
        font-size: 2em;
    }
</style>
@endsection

@section('contents')


    <!-- Begin Page Content -->
    <div class="container-fluid">

        @include('admin.students.partials.sections.table')
        @include('admin.students.partials.sections.profile-modal')

    </div>
    <!-- /.container-fluid -->

@endsection

@section('scripts')
    @include('admin.students.partials.scripts.datatables')
    @include('admin.students.partials.scripts.actions')
@endsection