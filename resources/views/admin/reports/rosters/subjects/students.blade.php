<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://ogp.me/ns/fb#">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="This the MLGCL Portal where custom school management functions reside.">
    <meta name="author" content="Francis Gelsano">
    <meta property="og:image" content="{{ asset('admin/img/MLG_Logo-Since-1999.jpg')}}" />
    <meta property="og:image:width" content="450"/>
    <meta property="og:image:height" content="298"/>
    <title>MLGCL | Roster for Subject {{ $subject->description }}</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('admin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Custom styles for this template-->
    <link href="{{ asset('admin/css/sb-admin-2.min.css') }}" rel="stylesheet">

    {{-- Favicon --}}
    <link rel="icon" type="image/png" href="{{ asset('admin/img/favicon.png') }}">

    {{-- FontAwesome --}}
    <script src="https://kit.fontawesome.com/2e85fc64c2.js" crossorigin="anonymous"></script>
    
    {{-- Merriweather Font --}}
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@300;700;900&display=swap" rel="stylesheet">

    {{-- DataTables --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">

    <!-- CSS -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
    <!-- Default theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/>
    <!-- Semantic UI theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.min.css"/>
    <!-- Bootstrap theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css"/>
    {{-- SweetAlert --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@9.14.4/dist/sweetalert2.min.css">

    {{-- Dropify --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/dropify@0.2.2/dist/css/dropify.min.css">

    <style>
        #profile-pic,
        #enroll-profile-pic{
            /* height: 250px; */
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

        #request-loading{
            z-index: 999;
            position: fixed;
            top: 45%;
            left: 45%;
            background: rgba(255, 255, 255, .5);
        }

        .merriweather{
            font-family: 'Merriweather', serif;
        }
        #logo{
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center;
        }
        #registrarSignature{
            position: relative;
            top: 25px;
        }
        @media print {
            .no-print{
                display: none;
            }
        }
    </style>

    @yield('styles')
</head>

<body>
    
    <img src="{{ asset('admin/img/loading-ellipsis.gif') }}" alt="request-loading" id="request-loading" class="d-none">
    <!-- Page Wrapper -->
    <div id="wrapper">

        <div class="container">
            <div class="row pt-5 pb-3 my-3 border-bottom">
                <div id="logo" class="col-12 col-md-1 text-right" style="background-image: url({{ asset('admin/img/MLG_Logo-Since-1999.jpg') }})"></div>
                <div class="col-12 col-md-6 px-0">
                    <h5 class="merriweather font-weight-bold m-0">MLG College of Learning, Inc</h5>
                    <p class="m-0 merriweather">Brgy. Atabay, Hilongos, Leyte</p>
                </div>
                <div class="col-12 col-md-5 text-right px-0 d-flex flex-column align-items-end align-self-end font-weight-bold">
                    <h3 class="text-uppercase merriweather m-0">Subject Roster</h3>
                </div>
            </div>
            <div id="subject-details" class="text-center py-3">
                <h4 class="merriweather">{{ $subject->code }}</h4>
                <h4 class="merriweather">{{ $subject->description }} <small>({{ $subject->subject_category }})</small></h4>
                <a href="{{ $subject->url }}">{{ $subject->url }}</a>
                <p class="m-0">{{ $subject->day }} | {{ $subject->time }} at {{ $subject->room_type == '0' ? 'Room' : '' }}{{ $subject->room_type == '1' ? 'Lab' : '' }} {{ $subject->location }}</p>
                <p class="badge m-0 px-3 py-1 {{ $subject->subject_type == '1' ? 'badge-primary' : 'badge-warning'}}">{{ $subject->subject_type == '0' ? 'Lecture' : 'Laboratory'}}</p>
                
            </div>
            <div class="row">
                <div class="col-12 col-md-6">
                    Instructor: <strong>{{ $subject->first_name }} {{ $subject->last_name }}</strong>
                </div>
                <div class="col-12 col-md-6 text-right">
                    <span class="font-weight-bold">{{ $students->count() }}</span> Students
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card border-0">
                        <div class="card-body px-0">
                            <div class="table-responsive">
                                <table id="students" class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Student Id</th>
                                            <th>Last Name</th>
                                            <th>First Name</th>
                                            <th>Course</th>
                                            <th>Year</th>
                                            <th class="no-print">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $count = 1;
                                        @endphp
                                        @foreach ($students->sortBy('last_name')->sortBy('gender') as $key => $student)
                                            <tr>
                                                <td>{{ $count }}</td>
                                                <td>{{ $student->school_id }}</td>
                                                <td>{{ $student->last_name }}</td>
                                                <td>{{ $student->first_name }}</td>
                                                <td>{{ $student->course }}</td>
                                                <td>
                                                    @if ($student->year_level == 1)
                                                        1st Year
                                                    @elseif ($student->year_level == 2)
                                                        2nd Year
                                                    @elseif ($student->year_level == 3)
                                                        3rd Year
                                                    @elseif ($student->year_level == 4)
                                                        4th Year
                                                    @endif
                                                </td>
                                                <td class="no-print"><button class="btn btn-sm btn-primary viewStudentProfile" data-id="{{ $student->student_id }}"><i class="fas fa-eye"></i> View Profile</button></td>
                                            </tr>
                                            @php
                                                $count++;
                                            @endphp
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <p class="bg-danger text-center py-2 text-white">
                This is a system-generated report. If you need a signed version, please bring a printed copy of this report to the school registrar.
            </p>
            <div class="row my-5 no-print">
                <div class="col-12 col-md-2">
                    <button id="printCOR" class="btn btn-warning btn-block">
                        <i class="fas fa-print"></i> Print
                    </button>
                </div>
            </div>

            @include('admin.reports.rosters.subjects.sections.student-modal')
        </div>

    </div>

    @section('scripts')
        @include('admin.reports.rosters.subjects.scripts.actions')
    @endsection
    <!-- End of Page Wrapper -->

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('admin/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('admin/js/sb-admin-2.min.js') }}"></script>

    {{-- DataTables --}}
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

    {{-- Alertify --}}
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    {{-- SweetAlert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.14.4/dist/sweetalert2.all.min.js"></script>

    <script>
        // Print
        $('#printCOR').click(function(){
            alert('IMPORTANT REMINDER!\n Enable the "Background Graphics" option first before printing.\n This will allow the images to be included in the printout.')
            window.print();
        })
    </script>

    @yield('scripts')

</body>

</html>