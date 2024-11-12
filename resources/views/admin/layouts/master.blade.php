<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  @auth('admin')
  <title>SISTA | {{ Auth::guard('admin')->user()->name }} &mdash; {{ config('app.name') }}</title>
  @endauth
  @auth('lecturer')
  <title>SISTA | {{ Auth::guard('lecturer')->user()->name }} &mdash; {{ config('app.name') }}</title>
  @endauth

  <!-- General CSS Files -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

  <!-- CSS Libraries -->
    @stack('css')

  <!-- Template CSS -->
  <link rel="stylesheet" href="{{url('/')}}/stisla-master/assets/css/style.css">
  <link rel="stylesheet" href="{{url('/')}}/stisla-master/assets/css/components.css">
</head>

<body>
  <div id="app">
    @yield('content-2')
    <div class="main-wrapper">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        <form class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
          </ul>
          @include('admin.layouts.search')
        </form>
        <ul class="navbar-nav navbar-right">
          @include('admin.layouts.email')
          @include('admin.layouts.notification')
          <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            <img alt="image" src="{{url('/')}}/stisla-master/assets/img/avatar/avatar-1.png" class="rounded-circle mr-1">
            @auth('admin')
            <div class="d-sm-none d-lg-inline-block">Hi, {{Auth::guard('admin')->user()->name}}</div></a>
            @endauth
            @auth('lecturer')
            <div class="d-sm-none d-lg-inline-block">Hi, {{Auth::guard('lecturer')->user()->name}}</div></a>
            @endauth
            <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="{{ route('admin_logout') }}"
                onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('admin_logout') }}" method="POST" style="display: none;">
                  @csrf
                </form>
              {{-- </a> --}}
            </div>
          </li>
        </ul>
      </nav>
      <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="index.html">{{config('app.name')}}</a>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">St</a>
          </div>
          @include('admin.layouts.menu')
        </aside>
      </div>
      
      <!-- Main Content -->
      <div class="main-content">
        @include('admin.layouts.alert')
        
        @yield('content')
      </div>
      <footer class="main-footer">
        <div class="footer-left">
          Copyright &copy; {{ date('Y') }} <div class="bullet"></div> Design By <a href="https://nauval.in/">Muhamad Nauval Azhar</a>
        </div>
        <div class="footer-right">
          
        </div>
      </footer>
    </div>
  </div>

  <!-- General JS Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
  <script src="{{url('/')}}/stisla-master/assets/js/stisla.js"></script>

  <!-- JS Libraies -->
    @stack('js')
    @include('admin.layouts.delete')
    @include('admin.layouts.confirm')

  <!-- Template JS File -->
  <script src="{{url('stisla-master/assets/js/scripts.js')}}"></script>
  <script src="{{url('stisla-master/assets/js/custom.js')}}"></script>
</body>
</html>
