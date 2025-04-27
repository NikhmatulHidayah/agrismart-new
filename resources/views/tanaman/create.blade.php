@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card shadow-sm">
                <div class="card-header bg-success text-white">
                    <h4 class="mb-0">Tambah Data Tanaman</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('tanaman.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="nama_tanaman" class="form-label">Nama Tanaman</label>
                            <select name="nama_tanaman" id="nama_tanaman" class="form-select" required>
                                <option value="" disabled selected>-- Pilih Tanaman --</option>
                                @foreach($tanamanList as $tanaman)
                                    <option value="{{ $tanaman }}">{{ $tanaman }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="tanggal_ditanam" class="form-label">Tanggal Ditanam</label>
                            <input type="date" name="tanggal_ditanam" id="tanggal_ditanam" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi Aktivitas Pertanian</label>
                            <textarea name="deskripsi" id="deskripsi" class="form-control" rows="4" placeholder="Contoh: Menyiram tanaman, memberi pupuk, mengecek pertumbuhan..."></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="picture" class="form-label">Upload Foto Tanaman (Opsional)</label>
                            <input type="file" name="picture" id="picture" class="form-control">
                            <img id="preview-image" style="max-width: 100%; margin-top: 10px; display: none;">
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-success px-4">Simpan</button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
// Untuk preview gambar tetap pakai JS
document.addEventListener('DOMContentLoaded', function () {
    const pictureInput = document.getElementById('picture');
    if (pictureInput) {
        pictureInput.addEventListener('change', function(event) {
            const [file] = event.target.files;
            if (file) {
                const preview = document.getElementById('preview-image');
                preview.src = URL.createObjectURL(file);
                preview.style.display = 'block';
            }
        });
    }
});
</script>

@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: '{{ session('success') }}',
        confirmButtonColor: '#198754'
    });
</script>
@endif

@if(session('error'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Gagal!',
        text: '{{ session('error') }}',
        confirmButtonColor: '#dc3545'
    });
</script>
@endif

@endpush

