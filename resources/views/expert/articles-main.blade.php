<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agrismart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .container {
            display: flex;
            flex-wrap: wrap;
            gap: 24px;
            padding: 24px;
        }
        .card {
            width: 250px;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
            background-color: white;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .card img {
            width: 100%;
            height: 160px;
            object-fit: cover;
        }
        .card-body {
            padding: 16px;
        }
        .card-title {
            font-weight: bold;
            font-size: 18px;
            margin-bottom: 8px;
        }
        .card-content {
            font-size: 14px;
            color: #555;
            margin-bottom: 16px;
        }
        .btn-article {
            display: inline-block;
            padding: 10px;
            text-align: center;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            margin: 0 16px 16px 16px;
        }
        .add-card {
            width: 250px;
            height: 340px;
            border: 2px dashed #ccc;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            color: #444;
            cursor: pointer;
        }
        .add-card:hover {
            border-color: #888;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="/expert/articles/create">Buat Artikel</a>
        </li>
      </ul>
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Cari Artikel" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>

<div class="container">
        @foreach ($articles as $article)
            <div class="card">
                <img src="{{ asset('storage/' . $article->picture) }}" alt="{{ $article->title }}">
                <div class="card-body">
                    <div class="card-title">{{ $article->title }}</div>
                    <div class="card-content">{{ \Illuminate\Support\Str::limit($article->content, 100) }}</div>
                </div>
                <a href="{{ url('/expert/articles/' . $article->id) }}" class="btn-article">Lihat Artikel</a>
            </div>
        @endforeach

        <div class="add-card" onclick="window.location.href='/expert/articles/create'">
            <div style="font-size: 32px;">＋</div>
            <div>Add article</div>
        </div>
    </div>
</body>
</html>