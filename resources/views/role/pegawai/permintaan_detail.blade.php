@extends('layouts.detail')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Detail Permintaan</h5>
        <span class="badge 
            {{ $cart->status === 'pending' ? 'bg-warning' : 
               ($cart->status === 'approved' ? 'bg-success' : 
               ($cart->status === 'rejected' ? 'bg-danger' : 'bg-secondary')) }}">
            {{ ucfirst($cart->status) }}
        </span>
    </div>
    <div class="table-responsive text-nowrap">
        @if(!$cart || $cart->cartItems->isEmpty())
            <div class="text-center text-muted py-4">
                <i class="ri-information-line me-1"></i>
                Tidak ada produk di permintaan ini.
            </div>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th>Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cart->cartItems as $item)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('storage/' . $item->item->image) }}" 
                                     class="rounded me-2" 
                                     style="width: 50px; height: 50px; object-fit: cover;">
                                {{ $item->item->name }}
                            </div>
                        </td>
                        <td>{{ $item->quantity }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

    {{-- Tombol kembali --}}
    <div class="card-footer text-end">
        <a href="{{ route('pegawai.permintaan.pending') }}" class="btn btn-primary">
            <i class="ri-arrow-left-line me-1"></i> Kembali
        </a>
    </div>
</div>
@endsection
