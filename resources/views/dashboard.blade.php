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
        background-attachment: fixed;">
    </div>

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

<section style="background-color: #e9f7ef;">
    <br><br><br>

    <div class="container">
        <div class="slider-container">
            <button class="slider-button left" onclick="moveSlider(-1)">&#60;</button>
            
            <div class="slider">
                @foreach($articles as $article)
                    <a href="{{ route('articles.show', $article->id) }}" class="slider-box" style="text-decoration: none;">
                        <div class="slider-image">
                            @if($article->picture)
                                <img src="{{ asset('storage/' . $article->picture) }}" alt="{{ $article->title }}" width="100%" style="object-fit: cover;">
                            @else
                                <p>No image</p>
                            @endif
                        </div>

                        <div class="slider-title">
                            <h4 style="text-decoration:none; color:black;">{{ $article->title }}</h4>
                        </div>
                    </a>
                @endforeach
            </div>

            <button class="slider-button right" onclick="moveSlider(1)">&#62;</button>
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
                        <a href="{{ url('hama') }}" class="btn btn-outline-warning text-dark rounded-pill mt-3 px-4">Lihat</a>
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

            <!-- Card 4 -->
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="450">
                <div class="card shadow-sm border-0 h-100 text-center fitur-card bg-white" style="transition: all 0.3s;">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                        <img src="{{ asset('images/icons/ordermeet.png') }}" alt="Order Meet" width="70" class="mb-4">
                        <h5 class="card-title fw-bold text-success">order meet</h5>
                        <p class="card-text mt-2">Ayo berdiskusi langsung dengan Expert kami dalam hal bertani.</p>
                        <a href="{{ route('ordermeet.index') }}" class="btn btn-outline-success rounded-pill mt-3 px-4">Lihat</a>
                    </div>
                </div>
            </div>

            <!-- Card 5: Konsultasi -->
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
        </div>
    </div>
</section>

<!-- CSS Tambahan -->
<style>
    .slider-container {
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }

    .slider {
        display: flex;
        scroll-behavior: smooth;
        overflow-x: auto;
        width: 100%;
        scroll-snap-type: x mandatory;
    }

    .slider-box {
        background-color: white;
        height: 200px;
        width: 350px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        margin: 10px;
        flex-shrink: 0;
        scroll-snap-align: start;
        text-decoration: none; 
    }

    .slider-image {
        width: 100%;
        height: 70%;
        padding: 0;
        margin-bottom: 10px;
    }

    .slider-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .slider-title {
        width: 100%;
        text-align: left; 
    }

    .slider h4 {
        font-size: 1.2rem;
        margin-bottom: 10px;
    }

    .slider p {
        font-size: 0.9rem;
    }

    .slider-button {
        background-color: rgba(0, 0, 0, 0.5);
        color: white;
        border: none;
        padding: 10px;
        cursor: pointer;
    }
</style>

@push('scripts')
    <script>
        function moveSlider(direction) {
            const slider = document.querySelector('.slider');
            const scrollAmount = 350;
            slider.scrollBy(direction * scrollAmount, 0);
        }

    </script>
@endpush

@endsection
