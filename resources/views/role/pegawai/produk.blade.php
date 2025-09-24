@extends('layouts.index')
@section('content')
<div class="row gy-4">
    @foreach ($items as $item)
        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">
            <div class="card h-100 shadow-sm border-0">
                {{-- Gambar Produk --}}
                <img src="{{ asset('storage/'. $item->image) }}"
                     class="card-img-top"
                     alt="{{ $item->name }}"
                     style="height: 200px; object-fit: cover;">

                <div class="card-body d-flex flex-column">
                    {{-- Nama & Kategori --}}
                    <h5 class="card-title mb-1">{{ $item->name }}</h5>
                    <p class="card-text text-muted mb-2">
                        Kategori: <span class="fw-semibold">{{ $item->category->name ?? '-' }}</span>
                    </p>

                    {{-- Form permintaan --}}
                    <form action="{{ route('pegawai.permintaan.create') }}" method="POST" class="mt-auto">
                        @csrf
                        <input type="hidden" name="items[0][item_id]" value="{{ $item->id }}">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="input-group" style="max-width: 120px;">
                                <input type="number"
                                    name="items[0][quantity]"
                                    class="form-control text-center"
                                    value="1" min="1"
                                    max="{{ $item->stock }}"
                                    {{ $item->stock == 0 ? 'disabled' : '' }}>
                            </div>
                            <button type="submit"
                                    class="btn btn-sm btn-primary ms-2"
                                    {{ $item->stock == 0 ? 'disabled' : '' }}>
                                <i class="ri-shopping-cart-2-line"></i> Ajukan
                            </button>
                        </div>
                    </form>


                    {{-- Stok --}}
                    <small class="mt-2 text-muted">
                        Stok: {{ $item->stock }}
                    </small>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection