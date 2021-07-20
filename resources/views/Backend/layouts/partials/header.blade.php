<!DOCTYPE html>
<html lang="en">
  <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <!-- Required meta tags -->
    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>Application Dashboard - POS System</title>
    <link href="https://fonts.googleapis.com/css?family=Merriweather&display=swap" rel="stylesheet">
    <!-- plugins:css Material design css required-->
    <link rel="stylesheet" href="{{ asset('css/backend/css/icons-css/materialdesignicons.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('css/all.min.css') }}">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    
    
    <!-- inject:css shared-css/style.css is a like bootsrap css just some partial diffecne 
    or also you can use bootrap css ok
    -->
    <link rel="stylesheet" href="{{ asset('css/backend/css/shared-css/style.css') }}">
    <!-- <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css"> -->
    <!-- endinject -->
    <!-- Layout styles this is the main custom css-->
    <link rel="stylesheet" href="{{ asset('css/backend/css/dashboard-main/dashboard.css') }}">
    <!-- End Layout styles -->

    <link rel="stylesheet" type="text/css" href="{{ asset('css/backend/css/nav-responsive/top-nav-responsive.css') }}">

    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/backend/css/custom-main.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/backend/css/responsive/responsive.css') }}">


    <link rel="shortcut icon" href="../assets/images/favicon.png" />
  
    @stack('backendCSS')
  </head>
  <body>
    <div id="app">
      
    <div class="container-scroller">
      <!-- partial:../../partials/_navbar.html -->
      <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
          <a class="navbar-brand brand-logo" href="{{ route('home') }}">
            <img src="{{ asset('images/backend/images/logo.png') }}" alt="logo" /> </a>
          <a class="navbar-brand brand-logo-mini" href="{{ route('home') }}">
            <img src="{{ asset('images/backend/images/logo.png') }}" alt="logo" /> </a>
        </div>
        
        <div class="navbar-menu-wrapper d-flex align-items-center">
          
          <ul class="navbar-nav" id="visile_nav_when_other_is_toggle">
            <li class="nav-item dropdown language-dropdown user_second_dropdwon">
              <a class="nav-link dropdown-toggle px-2 d-flex align-items-center" id="LanguageDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                <div class="d-inline-flex mr-0 mr-md-3">
                  <div class="flag-icon-holder">
                    <!-- <i class="fas fa-user"></i> -->
                  </div>
                </div>
                <!-- <span class="profile-text font-weight-medium d-none d-md-block">Something</span> -->
              </a>
              <div class="dropdown-menu dropdown-menu-left navbar-dropdown py-2" aria-labelledby="LanguageDropdown">
                <a class="dropdown-item" href="{{ route('application.profile.show', Auth::user()->id) }}">
                  <div class="flag-icon-holder">
                  </div>My Profile
                </a>
                <a class="dropdown-item" href="{{ route('logout') }}"
                  onclick="event.preventDefault();
                document.getElementById('logout-form-two').submit();"
                >
                  <div class="flag-icon-holder">
                  </div>Sign Out
                </a>

                <form id="logout-form-two" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
                </form>
              </div>
            </li>
          </ul>

          <span id="top_search_icon">
            <i class="fas fa-search"></i>
          </span>
          <div class="top_search_form_are">
            <form id="top_search_form" class="d-flex justify-content-between ml-auto">
              @csrf
              <select id="top_searchIn" class="form-control mx-2 my-sm-0">
                <option value="in_order_no">By Order No</option>
                <option value="tokopedia_order_number">By Order Number Name From Tokopedia</option>
                <option value="inTracking">Tracking</option>
              </select>
              
              <!--<select id="select_store_to_search" class="form-control mx-2 my-sm-0">-->
                  
              <!--</select>-->

              <input id="top_searchKey" type="search" class="form-control" placeholder="Search records...">
              
              <span id="close_top_search_form" title="Close Search Form"><i class="fas fa-window-close"></i></span>
              <small id="type_to_search">Type to search...</small>
              
            </form>
          </div>
          <span id="top_search_no_result_found">No Result Found</span>

          <ul class="navbar-nav ml-auto topNotificationsBar">
            <li class="nav-item dropdown d-none d-xl-inline-block user-dropdown">
              <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                <img class="img-xs rounded-circle" src="{{ asset('images/backend/images/avatar.png') }}" alt="Profile image"> </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                <div class="dropdown-header text-center">
                  <img class="img-md rounded-circle" src="{{ asset('images/backend/images/avatar.png') }}" alt="Profile image">
                  <p class="mb-1 mt-3 font-weight-semibold">{{ Auth::user()->name }}</p>
                  <p class="font-weight-light text-muted mb-0">{{ Auth::user()->email }}</p>
                </div>
                <a class="dropdown-item" href="{{ route('application.profile.show', Auth::user()->id) }}">My Profile</a>
                <a class="dropdown-item" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();"
                >Sign Out</a>
                
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
                </form>             
              </div>
            </li>
          </ul>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <i class="fas fa-bars"></i>
          </button>
        </div>
      </nav>
      <!-- partial -->