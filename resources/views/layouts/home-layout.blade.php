@extends('layouts.root-layout')

@section('root-content')
      <!-- <body data-layout="horizontal"> -->

   <!-- Begin page -->
   <div id="layout-wrapper">
      @include('components.navbar.home-navbar')

      <!-- ========== Left Sidebar Start ========== -->
      @include('components.sidebar.home-left-sidebar')
      <!-- Left Sidebar End -->

      <!-- ============================================================== -->
      <!-- Start right Content here -->
      <!-- ============================================================== -->
      @yield('home-content')
      <!-- end main content-->
   </div>
   <!-- END layout-wrapper -->

   <!-- Right Sidebar -->
   @include('components.sidebar.home-right-sidebar')
   <!-- /Right-bar -->

   <!-- Right bar overlay-->
   <div class="rightbar-overlay"></div>
@endsection