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

                <!-- Tombol trigger modal -->
                <button type="button"
                        class="btn btn-sm btn-primary mt-2"
                        data-bs-toggle="modal"
                        data-bs-target="#scanModal-{{ $item->id }}"
                        {{ $item->stock == 0 ? 'disabled' : '' }}>
                    <i class="ri-shopping-cart-2-line"></i> Keluarkan
                </button>
            </div>
        </div>
    </div>

    <!-- Modal Item Out -->
    <div class="modal fade" id="scanModal-{{ $item->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="form-{{ $item->id }}" action="{{ route('admin.itemout.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Barang Keluar: {{ $item->name }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Hidden untuk relasi -->
                        <input type="hidden" name="guest_id" value="{{ $guest->id }}">
                        <input type="hidden" name="item_id" value="{{ $item->id }}">
                        <input type="hidden" name="quantity" value="1">

                        <!-- Input barcode (scanner isi otomatis) -->
                        <div class="mb-3">
                            <label class="form-label">Scan Barcode</label>
                            <input id="barcode-{{ $item->id }}" type="text" name="barcode" class="form-control" placeholder="Scan barcode di sini" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Simpan</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection

@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", function() {
    @foreach ($items as $item)
    const input{{ $item->id }} = document.getElementById("barcode-{{ $item->id }}");

    // Saat modal terbuka, fokuskan input agar scanner langsung ngetik
    $('#scanModal-{{ $item->id }}').on('shown.bs.modal', function () {
        input{{ $item->id }}.focus();
    });

    // Submit otomatis setelah scanner menekan Enter
    input{{ $item->id }}.addEventListener("keypress", function(e) {
        if (e.key === "Enter") {
            e.preventDefault();
            document.getElementById("form-{{ $item->id }}").submit();
        }
    });
    @endforeach
});
</script>
@endpush
