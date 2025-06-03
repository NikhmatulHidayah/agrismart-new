@extends('expert.app')
@section('title', 'Dashboard Expert')
@section('content')

<!-- Hero Section -->
<section class="hero position-relative d-flex flex-column justify-content-center align-items-center text-center text-white" style="overflow: hidden;">
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
            <!-- Card 5 -->
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="450">
                <div class="card shadow-sm border-0 h-100 text-center fitur-card bg-white" style="transition: all 0.3s;">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                        <img src="{{ asset('images/icons/articles.png') }}" alt="Order Meet" width="70" class="mb-4">
                        <h5 class="card-title fw-bold text-success">Articcels</h5>
                        <p class="card-text mt-2">Untuk melihat artricels</p>
                        <a href="/expert/articles" class="btn btn-outline-success rounded-pill mt-3 px-4">Lihat</a>
                    </div>
                </div>
            </div> 
            <!-- Card: Konsultasi Masuk -->
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="600">
                <div class="card shadow-sm border-0 h-100 text-center fitur-card bg-white" style="transition: all 0.3s;">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                         <img src="https://img.icons8.com/ios-filled/70/14532d/chat.png" alt="Konsultasi Masuk" width="70" class="mb-4">
                        <h5 class="card-title fw-bold text-success">Konsultasi Masuk</h5>
                        <p class="card-text mt-2">Lihat dan jawab pertanyaan konsultasi dari petani.</p>
                        <a href="{{ route('expert.konsultasi.index') }}" class="btn btn-outline-success rounded-pill mt-3 px-4">Lihat Konsultasi</a>
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

    // Check if profile data is empty and show modal
    @unless($dataAhliTani)
        var profileModal = new bootstrap.Modal(document.getElementById('profileCompletionModal'), {
            backdrop: 'static',
            keyboard: false
        });
        profileModal.show();
    @endunless

</script>
@endpush

<!-- Profile Completion Modal -->
@unless($dataAhliTani)
<div class="modal fade" id="profileCompletionModal" tabindex="-1" aria-labelledby="profileCompletionModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="profileCompletionModalLabel">Lengkapi Profil Anda</h5>
        {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
      </div>
      <div class="modal-body">
        Anda perlu melengkapi data profil Anda untuk dapat menggunakan semua fitur ahli di AgriSmart. Silakan isi data profil Anda sekarang.
      </div>
      <div class="modal-footer">
        {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> --}}
        <a href="{{ route('expert.profile.create') }}" class="btn btn-primary">Lengkapi Profil</a>
      </div>
    </div>
  </div>
</div>
@endunless

@endsection
 