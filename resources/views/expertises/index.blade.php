@extends('layouts.app')

@section('content')
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h2>Daftar Ahli Tani</h2>
        <a href="{{ route('expertises.create') }}" class="btn-green">+ Tambah Ahli Tani</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Status</th>
                <th>Pengalaman (tahun)</th>
                <th>Sertifikat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dataAhliTani as $ahliTani)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $ahliTani->status }}</td>
                    <td>{{ $ahliTani->yoe }}</td>
                    <td>
                        @if ($ahliTani->certificate)
                            <a href="{{ asset('storage/' . $ahliTani->certificate) }}" target="_blank">Lihat</a>
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('expertises.edit', $ahliTani->id) }}">Edit</a> |
                        <form action="{{ route('expertises.destroy', $ahliTani->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Yakin hapus?')" style="background: none; border: none; color: #d32f2f; cursor: pointer;">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
