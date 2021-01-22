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
  <title>MLGCL | COR ({{ $profile->first_name }} {{ $profile->last_name }})</title>

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
  <!-- Page Wrapper -->
  <div id="wrapper">

    <div class="container">
        <div class="row py-5 my-3 border-bottom">
            <div id="logo" class="col-12 col-md-1 text-right" style="background-image: url({{ asset('admin/img/MLG_Logo-Since-1999.jpg') }})"></div>
            <div class="col-12 col-md-6 px-0">
                <h5 class="merriweather font-weight-bold m-0">MLG College of Learning, Inc</h5>
                <p class="m-0 merriweather">Brgy. Atabay, Hilongos, Leyte</p>
            </div>
            <div class="col-12 col-md-5 text-right px-0 d-flex flex-column align-items-end align-self-end font-weight-bold">
                <h3 class="text-uppercase merriweather m-0">Certificate of Registration</h3>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-12 table-responsive">
                <table class="table table-sm">
                    <thead>
                        <tr class="table-primary py-3">
                            <th scope="col" class="py-3">#</th>
                            <th scope="col" class="py-3">Code</th>
                            <th scope="col" class="py-3">Description</th>
                            <th scope="col" class="py-3">Instructor</th>
                            <th scope="col" class="py-3">Schedule</th>
                            <th scope="col" class="py-3">Type</th>
                            <th scope="col" class="py-3">Units</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php 
                            $totalUnits = 0; 
                            $count = 1;
                        @endphp
                        @foreach ($profile->enrollments as $key => $enrollment)
                            <tr>
                                @foreach ($subjects as $subject)
                                    @if($subject->subjectId == $enrollment->subject_id)
                                        <td>{{ $count }}.</td>
                                        <td class="code">{{ $subject->code }}</td>
                                        <td class="desc">{{ $subject->description }}</td>
                                        <td class="instructor">
                                            {{ $subject->first_name }} {{ $subject->last_name }}
                                        </td>
                                        <td class="schedule">
                                            {{ $subject->day }} | {{ $subject->time }} at 
                                            @if($subject->roomType == 0)
                                                Room {{ $subject->location }} 
                                            @elseif($subject->roomType == 1)
                                                Lab {{{ $subject->location }}} 
                                            @else
                                                Home 
                                            @endif
                                        </td>
                                        <td class="type">
                                            {!! $subject->type == 0 ? '<span class="badge badge-warning">Lecture</span>' : '<span class="badge badge-primary">Laboratory</span>'!!}
                                        </td>
                                        <td class="units text-center">{{ $subject->units }}</td>
                                        @php $count++ @endphp
                                        @php $totalUnits += $subject->units; @endphp
                                    @endif
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="row mb-3">
                    <div class="col-8 col-md-2 offset-9 text-right">
                        Total Units: 
                    </div>
                    <div class="col-4 col-md-1 text-center font-weight-bold">
                        {{ $totalUnits }}
                    </div>
                </div>
            </div>
        </div>
        
        <p class="text-center bg-danger text-white py-2">This is a system generated report. If you need a signed version of this report. Please bring a printed out copy of this report to the registrar's office for signing.</p>
        
        <div class="row mt-5">
            <div class="col-12 col-md-4">
                <h5>Approved by:</h5>
                {{-- <img src="{{ asset('admin/img/registrar-signature-no-bg.png') }}" alt="Registrar's Signature" width="50%" id="registrarSignature"> --}}
                <h5 class="mb-0 mt-5 text-uppercase font-weight-bold border-bottom">Emma Roa Wagas, MBA</h5>
                <p class="m-0">School Registrar</p>
            </div>
        </div>

        <div class="row my-5 no-print">
            <div class="col-12 col-md-2">
                <button id="printCOR" class="btn btn-warning btn-block">
                    <i class="fas fa-print"></i> Print
                </button>
            </div>
        </div>
    </div>

  </div>
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