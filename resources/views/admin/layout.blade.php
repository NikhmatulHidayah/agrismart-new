<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'AgriSmart')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @yield('extra_css')
</head>
<body>
    <!-- Admin Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/admin/dashboard') }}">
                <i class="fas fa-seedling"></i> AgriSmart
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="adminNavbar">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}" href="{{ url('/admin/dashboard') }}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('admin/manage-expert') ? 'active' : '' }}" href="{{ route('admin.manage-expert') }}">Manage Experts</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('admin/manage-recap') ? 'active' : '' }}" href="{{ route('admin.manage-recap') }}">Manage Recap</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('admin/manage-payment') ? 'active' : '' }}" href="{{ route('admin.manage-payment') }}">Manage Payment</a>
                    </li>
                </ul>

                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user-cog"></i> {{ session('admin.username') }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <form method="POST" action="{{ route('admin.logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="fas fa-sign-out-alt"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="container my-4">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer mt-auto py-3 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5><i class="fas fa-seedling"></i> AgriSmart </h5>
                    <p>Your smart partner for sustainable agriculture in Indonesia.</p>
                </div>
                <div class="col-md-4">
                    <h5>Contact Us</h5>
                    <address>
                        <i class="fas fa-map-marker-alt"></i> Jl. Telekomunikasi No. 1, Bandung Terusan Buahbatu<br>
                        <i class="fas fa-phone"></i> +6282145772310<br>
                        <i class="fas fa-envelope"></i> info@agrismart.com
                    </address>
                    <div class="social-icons">
                        <a href="https://wa.me/6282145772310"><i class="fab fa-whatsapp" style="font-size: 30px;"></i></a>
                        <a href="https://www.instagram.com/aryva_23/"><i class="fab fa-instagram" style="font-size: 30px;"></i></a>
                    </div>                
                </div>
            </div>
            <hr>
            <div class="text-center">
                <p>&copy; 2025 AgriSmart. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    @yield('extra_js')
</body>
</html>
