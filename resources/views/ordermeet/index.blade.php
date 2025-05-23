@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Daftar Order Meet Anda</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('ordermeet.create') }}" class="btn btn-success mb-3">Buat Order Meet</a>

    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead>
                <tr>
                    <th>Topik</th>
                    <th>Tanggal</th>
                    <th>Ahli Tani</th>
                    <th>Status</th>
                    <th>Link Meet</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr>
                    <td>{{ $order->topic }}</td>
                    <td>{{ $order->date }}</td>
                    <td>{{ $order->ahli_name }}</td>
                    <td>
                        @if($order->is_done)
                            <span class="badge bg-success">Selesai</span>
                        @elseif($order->is_confirmation)
                            <span class="badge bg-warning text-dark">Dikonfirmasi</span>
                        @else
                            <span class="badge bg-secondary">Menunggu</span>
                        @endif
                    </td>
                    <td>
                        @if($order->link_meet)
                            <a href="{{ $order->link_meet }}" target="_blank" class="btn btn-sm btn-primary">
                                Join Meet
                            </a>
                        @else
                            <span class="text-muted">Belum tersedia</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
