@extends('layouts.app')

@section('content')
<style>
    body {
        background: #f8f9fa;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        margin: 0;
        padding: 0;
        min-height: 100vh;
    }
    .success-card {
        border-radius: 15px;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2), 0 6px 6px rgba(0, 0, 0, 0.1);
        border: none;
        background: rgba(255, 255, 255, 0.9);
        padding: 30px;
        position: relative;
        overflow: hidden;
        transition: transform 0.3s ease-in-out;
    }
    .success-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.3), 0 10px 10px rgba(0, 0, 0, 0.2);
    }
    .center-vertically {
        min-height: 80vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .success-icon {
        font-size: 3rem;
        color: #28a745;
        margin-bottom: 15px;
    }
    h2.text-success {
        color: #28a745 !important;
        font-size: 1.8rem;
        font-weight: 600;
    }
    .lead.mb-4 {
        font-size: 1.1rem;
        color: #555;
        margin-bottom: 25px !important;
    }
    .btn-green-muda {
        background: #28a745;
        color: white;
        border: none;
        font-weight: 500;
        border-radius: 5px;
        padding: 10px 24px;
        transition: background-color 0.2s ease-in-out;
    }
    .btn-green-muda:hover {
        background: #218838;
        color: white;
    }
</style>
<div class="container center-vertically">
    <div class="row justify-content-center w-100">
        <div class="col-md-8">
            <div class="card text-center success-card">
                <div class="card-body py-5">
                    <div class="success-icon mb-3">
                        <i class="bi bi-check-circle-fill"></i>
                    </div>
                    <h2 class="text-success mb-3">Pembayaran Berhasil!</h2>
                    <p class="lead mb-4">Terima kasih, pembayaran pertemuan Anda telah berhasil diproses.<br>Silakan tunggu konfirmasi dari ahli tani.</p>
                    <a href="{{ route('ordermeet.index') }}" class="btn btn-green-muda px-4">Lihat Daftar Pertemuan</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 