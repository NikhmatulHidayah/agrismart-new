@extends('layouts.app')

@section('content')
<div class="container py-4 mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <a href="{{ route('konsultasi.index') }}" class="btn btn-secondary mb-3">Kembali ke Daftar Ahli</a> {{-- Assuming this is where they came from --}}
            <div class="card shadow-lg border-0 rounded-4" style="background: #fff;">
                <div class="card-header" style="background: #6ee7b7; color: #14532d; border-bottom: 0; border-top-left-radius: 1rem; border-top-right-radius: 1rem;">
                    <h4 class="mb-0 fw-bold" style="color: #14532d;">Detail Konsultasi</h4>
                </div>
                <div class="card-body p-4">
                    <div class="mb-3">
                        <h5 class="fw-semibold" style="color: #14532d;">Permasalahan:</h5>
                        <p>{{ $konsultasi->question }}</p>
                    </div>

                    @if($konsultasi->picture_question)
                        <div class="mb-3">
                            <h5 class="fw-semibold" style="color: #14532d;">Gambar Terlampir:</h5>
                            <img src="{{ asset('storage/' . $konsultasi->picture_question) }}" alt="Gambar Konsultasi" class="img-fluid rounded shadow" style="max-height: 300px;">
                        </div>
                    @endif

                    <hr>

                    <h4 class="mb-3 fw-bold" style="color: #14532d;">Jawaban Ahli</h4>

                    @if($konsultasi->is_done)
                        <div class="mb-3">
                            <h5 class="fw-semibold" style="color: #14532d;">Status: <span class="badge bg-success">Selesai</span></h5>
                        </div>
                         @if($konsultasi->feedback)
                            <div class="mb-3">
                                <h5 class="fw-semibold" style="color: #14532d;">Jawaban:</h5>
                                <p>{{ $konsultasi->feedback }}</p>
                            </div>
                        @endif

                        @if($konsultasi->picture_feedback)
                            <div class="mb-3">
                                <h5 class="fw-semibold" style="color: #14532d;">Gambar dari Ahli:</h5>
                                <img src="{{ asset('storage/' . $konsultasi->picture_feedback) }}" alt="Gambar Jawaban Ahli" class="img-fluid rounded shadow" style="max-height: 300px;">
                            </div>
                        @endif

                    @else
                        <div class="mb-3">
                            <h5 class="fw-semibold" style="color: #14532d;">Status: <span class="badge bg-warning text-dark">Menunggu Jawaban Ahli</span></h5>
                            <p>Silakan tunggu ahli tani memberikan jawaban atas konsultasi Anda.</p>
                        </div>
                    @endif

                    {{-- Link back to farmer's consultation list (if such a page exists) --}}
                     {{-- <a href="{{ route('farmer.konsultations') }}" class="btn btn-secondary mt-3">Kembali ke Daftar Konsultasi Saya</a> --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 