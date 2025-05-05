@extends('layouts.app')

@section('content')
<section class="position-relative d-flex flex-column justify-content-center align-items-center text-center text-white" style="min-height: 100vh; overflow: hidden; padding-top: 150px;">
    <div style="
        background: url('{{ asset('images/thumb-monitoring.jpg') }}') center center / cover no-repeat;
        filter: brightness(65%) blur(1px);
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        z-index: 1;
    "></div>

    <div class="container position-relative z-2">
        <h1 class="fw-bold mb-4" style="font-size: 2.8rem; text-shadow: 2px 2px 8px rgba(0,0,0,0.7);">
            Rekomendasi Pemupukan Tanaman
        </h1>
        <p class="lead mb-5" style="max-width: 600px; margin: 0 auto; text-shadow: 1px 1px 5px rgba(0,0,0,0.5);">
            Temukan jenis pupuk terbaik berdasarkan jenis tanaman, kondisi tanah, dan tahap pertumbuhan 🌿
        </p>

        <!-- Form Input -->
        <div class="row justify-content-center mb-5">
            <div class="col-md-8">
                <div class="card shadow-sm border-0 rounded-4" style="background: rgba(255, 255, 255, 0.9);">
                    <div class="card-body p-4">
                        <form method="GET" action="{{ url('/pemupukan') }}">
                            <div class="mb-3">
                                <label class="form-label fw-semibold text-dark">Jenis Tanaman</label>
                                <select name="jenis_tanaman" class="form-select" required>
                                    <option value="">-- Pilih Tanaman --</option>
                                    @foreach($tanamans as $item)
                                        <option value="{{ $item }}" {{ request('jenis_tanaman') == $item ? 'selected' : '' }}>{{ $item }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold text-dark">Kondisi Tanah</label>
                                <select name="kondisi_tanah" class="form-select" required>
                                    <option value="">-- Pilih Kondisi Tanah --</option>
                                    @foreach($tanahs as $item)
                                        <option value="{{ $item }}" {{ request('kondisi_tanah') == $item ? 'selected' : '' }}>{{ $item }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-semibold text-dark">Tahap Pertumbuhan</label>
                                <select name="tahap_pertumbuhan" class="form-select" required>
                                    <option value="">-- Pilih Tahap --</option>
                                    @foreach($tahaps as $item)
                                        <option value="{{ $item }}" {{ request('tahap_pertumbuhan') == $item ? 'selected' : '' }}>{{ $item }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-success rounded-pill py-2 fw-semibold">Cari Rekomendasi</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Hasil Rekomendasi -->
        @isset($rekomendasi)
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm border-0 rounded-4 p-4 text-center" style="background: rgba(255, 255, 255, 0.9);">
                    <h4 class="fw-bold mb-4" style="color: #14532d;">Rekomendasi Pemupukan</h4>
                    @if($rekomendasi->gambar)
                        <img src="{{ asset($rekomendasi->gambar) }}" alt="Gambar Pupuk" class="img-fluid rounded mb-4" style="max-height: 300px; object-fit: contain;">
                    @endif
                    <p class="lead" style="font-size: 1.1rem; color: #333;">{{ $rekomendasi->rekomendasi }}</p>
                </div>
            </div>
        </div>
        @endisset

    </div>
</section>
@endsection
