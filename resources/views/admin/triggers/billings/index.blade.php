@extends('layouts.admin')

@section('title', 'Billings Trigger')
@section('menu-title', 'Billings Trigger')

@section('styles')
<style>
    
</style>
@endsection

@section('contents')


    <!-- Begin Page Content -->
    <div class="container-fluid">

        @if ($status == 'success')
            <div class="alert alert-success">
                {{ $count }} records migrated to the Billings table.
            </div>
        @elseif ($status)
            <div class="alert alert-danger">
                {{ $failed }}
            </div>            
        @endif

    </div>
    <!-- /.container-fluid -->

@endsection

@section('scripts')
    
@endsection