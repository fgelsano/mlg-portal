@extends('layouts.admin')

@section('title', 'Profile')
@section('menu-title', 'Profile')

@section('styles')
<style>
    .uploaded-doc{
        height: 300px;
        position: relative;
        background-size: cover;
        background-repeat: no-repeat;
        border: 15px solid #fff;
        background-position: 0px -45px;
    }

    .uploaded-doc p{
        position: absolute;
        bottom: 5px;
        width: 90%;
    }

    .pass_show{
        position: relative
    } 

    .pass_show .ptxt { 
        position: absolute; 
        top: 50%; 
        right: 10px; 
        z-index: 1; 
        color: #f36c01; 
        margin-top: -10px; 
        cursor: pointer; 
        transition: .3s ease all; 
    } 

    .pass_show .ptxt:hover{
        color: #333333;
    } 
</style>
@endsection

@section('contents')


    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                @include('admin.profile.sections.tab-menus')
                <div class="tab-content" id="profileContents">
                    @include('admin.profile.sections.profile-contents')
                    @include('admin.profile.sections.edit-profile-contents')
                    @include('admin.profile.sections.password-reset-contents')
                </div>
            </div>
        </div>
        
    </div>
    <!-- /.container-fluid -->

@endsection

@section('scripts')
    @include('admin.profile.scripts.onload-scripts')    
@endsection