@extends('layouts.index')
@section('content')
<div class="card">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="mb-0">Daftar Akun</h5>
    <a href="{{ route('super_admin.users.create') }}" class="btn btn-sm btn-primary">
      <i class="ri ri-add-line me-1"></i> Tambah
    </a>
  </div>
  <div class="table-responsive text-nowrap">
    <table class="table">
      <thead>
        <tr>
          <th>Nama</th>
          <th>Email</th>
          <th>Role</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        @forelse($users as $user)
        <tr>
          <td><i class="ri ri-user-line text-info me-2"></i>{{ $user->name }}</td>
          <td>{{ $user->email }}</td>
          <td>
            <span class="badge bg-label-{{ $user->role == 'super_admin' ? 'danger' : ($user->role == 'admin' ? 'primary' : 'secondary') }}">
              {{ ucfirst($user->role) }}
            </span>
          </td>
          <td>
            <div class="dropdown">
              <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                <i class="ri ri-more-2-line"></i>
              </button>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="{{ route('super_admin.users.edit', $user->id) }}">
                  <i class="ri ri-pencil-line me-1"></i> Edit
                </a>
                <form action="{{ route('super_admin.users.destroy', $user->id) }}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="dropdown-item" onclick="return confirm('Yakin hapus akun ini?')">
                    <i class="ri ri-delete-bin-6-line me-1"></i> Delete
                  </button>
                </form>
              </div>
            </div>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="4" class="text-center text-muted py-4">
            <i class="ri-information-line me-1"></i> Belum ada akun
          </td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection
