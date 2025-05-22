@extends('admin.layout')

@section('title', 'Manage Experts')

@section('content')
<div class="container mt-4">
  <h2 class="mb-4">Manage Expert Registrations</h2>

  <div class="card shadow">
    <div class="card-header bg-primary text-white">
      <h4 class="mb-0">Expert Applications</h4>
    </div>
    <div class="card-body">
      <table class="table table-striped">
        <thead>
          <tr>
            <th>ID</th>
            <th>User</th>
            <th>Price</th>
            <th>YOE</th>
            <th>Alumni</th>
            <th>Expired Certificate</th>
            <th>Certificate</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach($experts as $expert)
          <tr>
            <td>{{ $expert->id }}</td>
            <td>{{ $expert->user->name ?? 'N/A' }}</td>
            <td>{{ $expert->price }}</td>
            <td>{{ $expert->yoe ?? '-' }}</td>
            <td>{{ $expert->alumni ?? '-' }}</td>
            <td>{{ $expert->expired_certificate ?? '-' }}</td>
            <td>
              @if($expert->certificate)
              <a href="{{ asset('storage/'.$expert->certificate) }}" target="_blank">View</a>
              @else
              No Certificate
              @endif
            </td>
            <td>
              <span class="badge bg-{{ strtolower($expert->status) === 'approved' ? 'success' : (strtolower($expert->status) === 'pending' ? 'warning' : 'danger') }}">
                {{ ucfirst($expert->status) }}
              </span>
            </td>
            <td>
              @if (strtolower($expert->status) === 'pending')
              <button class="btn btn-success btn-sm" onclick="updateExpertStatus({{ $expert->id }}, 'Approved')">Approve</button>
              <button class="btn btn-danger btn-sm" onclick="updateExpertStatus({{ $expert->id }}, 'Rejected')">Reject</button>
              @else
              <a href="{{ route('admin.edit-expert', $expert->id) }}" class="btn btn-warning btn-sm">Edit</a>
              <button onclick="deleteExpert({{ $expert->id }})" class="btn btn-danger btn-sm">Delete</button>
              @endif
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

<script>
  function updateExpertStatus(expertId, newStatus) {
    if (confirm(`Are you sure you want to ${newStatus.toLowerCase()} this expert application?`)) {
      fetch(`/admin/experts/${expertId}/status`, {
          method: 'PUT',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
          },
          body: JSON.stringify({
            status: newStatus
          })
        })
        .then(response => response.json())
        .then(data => {
          alert(data.message || "Status updated");
          location.reload();
        })
        .catch(error => {
          console.error('Error:', error);
          alert("Failed to update status.");
        });
    }
  }

  function deleteExpert(expertId) {
    if (confirm('Are you sure you want to delete this expert?')) {
      fetch(`/admin/experts/${expertId}`, {
          method: 'DELETE',
          headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json'
          }
        })
        .then(response => {
          if (response.ok) {
            location.reload(); // Reload halaman setelah delete
          } else {
            alert('Failed to delete expert');
          }
        })
        .catch(error => {
          console.error('Error:', error);
          alert('An error occurred');
        });
    }
  }
</script>
@endsection