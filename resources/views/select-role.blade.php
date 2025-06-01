<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agrismart Select Role</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500&family=Zen+Kaku+Gothic+Antique:wght@400;500;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style_select-role.css') }}">
</head>
<body>
  <div class="container">
    <div class="left">
    <img src="{{ asset('image/image-auth.jpeg') }}" alt="AgriSmart Background">
      <div class="left-overlay">
        <h1>Welcome to AgriSmart</h1>
        <p>Smart Consultation for Farmers & Plant Enthusiasts!</p>
      </div>
    </div>

    <div class="right">
      <div class="content-box">
        <h2>Join Us!</h2>
        <p>To begin this journey, tell us what type of account you’d be opening.</p>

<a href="/register/farmer">
    <div class="card" style="text-decoration: none;">
        <div class="icon-box">
            <img src="{{ asset('image/user.png') }}" alt="">
        </div>
        <div class="card-content">
            <h4 style="text-decoration: none;">Farm or plant enthusiasts</h4>
            <p style="text-decoration: none;">Personal account to manage all your activities.</p>
        </div>
        <div class="arrow" style="text-decoration: none;">→</div>
    </div>
</a>

<a href="/register/expert">
    <div class="card" style="text-decoration: none;">
        <div class="icon-box">
            <img src="{{ asset('image/farm.png') }}" alt="">
        </div>
        <div class="card-content">
            <h4 style="text-decoration: none;">Agricultural expert</h4>
            <p style="text-decoration: none;">Own or belong to a company, this is for you.</p>
        </div>
        <div class="arrow" style="text-decoration: none;">→</div>
    </div>
</a>

        <div class="card">
        
          <div class="card-content">
          <a href="/login" style="text-decoration:none;"><h4>Login</h4></a>
            <p>If you have account on Agrismart</p>
          </div>
          <div class="arrow">→</div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>