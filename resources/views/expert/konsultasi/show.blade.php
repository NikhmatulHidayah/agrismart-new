@extends('expert.app')

@section('content')
<style>
    body {
        background: linear-gradient(135deg, #e2f4e1 0%, #f8fafc 100%); /* Warna background dari layout farmer */
    }
    .consult-detail-card {
        border-radius: 20px; /* Sudut membulat */
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1), 0 3px 6px rgba(0, 0, 0, 0.05); /* Bayangan untuk efek 3D */
        border: none; /* Tanpa border */
        background: rgba(255, 255, 255, 0.9); /* Background putih sedikit transparan */
        backdrop-filter: blur(5px); /* Efek blur pada background di belakang card */
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
    }
    .consult-detail-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15), 0 5px 10px rgba(0, 0, 0, 0.08);
    }
    .consult-detail-header {
        background: #a7f3d0; /* Warna header */
        color: #14532d; /* Warna teks header */
        border-top-left-radius: 20px; /* Sudut membulat atas */
        border-top-right-radius: 20px;
        padding: 15px 25px;
        font-size: 1.4rem;
        font-weight: bold;
    }
    .consult-detail-body {
        padding: 25px;
    }
    .consult-detail-body strong {
        color: #14532d; /* Warna label */
    }
    .consult-detail-body p {
        margin-bottom: 15px;
        line-height: 1.6;
    }
    .consult-detail-body hr {
        border-top: 1px solid #bbf7d0; /* Garis pemisah */
        margin: 20px 0;
    }
</style>
<div class="container pt-5 mt-4 mb-5">
    <a href="{{ route('expert.konsultasi.index') }}" class="btn btn-secondary mb-3">Kembali ke Daftar Konsultasi</a>

    <h1>Detail Konsultasi</h1>

    @if ($konsultasi)
    <div class="card consult-detail-card">
        <div class="consult-detail-header">
            Detail Konsultasi
        </div>
        <div class="consult-detail-body">
            <p><strong>Permasalahan:</strong> {{ $konsultasi->question }}</p>
            <p><strong>Dari Petani:</strong> {{ $konsultasi->petani->name ?? '-' }}</p>
            {{-- DEBUG: Tampilkan nilai picture_question --}}
            <p><strong>Debug Picture Path (Expert):</strong> {{ $konsultasi->picture_question ?? 'Kosong' }}</p>
            @if ($konsultasi->picture_question)
            <p><strong>Foto:</strong></p>
            <img src="{{ asset('storage/' . $konsultasi->picture_question) }}" alt="Foto Konsultasi" class="img-fluid rounded shadow" style="max-width: 400px; height: auto;">
            @endif
            <p><strong>Status:</strong> {{ $konsultasi->is_done ? 'Selesai' : 'Menunggu Jawaban' }}</p>

            {{-- Form untuk Jawaban Ahli --}}
            @if (!$konsultasi->is_done)
            <hr>
            <h5>Berikan Jawaban Anda</h5>
            <form action="{{ route('expert.konsultasi.submitAnswer', $konsultasi->id) }}" method="POST">
                @csrf
                {{-- method put karena update data --}}
                @method('PUT') 

                <div class="mb-3">
                    <label for="answer" class="form-label">Jawaban:</label>
                    <textarea class="form-control" id="answer" name="answer" rows="5" required></textarea>
                </div>
                {{-- Input untuk feedback dan picture_feedback akan ditambahkan jika diperlukan --}}
                
                <button type="submit" class="btn btn-primary">Kirim Jawaban</button>
            </form>
            @else
            <hr>
            <h5>Jawaban Anda</h5>
            <p>{{ $konsultasi->feedback ?? '-' }}</p>
            @endif
        </div>
    </div>

    @else
    <div class="alert alert-warning">Konsultasi tidak ditemukan atau bukan untuk Anda.</div>
    @endif
</div>
@endsection 