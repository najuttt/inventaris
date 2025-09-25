@extends('layouts.index')
@section('content')
<div class="row gy-4">
    @foreach ($items as $item)
    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">
        <div class="card h-100 shadow-sm border-0">
            <img src="{{ asset('storage/'. $item->image) }}"
                 class="card-img-top"
                 alt="{{ $item->name }}"
                 style="height: 200px; object-fit: cover;">

            <div class="card-body d-flex flex-column">
                <h5 class="card-title mb-1">{{ $item->name }}</h5>
                <p class="card-text text-muted mb-2">
                    Kategori: <span class="fw-semibold">{{ $item->category->name ?? '-' }}</span>
                </p>
                <small class="mt-2 text-muted">Stok: {{ $item->stock }}</small>

                @php
                    $sudahAjukan = $guest->carts->flatMap->items->contains('id', $item->id);
                @endphp

                <form action="{{ route('admin.guestCart.add', [$guest->id, $item->id]) }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit"
                            class="btn btn-sm btn-primary ms-2"
                            {{ $item->stock == 0 || $sudahAjukan ? 'disabled' : '' }}>
                        <i class="ri-shopping-cart-2-line"></i> Ajukan
                    </button>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection