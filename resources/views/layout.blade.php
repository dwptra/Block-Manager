<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Block Generation</title>

    <link rel="shortcut icon"
        href="https://o.remove.bg/downloads/eb624192-57ae-4711-ba39-93cc75d5c050/image-removebg-preview.png"
        type="image/x-icon">
    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/dist/modules/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dist/modules/fontawesome/css/all.min.css') }}">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('assets/dist/modules/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dist/modules/weather-icon/css/weather-icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dist/modules/jquery-selectric/selectric.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dist/modules/weather-icon/css/weather-icons-wind.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dist/modules/summernote/summernote-bs4.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dist/modules/dropzonejs/dropzone.css') }}">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('assets/dist/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dist/css/components.css') }}">
</head>

<body>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                <form class="form-inline mr-auto">
                    <ul class="navbar-nav mr-3">
                        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i
                                    class="fas fa-bars"></i></a></li>
                        <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i
                                    class="fas fa-search"></i></a></li>
                    </ul>
                    <div class="search-element">
                    </div>
                </form>
                <ul class="navbar-nav navbar-right">
                    <li class="dropdown"><a href="#" data-toggle="dropdown"
                            class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                            <div class="d-sm-none d-lg-inline-block">Hi, {{ Auth()->User()->name }}</div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="{{ route('logout') }}" class="dropdown-item has-icon text-danger">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                        </div>
                    </li>
                </ul>
            </nav>
            <div class="main-sidebar sidebar-style-2">
                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand">
                        <a href="dashboard-ecommerce.html">Block Manager</a>
                    </div>
                    <div class="sidebar-brand sidebar-brand-sm">
                        <a href="dashboard-ecommerce.html">BM</a>
                    </div>
                    <ul class="sidebar-menu"> 
                        <li class="{{ Request::is('dashboard') ? 'active' : '' }}"><a class="nav-link" href="{{ route('dashboard') }}"><i class="fas fa-fire"></i>
                                <span>Dashboard</span></a></li>
                        <li class="menu-header">Master Data</li>
                        <li class="dropdown {{ Request::is('block/blocks*') || Request::is('block/categories*') ? 'active' : '' }}">
                            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                                    class="fas fa-columns"></i> <span>Block</span></a>
                            <ul class="dropdown-menu">
                                <li class="{{ Request::is('block/blocks*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('block.master') }}">Block</a></li>
                                <li class="{{ Request::is('block/categories*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('block.categories') }}">Block Category</a></li>
                            </ul>
                        </li>
                        <li class="{{ Request::is('user') ? 'active' : '' }}"><a class="nav-link" href="{{ route('user') }}"><i class="fas fa-user"></i>
                                <span>User</span></a></li>
                    </ul>
                </aside>
            </div>

            <!-- Main Content -->
            <div class="main-content">
                @yield('content')
            </div>
            <footer class="main-footer">
                <div class="footer-left">
                    Copyright &copy; 2018 <div class="bullet"></div> Design By <a href="https://nauval.in/">Muhamad
                        Nauval Azhar</a>
                </div>
                <div class="footer-right">

                </div>
            </footer>
        </div>
    </div>

    <!-- General JS Scripts -->
    <script src="{{ asset('assets/dist/modules/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/dist/modules/jquery-selectric/jquery.selectric.min.js') }}"></script>
    <script src="{{ asset('assets/dist/modules/popper.js') }}"></script>
    <script src="{{ asset('assets/dist/modules/tooltip.js') }}"></script>
    <script src="{{ asset('assets/dist/modules/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/dist/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('assets/dist/modules/moment.min.js') }}"></script>
    <script src="{{ asset('assets/dist/js/stisla.js') }}"></script>

    <!-- JS Libraies -->
    <script src="{{ asset('assets/dist/modules/simple-weather/jquery.simpleWeather.min.js') }}"></script>
    <script src="{{ asset('assets/dist/modules/chart.min.js') }}"></script>
    <script src="{{ asset('assets/dist/modules/jqvmap/dist/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('assets/dist/modules/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
    <script src="{{ asset('assets/dist/modules/summernote/summernote-bs4.js') }}"></script>
    <script src="{{ asset('assets/dist/modules/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>
    <script src="{{ asset('assets/dist/modules/dropzonejs/min/dropzone.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('assets/dist/js/page/dashboard-general.js') }}"></script>
    <script src="{{ asset('assets/dist/js/page/components-multiple-upload.js') }}"></script>

    <!-- Template JS File -->
    <script src="{{ asset('assets/dist/js/scripts.js') }}"></script>
    <script src="{{ asset('assets/dist/js/custom.js') }}"></script>
</body>

</html>
