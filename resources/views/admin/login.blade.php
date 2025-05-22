<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>AgriSmart Sign In</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500&family=Zen+Kaku+Gothic+Antique:wght@400;500;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/style_login-register.css') }}">
</head>
<body>
  <div class="container">
    <div class="left">
      <img src="{{ asset('image/image-auth.jpeg') }}" alt="AgriSmart Background">
      <div class="overlay">
        <h1>Welcome to AgriSmart</h1>
        <p>Smart Consultation for Farmers & Plant Enthusiasts!</p>
      </div>
    </div>

    <div class="right">
      <form class="form" action="/admin/login" method="post">
        @csrf
        <div class="input-box">
          <input type="email" name="email" placeholder="Enter email address" class="input-field" required>
        </div>

        <div class="input-box">
          <input type="password" name="password" placeholder="Enter password" id="password" class="input-field" required>
          <span id="togglePassword" class="toggle-password">SHOW</span>
        </div>

        <button type="submit" class="submit-btn">Sign In</button>
      </form>
    </div>
  </div>

  <script>
    const toggle = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');

    toggle.addEventListener('click', () => {
      const isHidden = passwordInput.type === 'password';
      passwordInput.type = isHidden ? 'text' : 'password';
      toggle.textContent = isHidden ? 'HIDE' : 'SHOW';
    });
  </script>
</body>
</html>