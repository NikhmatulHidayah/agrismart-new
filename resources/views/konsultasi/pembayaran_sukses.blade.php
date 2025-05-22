@extends('layouts.app')

@section('content')
<style>
    .success-card {
        border-radius: 24px;
        box-shadow: 0 8px 32px rgba(20, 83, 45, 0.18), 0 1.5px 4px rgba(20, 83, 45, 0.10);
        border: 2px solid #bbf7d0;
        background: linear-gradient(135deg, rgba(226,244,225,0.85) 0%, rgba(255,255,255,0.85) 100%);
        /* margin-top: 60px; */
        animation: zoomIn 0.7s cubic-bezier(0.68, -0.55, 0.27, 1.55);
        position: relative;
        overflow: visible;
    }
    .center-vertically {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    @keyframes zoomIn {
        0% {
            opacity: 0;
            transform: scale(0.7);
        }
        80% {
            opacity: 1;
            transform: scale(1.05);
        }
        100% {
            opacity: 1;
            transform: scale(1);
        }
    }
    .confetti {
        position: absolute;
        top: 0; left: 0; width: 100%; height: 100%;
        pointer-events: none;
        z-index: 2;
    }
    .success-icon {
        font-size: 4rem;
        color: #16a34a;
        margin-bottom: 16px;
    }
    .success-btn {
        background: linear-gradient(90deg, #16a34a 60%, #22d3ee 100%);
        border: none;
        font-weight: 600;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(20, 83, 45, 0.10);
        transition: background 0.2s, box-shadow 0.2s;
        color: #fff;
    }
    .success-btn:hover {
        background: linear-gradient(90deg, #22d3ee 60%, #16a34a 100%);
        color: #fff;
    }
    .btn-green-muda {
        background: #6ee7b7;
        color: #14532d;
        border: none;
        font-weight: 600;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(20, 83, 45, 0.10);
        transition: background 0.2s, box-shadow 0.2s;
    }
    .btn-green-muda:hover {
        background: #a7f3d0;
        color: #14532d;
    }
</style>
<div class="container center-vertically">
    <div class="row justify-content-center w-100">
        <div class="col-md-8">
            <div class="card text-center success-card">
                <canvas class="confetti"></canvas>
                <div class="card-body py-5">
                    <div class="success-icon mb-3">
                        <i class="bi bi-check-circle-fill"></i>
                    </div>
                    <h2 class="text-success mb-3">Pembayaran Berhasil!</h2>
                    <p class="lead mb-4">Terima kasih, pembayaran konsultasi Anda telah berhasil diproses.<br>Silakan tunggu konfirmasi dari ahli tani.</p>
                    <a href="{{ route('isi_konsultasi', ['id_ahli_tani' => request()->query('id_ahli_tani'), 'amount' => request()->query('amount')]) }}" class="btn btn-green-muda px-4">Isi Konsultasi</a>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
// Confetti simple effect
function randomColor() {
    const colors = ['#6ee7b7', '#a7f3d0', '#16a34a', '#bbf7d0', '#facc15'];
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
</script>
@endsection 