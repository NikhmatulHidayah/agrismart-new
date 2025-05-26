@extends('expert.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Kelola Permintaan Order Meet</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead>
                <tr>
                    <th>Petani</th>
                    <th>Topik</th>
                    <th>Tanggal</th>
                    <th>Link Meet</th>
                    <th>Status</th>
                    <th>Konfirmasi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr>
                    <td>{{ $order->petani->name ?? '-' }}</td>
                    <td>{{ $order->topic }}</td>
                    <td>{{ $order->date }}</td>
                    <td>
                        @if($order->link_meet)
                            <a href="{{ $order->link_meet }}" target="_blank">{{ $order->link_meet }}</a>
                        @else
                            <em>-</em>
                        @endif
                    </td>
                    <td>
                        @if($order->is_done)
                            <span class="badge bg-secondary">Selesai</span>
                        @elseif($order->is_confirmation)
                            <span class="badge bg-success">Terkonfirmasi</span>
                        @else
                            <span class="badge bg-warning text-dark">Menunggu</span>
                        @endif
                    </td>
                    <td>
                        @if(!$order->is_confirmation)
                            {{-- Form Konfirmasi --}}
                            <form method="POST" action="{{ route('ordermeet.confirm', $order->id) }}">
                                @csrf
                                <input type="url" name="link_meet" class="form-control mb-2" placeholder="Link Meet" required>
                                <button type="submit" class="btn btn-sm btn-primary">Konfirmasi</button>
                            </form>
                        @else
                            @if(!$order->is_done)
                                {{-- Tombol Selesaikan --}}
                                <form method="POST" action="{{ route('ordermeet.done', $order->id) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-outline-secondary">Selesaikan</button>
                                </form>
                            @else
                                <span class="text-muted">Sudah Selesai</span>
                            @endif
                        @endif
                    </td>
                </tr>
                @endforeach
                @if($orders->isEmpty())
                <tr><td colspan="6" class="text-center">Belum ada permintaan.</td></tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection
