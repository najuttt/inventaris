@extends('layouts.index')
@section('content')
<hr>
<h5 class="mb-4"> Dashboard Barang</h5>

<!-- Dropdown filter -->
<form method="GET" class="mb-4">
    <div class="row">
        <div class="col-md-4">
            <select name="supplier_id" class="form-select" onchange="this.form.submit()">
                <option value="">Semua Supplier</option>
                @foreach ($suppliers as $supplier)
                    <option value="{{ $supplier->id }}" {{ $supplierId == $supplier->id ? 'selected' : '' }}>
                        {{ $supplier->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
</form>

<!-- Filter info -->
<h6 class="text-muted text-center mt-3">
    Menampilkan stok dari:
    <strong>
        {{ $suppliers->firstWhere('id', $supplierId)?->name ?? 'Semua Supplier' }}
    </strong>
</h6>

<!-- Dashboard expired / non-expired -->
<div class="row text-center mt-4">
    <!-- Belum Expired -->
    <div class="col-md-6 mb-3">
        <div class="card border-0 shadow-sm" style="background-color: #e6f4ea;">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-center mb-2">
                    <i class="bi bi-check-circle-fill text-success me-2" style="font-size: 1.5rem;"></i>
                    <h6 class="text-success mb-0">Belum Expired</h6>
                </div>
                <h2 class="text-success fw-bold mb-0">{{ $nonExpiredCount }}</h2>
            </div>
        </div>
    </div>

    <!-- Sudah Expired -->
    <div class="col-md-6 mb-3">
        <div class="card border-0 shadow-sm" style="background-color: #fbeaea;">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-center mb-2">
                    <i class="bi bi-exclamation-triangle-fill text-danger me-2" style="font-size: 1.5rem;"></i>
                    <h6 class="text-danger mb-0">Sudah Expired</h6>
                </div>
                <h2 class="text-danger fw-bold mb-0">{{ $expiredCount }}</h2>
            </div>
        </div>
    </div>
</div>
@endsection
