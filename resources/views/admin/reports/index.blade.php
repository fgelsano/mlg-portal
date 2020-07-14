@extends('layouts.admin')

@section('title', 'Reports')
@section('menu-title', 'Reports')

@section('styles')
<style>
    .merriweather{
        font-family: 'Merriweather', serif;
    }
    #logo{
        background-size: contain;
        background-repeat: no-repeat;
        background-position: center;
    }
    @media print {
        .no-print{
            display: none;
        }
        .card-body{
            padding-top: 5px;
            padding-bottom: 5px;
        }
        body,
        #wrapper #content-wrapper,
        .card-body{
            background-color: #fff !important;
        }
        .shadow{
            box-shadow: none !important;
        }
        .row {
            display: flex !important;
            flex-wrap: wrap !important;
            margin-right: -.75rem !important;
            margin-left: -.75rem !important;
        }
        .col-6 {
            flex: 0 0 50% !important;
            max-width: 50% !important;
        }
        #letterhead{
            display: block !important;
        }
    }
</style>
@endsection

@section('contents')


    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="merriweather p-3 d-none text-center" id="letterhead">
                <img src="{{ asset('admin/img/MLG_Logo-Since-1999.jpg') }}" width="10%">
                <h3 class="mb-0">MLG College of Learning, Inc</h3>
                <p class="mb-3">Brgy. Atabay, Hilongos, Leyte</p>
                <h3 class="text-uppercase mb-3">Enrollment Report</h3>
        </div>
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-12 col-md-8">
                        <i class="fas fa-chart-bar"></i> Enrollment Report as of <span id="report-date" class="text-primary font-weight-bold">{{ $today }}</span>
                    </div>
                    <div class="col-12 col-md-4 no-print d-none">
                        <input type="text" name="report-date-range" id="report-date-range" class="form-control form-control-sm input-sm">
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row" id="totalStudents">
                    <div class="col-12 mb-1">
                        <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    <i class="fas fa-user-plus fa-2x mr-3"></i> 
                                    Total Number of Enrolled Students
                                </div>
                            </div>
                            <div class="col-auto">
                                <h1>{{ $totalStudents->count() }}</h1>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    <!-- Card -->
                    <div class="col-12 col-md-3 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">First Years</div>
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="col-auto">
                                <h3>{{ $yearLevel['1'] }}</h3>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    <!-- Card -->
                    <div class="col-12 col-md-3 mb-4">
                        <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Second Years</div>
                                <i class="fas fa-user-friends"></i>
                            </div>
                            <div class="col-auto">
                                <h3>{{ $yearLevel['2'] }}</h3>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    <!-- Card -->
                    <div class="col-12 col-md-3 mb-4">
                        <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Third Years</div>
                                <i class="fas fa-users"></i>
                            </div>
                            <div class="col-auto">
                                <h3>{{ $yearLevel['3'] }}</h3>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    <!-- Card -->
                    <div class="col-12 col-md-3 mb-4">
                        <div class="card border-left-danger shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Fourth Years</div>
                                <i class="fas fa-user-graduate"></i>
                            </div>
                            <div class="col-auto">
                                <h3>{{ $yearLevel['4'] }}</h3>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row" id="totalBSIT">
                    <div class="col-12 mb-1">
                        <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">
                                    <i class="fas fa-user-plus fa-2x mr-3 text-warning"></i> 
                                    Total Number of <span class="font-weight-bold text-danger">BSIT</span> Students
                                </div>
                            </div>
                            <div class="col-auto">
                                <h2>{{ $totalIT }}</h2>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    <!-- Card -->
                    <div class="col-12 col-md-3 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">First Years</div>
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="col-auto">
                                <h3>{{ $yearIT['1'] }}</h3>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    <!-- Card -->
                    <div class="col-12 col-md-3 mb-4">
                        <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Second Years</div>
                                <i class="fas fa-user-friends"></i>
                            </div>
                            <div class="col-auto">
                                <h3>{{ $yearIT['2'] }}</h3>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    <!-- Card -->
                    <div class="col-12 col-md-3 mb-4">
                        <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Third Years</div>
                                <i class="fas fa-users"></i>
                            </div>
                            <div class="col-auto">
                                <h3>{{ $yearIT['3'] }}</h3>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    <!-- Card -->
                    <div class="col-12 col-md-3 mb-4">
                        <div class="card border-left-danger shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Fourth Years</div>
                                <i class="fas fa-user-graduate"></i>
                            </div>
                            <div class="col-auto">
                                <h3>{{ $yearIT['4'] }}</h3>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="row" id="totalBEED">
                    <div class="col-12 mb-1">
                        <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    <i class="fas fa-user-plus fa-2x mr-3"></i> 
                                    Total Number of <span class="font-weight-bold text-danger">BEED</span> Students
                                </div>
                            </div>
                            <div class="col-auto">
                                <h2>{{ $totalBEED }}</h2>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    <!-- Card -->
                    <div class="col-12 col-md-3 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">First Years</div>
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="col-auto">
                                <h3>{{ $yearBEED['1'] }}</h3>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    <!-- Card -->
                    <div class="col-12 col-md-3 mb-4">
                        <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Second Years</div>
                                <i class="fas fa-user-friends"></i>
                            </div>
                            <div class="col-auto">
                                <h3>{{ $yearBEED['2'] }}</h3>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    <!-- Card -->
                    <div class="col-12 col-md-3 mb-4">
                        <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Third Years</div>
                                <i class="fas fa-users"></i>
                            </div>
                            <div class="col-auto">
                                <h3>{{ $yearBEED['3'] }}</h3>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    <!-- Card -->
                    <div class="col-12 col-md-3 mb-4">
                        <div class="card border-left-danger shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Fourth Years</div>
                                <i class="fas fa-user-graduate"></i>
                            </div>
                            <div class="col-auto">
                                <h3>{{ $yearBEED['4'] }}</h3>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="row" id="totalBSEDMath">
                    <div class="col-12 mb-1">
                        <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    <i class="fas fa-user-plus fa-2x mr-3"></i> 
                                    Total Number of <span class="font-weight-bold text-danger">BSED-Math</span> Students
                                </div>
                            </div>
                            <div class="col-auto">
                                <h2>{{ $totalBSEDMath }}</h2>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    <!-- Card -->
                    <div class="col-12 col-md-3 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">First Years</div>
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="col-auto">
                                <h3>{{ $yearBSEDMath['1'] }}</h3>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    <!-- Card -->
                    <div class="col-12 col-md-3 mb-4">
                        <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Second Years</div>
                                <i class="fas fa-user-friends"></i>
                            </div>
                            <div class="col-auto">
                                <h3>{{ $yearBSEDMath['2'] }}</h3>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    <!-- Card -->
                    <div class="col-12 col-md-3 mb-4">
                        <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Third Years</div>
                                <i class="fas fa-users"></i>
                            </div>
                            <div class="col-auto">
                                <h3>{{ $yearBSEDMath['3'] }}</h3>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    <!-- Card -->
                    <div class="col-12 col-md-3 mb-4">
                        <div class="card border-left-danger shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Fourth Years</div>
                                <i class="fas fa-user-graduate"></i>
                            </div>
                            <div class="col-auto">
                                <h3>{{ $yearBSEDMath['4'] }}</h3>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="row" id="totalBSEDSocStu">
                    <div class="col-12 mb-1">
                        <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    <i class="fas fa-user-plus fa-2x mr-3"></i> 
                                    Total Number of <span class="font-weight-bold text-danger">BSED-SocStu</span> Students
                                </div>
                            </div>
                            <div class="col-auto">
                                <h2>{{ $totalBSEDSocStu }}</h2>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    <!-- Card -->
                    <div class="col-12 col-md-3 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">First Years</div>
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="col-auto">
                                <h3>{{ $yearBSEDSocStu['1'] }}</h3>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    <!-- Card -->
                    <div class="col-12 col-md-3 mb-4">
                        <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Second Years</div>
                                <i class="fas fa-user-friends"></i>
                            </div>
                            <div class="col-auto">
                                <h3>{{ $yearBSEDSocStu['2'] }}</h3>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    <!-- Card -->
                    <div class="col-12 col-md-3 mb-4">
                        <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Third Years</div>
                                <i class="fas fa-users"></i>
                            </div>
                            <div class="col-auto">
                                <h3>{{ $yearBSEDSocStu['3'] }}</h3>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    <!-- Card -->
                    <div class="col-12 col-md-3 mb-4">
                        <div class="card border-left-danger shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Fourth Years</div>
                                <i class="fas fa-user-graduate"></i>
                            </div>
                            <div class="col-auto">
                                <h3>{{ $yearBSEDSocStu['4'] }}</h3>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="row" id="totalBSEDSupplemental">
                    <div class="col-12 mb-1">
                        <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    <i class="fas fa-user-plus fa-2x mr-3"></i> 
                                    Total Number of <span class="font-weight-bold text-danger">BSED-Supplemental</span> Students
                                </div>
                            </div>
                            <div class="col-auto">
                                <h2>{{ $totalBSEDSupplemental }}</h2>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    <!-- Card -->
                    <div class="col-12 col-md-3 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">First Years</div>
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="col-auto">
                                <h3>{{ $yearBSEDSupplemental['1'] }}</h3>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    <!-- Card -->
                    <div class="col-12 col-md-3 mb-4">
                        <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Second Years</div>
                                <i class="fas fa-user-friends"></i>
                            </div>
                            <div class="col-auto">
                                <h3>{{ $yearBSEDSupplemental['2'] }}</h3>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    <!-- Card -->
                    <div class="col-12 col-md-3 mb-4">
                        <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Third Years</div>
                                <i class="fas fa-users"></i>
                            </div>
                            <div class="col-auto">
                                <h3>{{ $yearBSEDSupplemental['3'] }}</h3>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    <!-- Card -->
                    <div class="col-12 col-md-3 mb-4">
                        <div class="card border-left-danger shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Fourth Years</div>
                                <i class="fas fa-user-graduate"></i>
                            </div>
                            <div class="col-auto">
                                <h3>{{ $yearBSEDSupplemental['4'] }}</h3>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer no-print">
                <a href="#" class="btn btn-warning btn-sm" id="printReport">
                    <i class="fas fa-print mr-2"></i> Print Report
                </a>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

@endsection

@section('scripts')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <script>
        $(function() {
            $('#report-date-range').daterangepicker({
                opens: 'left'
            }, function(start, end, label) {
                console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
            });
        });
    </script>

    <script>
        // Print
        $('#printReport').click(function(){
            alert('IMPORTANT REMINDER!\n Enable the "Background Graphics" option first before printing.\n This will allow the images to be included in the printout.')
            window.print();
        })
    </script>
@endsection