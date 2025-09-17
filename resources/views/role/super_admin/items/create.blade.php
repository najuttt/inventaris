@extends('layouts.index')

@section('content')
<div class="row mb-6 gy-6">
  <div class="col-xxl">
    <div class="card">
      <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="mb-0">Tambah Barang</h5>
        <small class="text-body-secondary">Form input barang baru</small>
      </div>
      <div class="card-body">
        <form action="{{ route('super_admin.items.store') }}" method="POST">
          @csrf

          <div class="row mb-4">
            <label class="col-sm-2 col-form-label">Nama Barang</label>
            <div class="col-sm-10">
              <input type="text" name="name" class="form-control" placeholder="Isi Nama Barang" required>
              @error('name') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
          </div>

          <div class="row mb-4">
            <label class="col-sm-2 col-form-label">Kategori</label>
            <div class="col-sm-10">
              <select name="category_id" class="form-control" required>
                <option value="">-- Pilih Kategori --</option>
                @foreach($categories as $category)
                  <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
              </select>
              @error('category_id') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
          </div>

          <div class="row mb-4">
            <label class="col-sm-2 col-form-label">Stok</label>
            <div class="col-sm-10">
              <input type="number" name="stock" class="form-control" placeholder="Isi Jumlah Stok" required>
              @error('stock') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
          </div>

          <div class="row mb-4">
            <label class="col-sm-2 col-form-label">Harga</label>
            <div class="col-sm-10">
              <input type="number" name="price" class="form-control" placeholder="Isi Harga Barang" required>
              @error('price') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
          </div>

          <div class="row mb-4">
            <label class="col-sm-2 col-form-label">Supplier</label>
            <div class="col-sm-10">
              <input type="text" name="supplier" class="form-control" placeholder="Isi Nama Supplier">
              @error('supplier') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
          </div>

          <div class="row justify-content-end">
            <div class="col-sm-10">
              <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
              <a href="{{ route('super_admin.items.index') }}" class="btn btn-secondary btn-sm">Kembali</a>
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>
@endsection
