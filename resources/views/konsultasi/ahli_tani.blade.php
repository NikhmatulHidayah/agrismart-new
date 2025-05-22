@extends('layouts.app')

@section('content')
<style>
    body {
        background: #f4fbf6;
    }
    .ahli-card {
        background: rgba(167, 243, 208, 0.7); /* hijau muda transparan */
        border: none;
        border-radius: 18px;
        box-shadow: 0 8px 32px rgba(20, 83, 45, 0.10), 0 1.5px 4px rgba(20, 83, 45, 0.10);
        transition: box-shadow 0.2s, transform 0.2s;
        margin-bottom: 32px;
    }
    .ahli-card:hover {
        box-shadow: 0 16px 48px rgba(20, 83, 45, 0.18), 0 2px 8px rgba(20, 83, 45, 0.12);
        transform: translateY(-6px) scale(1.01);
    }
    .ahli-card .card-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #14532d;
        margin-bottom: 0.5rem;
        text-transform: capitalize;
    }
    .ahli-card .card-text {
        color: #14532d;
        font-size: 1.1rem;
    }
    .ahli-card .btn {
        background: #6ee7b7;
        color: #14532d;
        border: none;
        font-weight: 600;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(20, 83, 45, 0.10);
        transition: background 0.2s, box-shadow 0.2s;
    }
    .ahli-card .btn:hover {
        background: #a7f3d0;
        color: #14532d;
        box-shadow: 0 4px 16px rgba(20, 83, 45, 0.18);
    }
    .ahli-card .alumni {
        font-size: 1rem;
        color: #198754;
        font-weight: 500;
    }
    .ahli-card .harga {
        font-size: 1.2rem;
        font-weight: 700;
        color: #14532d;
        margin-bottom: 1rem;
    }
    .ahli-card .icon-ahli {
        font-size: 2.5rem;
        color: #16a34a;
        margin-bottom: 12px;
    }
    .ahli-row {
        justify-content: center;
    }
</style>
<div class="container py-4 mt-5">
    <h2 class="mb-5 text-center fw-bold" style="color: #14532d;">Pilih Ahli Tani untuk Konsultasi</h2>
    <div class="row ahli-row g-4">
        @forelse($ahliTaniList as $ahli)
            <div class="col-md-6 col-lg-4 d-flex align-items-stretch">
                <div class="card ahli-card w-100">
                    <div class="card-body text-center d-flex flex-column justify-content-center align-items-center">
                        <div class="icon-ahli mb-2">
                            <i class="bi bi-person-circle"></i>
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