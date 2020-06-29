@extends('layouts.admin')

@section('title', 'Dashboard')
@section('menu-title', 'Dashboard')

@section('styles')
<style>
    .sidebar .sidebar-brand{
        text-align: left;
        text-transform: none;
    }
</style>
@endsection

@section('contents')


    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        {{-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1> --}}
        {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> --}}
        {{-- </div> --}}

        @if (Auth::user()->role == 0 || Auth::user()->role == 1)
            <!-- Content Row -->
            <div class="row">
                
                <!-- Online Admission Card -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-danger shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Online Admissions</div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800" id="online-admissions"></div>
                                </div>
                                <div class="col">
                                    <div class="progress progress-sm mr-2">
                                        <div class="progress-bar bg-info" role="progressbar" style="" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" id="online-admission-percent"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            {{-- <i class="fas fa-comments fa-2x text-gray-300"></i> --}}
                            <i class="fas fa-user-plus fa-2x"></i>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>

                <!-- Instructors Card -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Instructors</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="instructors"></div>
                        </div>
                        <div class="col-auto">
                            {{-- <i class="fas fa-teacher fa-2x text-gray-300"></i> --}}
                            <i class="fas fa-chalkboard-teacher fa-2x"></i>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>

                <!-- Students Card -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Students</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="students"></div>
                        </div>
                        <div class="col-auto">
                            {{-- <i class="fas fa-clipboard-list fa-2x text-gray-300"></i> --}}
                            <i class="fas fa-user-graduate fa-2x"></i>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>

                <!-- Subjects Card -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Subjects</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="subjects"></div>
                        </div>
                        <div class="col-auto">
                            {{-- <i class="fas fa-calendar fa-2x text-gray-300"></i> --}}
                            <i class="fas fa-book fa-2x"></i>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>

            </div>
        @endif

        <!-- Content Column -->
        <div class="">

            <!-- Announcements -->
            <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Announcements</h6>
            </div>
            <div class="card-body px-3">
                <!-- Color System -->
                <div class="mb-4">
                    @if (Auth::user()->role != 3)    
                        <div class="card bg-danger text-white shadow">
                            <div class="card-body text-white">
                                <h5>No Announcements at the moment.</h5>
                                <p>This section will just automatically update once an announcement becomes available for you to view.</p>
                            </div>
                        </div>
                    @endif
                    @if (Auth::user()->role == 0 || Auth::user()->role == 1 || Auth::user()->role == 3)
                        <div class="card">
                            <div class="alert alert-success mb-0">
                                <strong>Reminder: </strong>
                                <p>All students must fillout the Guidance Center Student Profile Form</p>
                                <a href="https://docs.google.com/forms/d/e/1FAIpQLSfpgUFCgZoIS5e4MEYfMNrj5doQB7xKweyZumPzCUvQ_dmmrQ/viewform" class="btn btn-warning btn-sm m-0" target="_blank">Fill out the form</a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            

        </div>

    </div>
    <!-- /.container-fluid -->

@endsection
@section('scripts')
    <script>
        $(document).ready(function(){
            let id = "{{ Auth::user()->profile_id }}";
            let route = "{{ route('profile.check','id') }}";
            let profileCheckUrl = route.replace('id',id);
            
            let profileRoute = "{{ route('profile.show','id') }}";
            let location = profileRoute.replace('id',id);
            $.ajax({
                url: profileCheckUrl,
                type: 'GET',
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(data){
                    if(data.complete_profile != 1){
                        Swal.fire({
                            icon: 'info',
                            title: 'Incomplete Profile',
                            text: 'Please do a final review of your profile and hit update button inside "Edit Profile" tab'
                        }).then(function() {
                            window.location.href = location;
                        })
                    }
                }
            });

            $.ajax({
                url: "{{ route('dashboard.check') }}",
                type: 'GET',
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(data){
                    console.log(data);
                    let admissions = (data.enrolled.length / data.requests.length)*100;
                    let percent = admissions.toFixed(1);
                    $('#online-admissions').text(percent+'%');
                    $('#online-admission-percent').attr('style','width: '+percent+'%');
                    if(percent < 75){
                        $('#online-admission-percent').removeClass('bg-info');
                        $('#online-admission-percent').addClass('bg-danger');
                    }
                    $('#instructors').text(data.instructors.length);
                    $('#students').text(data.students.length);
                    $('#subjects').text(data.subjects.length);
                }
            });
        })
    </script>
@endsection