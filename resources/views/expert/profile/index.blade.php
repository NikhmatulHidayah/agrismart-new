@extends('layouts.app')

@section('content')
<div class="container py-4 mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <a href="{{ route('expert.dashboard') }}" class="btn btn-success mb-3">Kembali ke Dashboard</a>
            <div class="card shadow-lg border-0 rounded-4" style="background: #fff;">
                <div class="card-header" style="background: #6ee7b7; color: #14532d; border-bottom: 0; border-top-left-radius: 1rem; border-top-right-radius: 1rem;">
                    <h4 class="mb-0 fw-bold" style="color: #14532d;">Data Profil Ahli Tani</h4>
                </div>
                <div class="card-body p-4">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($dataAhliTani)
                        <div class="mb-3">
                            <h5 class="fw-semibold" style="color: #14532d;">Status</h5>
                            <span class="badge
                                @if(strtolower($dataAhliTani->status) == 'approved') bg-success
                                @elseif(strtolower($dataAhliTani->status) == 'reject') bg-danger
                                @else bg-secondary
                                @endif px-3 py-2">
                                {{ ucfirst($dataAhliTani->status) }}
                            </span>
                        </div>
                        <div class="mb-3">
                            <h5 class="fw-semibold" style="color: #14532d;">Sertifikat</h5>
                            @if($dataAhliTani->certificate)
                                <button type="button" class="btn btn-outline-success btn-sm" data-bs-toggle="modal" data-bs-target="#showCertificateModal">
                                    Show Image
                                </button>
                            @else
                                <span class="text-muted">Belum ada sertifikat</span>
                            @endif
                        </div>
                        <!-- Modal Sertifikat -->
                        <div class="modal fade" id="showCertificateModal" tabindex="-1" aria-labelledby="showCertificateModalLabel" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="showCertificateModalLabel">Sertifikat</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body text-center">
                                <img src="{{ asset('storage/' . $dataAhliTani->certificate) }}" alt="Sertifikat" class="img-fluid rounded shadow" style="max-height:400px;">
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="mb-3">
                            <h5 class="fw-semibold" style="color: #14532d;">Masa Berlaku Sertifikat</h5>
                            <p>{{ \Carbon\Carbon::parse($dataAhliTani->expired_certificate)->format('d F Y') }}</p>
                        </div>
                        <div class="mb-3">
                            <h5 class="fw-semibold" style="color: #14532d;">Biaya Konsultasi</h5>
                            <p class="fs-5 fw-bold">Rp {{ number_format($dataAhliTani->price, 0, ',', '.') }}</p>
                        </div>
                        <div class="mb-3">
                            <h5 class="fw-semibold" style="color: #14532d;">Pengalaman (Tahun)</h5>
                            <p>{{ $dataAhliTani->yoe }} tahun</p>
                        </div>
                        <div class="mb-3">
                            <h5 class="fw-semibold" style="color: #14532d;">Alumni</h5>
                            <p>{{ $dataAhliTani->alumni }}</p>
                        </div>
                        <a href="{{ route('expert.profile.edit') }}" class="btn btn-success">Edit Data</a>
                    @else
                        <div class="d-flex justify-content-center align-items-center" style="min-height: 300px;">
                            <div class="card shadow-sm p-4 text-center" style="background: #e0f7fa; border: 1.5px solid #38b6ff; max-width: 400px; margin: auto;">
                                <img src='https://img.icons8.com/fluency/48/000000/info.png' alt='info' class='mb-3' style='width:48px;'>
                                <p class="mb-4" style="color: #14532d; font-size: 1.1rem; font-weight: 500;">Anda belum menambahkan data profil.<br>Silakan tambahkan data profil Anda.</p>
                                <a href="{{ route('expert.profile.create') }}" class="btn btn-primary">Tambah Data Profil</a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 