<div class="container-fluid page-body-wrapper">
        <!-- partial:../../partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <li class="nav-item nav-profile">
              <a href="#" class="nav-link">
                <div class="profile-image">
                  <!-- <img class="img-xs rounded-circle" src="{{ asset('images/backend/images/profile-images/05.jpg') }}" alt="profile image"> -->
                  <div class="dot-indicator bg-success"></div>
                </div>
                <div class="text-wrapper">
                  <p class="profile-name">{{ Auth::user()->name }}</p>
                  <p class="designation text-center">
                    @if(Auth::user()->identity === "user")
                    {{ 'USER' }}
                    @elseif(Auth::user()->identity === "admin")
                    {{ 'ADMIN' }}
                    @else
                    {{ 'Something Wrong' }}
                    @endif
                  </p>
                </div>
              </a>
            </li>
            <li class="nav-item nav-category">Main Menu</li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('home') }}">
                <span class="menu-title">Dashboard</span>
              </a>
            </li>
            @if(Auth::user()->identity === "user" || 
              Auth::user()->identity === "admin")
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
                <span class="menu-title">Stores</span>
                <i class="fas fa-angle-down menu_down_icons"></i>
              </a>
              <div class="collapse" id="auth">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('application.stores.create') }}">Add New</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('application.stores.index') }}">All Stores</a>
                  </li>
                </ul>
              </div>
            </li>

            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#inputData" aria-expanded="false" aria-controls="inputData">
                <span class="menu-title">Data</span>
                <i class="fas fa-angle-down menu_down_icons"></i>
              </a>
              <div class="collapse" id="inputData">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('application.input.create') }}">Input New</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('application.input.index') }}">Output</a>
                  </li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('application.questionsPage') }}">
                <span class="menu-title">Questions</span>
              </a>
            </li>
            @else
            {{ 'Something Wrong' }}
            @endif

            @if(Auth::user()->identity === "admin")

            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#worker" aria-expanded="false" aria-controls="worker">
                <span class="menu-title">Workers</span>
                <i class="fas fa-angle-down menu_down_icons"></i>
              </a>
              <div class="collapse" id="worker">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('application.workers.create') }}">Add New</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('application.workers.index') }}">All Workers</a>
                  </li>
                </ul>
              </div>
            </li>
            @endif

          </ul>
        </nav>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
        <div id="display_top_search_result_here"></div>