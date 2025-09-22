@extends('layouts.index')
@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Daftar Barang Masuk</h5>
        <a href="{{ route('super_admin.item_ins.create') }}" class="btn btn-sm btn-primary">
            <i class="ri ri-add-line me-1"></i> Tambah
        </a>
    </div>
    <div class="table-responsive text-nowrap">
        <table class="table">
            <thead>
                <tr>
                    <th>Barang</th>
                    <th>Jumlah</th>
                    <th>Supplier</th>
                    <th>Expired</th>
                    <th>Status</th>
                    <th>Dibuat Oleh</th>
                    <th>Actions</th>
                </tr>
            </thead>
            @forelse($items_in as $row)
            <tbody class="table-border-bottom-0">
                <tr>
                    <td>
                        <span>{{ $row->item->name ?? '-' }}</span>
                    </td>
                    <td>{{ $row->quantity }}</td>
                    <td>{{ $row->supplier->name ?? '-' }}</td>
                    <td>{{ $row->expired_at ? $row->expired_at->format('d-m-Y') : '-' }}</td>
                    <td>
                        <span class="badge {{ $row->status === 'expired' ? 'bg-danger' : 'bg-success' }}">
                            {{ $row->status }}
                        </span>
                    </td>
                    <td>{{ $row->creator->name ?? '-' }}</td>
                    <td>
                        <div class="dropdown">
                            <button
                                type="button"
                                class="btn p-0 dropdown-toggle hide-arrow shadow-none"
                                data-bs-toggle="dropdown">
                                <i class="ri ri-more-2-line icon-18px"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ route('super_admin.item_ins.edit', $row->id) }}">
                                    <i class="ri ri-pencil-line icon-18px me-1"></i>
                                    Edit
                                </a>
                                <form action="{{ route('super_admin.item_ins.destroy', $row->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="dropdown-item" onclick="return confirm('Yakin hapus data ini?')">
                                        <i class="ri ri-delete-bin-6-line icon-18px me-1"></i>
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center text-muted py-4">
                        <i class="ri-information-line me-1"></i>
                        Belum Ada Data
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        {{ $items_in->links() }}
    </div>
</div>
@endsection
