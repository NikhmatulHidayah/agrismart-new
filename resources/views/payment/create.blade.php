@extends('layouts.app')

@section('content')
    <h1>Create New Consultation</h1>

    <form action="{{ route('konsultasi.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group mt-3">
            <label for="topik">Consultation Topic</label>
            <input type="text" name="topik" id="topik" class="form-control" required>
        </div>

        <div class="form-group mt-3">
            <label for="deskripsi">Problem Description</label>
            <textarea name="deskripsi" id="deskripsi" class="form-control" rows="5" required></textarea>
        </div>

        <div class="form-group mt-3">
            <label for="gambar_masalah">Upload Problem Image</label>
            <input type="file" name="gambar_masalah" id="gambar_masalah" class="form-control">
        </div>

        <button type="submit" class="btn btn-green mt-3">Submit Consultation</button>
    </form>
@endsection
