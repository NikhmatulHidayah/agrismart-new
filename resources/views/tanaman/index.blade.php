@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-center fw-bold">Monitoring Tanaman Saya</h2>

    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('tanaman.create') }}" class="btn btn-success">
            + Tambah Data Tanaman
        </a>
    </div>

    @if($tanamans->isEmpty())
        <div class="alert alert-info text-center" role="alert">
            Belum ada data tanaman. Silakan tambah data terlebih dahulu.
        </div>
    @else
    <div class="table-responsive">
        <table class="table table-bordered table-striped shadow-sm align-middle">
            <thead class="table-success text-center">
                <tr>
                    <th>Nama Tanaman</th>
                    <th>Tanggal Ditanam</th>
                    <th>Prediksi Pupuk 1</th>
                    <th>Prediksi Pupuk 2</th>
                    <th>Prediksi Pupuk 3</th>
                    <th>Prediksi Panen</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody class="text-center">
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

                        $pupuk1 = $tanggalDitanam->copy()->addDays($durasi['pupuk1'])->format('d-m-Y');
                        $pupuk2 = $tanggalDitanam->copy()->addDays($durasi['pupuk2'])->format('d-m-Y');
                        $pupuk3 = $tanggalDitanam->copy()->addDays($durasi['pupuk3'])->format('d-m-Y');
                        $panen  = $tanggalDitanam->copy()->addDays($durasi['panen'])->format('d-m-Y');
                    @endphp

                    <tr>
                        <td>{{ $tanaman->nama_tanaman }}</td>
                        <td>{{ $tanggalDitanam->format('d-m-Y') }}</td>
                        <td>{{ $pupuk1 }}</td>
                        <td>{{ $pupuk2 }}</td>
                        <td>{{ $pupuk3 }}</td>
                        <td>{{ $panen }}</td>
                        <td>
                            <a href="{{ route('tanaman.edit', $tanaman->id) }}" class="btn btn-warning btn-sm mb-1">Edit</a>

                            <button type="button" class="btn btn-danger btn-sm delete-btn" data-id="{{ $tanaman->id }}">Hapus</button>

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
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // SweetAlert konfirmasi Hapus
    const deleteButtons = document.querySelectorAll('.delete-btn');
    deleteButtons.forEach(button => {
        button.addEventListener('click', function () {
            const id = this.getAttribute('data-id');
            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: "Data tanaman akan dihapus permanen!",
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

    // SweetAlert sukses untuk tambah/edit/hapus
    @if (session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Sukses!',
            text: '{{ session('success') }}',
            confirmButtonColor: '#198754'
        });
    @endif
});
</script>
@endpush
