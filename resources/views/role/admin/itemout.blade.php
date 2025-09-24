@extends('layouts.index')

@section('content')
<div class="container py-4">
    {{-- Permintaan dari User --}}
    <h4 class="mb-3 fw-bold text-primary">📦 Permintaan User</h4>
    @forelse($approvedItems as $cart)
        <div class="card shadow-sm mb-4 border-0">
            <div class="card-header bg-light d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="mb-1">Permintaan <strong>#{{ $cart->id }}</strong> oleh
                        <span class="text-dark">{{ $cart->user->name ?? 'User Tidak Diketahui' }}</span>
                    </h6>
                    <small>
                        Status: <span class="badge bg-success">{{ ucfirst($cart->status) }}</span>
                        @if($cart->picked_up_at)
                            <span class="ms-2">| Diambil: {{ $cart->picked_up_at }}</span>
                        @endif
                    </small>
                </div>
                <a href="{{ route('admin.itemout.struk', $cart->id) }}"
                   class="btn btn-sm btn-outline-success" target="_blank">
                    Cetak Struk (PDF)
                </a>
            </div>

            <div class="card-body p-0">
                <table class="table table-hover table-sm mb-0 align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th style="width: 5%">No</th>
                            <th style="width: 30%">Nama Item</th>
                            <th style="width: 20%">Kode</th>
                            <th style="width: 10%">Jumlah</th>
                            <th style="width: 15%">Status Scan</th>
                            <th style="width: 10%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cart->cartItems as $index => $cart_item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $cart_item->item->name }}</td>
                                <td><span class="text-monospace">{{ $cart_item->item->code }}</span></td>
                                <td>{{ $cart_item->quantity }}</td>
                                <td>
                                    @if($cart_item->scanned_at)
                                        <span class="badge bg-info">Sudah Scan</span>
                                    @else
                                        <span class="badge bg-warning">Belum Scan</span>
                                    @endif
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-primary"
                                            data-bs-toggle="modal"
                                            data-bs-target="#scanModal{{ $cart_item->id }}">
                                        Scan
                                    </button>
                                </td>
                            </tr>

                            <!-- Modal Scan -->
                            <div class="modal fade" id="scanModal{{ $cart_item->id }}" tabindex="-1" aria-labelledby="scanModalLabel{{ $cart_item->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="{{ route('admin.itemout.scan', $cart_item->id) }}" method="POST">
                                            @csrf
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="scanModalLabel{{ $cart_item->id }}">Scan Barang</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Silakan scan barcode untuk item <strong>{{ $cart_item->item->name }}</strong>.</p>
                                                <div class="mb-3">
                                                    <label for="barcode{{ $cart_item->id }}" class="form-label">Barcode</label>
                                                    <input type="text" name="barcode" id="barcode{{ $cart_item->id }}" class="form-control" autofocus>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-primary">Proses Scan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @empty
        <div class="alert alert-info">Belum ada permintaan user.</div>
    @endforelse

    <!-- Pagination User -->
    <div class="d-flex justify-content-center my-3">
        {{ $approvedItems->links() }}
    </div>

    {{-- Permintaan dari Guest --}}
    <h4 class="mb-3 fw-bold text-secondary">👤 Permintaan Guest</h4>
    @forelse($guestRequests as $guest_cart)
        <div class="card shadow-sm mb-4 border-0">
            <div class="card-header bg-light">
                <h6 class="mb-0">Permintaan Guest <strong>#{{ $guest_cart->id }}</strong>
                    ({{ $guest_cart->guest->name ?? 'Guest Tidak Diketahui' }})
                </h6>
            </div>
            <div class="card-body p-0">
                <table class="table table-hover table-sm mb-0 align-middle">
                    <thead class="table-secondary">
                        <tr>
                            <th style="width: 5%">No</th>
                            <th style="width: 35%">Nama Item</th>
                            <th style="width: 25%">Kode</th>
                            <th style="width: 10%">Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($guest_cart->guestCartItems as $index => $guest_item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $guest_item->item->name }}</td>
                                <td><span class="text-monospace">{{ $guest_item->item->code }}</span></td>
                                <td>{{ $guest_item->quantity }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @empty
        <div class="alert alert-info">Belum ada permintaan guest.</div>
    @endforelse

    <!-- Pagination Guest -->
    <div class="d-flex justify-content-center my-3">
        {{ $guestRequests->links() }}
    </div>
</div>
@endsection

@push('styles')
<style>
    /* Pagination lebih kecil */
    .pagination {
        font-size: 0.85rem;  /* perkecil font */
    }

    .pagination .page-link {
        padding: 0.25rem 0.5rem; /* perkecil padding */
    }

    .pagination .page-item .page-link svg {
        width: 14px;
        height: 14px;
    }
</style>
@endpush
