@extends('admin.layout')

@section('title', 'Manage Payment')

@section('content')
<div class="container mt-4">
  <h2 class="mb-4">Manage Payments</h2>

  <div class="card shadow">
    <div class="card-header bg-primary text-white">
      <h4 class="mb-0">User Payments</h4>
    </div>
    <div class="card-body">
      <table class="table table-striped">
        <thead>
          <tr>
            <th>#</th>
            <th>User</th>
            <th>Amount</th>
            <th>Type</th>
            <th>Date</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          @forelse($payments as $index => $payment)
          <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $payment->petani->name ?? '-' }}</td>
            <td>Rp{{ number_format($payment->amount, 0, ',', '.') }}</td>
            <td>
              <span class="badge bg-info text-dark">
                {{ ucfirst($payment->type) }}
              </span>
            </td>
            <td>{{ $payment->created_at->format('d M Y, H:i') }}</td>
            <td>
              <span class="badge bg-{{ $payment->is_payment ? 'success' : 'warning' }}">
                {{ $payment->is_payment ? 'Paid' : 'Unpaid' }}
              </span>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="6" class="text-center text-muted">No payments found.</td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection