@extends('layouts.app')

@section('content')
    <h1>Konsultasi</h1>

    <a href="{{ route('konsultasi.create') }}" class="btn btn-green">Buat Konsultasi Baru</a>

    <!-- Menampilkan Notifikasi Sukses jika ada -->
    @if(session('success'))
        <script>
            // Menampilkan notifikasi menggunakan alert
            alert("{{ session('success') }}");
        </script>
    @endif

    <!-- Cek apakah data konsultasi ada -->
    @if(empty($konsultasi)) <!-- Menggunakan empty untuk array -->
        <p>Tidak ada riwayat konsultasi.</p>
    @else
        <table class="table mt-4">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Deskripsi</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($konsultasi as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->feedback }}</td>
                        <td>{{ $item->created_at->format('d-m-Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
