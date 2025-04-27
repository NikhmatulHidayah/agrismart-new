@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="text-center fw-bold mb-4">Saran Pemupukan Berdasarkan Tanah dan Tanaman</h2>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <form action="{{ route('pemupukan.search') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="jenis_tanah" class="form-label">Jenis Tanah</label>
                            <select name="jenis_tanah" id="jenis_tanah" class="form-select" required>
                                <option value="" disabled selected>-- Pilih Jenis Tanah --</option>
                                @foreach($tanahs as $tanah)
                                    <option value="{{ $tanah }}" {{ (isset($request) && $request->jenis_tanah == $tanah) ? 'selected' : '' }}>
                                        {{ $tanah }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="jenis_tanaman" class="form-label">Jenis Tanaman</label>
                            <select name="jenis_tanaman" id="jenis_tanaman" class="form-select" required>
                                <option value="" disabled selected>-- Pilih Jenis Tanaman --</option>
                                @foreach($tanamans as $tanaman)
                                    <option value="{{ $tanaman }}" {{ (isset($request) && $request->jenis_tanaman == $tanaman) ? 'selected' : '' }}>
                                        {{ $tanaman }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-success px-4">Cari Saran</button>
                        </div>
                    </form>
                </div>
            </div>

            @isset($result)
            <div class="card mt-4 shadow-sm">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">Hasil Rekomendasi Pemupukan</h5>
                </div>
                <div class="card-body">
                    @if($result)
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><strong>Pemupukan Awal:</strong> {{ $result['awal'] }}</li>
                            <li class="list-group-item"><strong>Pemupukan Susulan 1:</strong> {{ $result['susulan1'] }}</li>
                            <li class="list-group-item"><strong>Pemupukan Susulan 2:</strong> {{ $result['susulan2'] }}</li>
                        </ul>
                    @else
                        <div class="alert alert-warning mb-0" role="alert">
                            Maaf, belum ada rekomendasi untuk kombinasi tersebut.
                        </div>
                    @endif
                </div>
            </div>
            @endisset
        </div>
    </div>
</div>
@endsection
