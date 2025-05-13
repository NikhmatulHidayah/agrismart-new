<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agrismart Sign Up</title>
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
      <form class="form" action="{{ route('register.farmer') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="input-box mb-3">
          <input type="text" name="name" placeholder="Enter name" class="input-field" required>
        </div>

        <div class="input-box mb-3">
          <input name="email" type="email" placeholder="Enter email address" class="input-field" required>
        </div>

        <div class="input-box mb-3">
          <input name="phone" type="text" placeholder="Enter phone number" class="input-field" required>
        </div>

        <div class="input-box mb-3">
          <input type="password" name="password" placeholder="Enter password" id="password" class="input-field" required>
          <span id="togglePassword" class="toggle-password">SHOW</span>
        </div>

        <div class="input-box mb-3" style="position: relative;">
          <input type="text" id="file-path" class="input-field" placeholder="Enter a file" readonly style="padding-right: 100px;" required>

          <button type="button" onclick="document.getElementById('real-file').click()" 
                  style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%);
                         padding: 6px 12px; border: none; background-color: #49802c; color: white; border-radius: 4px;">
            Browse
          </button>

          <input name="image" type="file" id="real-file" style="display: none;" 
                 onchange="document.getElementById('file-path').value = this.files[0]?.name">
        </div>

        <button type="submit" class="submit-btn">Sign Up</button>
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