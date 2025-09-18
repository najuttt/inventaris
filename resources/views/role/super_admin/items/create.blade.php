@extends('layouts.index')

@section('content')
<div class="row mb-6 gy-6">
  <div class="col-xxl">
    <div class="card">
      <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="mb-0">Tambah Item</h5>
        <small class="text-body-secondary">Form input item baru</small>
      </div>
      <div class="card-body">
        <form action="{{ route('super_admin.items.store') }}" method="POST" enctype="multipart/form-data">
          @csrf

          <div class="row mb-4">
            <label class="col-sm-2 col-form-label">Nama Item</label>
            <div class="col-sm-10">
              <input type="text" name="name" class="form-control" placeholder="Isi Nama Item" required>
              @error('name') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
          </div>

          <div class="row mb-4">
            <label class="col-sm-2 col-form-label">Kategori</label>
            <div class="col-sm-10">
              <select name="category_id" class="form-control" required>
                <option value="">-- Pilih Kategori --</option>
                @foreach($categories as $cat)
                  <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                @endforeach
              </select>
              @error('category_id') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
          </div>

          <div class="row mb-4">
            <label class="col-sm-2 col-form-label">Satuan Barang</label>
            <div class="col-sm-10">
              <select name="unit_id" class="form-control" required>
                <option value="">-- Pilih Satuan --</option>
                @foreach($units as $unit)
                  <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                @endforeach
              </select>
              @error('unit_id') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
          </div>

          <div class="row mb-4">
            <label class="col-sm-2 col-form-label">Supplier</label>
            <div class="col-sm-10">
              <select name="supplier_id" class="form-control" required>
                <option value="">-- Pilih Supplier --</option>
                @foreach($suppliers as $sup)
                  <option value="{{ $sup->id }}">{{ $sup->name }}</option>
                @endforeach
              </select>
              @error('supplier_id') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
          </div>

          <div class="row mb-4">
            <label class="col-sm-2 col-form-label">Stock</label>
            <div class="col-sm-10">
              <input type="number" name="stock" class="form-control" placeholder="Isi stock" required>
              @error('stock') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
          </div>zz

          <div class="form-group mb-4">
              <label for="image">Gambar</label>
              <input type="file" name="image" id="image" class="form-control">
              @if(isset($item) && $item->image)
                  <img src="{{ asset('storage/' . $item->image) }}" alt="Gambar" width="100" class="mt-2">
              @endif
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
