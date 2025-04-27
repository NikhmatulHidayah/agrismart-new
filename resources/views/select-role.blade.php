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

        <div class="card selected">
          <div class="icon-box">
            <a href="/register/farmer">
              <img src="{{ asset('image/user.png') }}" alt="">
            </a>
          </div>
          <div class="card-content">
            <h4>Farm or plant enthusiasts</h4>
            <p>Personal account to manage all your activities.</p>
          </div>
          <div class="arrow">→</div>
        </div>

        <div class="card">
          <div class="icon-box">
            <a href="/register/expert">
              <img src="{{ asset('image/farm.png') }}" alt="">
            </a>
          </div>
          <div class="card-content">
            <h4>Agricultural expert</h4>
            <p>Own or belong to a company, this is for you.</p>
          </div>
          <div class="arrow">→</div>
        </div>

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