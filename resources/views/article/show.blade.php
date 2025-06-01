@extends('layouts.app')

@section('content')
<!-- Artikel Detail -->
<section class="container py-5">
    <!-- Judul Artikel -->
    <h1 class="display-4 mb-4">{{ $article->title }}</h1>
    
    <!-- Gambar Artikel -->
    <div class="mb-4">
        @if($article->picture)
            <img src="{{ asset('storage/' . $article->picture) }}" alt="{{ $article->title }}" class="img-fluid rounded" style="object-fit: cover; max-height: 400px; width: 100%; margin-bottom: 20px;">
        @else
            <p>No image available</p>
        @endif
    </div>

    <!-- Konten Artikel -->
    <div class="content">
        <p>{!! nl2br(e($article->content)) !!}</p>
    </div>

    <!-- Informasi Penulis -->
    <div class="mt-4">
        <p><strong>By:</strong> {{ $article->author_name }}</p>
        <p><strong>Published on:</strong> {{ \Carbon\Carbon::parse($article->date)->format('F d, Y') }}</p>
    </div>

    <!-- Back to Articles Link -->
    <div class="mt-5">
        <a href="/login/farmer/dashboard" class="btn btn-primary">Back to Home</a>
    </div>
</section>
@endsection
