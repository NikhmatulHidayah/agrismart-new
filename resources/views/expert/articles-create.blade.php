<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Article Form</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body, html {
      height: 100%;
      background-color: #f5f5f7;
      font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
      margin: 0;
    }

    .card {
      background-color: #ffffff;
      border: none;
      border-radius: 24px;
      box-shadow: 0 8px 24px rgba(0,0,0,0.05);
      padding: 32px;
      width: 100%;
      height: 100%;
    }

    .form-control,
    .form-control:focus {
      background-color: #f0f0f5;
      border: none;
      border-radius: 12px;
      box-shadow: none;
    }

    textarea.form-control {
      resize: none;
    }

    .btn-primary {
      background-color: #49802c;
      border: none;
      border-radius: 14px;
      padding: 12px;
      font-weight: 500;
    }

    .btn-primary:hover {
      background-color: #49802c;
    }

    .form-label {
      font-weight: 500;
      margin-bottom: 6px;
    }
  </style>
</head>
<body>
  <div class="card">
    <h2 class="mb-4">Buat Artikel</h2>

    <form action="/expert/articles/create/post" method="POST" enctype="multipart/form-data">
    @csrf
      <div class="mb-4">
        <label for="title" class="form-label">Judul</label>
        <input type="text" class="form-control" id="title" name="title" required />
      </div>

      <div class="mb-4">
        <label for="article" class="form-label">Isi konten</label>
        <textarea class="form-control" id="article" name="article" rows="10"  required></textarea>
      </div>

      <div class="mb-4">
        <label for="image" class="form-label">Gambar</label>
        <input class="form-control" type="file" id="image" name="image" accept="image/*" />
      </div>
        <br>
      <div class="d-grid">
        <button type="submit" class="btn btn-primary">Sebarkan Artikel</button>
      </div>
    </form>
  </div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
