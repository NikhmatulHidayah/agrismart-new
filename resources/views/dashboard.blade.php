@extends('layouts.app')

@section('content')
<div class="d-flex">
    <!-- Sidebar -->
    <div class="bg-success p-3 text-white" style="width: 250px; min-height: 100vh;">
        <h4>AgriSmart</h4>
        <ul class="nav flex-column mt-4">
            <li class="nav-item mb-2">
                <a href="/dashboard" class="nav-link text-white">Dashboard</a>
            </li>
            <li class="nav-item mb-2">
                <a href="{{ route('tanaman.index') }}" class="nav-link text-white">Monitoring Tanaman</a>
            </li>
            <li class="nav-item mb-2">
                <a href="{{ route('hama.index') }}" class="nav-link text-white">Rekomendasi Penanganan Hama</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('pemupukan.index') }}" class="nav-link text-white">Saran Pemupukan</a>
            </li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="p-4" style="flex-grow: 1;">
        <h2>Selamat datang di AgriSmart!</h2>

        <div class="row mt-4">
            <!-- Card Monitoring Tanaman -->
            <div class="col-md-4 mb-3">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body text-center d-flex flex-column justify-content-between">
                        <div>
                            <h5 class="card-title">Monitoring Tanaman</h5>
                            <p class="card-text">Pantau pertumbuhan tanamanmu dengan mudah.</p>
                        </div>
                        <a href="{{ route('tanaman.index') }}" class="btn btn-primary mt-3">Lihat Monitoring</a>
                    </div>
                </div>
            </div>

            <!-- Card Rekomendasi Penanganan Hama -->
            <div class="col-md-4 mb-3">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body text-center d-flex flex-column justify-content-between">
                        <div>
                            <h5 class="card-title">Rekomendasi Hama</h5>
                            <p class="card-text">Cari solusi terbaik untuk mengatasi hama tanamanmu.</p>
                        </div>
                        <a href="{{ route('hama.index') }}" class="btn btn-warning mt-3">Lihat Rekomendasi</a>
                    </div>
                </div>
            </div>

            <!-- Card Saran Pemupukan (FITUR BARU) -->
            <div class="col-md-4 mb-3">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body text-center d-flex flex-column justify-content-between">
                        <div>
                            <h5 class="card-title">Saran Pemupukan</h5>
                            <p class="card-text">Dapatkan rekomendasi pemupukan sesuai jenis tanah dan tanaman.</p>
                        </div>
                        <a href="{{ route('pemupukan.index') }}" class="btn btn-success mt-3">Cari Saran</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
