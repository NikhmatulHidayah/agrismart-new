<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AgriSmart Dashboard Expert</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- AOS Animation CSS -->
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">

    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Custom Global Styles -->
    <style>
        /* Reset */
        body {
            background-color: #f4fbf6; /* hijau muda soft */
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            min-height: 100vh;
        }

        /* Navbar */
        nav.navbar {
            background: rgba(25, 135, 84, 0.85); /* hijau transparan */
            backdrop-filter: blur(8px);
        }

        /* Hero Section */
        .hero {
            margin-top: 0;
            padding-top: 0;
            position: relative;
            height: 100vh;
            background: url('{{ asset('images/hero-agrisMart.png') }}') no-repeat center center/cover;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            color: white;
            text-align: center;
        }

        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.4); /* overlay gelap supaya teks tetap kontras */
        }

        .hero-content {
            position: relative;
            z-index: 2;
            padding-top: 80px; /* supaya teks tidak ketutup navbar */
        }

        .btn-hero {
            background: white;
            color: #198754;
            border: none;
            padding: 10px 24px;
            font-weight: 600;
            border-radius: 8px;
            transition: 0.3s;
        }

        .btn-hero:hover {
            background: #198754;
            color: white;
        }

        /* Section Fitur */
        #fitur {
            padding: 5rem 0;
        }

        #fitur .card {
            border-radius: 10px;
            transition: 0.3s;
        }

        #fitur .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }
    </style>

    @stack('head') <!-- untuk tambahan css custom di setiap halaman -->
</head>

<body class="d-flex flex-column min-vh-100">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">AgriSmart</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav gap-3">
                    <li class="nav-item"><a class="nav-link" href="{{ url('/expert') }}">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('expert.profile.index') }}">Profil</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('process.logout') }}">Logout</a></li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Halo, Expert {{ Auth::user()->name }}
                            @if(Auth::check() && Auth::user()->role == 'expert')
                                @if(Auth::user()->dataAhliTani)
                                    <span class="badge ms-2
                                        @if(strtolower(Auth::user()->dataAhliTani->status) == 'approved') bg-success
                                        @elseif(strtolower(Auth::user()->dataAhliTani->status) == 'reject') bg-danger
                                        @else bg-secondary
                                        @endif">
                                        {{ ucfirst(Auth::user()->dataAhliTani->status) }}
                                    </span>
                                @else
                                    <span class="badge ms-2 bg-secondary">
                                        Pending
                                    </span>
                                @endif
                            @endif
                            &nbsp
                            @if(Auth::check() && Auth::user()->picture)
                                <img src="{{ asset('storage/' . Auth::user()->picture) }}" alt="Foto Profil" class="rounded-circle me-2" style="width: 30px; height: 30px; object-fit: cover;">
                            @endif
                        </a>
                    </li>
                    
                    
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-grow-1">
        @yield('content')
    </main>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    @stack('scripts')

    <!-- AOS Animation JS -->
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script>
    AOS.init({
        duration: 800,   // durasi animasi
        once: true,      // animasi hanya sekali scroll
    });
    </script>

    <footer class="footer mt-auto py-3 bg-light">
        <div class="container">
            <div class="row justify-content-start">
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
                        <a href="https://www.linkedin.com/in/muhammad-dhiyaulhaq-aryva/"><i class="fab fa-linkedin" style="font-size: 30px;"></i></a>
                    </div>
                </div>
            </div>
            <hr>
            <div class="text-center">
                <p>&copy; 2025 AgriSmart. All rights reserved.</p>
            </div>
        </div>
    </footer>

</body>
</html>
