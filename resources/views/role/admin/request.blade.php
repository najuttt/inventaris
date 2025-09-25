@extends('layouts.index')

@section('content')
<div class="container">
    <h3>Daftar Request Pending & Rejected</h3>
    <table class="table table-bordered  table-responsive">
        <thead>
            <tr>
                <th>No</th>
                <th>User</th>
                <th>Email</th>
                <th>Role</th>
                <th>Status</th>
                <th>Quantity</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($requests as $index => $req)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $req->name }}</td>
                    <td>{{ $req->email }}</td>
                    <td>{{ ucfirst($req->role) }}</td>
                    <td>
                        <span class="badge
                            @if($req->status == 'pending') bg-warning
                            @elseif($req->status == 'rejected') bg-danger
                            @elseif($req->status == 'approved') bg-success
                            @endif">
                            {{ ucfirst($req->status) }}
                        </span>
                    </td>
                    <td>{{ $req->total_quantity }}</td>
                    <td>{{ $req->created_at }}</td>
                    <td>
                        @if($req->status == 'pending')
                            <!-- Tombol approve -->
                            <form action="{{ route('admin.carts.update', $req->cart_id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="approved">
                                <button type="submit" class="btn btn-success btn-sm">Approve</button>
                            </form>

                            <!-- Tombol reject -->
                            <form action="{{ route('admin.carts.update', $req->cart_id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="rejected">
                                <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                            </form>
                        @elseif($req->status == 'rejected')
                            <span class="text-danger">Sudah Ditolak</span>
                        @elseif($req->status == 'approved')
                            <span class="text-success">Sudah Disetujui</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection