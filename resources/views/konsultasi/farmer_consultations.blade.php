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
    .farmer-consultation-item {
        background-color: rgba(255, 255, 255, 0.9); /* Background putih sedikit transparan */
        backdrop-filter: blur(5px); /* Efek blur di belakang card */
        border: none; /* Hilangkan border default list group */
        border-radius: 15px; /* Sudut membulat */
        margin-bottom: 15px; /* Jarak antar item */
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15), 0 3px 6px rgba(0, 0, 0, 0.1); /* Bayangan untuk efek 3D */
        transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        padding: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        text-decoration: none; /* Hapus garis bawah */
        color: inherit; /* Pastikan warna teks diwarisi */
    }
    .farmer-consultation-item:hover {
        transform: translateY(-5px); /* Efek angkat saat hover */
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2), 0 5px 10px rgba(0, 0, 0, 0.12);
        color: inherit; /* Pastikan warna teks tetap saat hover */
    }
    .farmer-consultation-item h5 {
        color: #14532d; /* Warna teks topik */
        font-weight: 600;
        margin-bottom: 5px;
    }
    .farmer-consultation-item p {
        color: #555; /* Warna teks ahli tani */
        margin-bottom: 5px;
        font-size: 0.95rem;
    }
    .farmer-consultation-item small {
        color: #777; /* Warna teks status */
        font-size: 0.85rem;
    }
    .consult-status-badge {
        padding: 5px 10px;
        border-radius: 10px;
        font-size: 0.8rem;
        font-weight: bold;
    }
    .view-detail-btn-farmer {
         background-color: #6ee7b7; /* Warna hijau muda */
         color: #14532d; /* Warna teks hijau tua */
         border: none;
         border-radius: 8px;
         padding: 8px 15px;
         font-size: 0.9rem;
         font-weight: 600;
         transition: background-color 0.2s ease-in-out;
    }
    .view-detail-btn-farmer:hover {
        background-color: #a7f3d0; /* Warna hover */
    }
     h2.mb-4 {
         margin-top: 20px; /* Ruang di atas judul */
         margin-bottom: 30px !important; /* Ruang di bawah judul */
         color: #14532d; /* Warna judul */
         text-align: center;
     }

</style>

<div class="custom-navbar-space"></div> {{-- Memberi ruang di bawah navbar --}}

<div class="container py-4">
    <h2 class="mb-4">Daftar Konsultasi Saya</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($konsultasis->isEmpty())
        <div class="alert alert-info">Anda belum memiliki riwayat konsultasi.</div>
    @else
        <div class="list-group"> {{-- list-group tetap digunakan sebagai container flex --}}
            @foreach($konsultasis as $konsultasi)
                <a href="{{ route('konsultasi.farmer_detail', $konsultasi->id) }}" class="farmer-consultation-item d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="mb-1">Permasalahan: {{ $konsultasi->question }}</h5>
                        <p class="mb-1">Ahli Tani: {{ $konsultasi->ahliTani->name ?? 'N/A' }}</p>
                        <small>Status: <span class="consult-status-badge {{ $konsultasi->is_done ? 'bg-success text-white' : 'bg-warning text-dark' }}">{{ $konsultasi->is_done ? 'Selesai' : 'Menunggu Jawaban' }}</span></small>
                    </div>
                     <span class="badge rounded-pill view-detail-btn-farmer">Lihat Detail</span> {{-- Menggunakan span dengan styling tombol --}}
                </a>
            @endforeach
        </div>
    @endif
</div>
@endsection 