@extends('expert.app')

@section('content')
<style>
    body {
        background: linear-gradient(135deg, #e2f4e1 0%, #f8fafc 100%);
    }
    .custom-navbar-space {
        margin-bottom: 50px; /* Memberi ruang di bawah navbar, sedikit dilebarkan */
    }
    .consult-list-item {
        background-color: rgba(255, 255, 255, 0.9); /* Background putih sedikit transparan */
        backdrop-filter: blur(5px); /* Efek blur pada background */
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
    }
    .consult-list-item:hover {
        transform: translateY(-5px); /* Efek angkat saat hover */
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2), 0 5px 10px rgba(0, 0, 0, 0.12);
    }
    .consult-list-item h5 {
        color: #14532d; /* Warna teks topik */
        font-weight: 600;
        margin-bottom: 5px;
    }
    .consult-list-item p {
        color: #555; /* Warna teks petani */
        margin-bottom: 5px;
        font-size: 0.95rem;
    }
    .consult-list-item small {
        color: #777; /* Warna teks status */
        font-size: 0.85rem;
    }
    .consult-status-badge {
        /* Styling untuk badge status */
        padding: 5px 10px;
        border-radius: 10px;
        font-size: 0.8rem;
        font-weight: bold;
    }
    .view-detail-btn {
         background-color: #6ee7b7; /* Warna hijau muda */
         color: #14532d; /* Warna teks hijau tua */
         border: none;
         border-radius: 8px;
         padding: 8px 15px;
         font-size: 0.9rem;
         font-weight: 600;
         transition: background-color 0.2s ease-in-out;
    }
    .view-detail-btn:hover {
        background-color: #a7f3d0; /* Warna hover */
    }

</style>
<div class="custom-navbar-space"></div> {{-- Memberi ruang di bawah navbar --}}
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <h2 class="mb-4">Konsultasi Masuk</h2>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if($konsultasis->isEmpty())
                <div class="alert alert-info">Tidak ada konsultasi masuk saat ini.</div>
            @else
                <div class="list-group">
                    @foreach($konsultasis as $konsultasi)
                        <a href="{{ route('expert.konsultasi.show', $konsultasi->id) }}" class="consult-list-item d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="mb-1">Permasalahan: {{ $konsultasi->question }}</h5>
                                <p class="mb-1">Dari Petani: {{ $konsultasi->petani->name ?? 'N/A' }}</p>
                                <small>Status: <span class="consult-status-badge {{ $konsultasi->is_done ? 'bg-success text-white' : 'bg-warning text-dark' }}">{{ $konsultasi->is_done ? 'Selesai' : 'Menunggu Jawaban' }}</span></small>
                            </div>
                            <span class="view-detail-btn">View Detail</span>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
@endsection 