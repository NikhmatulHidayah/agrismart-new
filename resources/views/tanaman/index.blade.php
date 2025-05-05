@extends('layouts.app')

@section('content')

<!-- Hero Section Monitoring (FULLSCREEN) -->
<section class="position-relative d-flex flex-column justify-content-center align-items-center text-center text-white" style="min-height: 100vh; overflow: hidden;">
    <div style="
        background: url('{{ asset('images/thumb-monitoring.jpg') }}') center center / cover no-repeat;
        filter: brightness(65%) blur(1px);
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        z-index: 1;
    "></div>

    <div class="container position-relative z-2">
        <h1 class="fw-bold mb-3" style="font-size: 3rem; text-shadow: 2px 2px 8px rgba(0,0,0,0.7);">
            Monitoring Tanaman Saya
        </h1>
        <p class="lead" style="max-width: 700px; margin: 0 auto; text-shadow: 1px 1px 5px rgba(0,0,0,0.5);">
            Pantau jadwal pemupukan dan prediksi panen tanamanmu dengan AgriSmart 🌱
        </p>
    </div>
</section>

<!-- Section Data Tabel -->
<section class="py-5" style="background-color: #e9f7ef;">
    <div class="container">

        <!-- Tombol Tambah -->
        <div class="d-flex justify-content-end mb-4">
            <a href="{{ route('tanaman.create') }}" class="btn btn-success rounded-pill px-4 py-2 shadow-sm btn-animated">
                + Tambah Data
            </a>
        </div>

        <!-- Tabel -->
        @if($tanamans->isEmpty())
            <div class="alert alert-info text-center" role="alert">
                Belum ada data tanaman. Yuk tambah dulu!
            </div>
        @else
        <div class="table-responsive shadow-sm rounded-3 bg-white p-4">
            <table class="table align-middle text-center">
                <thead class="table-success">
                    <tr>
                        <th>Nama Tanaman</th>
                        <th>Tanggal Ditanam</th>
                        <th>Pupuk 1</th>
                        <th>Pupuk 2</th>
                        <th>Pupuk 3</th>
                        <th>Prediksi Panen</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tanamans as $tanaman)
                        @php
                            $tanggalDitanam = \Carbon\Carbon::parse($tanaman->tanggal_ditanam);
                            $mappingDurasi = [
                                'Tomat' => ['pupuk1' => 14, 'pupuk2' => 28, 'pupuk3' => 42, 'panen' => 90],
                                'Cabai' => ['pupuk1' => 21, 'pupuk2' => 42, 'pupuk3' => 63, 'panen' => 120],
                                'Jagung' => ['pupuk1' => 10, 'pupuk2' => 30, 'pupuk3' => 50, 'panen' => 100],
                                'Padi' => ['pupuk1' => 15, 'pupuk2' => 30, 'pupuk3' => 45, 'panen' => 105],
                            ];
                            $durasi = $mappingDurasi[$tanaman->nama_tanaman] ?? ['pupuk1' => 14, 'pupuk2' => 28, 'pupuk3' => 42, 'panen' => 90];

                            $pupuk1 = $tanggalDitanam->copy()->addDays($durasi['pupuk1'])->format('d M Y');
                            $pupuk2 = $tanggalDitanam->copy()->addDays($durasi['pupuk2'])->format('d M Y');
                            $pupuk3 = $tanggalDitanam->copy()->addDays($durasi['pupuk3'])->format('d M Y');
                            $panen  = $tanggalDitanam->copy()->addDays($durasi['panen'])->format('d M Y');
                        @endphp

                        <tr>
                            <td>{{ $tanaman->nama_tanaman }}</td>
                            <td>{{ $tanggalDitanam->format('d M Y') }}</td>

                            <td>
                                <span class="badge badge-animated bg-success-subtle text-success rounded-pill px-3 py-2 shadow-sm" style="font-size: 0.9rem;">
                                    {{ $pupuk1 }}
                                </span>
                            </td>

                            <td>
                                <span class="badge badge-animated bg-primary-subtle text-primary rounded-pill px-3 py-2 shadow-sm" style="font-size: 0.9rem;">
                                    {{ $pupuk2 }}
                                </span>
                            </td>

                            <td>
                                <span class="badge badge-animated bg-warning-subtle text-warning rounded-pill px-3 py-2 shadow-sm" style="font-size: 0.9rem;">
                                    {{ $pupuk3 }}
                                </span>
                            </td>

                            <td>
                                <span class="badge badge-animated bg-success text-white rounded-pill px-3 py-2 shadow-sm" style="font-size: 0.9rem;">
                                    {{ $panen }}
                                </span>
                            </td>

                            <td>
                                <a href="{{ route('tanaman.edit', $tanaman->id) }}" class="btn btn-warning btn-sm rounded-pill me-1 px-3 py-2 shadow-sm btn-animated">
                                    ✏️ Edit
                                </a>
                                <button type="button" class="btn btn-danger btn-sm rounded-pill px-3 py-2 shadow-sm btn-animated delete-btn" data-id="{{ $tanaman->id }}">
                                    🗑️ Hapus
                                </button>

                                <form id="delete-form-{{ $tanaman->id }}" action="{{ route('tanaman.destroy', $tanaman->id) }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif

    </div>
</section>

<!-- Animasi Hover -->
<style>
    .btn-animated:hover {
        transform: scale(1.08);
        transition: all 0.3s ease;
    }

    .badge-animated {
        transition: all 0.3s ease;
    }
    .badge-animated:hover {
        background-color: #14532d !important;
        transform: scale(1.05);
    }
</style>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const deleteButtons = document.querySelectorAll('.delete-btn');
    deleteButtons.forEach(button => {
        button.addEventListener('click', function () {
            const id = this.getAttribute('data-id');
            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: "Data tanaman ini akan dihapus permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`delete-form-${id}`).submit();
                }
            });
        });
    });

    @if (session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session('success') }}',
            confirmButtonColor: '#198754',
            timer: 2000,
            showConfirmButton: false
        });
    @endif
});
</script>
@endpush
