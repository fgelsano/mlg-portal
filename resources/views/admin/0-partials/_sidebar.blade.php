<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    @include('admin.0-partials._sidebar-brand')

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item
      {{ (request()->is('dashboard')) ? 'active' : '' }}">
      <a class="nav-link" 
      href="{{ route('dashboard') }}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
      Registrar Menus
    </div>

    <!-- Nav Item - Enrolment Collapse Menu -->
    <li class="nav-item
      {{ url()->current() === route('all-requests.index') ? 'active' : '' }}
      {{ url()->current() === route('accepted-requests.index') ? 'active' : '' }}
      {{ url()->current() === route('pending-requests.index') ? 'active' : '' }}
      {{ url()->current() === route('rejected-requests.index') ? 'active' : '' }}
      {{ url()->current() === route('schedules.index') ? 'active' : '' }}
      {{ url()->current() === route('rooms-labs.index') ? 'active' : '' }}">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
        <i class="fas fa-book-open"></i>
        <span class="ml-2">Enrolment</span>
      </a>
      <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Admissions:</h6>
          <a class="collapse-item" href="{{ route('all-requests.index') }}">All Requests</a>
          <a class="collapse-item" href="{{ route('pending-requests.index') }}">Pending Requests</a>
          <a class="collapse-item" href="{{ route('accepted-requests.index') }}">Accepted</a>
          <a class="collapse-item" href="{{ route('rejected-requests.index') }}">Rejected</a>
          <div class="collapse-divider"></div>
          <h6 class="collapse-header">Others:</h6>
          <a class="collapse-item" href="{{ route('schedules.index') }}">Schedules</a>
          <a class="collapse-item" href="{{ route('rooms-labs.index') }}">Rooms / Labs</a>
        </div>
      </div>
    </li>

    <!-- Nav Item - Subjects -->
    <li class="nav-item
      {{ url()->current() === route('subjects.index') ? 'active' : '' }}">
      <a class="nav-link" href="{{ route('subjects.index') }}">
        <i class="fas fa-book"></i>
        <span class="ml-2">Subjects</span></a>
    </li>

    <!-- Nav Item - Instructors -->
    <li class="nav-item
      {{ url()->current() === route('instructors.index') ? 'active' : '' }}">
      <a class="nav-link" href="{{ route('instructors.index') }}">
        <i class="fas fa-chalkboard-teacher"></i>
        <span class="ml-2">Instructors</span></a>
    </li>

    <!-- Nav Item - Students -->
    <li class="nav-item
      {{ url()->current() === route('students.index') ? 'active' : '' }}">
      <a class="nav-link" href="{{ route('students.index') }}">
        <i class="fas fa-user-graduate"></i>
        <span class="ml-2">Students</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Heading -->
    <div class="sidebar-heading">
      Admin Menus
    </div>

    <!-- Nav Item - Tables -->
    <li class="nav-item
      {{ url()->current() === route('users.index') ? 'active' : '' }}">
      <a class="nav-link" href="{{ route('users.index') }}">
        <i class="fas fa-users"></i>
        <span class="ml-2">Users</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
      <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

  </ul>
  <!-- End of Sidebar -->