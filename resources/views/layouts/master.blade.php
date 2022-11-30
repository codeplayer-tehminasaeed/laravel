
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{ config('app.name', 'Auto Time Table') }}</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  
  <!-- Google Font -->
  <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper" id="app">

  <header class="main-header">

    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>LT</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>{{ config('app.name', 'Auto Time Table') }}</b></span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{asset('images/img.jpg')}}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{Auth::user()->name}}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <!-- <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat">
                  <i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form> -->
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
          @if(Auth::user()->role_name == "admin")
        {{-- <li class="menu-open">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li> --}}
        <li class= "{{ request()->is('department') ? 'active' : '' }}">
          <a href="/department" >
            <i class="fa fa-files-o"></i>
            <span>Departments</span>
          </a>
        </li> 
        <li class= "{{ request()->is('rooms') ? 'active' : '' }}">
          <a href="/rooms">
            <i class="fa fa-files-o"></i>
            <span>Rooms</span>
          </a>
        </li>
        <li class= "{{ request()->is('labs') ? 'active' : '' }}">
          <a href="/labs">
            <i class="fa fa-files-o"></i>
            <span>Labs</span>
          </a>
        </li>
        <li class= "{{ request()->is('programs') ? 'active' : '' }}">
          <a href="/programs" >
            <i class="fa fa-th"></i> <span>Programs</span>
        </a>
        </li>
        
        <li class= "{{ request()->is('slots') ? 'active' : '' }}">
            <a href="/slots">
              <i class="fa fa-th"></i> <span>Slots</span>
            </a>
        </li>

        <li class= "{{ request()->is('sections') ? 'active' : '' }}">
          <a href="/sections">
            <i class="fa fa-pie-chart"></i>
            <span>Sections</span>
          </a>
        </li>
        <li class= "{{ request()->is('courses') ? 'active' : '' }}">
          <a href="/courses">
            <i class="fa fa-laptop"></i>
            <span>Courses</span>
          </a>
        </li>
        <li class= "{{ request()->is('teacher') ? 'active' : '' }}">
          <a href="/teacher">
            <i class="fa fa-table"></i> <span>Teachers</span>
          </a>
        </li>
        <li class= "{{ request()->is('student') ? 'active' : '' }}">
          <a href="/student">
            <i class="fa fa-calendar"></i> <span>Students</span>
          </a>
        </li>
        <li class= "{{ request()->is('teacherCourses') ? 'active' : '' }}">
          <a href="/teacherCourses">
            <i class="fa fa-calendar"></i> <span>Assign Courses</span>
          </a>
        </li>
        <li class= "{{ request()->is('timetable') ? 'active' : '' }}">
          <a href="/timetable">
            <i class="fa fa-calendar"></i> <span>Time Table</span>
          </a>
        </li>     
        <li class= "{{ request()->is('request') ? 'active' : '' }}">
          <a href="/request">
            <i class="fa fa-calendar"></i> <span>Requests for Lectures</span>
          </a>
        </li>
         <li class= "{{ request()->is('shiftLec') ? 'active' : '' }}">
          <a href="/shiftLec">
            <i class="fa fa-calendar"></i> <span>Requests for Shift Lectures</span>
          </a>
        </li>
        @endif
        @if(Auth::user()->role_name == "teacher")
          <li class= "{{ request()->is('teachertimetable') ? 'active' : '' }}">
              <a href="/teachertimetable">
                <i class="fa fa-calendar"></i> <span>My Time Table</span>
              </a>
          </li>
          <li class= "{{ request()->is('/shiftLecRequest') ? 'active' : '' }}">
              <a href="/shiftLecRequest">
                <i class="fa fa-calendar"></i> <span>Shift Lecture Request</span>
              </a>
          </li>
          
        @endif
        @if(Auth::user()->role_name == "student")
          <li class= "{{ request()->is('stdtimetable') ? 'active' : '' }}">
              <a href="/stdtimetable">
                <i class="fa fa-calendar"></i> <span>My Time Table</span>
              </a>
          </li>
          <!-- <li class= "{{ request()->is('customtime') ? 'active' : '' }}">
              <a href="/customtime">
                <i class="fa fa-calendar"></i> <span>Custome Time Table</span>
              </a>
          </li> -->
          {{-- <li class= "{{ request()->is('times/table') ? 'active' : '' }}">
              <a href="/times/table">
                <i class="fa fa-calendar"></i> <span>My Custome Time Table</span>
              </a>
          </li> --}}
        @endif
        <li>
          <a href="{{ route('logout') }}"
              onclick="event.preventDefault();
                       document.getElementById('logout-form').submit();">
              <i class="fa fa-power-off"></i> <span>Logout</span>
          </a>

          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              {{ csrf_field() }}
          </form>
      </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">

    </section>

    <!-- Main content -->
    <section class="content">
        @include('inc.message')
        @yield('content')
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b></b> 
    </div>
    
  </footer>
  
</div>
<script src="{{asset('js/app.js')}}"></script>
<!-- ./wrapper -->
<script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
  <script>
      CKEDITOR.replace( 'cktable' );
  </script>
</body>
</html>
