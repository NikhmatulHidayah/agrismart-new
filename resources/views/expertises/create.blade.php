@extends('layouts.app')

@section('content')
    <h2>Tambah Data Ahli Tani</h2>

    <!-- Tampilkan error jika ada -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('expertises.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="status">Status</label>
            <input type="text" id="status" name="status" value="{{ old('status') }}" required>
        </div>

        <div class="form-group">
            <label for="yoe">Pengalaman (tahun)</label>
            <input type="number" id="yoe" name="yoe" value="{{ old('yoe') }}" required>
        </div>

        <div class="form-group">
            <label for="certificate">Unggah Sertifikat (Wajib)</label>
            <input type="file" id="certificate" name="certificate" required>
        </div>

        <button type="submit" class="btn-green">Simpan</button>
        <a href="{{ route('expertises.index') }}" class="btn-grey">Batal</a>
    </form>
@endsection
