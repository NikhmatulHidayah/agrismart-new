@extends('admin.layout')

@section('content')
<div class="container mt-5">
  <h2>Edit Expert</h2>
  <form action="{{ route('admin.update-expert', $expert->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
      <label class="form-label">Nama</label>
      <input type="text" class="form-control" value="{{ $expert->user->name }}" readonly>
    </div>

    <div class="mb-3">
      <label class="form-label">Email</label>
      <input type="text" class="form-control" value="{{ $expert->user->email }}" readonly>
    </div>

    <div class="mb-3">
      <label class="form-label">Price</label>
      <input type="text" name="price" class="form-control" value="{{ old('price', $expert->price) }}">
    </div>

    <!-- <div class="mb-3">
      <label class="form-label">Sertifikat</label>
      <input type="text" class="form-control" name="certificate" value="{{ old('certificate', $expert->certificate) }}" readonly>
    </div> -->

    <div class="mb-3">
      <label class="form-label">Status</label>
      <select name="status" class="form-select">
        <option value="Pending" {{ $expert->status == 'Pending' ? 'selected' : '' }}>Pending</option>
        <option value="Approved" {{ $expert->status == 'Approved' ? 'selected' : '' }}>Approved</option>
        <option value="Rejected" {{ $expert->status == 'Rejected' ? 'selected' : '' }}>Rejected</option>
      </select>
    </div>

    <button type="submit" class="btn btn-primary">Update</button>
    <a href="{{ route('admin.manage-expert') }}" class="btn btn-secondary">Back</a>
  </form>
</div>
@endsection
