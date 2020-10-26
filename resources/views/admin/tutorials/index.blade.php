@extends('layouts.admin')

@section('title', 'Tutorials')
@section('menu-title', 'Tutorials')

@section('styles')
<style>
    
</style>
@endsection

@section('contents')


    <!-- Begin Page Content -->
    <div class="container-fluid">

        
        <div class="card my-3">
            <div class="alert alert-success mb-0">
                <div class="row">
                    <div class="col-12 col-md-6 p-3">
                        <h4>LMS Tutorial (Desktop Version)</h4>
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe class="embed-responsive-item" width="560" height="315" src="https://www.youtube.com/embed/9l_EFtIStvI" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 p-3">
                        <h4>LMS Tutorial (Mobile Phone Version)</h4>
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe class="embed-responsive-item" width="560" height="315" src="https://www.youtube.com/embed/26bvXEUdEFs" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

@endsection

@section('scripts')
    
@endsection