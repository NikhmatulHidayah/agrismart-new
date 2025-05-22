@extends('layouts.app')

@section('content')
<style>
    body {
        background: linear-gradient(135deg, #e2f4e1 0%, #f8fafc 100%); /* Sesuai dengan background layout */
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        margin: 0;
        padding: 0;
        min-height: 100vh;
    }
    .custom-navbar-space {
        margin-bottom: 50px; /* Memberi ruang di bawah navbar fixed */
    }
    .ahli-card {
        background: rgba(255, 255, 255, 0.9); /* Background putih sedikit transparan */
        backdrop-filter: blur(5px); /* Efek blur di belakang card */
        border: none; /* Tanpa border */
        border-radius: 20px; /* Sudut membulat */
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15), 0 3px 6px rgba(0, 0, 0, 0.1); /* Bayangan untuk efek 3D */
        transition: box-shadow 0.3s ease-in-out, transform 0.3s ease-in-out;
        margin-bottom: 20px;
        padding: 30px 20px; /* Padding disesuaikan */
    }
    .ahli-card:hover {
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2), 0 5px 10px rgba(0, 0, 0, 0.12);
        transform: translateY(-5px);
    }
    .ahli-card .card-title {
        font-size: 1.5rem; /* Ukuran judul disesuaikan */
        font-weight: 700; /* Lebih bold */
        color: #14532d; /* Warna teks hijau tua */
        margin-bottom: 8px;
        text-transform: capitalize;
    }
    .ahli-card .alumni {
        font-size: 1rem;
        color: #555; /* Warna teks */
        font-weight: 400;
        margin-bottom: 8px;
    }
    .ahli-card .harga {
        font-size: 1.3rem; /* Ukuran harga disesuaikan */
        font-weight: 700; /* Lebih bold */
        color: #16a34a; /* Warna hijau sukses */
        margin-bottom: 20px;
    }
    .ahli-card .btn {
        background: #6ee7b7; /* Warna hijau muda */
        color: #14532d; /* Warna teks hijau tua */
        border: none;
        font-weight: 600;
        border-radius: 8px; /* Sudut membulat pada tombol */
        padding: 10px 24px; /* Padding tombol */
        transition: background-color 0.2s ease-in-out;
    }
     .ahli-card .btn:hover {
        background: #a7f3d0; /* Warna hover */
     }
    .ahli-card .icon-ahli {
        font-size: 2.5rem; /* Ukuran ikon disesuaikan */
        color: #16a34a; /* Warna ikon */
        margin-bottom: 15px;
    }
    .ahli-row {
        justify-content: center;
    }
     h2.text-center.fw-bold {
         margin-top: 20px; /* Ruang di atas judul */
         margin-bottom: 30px !important; /* Ruang di bawah judul */
         color: #14532d; /* Warna judul */
     }
    .btn-primary {
        /* Menggunakan class Bootstrap untuk tombol Riwayat Konsultasi */
        background-color: #007bff; /* Contoh warna biru Bootstrap */
        border-color: #007bff;
        font-weight: 500;
    }
    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #004085;
    }

</style>
<div class="custom-navbar-space"></div> {{-- Memberi ruang di bawah navbar --}}
<div class="container py-4">
    <h2 class="text-center fw-bold">Pilih Ahli Tani untuk Konsultasi</h2>

    {{-- Button to view farmer's consultations --}}
    <div class="text-center mb-4">
        <a href="{{ route('konsultasi.farmer_consultations') }}" class="btn btn-primary">Lihat Riwayat Konsultasi Saya</a>
    </div>

    <div class="row ahli-row g-4">
        @forelse($ahliTaniList as $ahli)
            <div class="col-md-6 col-lg-4 d-flex align-items-stretch">
                <div class="card ahli-card w-100">
                    <div class="card-body text-center d-flex flex-column justify-content-center align-items-center">
                        <div class="icon-ahli mb-2">
                            <i class="bi bi-person-circle"></i> {{-- Using a standard icon class, assuming Bootstrap Icons or similar --}}
                        </div>
                        <h5 class="card-title">{{ $ahli->user->name ?? 'Ahli Tani' }}</h5>
                        <div class="alumni mb-2">Alumni: {{ $ahli->alumni ?? '-' }}</div>
                        <div class="harga mb-2">Harga Konsultasi: <span>Rp {{ number_format($ahli->price ?? 0, 0, ',', '.') }}</span></div>
                        <a href="{{ route('konsultasi.pilihAhliTani', $ahli->id_ahli_tani) }}" class="btn px-4 py-2 mt-2">Pilih</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center">
                <div class="alert alert-info">Belum ada ahli tani yang tersedia.</div>
            </div>
        @endforelse
    </div>
</div>
@endsection 