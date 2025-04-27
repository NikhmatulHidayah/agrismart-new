@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card shadow-sm">
                <div class="card-header bg-warning text-white">
                    <h4 class="mb-0">Edit Data Tanaman</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('tanaman.update', $tanaman->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="nama_tanaman" class="form-label">Nama Tanaman</label>
                            <select name="nama_tanaman" id="nama_tanaman" class="form-select" required>
                                @foreach($tanamanList as $tanamanName)
                                    <option value="{{ $tanamanName }}" {{ $tanaman->nama_tanaman == $tanamanName ? 'selected' : '' }}>
                                        {{ $tanamanName }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="tanggal_ditanam" class="form-label">Tanggal Ditanam</label>
                            <input type="date" name="tanggal_ditanam" id="tanggal_ditanam" class="form-control" value="{{ $tanaman->tanggal_ditanam }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea name="deskripsi" id="deskripsi" class="form-control" rows="4">{{ $tanaman->deskripsi }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="picture" class="form-label">Upload Foto Baru (Opsional)</label>
                            <input type="file" name="picture" id="picture" class="form-control">
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-warning px-4">Update</button>
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
document.addEventListener('DOMContentLoaded', function () {
    // SweetAlert sukses edit
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

