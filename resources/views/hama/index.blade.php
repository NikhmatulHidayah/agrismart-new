@extends('layouts.app')

@section('content')

<!-- Hero Section + Form + Result -->
<section class="position-relative d-flex flex-column justify-content-center align-items-center text-center text-white" style="min-height: 100vh; overflow: hidden; padding-top: 150px;">
    <!-- Background -->
    <div style="
        background: url('{{ asset('images/thumb-hama.jpg') }}') center center / cover no-repeat;
        filter: brightness(65%) blur(1px);
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        z-index: 1;
    "></div>

    <!-- Konten -->
    <div class="container position-relative z-2">
        <!-- Judul -->
        <h1 class="fw-bold mb-4" style="font-size: 2.8rem; text-shadow: 2px 2px 8px rgba(0,0,0,0.7);">
            Rekomendasi Penanganan Hama
        </h1>
        <p class="lead mb-5" style="max-width: 600px; margin: 0 auto; text-shadow: 1px 1px 5px rgba(0,0,0,0.5);">
            Cari solusi terbaik untuk melindungi tanamanmu dari serangan hama 🌱
        </p>

        <!-- Form -->
        <div class="row justify-content-center mb-5">
            <div class="col-md-8">
                <div class="card shadow-sm border-0 rounded-4" style="background: rgba(255, 255, 255, 0.9);">
                    <div class="card-body p-4">
                        <form method="GET" action="{{ url('/hama') }}">
                            <div class="mb-4">
                                <label for="jenis_hama" class="form-label fw-semibold text-dark">Pilih Jenis Hama</label>
                                <select name="jenis_hama" id="jenis_hama" class="form-select" required>
                                    <option value="">-- Pilih Hama --</option>
                                    @foreach($hamas as $hama)
                                        <option value="{{ $hama }}" {{ (isset($request) && $request->jenis_hama == $hama) ? 'selected' : '' }}>
                                            {{ $hama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-success rounded-pill py-2 fw-semibold">
                                    Cari Rekomendasi
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Hasil Rekomendasi -->
        @if (isset($data))
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm border-0 rounded-4 p-4 text-center" style="background: rgba(255, 255, 255, 0.9);">
                    <h4 class="fw-bold mb-4" style="color: #14532d;">Rekomendasi Penanganan</h4>
                    <img src="{{ asset($data->gambar) }}" alt="Gambar Hama" class="img-fluid rounded mb-4" style="max-height: 300px; object-fit: contain;">
                    <p class="lead" style="font-size: 1.1rem; color: #333;">{{ $data->rekomendasi }}</p>
                </div>
            </div>
        </div>
        @endif
    </div>
</section>

@endsection
