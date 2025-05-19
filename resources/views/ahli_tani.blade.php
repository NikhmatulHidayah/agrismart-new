@extends('layouts.app')

@section('content')

<!-- Section Pemilihan Ahli Tani -->
<section class="py-5" style="background-color: #e2f4e1;">
    <div class="container">
        <h2 class="text-center fw-bold mb-5" style="color: #14532d; padding-top: 20px;" data-aos="fade-up">Pilih Ahli Tani</h2>

        <div class="row g-4 d-flex justify-content-between"> <!-- Flexbox untuk mengatur card agar lebih rapi -->
            @foreach($ahliTaniList as $index => $ahliTani)
            <div class="col-md-3" data-aos="fade-up" data-aos-delay="{{ 150 * ($index + 1) }}">
                <div class="card shadow-lg border-0 h-100 text-center fitur-card bg-white" style="transition: all 0.3s; border-radius: 15px;">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                        <img src="{{ asset('images/icons/profile.jpg') }}" alt="{{ $ahliTani->user->name ?? 'Ahli Tani' }}" class="rounded-circle mb-4" width="90">
                        <h5 class="card-title fw-bold text-success">{{ $ahliTani->user->name ?? 'Ahli Tani' }}</h5>
                        <p class="card-text mt-2 text-muted">Alumni: {{ $ahliTani->alumni }}</p>
                        <h6 class="mt-3 text-primary">Rp {{ number_format($ahliTani->price ?? 0, 0, ',', '.') }}</h6>
                        <a href="{{ url('/konsultasi/pembayaran/' . $ahliTani->id_ahli_tani) }}" class="btn btn-success rounded-pill mt-3 px-4 shadow-sm">Pilih</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- CSS Tambahan -->
<style>
    .fitur-card {
        background: linear-gradient(135deg, rgba(226,244,225,0.85) 0%, rgba(255,255,255,0.85) 100%) !important;
        border: 2px solid #bbf7d0 !important;
        box-shadow: 0 8px 32px rgba(20, 83, 45, 0.13), 0 1.5px 4px rgba(20, 83, 45, 0.08);
        border-radius: 15px;
        transition: 0.3s;
    }
    .fitur-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 12px 24px rgba(21, 84, 42, 0.25);
    }
    .btn:hover {
        transform: scale(1.05);
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
</script>
@endpush

@endsection
