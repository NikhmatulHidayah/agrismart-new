@extends('layouts.app')

@section('content')
<style>
.star-rating {
    direction: rtl;
    font-size: 2rem;
    unicode-bidi: bidi-override;
    display: inline-flex;
}
.star-rating input[type="radio"] {
    display: none;
}
.star-rating label {
    color: #ccc;
    cursor: pointer;
    transition: color 0.2s;
}
.star-rating label:hover,
.star-rating label:hover ~ label,
.star-rating input[type="radio"]:checked ~ label {
    color: #f5b301;
}
</style>

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
                    <th>Aksi</th>
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
                        <div class="d-flex flex-column gap-1">
                            @if($order->link_meet)
                                <a href="{{ $order->link_meet }}" target="_blank" class="btn btn-sm btn-primary">Join Meet</a>
                            @endif

                            @if($order->is_done)
                                <button class="btn btn-sm btn-outline-success" data-bs-toggle="modal" data-bs-target="#ulasanModal{{ $order->id }}">
                                    Berikan Ulasan
                                </button>
                            @endif
                        </div>

                        <!-- Modal per order -->
                        <div class="modal fade" id="ulasanModal{{ $order->id }}" tabindex="-1" aria-labelledby="ulasanModalLabel{{ $order->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <form action="{{ route('rating.store') }}" method="POST">
                                    @csrf
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="ulasanModalLabel{{ $order->id }}">Berikan Ulasan untuk {{ $order->ahli_name }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                                        </div>
                                        <div class="modal-body">
                                            <input type="hidden" name="id_order_meet" value="{{ $order->id }}">
                                            <input type="hidden" name="id_ahli_tani" value="{{ $order->id_ahli_tani }}">
                                            <input type="hidden" name="id_petani" value="{{ $order->id_petani }}">

                                            <div class="mb-3">
                                                <label class="form-label">Bagaimana pengalamanmu dengan {{ $order->ahli_name }}?</label>
                                                <br>
                                                <div class="star-rating">
                                                    @for ($i = 5; $i >= 1; $i--)
                                                        <input type="radio" id="star{{ $i }}-{{ $order->id }}" name="star" value="{{ $i }}" required>
                                                        <label for="star{{ $i }}-{{ $order->id }}" title="{{ $i }} stars">&#9733;</label>
                                                    @endfor
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label for="feedback{{ $order->id }}" class="form-label">Feedback</label>
                                                <textarea class="form-control" name="feedback" id="feedback{{ $order->id }}" rows="3" placeholder="Tulis ulasan Anda..." required></textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Kirim Ulasan</button>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
