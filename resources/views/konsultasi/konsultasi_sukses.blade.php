@extends('layouts.app')
@section('content')
<style>
    body {
         background: linear-gradient(135deg, #e2f4e1 0%, #f8fafc 100%); /* Menggunakan background yang sama dengan layout */
    }
    .custom-navbar-space {
        margin-bottom: 50px; /* Memberi ruang di bawah navbar fixed */
    }
    .success-card {
        border-radius: 20px; /* Sudut membulat */
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15), 0 3px 6px rgba(0, 0, 0, 0.1); /* Bayangan untuk efek 3D */
        border: none; /* Tanpa border */
        background: rgba(255, 255, 255, 0.9); /* Background putih sedikit transparan */
        backdrop-filter: blur(5px); /* Efek blur pada background di belakang card */
        /* Hapus animasi: animation: zoomIn 0.7s cubic-bezier(0.68, -0.55, 0.27, 1.55); */
        position: relative;
        overflow: hidden; /* Pastikan konten tidak keluar dari border radius */
        padding: 30px;
    }
     .center-content {
         min-height: 80vh; /* Mengatur tinggi untuk centering */
         display: flex;
         align-items: center;
         justify-content: center;
     }
    .success-icon {
        font-size: 3.5rem; /* Ukuran ikon disesuaikan */
        color: #16a34a; /* Warna ikon */
        margin-bottom: 15px;
    }
    h2.text-success {
        color: #14532d !important; /* Warna judul disesuaikan */
        font-weight: 700;
        margin-bottom: 15px;
    }
    p.lead.mb-4 {
        color: #555; /* Warna teks disesuaikan */
        font-size: 1.1rem;
        margin-bottom: 25px !important;
    }
    .success-btn {
        background: #6ee7b7; /* Warna hijau muda */
        color: #14532d; /* Warna teks hijau tua */
        border: none;
        font-weight: 600;
        border-radius: 8px; /* Sudut membulat pada tombol */
        padding: 10px 24px; /* Padding tombol */
        transition: background-color 0.2s ease-in-out;
    }
    .success-btn:hover {
        background: #a7f3d0; /* Warna hover */
        color: #14532d;
    }
     .alert-success {
         background-color: rgba(226,244,225, 0.9); /* Background alert sedikit transparan */
         border-color: #bbf7d0; /* Warna border alert */
         color: #14532d; /* Warna teks alert */
         border-radius: 10px;
         box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
         margin-top: 20px;
         font-weight: 500;
     }

</style>

<div class="custom-navbar-space"></div> {{-- Memberi ruang di bawah navbar --}}

<div class="container center-content">
    <div class="row justify-content-center w-100">
        <div class="col-md-8">
            <div class="card text-center success-card">
                {{-- Canvas confetti dihapus --}}
                <div class="card-body py-5">
                    <div class="success-icon mb-3">
                        <i class="bi bi-check-circle-fill"></i>
                    </div>
                    <h2 class="text-success mb-3">Konsultasi telah terkirim!</h2>
                    {{-- Teks diubah menjadi lebih simple --}}
                    <p class="lead mb-4">Terima kasih, konsultasi Anda telah berhasil dikirim.</p>

                    {{-- Tombol Selesai mengarah ke dashboard petani --}}
                    <a href="{{ route('dashboard.farmer') }}" class="btn success-btn px-4 mt-4">Selesai</a>
                </div>
            </div>
            {{-- Alert dihapus karena pesan sukses sudah ada di card --}}
            {{-- <div class="alert alert-success mt-4">Konsultasi berhasil dikirim!</div> --}}
        </div>
    </div>
</div>

{{-- Script confetti dihapus --}}

@endsection 