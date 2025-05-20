@extends('layouts.app')

@section('content')
<div class="container py-4 mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Tambah Data Profil Ahli Tani</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('expert.profile.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="status" value="Pending">
                        <div class="mb-3">
                            <label for="certificate" class="form-label">Sertifikat (Upload Gambar)</label>
                            <input type="file" class="form-control @error('certificate') is-invalid @enderror" id="certificate" name="certificate" accept="image/*" required>
                            @error('certificate')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="expired_certificate" class="form-label">Masa Berlaku Sertifikat</label>
                            <input type="date" class="form-control @error('expired_certificate') is-invalid @enderror" id="expired_certificate" name="expired_certificate" value="{{ old('expired_certificate') }}" required>
                            @error('expired_certificate')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Biaya Konsultasi</label>
                            <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price') }}" required>
                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="yoe" class="form-label">Pengalaman (Tahun)</label>
                            <input type="number" class="form-control @error('yoe') is-invalid @enderror" id="yoe" name="yoe" value="{{ old('yoe') }}" required>
                            @error('yoe')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="alumni" class="form-label">Alumni</label>
                            <input type="text" class="form-control @error('alumni') is-invalid @enderror" id="alumni" name="alumni" value="{{ old('alumni') }}" required>
                            @error('alumni')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('expert.profile.index') }}" class="btn btn-secondary">Kembali</a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 