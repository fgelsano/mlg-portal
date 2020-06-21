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

    .first-name-label .ptxt,
    .middle-name-label .ptxt,
    .last-name-label .ptxt,
    .religion-label .ptxt,
    .purok-label .ptxt,
    .sitio-label .ptxt,
    .barangay-label .ptxt,
    .municipality-label .ptxt,
    .province-label .ptxt,
    .zipcode-label .ptxt,
    .emergency-contact-label .ptxt,
    .contact-label .ptxt,
    .school-graduated-label .ptxt,
    .school-address-label .ptxt,
    .year-graduated-label .ptxt,
    .lrn-label .ptxt,
    .gwa-label .ptxt {
        position: absolute !important;
        top: 20% !important;
        right: 35px !important;
    }

    @media (max-width: 575.98px) { 
        .first-name-label .ptxt,
        .middle-name-label .ptxt,
        .last-name-label .ptxt,
        .religion-label .ptxt,
        .purok-label .ptxt,
        .sitio-label .ptxt,
        .barangay-label .ptxt,
        .municipality-label .ptxt,
        .province-label .ptxt,
        .zipcode-label .ptxt,
        .emergency-contact-label .ptxt,
        .contact-label .ptxt,
        .school-graduated-label .ptxt,
        .school-address-label .ptxt,
        .year-graduated-label .ptxt,
        .lrn-label .ptxt,
        .gwa-label .ptxt {
            display: none;
        }
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
    @include('admin.profile.scripts.actions')    
@endsection