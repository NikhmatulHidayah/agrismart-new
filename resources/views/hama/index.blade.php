@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="text-center fw-bold mb-4">Rekomendasi Penanganan Hama</h2>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <form action="{{ route('hama.search') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="jenis_hama" class="form-label">Pilih Jenis Hama</label>
                            <select name="jenis_hama" id="jenis_hama" class="form-select" required>
                                <option value="" disabled selected>-- Pilih Hama --</option>
                                @foreach($hamas as $hama)
                                    <option value="{{ $hama }}" {{ (isset($request) && $request->jenis_hama == $hama) ? 'selected' : '' }}>
                                        {{ $hama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-success px-4">Cari Rekomendasi</button>
                        </div>
                    </form>
                </div>
            </div>

            @isset($data)
            <div class="card mt-4 shadow-sm">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">Rekomendasi Penanganan</h5>
                </div>
                <div class="card-body text-center">
                    <img src="{{ asset($data['gambar']) }}" alt="gambar hama" class="img-fluid mb-3" style="max-height: 250px;">
                    <p class="mb-0">{{ $data['rekomendasi'] }}</p>
                </div>
            </div>
            @endisset

        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
$(document).ready(function() {
    $('#jenis_hama').select2({
        placeholder: "-- Pilih Hama --",
        allowClear: true
    });
});
</script>
@endpush
