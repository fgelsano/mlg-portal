<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion no-print" id="accordionSidebar">

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

    <!-- Nav Item - Profile -->
    <li class="nav-item
      {{ url()->current() === route('profile.show',Auth::user()->profile_id) ? 'active' : '' }}">
      <a class="nav-link" href="{{ route('profile.show',Auth::user()->profile_id) }}">
        <i class="fas fa-user"></i>
        <span class="ml-2">Profile</span></a>
    </li>

    @if (Auth::user()->role == 1 || Auth::user()->role == 0 || Auth::user()->role == 7)
        <!-- Divider -->
        <hr class="sidebar-divider">
        <!-- Heading -->
        <div class="sidebar-heading">
          Registrar Menus
        </div>

        <!-- Nav Item - Enrolment Collapse Menu -->
        <li class="nav-item
          {{ url()->current() === route('requests.index') ? 'active' : '' }}
          {{ url()->current() === route('cashier.list') ? 'active' : '' }}
          {{ url()->current() === route('enroll.index') ? 'active' : '' }}">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-book-open"></i>
            <span class="ml-2">Enrollment</span> 
          </a>
          <div id="collapsePages" class="collapse
          {{ url()->current() === route('requests.index') ? 'show' : '' }}
          {{ url()->current() === route('cashier.list') ? 'show' : '' }}
          {{ url()->current() === route('enroll.index') ? 'show' : '' }}
          {{ url()->current() === route('rejected.index') ? 'show' : '' }}
          {{ url()->current() === route('for-enrollment.index') ? 'show' : '' }}
          {{ url()->current() === route('enrolled.index') ? 'show' : '' }}
          " aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">Admissions:</h6>
              <a class="collapse-item {{ url()->current() === route('requests.index') ? 'active' : '' }}" href="{{ route('requests.index') }}"><i class="fas fa-plus-circle mr-2 text-success"></i> New Requests <span class="badge badge-danger badge-counter d-none" id="new-requests-counter">0</span></a>
              <a class="collapse-item {{ url()->current() === route('rejected.index') ? 'active' : '' }}" href="{{ route('rejected.index') }}"><i class="fas fa-times-circle mr-2 text-danger"></i> Rejected <span class="badge badge-danger badge-counter d-none" id="rejected-requests-counter">0</span></a>
              <div class="collapse-divider"></div>
              <h6 class="collapse-header">Cashier:</h6>
              <a class="collapse-item {{ url()->current() === route('cashier.list') ? 'active' : '' }}" href="{{ route('cashier.list') }}"><i class="fas fa-hand-holding-usd mr-2 text-warning"></i> Cashier's Hold</a>
              <div class="collapse-divider"></div>
              <h6 class="collapse-header">Enrollments:</h6>
              <a class="collapse-item {{ url()->current() === route('for-enrollment.index') ? 'active' : '' }}" href="{{ route('for-enrollment.index') }}"><i class="fas fa-file-import mr-2 text-info"></i> For Enrollment <span class="badge badge-danger badge-counter d-none" id="for-enrollments-counter">0</span></a>
              <a class="collapse-item {{ url()->current() === route('enrolled.index') ? 'active' : '' }}" href="{{ route('enrolled.index') }}"><i class="fas fa-archive mr-2 text-success"></i> Enrolled</a>
            </div>
          </div>
        </li>

        <!-- Nav Item - Reports -->
        <li class="nav-item
          {{ url()->current() === route('reports.index') ? 'active' : '' }}">
          <a class="nav-link" href="{{ route('reports.index') }}">
            <i class="fas fa-chart-bar"></i>
            <span class="ml-2">Reports</span></a>
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

        <!-- Nav Item - Profiles -->
        <li class="nav-item
          {{ url()->current() === route('profiles.index') ? 'active' : '' }}">
          <a class="nav-link" href="{{ route('profiles.index') }}">
            <i class="fas fa-id-card"></i>
            <span class="ml-2">Profiles</span></a>
        </li>

        <!-- Nav Item - Registrar Admission -->
        <li class="nav-item">
          <a class="nav-link" href="/registrar-admission" target="_blank">
            <i class="fas fa-user"></i>
            <span class="ml-2">Registrar Admission</span></a>
        </li>
    @endif
    
    @if (Auth::user()->role == 0 || Auth::user()->role == 2 || Auth::user()->role == 7)
      <!-- Divider -->
      <hr class="sidebar-divider">
      <div class="sidebar-heading">
        Cashier Menus
      </div>
        <!-- Nav Item - Payments -->
        <li class="nav-item
        {{ url()->current() === route('payments.index') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('payments.index') }}">
          <i class="fas fa-money-bill-alt"></i>
          <span class="ml-2">Payments</span></a>
      </li>

      <!-- Nav Item - eClearance -->
      <li class="nav-item">
        <a class="nav-link" href="{{ route('cashier-clearances.show',Auth::user()->profile_id) }}">
          <i class="fas fa-spell-check"></i>
          <span class="ml-2">eClearance</span></a>
      </li>
    @endif

    @if (Auth::user()->role == 0 || Auth::user()->role == 3 || Auth::user()->role == 6)
      <!-- Divider -->
      <hr class="sidebar-divider">
      <div class="sidebar-heading">
        Student Menus
      </div>
      <!-- Nav Item - Subjects -->
      <li class="nav-item
        {{ url()->current() === route('student-subjects.show',Auth::user()->profile_id) ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('student-subjects.show', Auth::user()->profile_id) }}">
          <i class="fas fa-book"></i>
          <span class="ml-2">Subjects & Schedules</span></a>
      </li>

      <!-- Nav Item - eClearance -->
      <li class="nav-item 
        {{ url()->current() === route('student-clearances.show', Auth::user()->profile_id) ? 'active' : 'Failed' }}
        ">
        <a class="nav-link" href="{{ route('student-clearances.show',Auth::user()->profile_id) }}">
          <i class="fas fa-spell-check"></i>
          <span class="ml-2">eClearance</span>
        </a>
      </li>

      <!-- Nav Item - Grades -->
      <li class="nav-item 
        {{ url()->current() === route('student-grades.show', Auth::user()->profile_id) ? 'active' : '' }}
        @if(isset($subject))
          {{ url()->current() === route('student-grades.show', $subject['id']) ? 'active' : '' }}
          {{ url()->current() === route('student-grades.edit', $subject['id']) ? 'active' : '' }}
        @endif
        ">
        <a class="nav-link" href="{{ route('student-grades.show', Auth::user()->profile_id) }}">
          <i class="fas fa-percentage"></i>
          <span class="ml-2">Grades</span></a>
      </li>

      <!-- Nav Item - Billing -->
      <li class="nav-item">
        <a class="nav-link" href="{{ route('student-billings.show', Auth::user()->profile_id) }}">
          <i class="fas fa-money-bill-alt"></i>
          <span class="ml-2">Billing</span></a>
      </li>
    @endif

    <!-- Divider -->
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
      Instructor Menus
    </div>
    @if (Auth::user()->role == 0 || Auth::user()->role == 1 || Auth::user()->role == 4 || Auth::user()->role == 5 || Auth::user()->role == 7)
      <!-- Nav Item - Subject Loads -->
      <li class="nav-item
          {{ url()->current() === route('instructor-subjects.show',Auth::user()->profile_id) ? 'active' : '' }}">
          <a class="nav-link" href="{{ route('instructor-subjects.show',Auth::user()->profile_id) }}">
          <i class="fas fa-book"></i>
          <span class="ml-2">Subject Loads</span></a>
      </li>

      <!-- Nav Item - eClearance -->
      <li class="nav-item 
        {{ url()->current() === route('instructor-clearances.show', Auth::user()->profile_id) ? 'active' : '' }}
        @if(isset($subject))
          {{ url()->current() === route('clear-students.show', $subject->id) ? 'active' : '' }}
        @endif
        ">
        <a class="nav-link" href="{{ route('instructor-clearances.show', Auth::user()->profile_id) }}">
          <i class="fas fa-spell-check"></i>
          <span class="ml-2">eClearance</span></a>
      </li>

      <!-- Nav Item - Grades -->
      <li class="nav-item
        {{ url()->current() === route('instructor-grades.show', Auth::user()->profile_id) ? 'active' : '' }}
        @if(isset($subject))
          {{ url()->current() === route('instructor-grades.show', $subject->id) ? 'active' : '' }}
          {{ url()->current() === route('instructor-grades.edit', $subject->id) ? 'active' : '' }}
        @endif
      ">
        <a class="nav-link" href="{{ route('instructor-grades.show', Auth::user()->profile_id) }}">
          <i class="fas fa-percentage"></i>
          <span class="ml-2">Grades</span></a>
      </li>
    @endif

    @if (Auth::user()->role == 0 || Auth::user()->role == 1 || Auth::user()->role == 2 || Auth::user()->role == 4 || Auth::user()->role == 5 || Auth::user()->role == 7)
      <!-- Nav Item - Announcements -->
      <li class="nav-item">
        <a class="nav-link" href="{{ route('announcements.index') }}">
          <i class="fas fa-bullhorn"></i>
          <span class="ml-2">Announcements</span></a>
      </li>
    @endif
    
    @if(Auth::user()->role == 0)
      <!-- Divider -->
      <hr class="sidebar-divider">
      <!-- Heading -->
      <div class="sidebar-heading">
        Admin Menus
      </div>

      <!-- Nav Item - Users -->
      <li class="nav-item
        {{ url()->current() === route('users.index') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('users.index') }}">
          <i class="fas fa-users"></i>
          <span class="ml-2">Users</span></a>
      </li>

      <!-- Nav Item - Users -->
      <li class="nav-item
        {{ url()->current() === route('userEmails.index') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('userEmails.index') }}">
          <i class="fas fa-mail-bulk"></i>
          <span class="ml-2">User Emails</span></a>
      </li>

      <!-- Nav Item - Options -->
      <li class="nav-item
        {{ url()->current() === route('options.index') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('options.index') }}">
          <i class="fas fa-list"></i>
          <span class="ml-2">Options</span></a>
      </li>
    @endif
    
    <!-- Divider -->
    @if (Auth::user()->role == 0)
      <hr class="sidebar-divider d-none d-md-block">
        <!-- Nav Item - Online Admission -->
      <li class="nav-item">
        <a class="nav-link" href="/online-admission" target="_blank">
          <i class="fas fa-user"></i>
          <span class="ml-2">Online Admission</span></a>
      </li>
    @endif

    <!-- Nav Item - Web Mail -->
    <li class="nav-item">
      <a class="nav-link" href="" target="_blank">
        <i class="fas fa-envelope"></i>
        <span class="ml-2">Web Mail</span></a>
    </li>    

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">
    <!-- Heading -->
    <div class="sidebar-heading">
      Support
    </div>
    <!-- Nav Item - Tutorials -->
    <li class="nav-item {{ url()->current() === route('tutorials.index') ? 'active' : '' }}">
      <a class="nav-link" href="{{ route('tutorials.index') }}">
        <i class="fas fa-question-circle"></i>
        <span class="ml-2">Tutorials</span></a>
    </li>
    <!-- Nav Item - Technical Support -->
    <li class="nav-item">
      <a class="nav-link" href="https://www.messenger.com/t/CreativeDevLabsInnovativeSolutions" target="_blank">
        <i class="fas fa-tools"></i>
        <span class="ml-2">Technical Support</span></a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
      <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

  </ul>
  <!-- End of Sidebar -->