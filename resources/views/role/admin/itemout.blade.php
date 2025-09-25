@extends('layouts.index')

@section('content')
<div class="container">
    {{-- Permintaan dari User --}}
    <h4 class="mb-3">Permintaan User</h4>
    @foreach($approvedItems as $cart)
        <div class="card mb-4">
            <div class="card-header">
                <h5>Permintaan #{{ $cart->id }} oleh {{ $cart->user->name ?? 'User Tidak Diketahui' }}</h5>
                <small>Status: <span class="badge bg-success">{{ ucfirst($cart->status) }}</span></small>
                @if($cart->picked_up_at)
                    <small class="ms-2">Diambil: {{ $cart->picked_up_at }}</small>
                @endif
                <a href="{{ route('admin.itemout.struk', $cart->id) }}"
                class="btn btn-sm btn-success" target="_blank">
                    Cetak Struk (PDF)
                </a>
            </div>

            <div class="card-body p-0">
                <table class="table table-bordered mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Nama Item</th>
                            <th>Kode</th>
                            <th>Jumlah</th>
                            <th>Status Scan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cart->cartItems as $index => $cart_item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $cart_item->item->name }}</td>
                                <td>{{ $cart_item->item->code }}</td>
                                <td>{{ $cart_item->quantity }}</td>
                                <td>
                                    @if($cart_item->scanned_at)
                                        <span class="badge bg-info">Sudah Scan</span>
                                    @else
                                        <span class="badge bg-warning">Belum Scan</span>
                                    @endif
                                </td>
                                <td>
                                    <!-- Tombol Modal -->
                                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#scanModal{{ $cart_item->id }}">
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
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
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
    @endforeach

    {{-- Permintaan dari Guest --}}
    <h4 class="mb-3 mt-5">Permintaan Guest</h4>
    @foreach($guestRequests as $guest_cart)
        <div class="card mb-4">
            <div class="card-header">
                <h5>Permintaan Guest #{{ $guest_cart->id }} ({{ $guest_cart->guest->name ?? 'Guest Tidak Diketahui' }})</h5>
            </div>
            <div class="card-body p-0">
                <table class="table table-bordered mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Nama Item</th>
                            <th>Kode</th>
                            <th>Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($guest_cart->guestCartItems as $index => $guest_item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $guest_item->item->name }}</td>
                                <td>{{ $guest_item->item->code }}</td>
                                <td>{{ $guest_item->quantity }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endforeach
</div>
@endsection