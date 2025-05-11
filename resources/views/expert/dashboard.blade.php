@extends('expert.app')
@section('title', 'Dashboard Expert')
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
                        <h5 class="card-title fw-bold text-success">konsultasi</h5>
                        <p class="card-text mt-2">Untuk Melakukan konfirmasi konsultasi</p>
                        <a href="{{ route('tanaman.index') }}" class="btn btn-outline-success rounded-pill mt-3 px-4">Lihat</a>
                    </div>
                </div>
            </div>
            <!-- Card 4 -->
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="450">
                <div class="card shadow-sm border-0 h-100 text-center fitur-card bg-white" style="transition: all 0.3s;">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                        <img src="{{ asset('images/icons/ordermeet.png') }}" alt="Order Meet" width="70" class="mb-4">
                        <h5 class="card-title fw-bold text-success">order meet</h5>
                        <p class="card-text mt-2">Untuk melakukan konfirmasi order meet</p>
                        <a href="{{ route('ordermeet.manage') }}" class="btn btn-outline-success rounded-pill mt-3 px-4">Lihat</a>
                    </div>
                </div>
            </div> 

        </div>
    </div>
</section>

<!-- CSS Tambahan -->
<style>
    .fitur-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 12px 24px rgba(21, 84, 42, 0.25);
    }
    .btn:hover {
        transform: scale(1.05);
    }
    html {
        scroll-behavior: smooth;
    }
</style>

<!-- Tambahkan AOS.js -->
@push('scripts')
<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
<script>
    AOS.init({
        duration: 1000,
        once: true,
    });
</script>
@endpush

@endsection
 