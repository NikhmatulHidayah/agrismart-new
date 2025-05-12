@extends('layouts.app')

@section('content')

<!-- Hero Section -->
<section class="hero position-relative d-flex flex-column justify-content-center align-items-center text-center text-white" style="min-height: 100vh; overflow: hidden;">
    <!-- Background Gambar dengan Parallax -->
    <div class="hero-bg" style="
        background: url('{{ asset('images/thumb-dashboard.jpg') }}') center center / cover no-repeat;
        filter: brightness(55%) blur(1px);
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        z-index: 1;
        background-attachment: fixed;
    "></div>

    <!-- Gradient Layer -->
    <div style="
        background: linear-gradient(to bottom, rgba(0,0,0,0.4), rgba(0,0,0,0.7));
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        z-index: 2;
    "></div>

    <!-- Konten Hero -->
    <div class="container position-relative z-3" data-aos="fade-down">
        <h1 class="display-3 fw-bold mb-4" style="text-shadow: 2px 2px 8px rgba(0,0,0,0.7);">
            Selamat Datang di <span style="color: #a7f3d0;">AgriSmart</span>
        </h1>
        <p class="lead mb-5" style="max-width: 700px; margin: 0 auto; text-shadow: 1px 1px 5px rgba(0,0,0,0.6); font-size: 1.3rem;">
            Platform pintar untuk memantau tanaman, mengatasi hama, dan mendapatkan panduan pemupukan terbaik.
        </p>

        <div>
            <a href="#fitur" class="btn btn-light btn-lg px-5 py-3 fw-semibold rounded-pill shadow-sm scroll-smooth" style="transition: all 0.3s ease;">
                Jelajahi Fitur
            </a>
        </div>
    </div>
</section>

<!-- Section Fitur -->
<section id="fitur" class="py-5" style="background-color: #e9f7ef;">
    <div class="container">
        <h2 class="text-center fw-bold mb-5" style="color: #14532d;" data-aos="fade-up">Fitur AgriSmart</h2>

        <div class="row g-4">
            <!-- Card 1 -->
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="150">
                <div class="card shadow-sm border-0 h-100 text-center fitur-card bg-white" style="transition: all 0.3s;">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                        <img src="{{ asset('images/icons/monitoring.png') }}" alt="Monitoring" width="70" class="mb-4">
                        <h5 class="card-title fw-bold text-success">Monitoring Tanaman</h5>
                        <p class="card-text mt-2">Pantau pertumbuhan tanamanmu secara rutin dan akurat.</p>
                        <a href="{{ route('tanaman.index') }}" class="btn btn-outline-success rounded-pill mt-3 px-4">Lihat</a>
                    </div>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                <div class="card shadow-sm border-0 h-100 text-center fitur-card bg-white" style="transition: all 0.3s;">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                        <img src="{{ asset('images/icons/hama.png') }}" alt="Hama" width="70" class="mb-4">
                        <h5 class="card-title fw-bold text-warning">Penanganan Hama</h5>
                        <p class="card-text mt-2">Cari solusi cepat untuk melindungi tanaman dari berbagai serangan hama.</p>
                        <a href="{{ url('/hama') }}" class="btn btn-outline-warning text-dark rounded-pill mt-3 px-4">Lihat</a>
                    </div>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="450">
                <div class="card shadow-sm border-0 h-100 text-center fitur-card bg-white" style="transition: all 0.3s;">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                        <img src="{{ asset('images/icons/pupuk.png') }}" alt="Pemupukan" width="70" class="mb-4">
                        <h5 class="card-title fw-bold text-success">Saran Pemupukan</h5>
                        <p class="card-text mt-2">Panduan pemupukan optimal berbasis tanah dan kebutuhan tanamanmu.</p>
                        <a href="{{ url('/pemupukan') }}" class="btn btn-outline-success rounded-pill mt-3 px-4">Cari</a>
                    </div>
                </div>
            </div>

            <!-- Card 4 for Konsultasi -->
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="600">
                <div class="card shadow-sm border-0 h-100 text-center fitur-card bg-white" style="transition: all 0.3s;">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                        <img src="{{ asset('images/icons/konsultasi.jpeg') }}" alt="Konsultasi" width="70" class="mb-4">
                        <h5 class="card-title fw-bold text-info">Konsultasi</h5>
                        <p class="card-text mt-2">Bingung dengan tanaman atau hama? Konsultasikan langsung dengan ahli kami!</p>
                        <a href="{{ url('/konsultasi') }}" class="btn btn-outline-info rounded-pill mt-3 px-4">Konsultasi</a>
                    </div>
                </div>
            </div>

            <!-- Card 5 -->
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="750">
                <div class="card shadow-sm border-0 h-100 text-center fitur-card bg-white" style="transition: all 0.3s;">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                        <img src="{{ asset('images/icons/ordermeet.png') }}" alt="Order Meet" width="70" class="mb-4">
                        <h5 class="card-title fw-bold text-success">order meet</h5>
                        <p class="card-text mt-2">Ayo berdiskusi langsung dengan Expert kami dalam hal bertani.</p>
                        <a href="{{ route('ordermeet.index') }}" class="btn btn-outline-success rounded-pill mt-3 px-4">Lihat</a>
                    </div>
                </div>
            </div> 

        </div>
    </div>
</section>

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

@endsection
