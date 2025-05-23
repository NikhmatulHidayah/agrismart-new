@extends('layouts.app')

@section('content')
<style>
    body {
        background: #f8f9fa; /* Light grey background */
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        margin: 0;
        padding: 0;
        min-height: 100vh;
    }
    .success-card {
        border-radius: 15px; /* Slightly rounded corners */
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2), 0 6px 6px rgba(0, 0, 0, 0.1);
        border: none; /* Remove subtle border */
        background: rgba(255, 255, 255, 0.9); /* White background with 90% opacity */
        padding: 30px; /* Adjusted padding */
        position: relative;
        overflow: hidden; /* Keep overflow hidden to be safe */
        transition: transform 0.3s ease-in-out;
    }
    .success-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.3), 0 10px 10px rgba(0, 0, 0, 0.2);
    }
    .center-vertically {
        min-height: 80vh; /* Adjust if needed, maybe less than 100vh */
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .success-icon {
        font-size: 3rem; /* Smaller icon */
        color: #28a745; /* Bootstrap success green */
        margin-bottom: 15px;
    }
     h2.text-success {
         color: #28a745 !important; /* Ensure success green */
         font-size: 1.8rem; /* Slightly smaller heading */
         font-weight: 600;
     }
     .lead.mb-4 {
         font-size: 1.1rem;
         color: #555;
         margin-bottom: 25px !important;
     }
    .btn-green-muda {
        background: #28a745; /* Solid success green */
        color: white;
        border: none;
        font-weight: 500;
        border-radius: 5px;
        padding: 10px 24px;
        transition: background-color 0.2s ease-in-out;
    }
    .btn-green-muda:hover {
        background: #218838; /* Darker green on hover */
        color: white;
    }
</style>
<div class="container center-vertically">
    <div class="row justify-content-center w-100">
        <div class="col-md-8">
            <div class="card text-center success-card">
                {{-- <canvas class="confetti"></canvas> --}} {{-- Removed animation canvas --}}
                <div class="card-body py-5">
                    <div class="success-icon mb-3">
                        <i class="bi bi-check-circle-fill"></i>
                    </div>
                    <h2 class="text-success mb-3">Pembayaran Berhasil!</h2>
                    <p class="lead mb-4">Terima kasih, pembayaran konsultasi Anda telah berhasil diproses.<br>Silakan tunggu konfirmasi dari ahli tani.</p>

                    {{-- Ensure the route parameters are correctly passed --}}
                    {{-- Menggunakan parameter dari variabel view --}}
                    <a href="{{ route('isi_konsultasi', ['id_ahli_tani' => $id_ahli_tani, 'amount' => $amount]) }}" class="btn btn-green-muda px-4">Isi Konsultasi</a>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- Removed animation script --}}
{{-- <script>
// Confetti simple effect
function randomColor() {
    const colors = ['#6ee7b7', 'a7f3d0', '16a34a', 'bbf7d0', 'facc15'];
    return colors[Math.floor(Math.random() * colors.length)];
}
function confetti(canvas) {
    const ctx = canvas.getContext('2d');
    const W = canvas.width = canvas.offsetWidth;
    const H = canvas.height = canvas.offsetHeight;
    let pieces = [];
    for (let i = 0; i < 40; i++) {
        pieces.push({
            x: Math.random() * W,
            y: Math.random() * -H,
            w: 8 + Math.random() * 8,
            h: 8 + Math.random() * 8,
            color: randomColor(),
            speed: 2 + Math.random() * 2,
            angle: Math.random() * 2 * Math.PI
        });
    }
    function draw() {
        ctx.clearRect(0, 0, W, H);
        for (let p of pieces) {
            ctx.save();
            ctx.translate(p.x, p.y);
            ctx.rotate(p.angle);
            ctx.fillStyle = p.color;
            ctx.fillRect(-p.w/2, -p.h/2, p.w, p.h);
            ctx.restore();
            p.y += p.speed;
            p.angle += 0.02;
            if (p.y > H + 20) p.y = -10;
        }
        requestAnimationFrame(draw);
    }
    draw();
}
document.addEventListener('DOMContentLoaded', function() {
    const canvas = document.querySelector('.confetti');
    if(canvas) confetti(canvas);
});
</script> --}}
@endsection 