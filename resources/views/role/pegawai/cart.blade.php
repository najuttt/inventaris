@extends('layouts.detail')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0"> Detail Keranjang</h5>
    </div>
    <div class="table-responsive text-nowrap">
        @if(!$cart || $cart->cartItems->isEmpty())
            <div class="text-center text-muted py-4">
                <i class="ri-information-line me-1"></i>
                Keranjang kamu kosong
            </div>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th>Jumlah</th>
                        <th>Aksi</th>
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
                        <td>
                            <form action="{{ route('pegawai.cart.destroy', $item->id)}}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="btn btn-sm btn-danger"
                                        onclick="return confirm('Yakin hapus barang ini?')">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

                <div class="card-footer text-end">
                    <form action="{{ route('pegawai.permintaan.submit', $cart->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary"
                                onclick="return confirm('Yakin ajukan permintaan ini?')">
                            Ajukan Peminjaman
                        </button>
                    </form>
                </div>
        @endif
    </div>
</div>
@endsection