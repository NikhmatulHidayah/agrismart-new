@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Buat Order Meet</h2>

    <form method="POST" action="{{ route('ordermeet.store') }}">
        @csrf

        <div class="mb-3">
            <label for="id_expert" class="form-label">Pilih Ahli Tani</label>
            <!-- <select name="id_expert" id="expert" class="form-select" required>
                <option value="">-- Pilih Ahli Tani --</option>
                @foreach($expertList as $expert)
                    <option value="{{ $expert->id }}">{{ $expert->name }}</option>
                @endforeach
            </select> -->

            
            <!-- Menampilkan daftar expert yang telah di approved saja -->
            <select name="id_expert" id="expert" class="form-select" required>                                           
                <option value="">-- Pilih Ahli Tani --</option>
                @foreach($expertList as $expert)
                <option value="{{ $expert->user->id }}" data-price="{{ $expert->price }}">{{ $expert->user->name ?? '-' }}</option>
                @endforeach
            </select>

        </div>

        <div class="mb-3">
            <label for="amount" class="form-label">Jumlah Biaya (Rp)</label>
            <input type="number" class="form-control" name="amount" id="amount" required min="1" readonly>
        </div>

        <div class="mb-3">
            <label for="topic" class="form-label">Topik Pertemuan</label>
            <input type="text" class="form-control" name="topic" placeholder="Misal: Konsultasi hama">
        </div>

        <div class="mb-3">
            <label for="date" class="form-label">Tanggal Pertemuan</label>
            <input type="date" class="form-control" name="date" required>
        </div>

        <button type="submit" class="btn btn-primary">Kirim Permintaan</button>
    </form>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const expertSelect = document.getElementById('expert');
        const amountInput = document.getElementById('amount');

        expertSelect.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const price = selectedOption.getAttribute('data-price');

            if (price !== null) {
                amountInput.value = price;
            } else {
                amountInput.value = '';
            }
        });
    });
</script>
@endpush

@endsection