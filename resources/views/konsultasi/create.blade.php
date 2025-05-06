@extends('layouts.app')

@section('content')
    <h1>Create New Consultation</h1>

    <form action="{{ route('konsultasi.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Menampilkan pesan error jika ada -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="form-group mt-3">
            <label for="question">Consultation Topic</label>
            <input type="text" name="question" id="question" class="form-control" value="{{ old('question') }}" required>
        </div>

        <div class="form-group mt-3">
            <label for="deskripsi">Problem Description</label>
            <textarea name="deskripsi" id="deskripsi" class="form-control" rows="5" required>{{ old('deskripsi') }}</textarea>
        </div>

        <div class="form-group mt-3">
            <label for="gambar_masalah">Upload Problem Image</label>
            <input type="file" name="gambar_masalah" id="gambar_masalah" class="form-control">
        </div>

        <button type="submit" class="btn btn-green mt-3">Submit Consultation</button>
    </form>
@endsection
