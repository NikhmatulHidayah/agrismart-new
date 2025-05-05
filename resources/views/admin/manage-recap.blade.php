@extends('admin.layout')

@section('title', 'Manage Recap')

@section('content')
<div class="container mt-4">
  <h2 class="mb-4">Manage Recap</h2>

  <div class="card shadow">
    <div class="card-header bg-primary text-white">
      <h4 class="mb-0">Expert Applications</h4>
    </div>
    <div class="card-body">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>User</th>
                <th>Avg Rating</th>
                <th>Feedback</th>
                <!-- <th>From Farmer</th> -->
            </tr>
        </thead>
        <tbody>
            @foreach($experts as $expert)
            <tr>
                <td>
                    <strong>{{ $expert->name }}</strong><br>
                    <small>{{ $expert->email }}</small>
                </td>
                <td>
                    @if($expert->average_rating)
                        <span class="badge bg-success">
                            {{ number_format($expert->average_rating, 1) }} ⭐
                        </span>
                    @else
                        <span class="badge bg-secondary">No ratings</span>
                    @endif
                </td>
                <td>
                    @forelse($expert->ratingsAsAhli as $rating)
                        <div class="mb-2 p-2 bg-light rounded">
                            <small>{{ $rating->feedback }}</small>
                            <br>
                            <small class="text-muted">
                            {{ optional($rating->created_at)->format('d M Y') ?? '-' }}
                            </small>
                        </div>
                    @empty
                        <span class="text-muted">No feedback yet</span>
                    @endforelse
                </td>
                <!-- <td>
                    @foreach($expert->ratingsAsAhli as $rating)
                        {{ $rating->petani->name ?? 'Anonymous' }}<br>
                    @endforeach
                </td> -->
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>
  </div>
</div>
@endsection


