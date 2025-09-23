@extends('layouts.index')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0"> Permintaan Pending</h5>
    </div>

    <div class="table-responsive text-nowrap">
        @if($carts->isEmpty())
            <div class="text-center text-muted py-4">
                <i class="ri-information-line me-1"></i>
                Belum ada permintaan yang pending
            </div>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tanggal</th>
                        <th>Barang</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($carts as $cart)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $cart->created_at->format('d M Y H:i') }}</td>
                        <td>{{ $cart->cart_items_count }} Barang</td>
                        <td>
                            <span class="badge bg-warning text-dark">Pending</span>
                        </td>
                        <td>
                            <a href="{{ route('pegawai.permintaan.detail', $cart->id) }}" 
                            class="btn btn-sm btn-primary">
                                Detail
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
@endsection
