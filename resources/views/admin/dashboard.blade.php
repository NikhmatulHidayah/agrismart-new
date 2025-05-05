@extends('admin.layout')

@section('content')
<div class="flex min-h-screen">
  <!-- Main content -->
  <main class="flex-1 p-8 bg-white text-black">
    <h1 class="text-base font-bold mb-6">Dashboard</h1>

    <div class="flex flex-col md:flex-row md:space-x-6 space-y-6 md:space-y-0">
      <!-- Welcome box -->
      <section class="flex items-center justify-between bg-gray-800 rounded p-6 w-full md:w-1/2">
        <div class="flex items-center space-x-6">
          <div class="flex items-center justify-center rounded-full bg-gray-700 w-12 h-12 text-lg font-semibold">
          </div>
          <div class="text-sm">
            <p class="font-bold leading-5">Welcome</p>
            <p class="text-gray-400 leading-5">Admin</p>
          </div>
        </div>
      </section>
    </div>

    <!-- Cards Row -->
    <div class="row mb-4 mt-6"> <!-- Added mt-6 for top margin -->
      <div class="col-md-3 mb-4"> <!-- Added mb-4 for bottom margin -->
        <div class="card bg-primary text-white">
          <div class="card-body">
            <h5 class="card-title">Total Farmer</h5>
            <h2 class="card-text">{{ $totalFarmer }}</h2>
          </div>
        </div>
      </div>
      <div class="col-md-3 mb-4"> <!-- Added mb-4 for bottom margin -->
        <div class="card bg-success text-white">
          <div class="card-body">
            <h5 class="card-title">Total Expert</h5>
            <h2 class="card-text">{{ $totalExpert }}</h2>
          </div>
        </div>
      </div>
    </div>

    <!-- Recent Expert Section -->
    <div class="mt-4">
      <div class="card shadow mb-4">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
          <h4 class="mb-0">Recent Experts</h4>
          <a href="{{ route('admin.manage-expert') }}" class="btn btn-sm btn-light">View All</a>
        </div>
        <div class="card-body">
          @if ($recentExperts->count() > 0)
          <table class="table table-striped">
            <thead>
              <tr>
                <th>ID</th>
                <th>User</th>
                <th>Email</th>
                <th>Sertifikat</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($recentExperts as $expert)
              <tr>
                <td>{{ $expert->id }}</td>
                <td>{{ $expert->user->name ?? '-' }}</td>
                <td>{{ $expert->user->email ?? '-' }}</td>
                <td>
                  @if($expert->certificate)
                  <a href="{{ asset('storage/'.$expert->certificate) }}" target="_blank">View</a>
                  @else
                  No Certificate
                  @endif
                  </td>
                  <td>
                    @php
                    $status = $expert->status ?? 'Unknown';
                    @endphp
                    <span
                      class="badge bg-{{ $status === 'Approved' ? 'success' : (strtolower($expert->status) === 'pending' ? 'warning' : 'danger') }}">
                      {{ ucfirst($status) }}
                    </span>
                  </td>
                  <td>
                    @if (strtolower($expert->status) === 'pending')
                    <button class="btn btn-success btn-sm"
                      onclick="updateStatus({{ $expert->id }}, 'Approved')">Approve</button>
                    <button class="btn btn-danger btn-sm"
                      onclick="updateStatus({{ $expert->id }}, 'Rejected')">Reject</button>
                    @else
                    <!-- <a href="{{ route('admin.edit-expert', $expert->id) }}" class="btn btn-warning btn-sm">Edit</a> -->
                    <button onclick="deleteExpert({{ $expert->id }})" class="btn btn-danger btn-sm">Delete</button>
                    @endif
                  </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          @else
          <div class="alert alert-info">No recent experts found.</div>
          @endif
        </div>
      </div>
    </div>
  </main>

  <script>
    function updateStatus(expertId, newStatus) {
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
        .then(response => {
          if (response.ok) {
            location.reload(); // reload biar status langsung berubah
          } else {
            alert('Gagal memperbarui status.');
          }
        })
        .catch(error => {
          console.error('Error:', error);
          alert('Terjadi kesalahan.');
        });
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


</div>
@endsection