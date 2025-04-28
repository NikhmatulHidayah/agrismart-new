@extends('layouts.app')

@section('content')
    <h2>Edit Data Ahli Tani</h2>

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

    <form action="{{ route('expertises.update', $dataAhliTani->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="status">Status</label>
            <input type="text" id="status" name="status" value="{{ old('status', $dataAhliTani->status) }}" required>
        </div>

        <div class="form-group">
            <label for="yoe">Pengalaman (tahun)</label>
            <input type="number" id="yoe" name="yoe" value="{{ old('yoe', $dataAhliTani->yoe) }}" required>
        </div>

        <div class="form-group">
            <label for="certificate">Ganti Sertifikat (Opsional)</label>
            <input type="file" id="certificate" name="certificate">
            @if ($dataAhliTani->certificate)
                <p>File saat ini: <a href="{{ asset('storage/' . $dataAhliTani->certificate) }}" target="_blank">Lihat Sertifikat</a></p>
            @endif
        </div>

        <button type="submit" class="btn-green">Perbarui</button>
        <a href="{{ route('expertises.index') }}" class="btn-grey">Batal</a>
    </form>
@endsection
