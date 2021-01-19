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
  <title>MLGCL | @yield('title')</title>

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
    .sidebar-dark .nav-item.active{
      background: #6885D9;
    }

    .modal {
      overflow-y: auto !important;
    }
    #alerts-list{
      height: 300px;
      overflow: auto;
    }
    @media print {
        .no-print{
            display: none !important;
        }
        .card{
          background-color: #fff;
        }
    }
  </style>

  @yield('styles')
</head>

<body>
  <!-- Page Wrapper -->
  <div id="wrapper">

    @include('admin.0-partials._sidebar')

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
    <div id="content">
        @include('admin.0-partials._topbar')
        @yield('contents')
    </div>
    <!-- End of Main Content -->
      
      @include('admin.0-partials._footer')
      
      @include('admin.0-partials._logout-modal')
    </div>
    <!-- End of Content Wrapper -->

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

  {{-- Dropify --}}
  <script src="https://cdn.jsdelivr.net/npm/dropify@0.2.2/src/js/dropify.min.js"></script>

  {{-- Notifications Check --}}
  <script>
    checkNotifications();
    
    setInterval(function() {
        checkNotifications();
    }, 5 * 1000); 

    function checkNotifications(){
      let routeUrl = "{{ route('notifications.check') }}";
        $.ajax({
            url: routeUrl,
            type: 'GEt',
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(data){
              if($('#alerts-list').attr('data-role') == 0 || $('#alerts-list').attr('data-role') == 1){
                let totalAlert = data.forEnrollments.length + data.newAdmissions.length;
                $('#alerts-list').empty();
                if(totalAlert > 0){
                  $('#no-alerts').addClass('d-none');
                } else {
                  $('#no-alerts').removeClass('d-none');
                }
                let newForEnrollmentAlert = '';
                let newAdmissionAlert = '';

                if(data.forEnrollments.length > 0){
                  $('#alerts-badge').removeClass('d-none');
                  $('#alerts-badge').text(totalAlert);
                  $('#for-enrollments-counter').text(data.forEnrollments.length);
                  $('#for-enrollments-counter').removeClass('d-none');
                  if(!isEmpty($('#alerts-list'))){
                    let forEnrollmentsCount = data.forEnrollments.length;

                    if($('.alert-date:last').attr('data-time') == 'For Enrollment'){
                      if(!data.forEnrollments[forEnrollmentsCount-1].updated_at == $('.alert-date:last').attr('data-time')){
                        $.each(data.forEnrollments, function(key, value){
                          let alertDate = parseDate(value.updated_at);
                          newForEnrollmentAlert = '<a class="dropdown-item d-flex align-items-center" href="{{ route('for-enrollment.index') }}">'+
                                                  '<div class="mr-3">'+
                                                    '<div class="icon-circle bg-primary">'+
                                                    '<i class="fas fa-file-import text-white"></i>'+
                                                    '</div>'+
                                                  '</div>'+
                                                  '<div>'+
                                                    '<div class="small text-gray-500 alert-date" data-time="'+value.updated_at+'" data-notification="For Enrollment">'+alertDate+'</div>'+
                                                    '<span class="font-weight-bold">'+value.first_name+' '+value.last_name+' is now ready for enrollment</span>'+
                                                  '</div>'+
                                                '</a>';
                          $('#alerts-list').append(newForEnrollmentAlert)
                        })
                      }
                    }
                  } else {
                    $.each(data.forEnrollments, function(key, value){
                        let alertDate = parseDate(value.updated_at);
                        newForEnrollmentAlert = '<a class="dropdown-item d-flex align-items-center" href="{{ route('for-enrollment.index') }}">'+
                                                '<div class="mr-3">'+
                                                  '<div class="icon-circle bg-primary">'+
                                                  '<i class="fas fa-file-import text-white"></i>'+
                                                  '</div>'+
                                                '</div>'+
                                                '<div>'+
                                                  '<div class="small text-gray-500 alert-date" data-time="'+value.updated_at+'" data-notification="For Enrollment">'+alertDate+'</div>'+
                                                  '<span class="font-weight-bold">'+value.first_name+' '+value.last_name+' is now ready for enrollment</span>'+
                                                '</div>'+
                                              '</a>';
                        $('#alerts-list').append(newForEnrollmentAlert)
                      })
                  }
                } else {
                  $('#for-enrollments-counter').addClass('d-none');
                }
                
                if(data.newAdmissions.length > 0){
                  $('#alerts-badge').removeClass('d-none');
                  $('#alerts-badge').text(totalAlert);
                  $('#new-requests-counter').text(data.newAdmissions.length);
                  $('#new-requests-counter').removeClass('d-none');
                  if(!isEmpty($('#alerts-list'))){
                    let admissionsCount = data.newAdmissions.length;
                    
                    if($('.alert-date:last').attr('data-time') == 'New Admission'){
                      if(!data.newAdmissions[admissionsCount-1].created_at == $('.alert-date:last').attr('data-time')){
                        $.each(data.newAdmissions, function(key, value){
                          let alertDate = parseDate(value.created_at);
                          newAdmissionAlert = '<a class="dropdown-item d-flex align-items-center" href="{{ route('requests.index') }}">'+
                                                  '<div class="mr-3">'+
                                                    '<div class="icon-circle bg-success">'+
                                                    '<i class="fas fa-file-alt text-white"></i>'+
                                                    '</div>'+
                                                  '</div>'+
                                                  '<div>'+
                                                    '<div class="small text-gray-500 alert-date" data-time="'+value.created_at+'" data-notification="New Admission">'+alertDate+'</div>'+
                                                    '<span class="font-weight-bold">New Admission Request by '+value.first_name+' '+value.last_name+'</span>'+
                                                  '</div>'+
                                                '</a>';
                          $('#alerts-list').append(newAdmissionAlert)
                        })
                      }
                    } else {
                      $.each(data.newAdmissions, function(key, value){
                          let alertDate = parseDate(value.created_at);
                          newAdmissionAlert = '<a class="dropdown-item d-flex align-items-center" href="{{ route('requests.index') }}">'+
                                                  '<div class="mr-3">'+
                                                    '<div class="icon-circle bg-success">'+
                                                    '<i class="fas fa-file-alt text-white"></i>'+
                                                    '</div>'+
                                                  '</div>'+
                                                  '<div>'+
                                                    '<div class="small text-gray-500 alert-date" data-time="'+value.created_at+'" data-notification="New Admission">'+alertDate+'</div>'+
                                                    '<span class="font-weight-bold">New Admission Request by '+value.first_name+' '+value.last_name+'</span>'+
                                                  '</div>'+
                                                '</a>';
                          $('#alerts-list').append(newAdmissionAlert)
                        })
                    }
                  } else {
                    $.each(data.newAdmissions, function(key, value){
                        let alertDate = parseDate(value.created_at);
                        newAdmissionAlert = '<a class="dropdown-item d-flex align-items-center" href="{{ route('requests.index') }}">'+
                                                '<div class="mr-3">'+
                                                  '<div class="icon-circle bg-primary">'+
                                                  '<i class="fas fa-file-alt text-white"></i>'+
                                                  '</div>'+
                                                '</div>'+
                                                '<div>'+
                                                  '<div class="small text-gray-500 alert-date" data-time="'+value.created_at+'" data-notification="New Admission">'+alertDate+'</div>'+
                                                  '<span class="font-weight-bold">New Admission Request by '+value.first_name+' '+value.last_name+'</span>'+
                                                '</div>'+
                                              '</a>';
                        $('#alerts-list').append(newAdmissionAlert)
                      })
                  }
                } else {
                  $('#new-requests-counter').addClass('d-none');
                }

                let newCount = data.forEnrollments.length + data.newAdmissions.length;
                if($('#alerts-list').attr('data-counter') != newCount){
                  $('#requests').DataTable().ajax.reload();
                  $('#for-enrollments').DataTable().ajax.reload();
                }
                $('#alerts-list').attr('data-counter', newCount);

                if(data.rejectedRequests.length > 0){
                  $('#rejected-requests-counter').removeClass('d-none');
                  $('#rejected-requests-counter').text(data.rejectedRequests.length);
                }
              }
            },
        });
    }
    function isEmpty( el ){
        return !$.trim(el.html())
    }
    function parseDate(created_at) {
        var system_date = new Date(Date.parse(created_at));
        var user_date = new Date();
        if (K.ie) {
            system_date = Date.parse(created_at.replace(/( \+)/, ' UTC$1'))
        }
        var diff = Math.floor((user_date - system_date) / 1000);
        if (diff <= 1) {return "just now";}
        if (diff < 20) {return diff + " seconds ago";}
        if (diff < 40) {return "half a minute ago";}
        if (diff < 60) {return "less than a minute ago";}
        if (diff <= 90) {return "one minute ago";}
        if (diff <= 3540) {return Math.round(diff / 60) + " minutes ago";}
        if (diff <= 5400) {return "1 hour ago";}
        if (diff <= 86400) {return Math.round(diff / 3600) + " hours ago";}
        if (diff <= 129600) {return "1 day ago";}
        if (diff < 604800) {return Math.round(diff / 86400) + " days ago";}
        if (diff <= 777600) {return "1 week ago";}
        return "on " + system_date;
    }

    // from http://widgets.twimg.com/j/1/widget.js
    var K = function () {
        var a = navigator.userAgent;
        return {
            ie: a.match(/MSIE\s([^;]*)/)
        }
    }();
  </script>

  @yield('scripts')

  <script>
    // Print
    $('#printCOR').click(function(){
        alert('IMPORTANT REMINDER!\n Enable the "Background Graphics" option first before printing.\n This will allow the images to be included in the printout.')
        window.print();
    })
  </script>

</body>

</html>