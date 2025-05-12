@extends('layouts.app')
@section('content')
<style>
    body {
        background: linear-gradient(135deg, #e2f4e1 0%, #f8fafc 100%);
    }
    .custom-navbar-space {
        margin-bottom: 40px;
        box-shadow: 0 8px 24px rgba(20, 83, 45, 0.08);
        border-radius: 0 0 30px 30px;
        background: #fff;
        min-height: 30px;
    }
    .consult-card {
        border-radius: 28px;
        box-shadow: 0 8px 32px rgba(20, 83, 45, 0.18), 0 1.5px 4px rgba(20, 83, 45, 0.10);
        border: none;
        background: #fff;
        margin-top: 50px;
        margin-bottom: 50px;
        transition: box-shadow 0.2s, transform 0.2s;
    }
    .consult-card:hover {
        box-shadow: 0 16px 48px rgba(20, 83, 45, 0.22), 0 2px 8px rgba(20, 83, 45, 0.12);
        transform: translateY(-6px) scale(1.01);
    }
    .consult-header {
        background: #a7f3d0;
        border-radius: 28px 28px 0 0;
        color: #14532d;
        box-shadow: 0 2px 8px rgba(20, 83, 45, 0.10);
        display: flex;
        align-items: center;
        gap: 12px;
    }
    .consult-header-icon {
        font-size: 2rem;
        margin-right: 8px;
        color: #16a34a;
    }
    .form-label {
        font-weight: 600;
        color: #14532d;
    }
    .form-control, .form-control:focus {
        border-radius: 12px;
        border: 1.5px solid #bbf7d0;
        box-shadow: none;
        transition: border-color 0.2s;
    }
    .form-control:focus {
        border-color: #6ee7b7;
    }
    .consult-btn {
        background: #6ee7b7;
        border: none;
        font-weight: 600;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(20, 83, 45, 0.10);
        transition: background 0.2s, box-shadow 0.2s;
        color: #14532d;
    }
    .consult-btn:hover {
        background: #a7f3d0;
        color: #14532d;
        box-shadow: 0 4px 16px rgba(20, 83, 45, 0.18);
    }
    .input-group-text {
        background: #bbf7d0;
        border-radius: 12px 0 0 12px;
        border: none;
        color: #16a34a;
        font-size: 1.2rem;
    }
</style>
<div class="custom-navbar-space"></div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-8">
            <div class="card consult-card animate__animated animate__fadeInUp">
                <div class="card-header consult-header">
                    <span class="consult-header-icon"><i class="bi bi-chat-dots-fill"></i></span>
                    <h4 class="mb-0">Isi Konsultasi</h4>
                </div>
                <div class="card-body py-4">
                    <form action="{{ route('submit_konsultasi') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <label for="topik" class="form-label">Topik Permasalahan</label>
                            <input type="text" class="form-control" id="topik" name="topik" required>
                        </div>
                        <div class="mb-4">
                            <label for="deskripsi" class="form-label">Deskripsi Permasalahan</label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4" required></textarea>
                        </div>
                        <div class="mb-4">
                            <label for="foto" class="form-label">Foto Permasalahan (opsional)</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-image"></i></span>
                                <input type="file" class="form-control" id="foto" name="foto" accept="image/*">
                            </div>
                        </div>
                        <button type="submit" class="btn consult-btn px-4 py-2">Kirim Konsultasi</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 