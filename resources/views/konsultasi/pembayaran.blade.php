@extends('layouts.app')

@section('content')
<style>
    body {
        background: linear-gradient(135deg, #e2f4e1 0%, #f8fafc 100%);
    }
    .custom-navbar-space {
        margin-bottom: 40px;
        box-shadow: 0 8px 24px rgba(20, 83, 45, 0.08);
        border-radius: 0 0 30px 30px;
        background: #fff;
        min-height: 30px;
    }
    .payment-card {
        border-radius: 24px;
        box-shadow: 0 8px 32px rgba(20, 83, 45, 0.18), 0 1.5px 4px rgba(20, 83, 45, 0.10);
        border: none;
        transition: transform 0.2s, box-shadow 0.2s;
        background: #fff;
    }
    .payment-card:hover {
        transform: translateY(-8px) scale(1.01);
        box-shadow: 0 16px 48px rgba(20, 83, 45, 0.22), 0 2px 8px rgba(20, 83, 45, 0.12);
    }
    .payment-header {
        background: #a7f3d0;
        border-radius: 24px 24px 0 0;
        color: #14532d;
        box-shadow: 0 2px 8px rgba(20, 83, 45, 0.10);
    }
    .payment-list .list-group-item {
        border: none;
        background: transparent;
        font-size: 1.08rem;
        padding-left: 0;
        padding-right: 0;
    }
    .payment-label {
        font-weight: 600;
        color: #14532d;
    }
    .payment-amount {
        color: #16a34a;
        font-size: 1.2rem;
        font-weight: bold;
    }
    .payment-btn {
        background: #6ee7b7;
        border: none;
        font-weight: 600;
        letter-spacing: 1px;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(20, 83, 45, 0.10);
        transition: background 0.2s, box-shadow 0.2s;
        color: #14532d;
    }
    .payment-btn:hover {
        background: #a7f3d0;
        color: #14532d;
        box-shadow: 0 4px 16px rgba(20, 83, 45, 0.18);
    }
    .payment-icon {
        width: 28px;
        margin-right: 10px;
        vertical-align: middle;
    }
</style>
<div class="custom-navbar-space"></div>
<div class="container mt-4 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-8">
            <div class="card payment-card animate__animated animate__fadeInUp">
                <div class="card-header payment-header">
                    <h4 class="mb-0"><i class="bi bi-credit-card"></i> Pembayaran Konsultasi</h4>
                </div>
                <div class="card-body">
                    <h5 class="mb-3" style="font-weight: 700; color: #14532d;">Detail Ahli Tani</h5>
                    <ul class="list-group mb-4 payment-list">
                        <li class="list-group-item"><span class="payment-label">Nama:</span> {{ $ahliTani->user->name ?? '-' }}</li>
                        <li class="list-group-item"><span class="payment-label">Alumni:</span> {{ $ahliTani->alumni ?? '-' }}</li>
                        <li class="list-group-item"><span class="payment-label">Harga Konsultasi:</span> <span class="payment-amount">Rp {{ number_format($ahliTani->price ?? 0, 0, ',', '.') }}</span></li>
                    </ul>
                    <form id="formPembayaran" action="{{ route('proses_pembayaran') }}" method="POST">
                        @csrf
                        <input type="hidden" name="ahli_tani_id" value="{{ $ahliTani->id_ahli_tani }}">
                        <input type="hidden" name="jumlah" value="{{ $ahliTani->price ?? 0 }}">
                        <div class="mb-4">
                            <label for="metode_pembayaran" class="form-label payment-label">Metode Pembayaran</label>
                            <select class="form-select mb-2" id="metode_pembayaran" name="metode_pembayaran" required>
                                <option value="">Pilih Metode</option>
                                
                                <optgroup label="E-Wallet">
                                    <option value="gopay">GoPay (QRIS)</option>
                                    <option value="ovo">OVO (QRIS)</option>
                                    <option value="dana">DANA (QRIS)</option>
                                    <option value="shopeepay">ShopeePay (QRIS)</option>
                                </optgroup>
                            </select>
                            <small class="text-muted">Pilih salah satu bank atau e-wallet yang tersedia.</small>
                        </div>
                        <button type="button" class="btn payment-btn px-4 py-2" data-bs-toggle="modal" data-bs-target="#modalPembayaran">Bayar Sekarang</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Pembayaran -->
<div class="modal fade" id="modalPembayaran" tabindex="-1" aria-labelledby="modalPembayaranLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalPembayaranLabel">Proses Pembayaran</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- QRIS -->
        <div id="qrisSection" style="display:none;">
          <p>Silakan scan QRIS berikut untuk pembayaran:</p>
          <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=ContohQRIS-AgriSmart" alt="QRIS" class="img-fluid mb-3">
        </div>
        <!-- Transfer Bank -->
        <div id="bankSection" style="display:none;">
          <p>Transfer ke rekening berikut:</p>
          <div class="alert alert-success">
            <strong>BRI 1234-5678-9012-3456<br>
            a.n. PT AgriSmart</strong>
          </div>
          <label for="noRek" class="form-label">Masukkan nomor rekening Anda:</label>
          <input type="text" class="form-control" id="noRek" placeholder="Nomor rekening pengirim">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" id="btnSelesaiPembayaran">Selesai</button>
      </div>
    </div>
  </div>
</div>

@endsection 

<script>
document.addEventListener('DOMContentLoaded', function() {
    const metode = document.getElementById('metode_pembayaran');
    const qrisSection = document.getElementById('qrisSection');
    const bankSection = document.getElementById('bankSection');
    const formPembayaran = document.getElementById('formPembayaran');
    const btnSelesaiPembayaran = document.getElementById('btnSelesaiPembayaran');

    if(metode) {
        metode.addEventListener('change', function() {
            if(['gopay', 'ovo', 'dana', 'shopeepay'].includes(this.value)) {
                qrisSection.style.display = 'block';
                bankSection.style.display = 'none';
            }  else {
                qrisSection.style.display = 'none';
                bankSection.style.display = 'none';
            }
        });
        // Trigger on load
        metode.dispatchEvent(new Event('change'));
    }

    if(btnSelesaiPembayaran && formPembayaran) {
        btnSelesaiPembayaran.addEventListener('click', function() {
            // Tutup modal
            const modal = bootstrap.Modal.getInstance(document.getElementById('modalPembayaran'));
            modal.hide();
            
            // Submit form pembayaran setelah modal ditutup
            setTimeout(function() {
                 formPembayaran.submit();
            }, 400); // Tunggu sedikit agar modal selesai transisi
        });
    }
});
</script> 