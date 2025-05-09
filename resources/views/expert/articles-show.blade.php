<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>{{ $article->title }} - AgriSmart Blog</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Inter', sans-serif;
      margin: 40px;
      line-height: 1.6;
    }
    .container {
      max-width: 800px;
      margin: auto;
    }
    .title {
      font-size: 32px;
      font-weight: bold;
    }
    .date {
      color: #888;
      margin-bottom: 20px;
    }
    .image {
      max-width: 100%;
      height: auto;
      margin-bottom: 20px;
    }
    .content {
      font-size: 18px;
      white-space: pre-line;
    }
    .back-link {
      display: inline-block;
      margin-top: 30px;
      text-decoration: none;
      color: #4CAF50;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="title">{{ $article->title }}</div>
    <div class="date">Published on {{ date('d M Y', strtotime($article->date)) }}</div>
    <img src="{{ asset('storage/' . $article->picture) }}" alt="{{ $article->title }}" class="image">
    <div class="content">{{ $article->content }}</div>

    <a href="{{ url('/expert/articles') }}" class="back-link">&larr; Kembali ke daftar artikel</a>
  </div>
</body>
</html>
