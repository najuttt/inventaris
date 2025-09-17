@extends('layouts.index')

@section('content')
<div class="row mb-6 gy-6">
  <div class="col-xxl">
    <div class="card">
      <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="mb-0">Edit Item Masuk</h5>
        <small class="text-body-secondary">Form ubah item masuk</small>
      </div>
      <div class="card-body">
        <form action="{{ route('super_admin.item_ins.update', $item_in->id) }}" method="POST">
          @csrf
          @method('PUT')

          <div class="row mb-4">
            <label class="col-sm-2 col-form-label">Item</label>
            <div class="col-sm-10">
              <select name="item_id" class="form-control" required>
                @foreach($items as $item)
                  <option value="{{ $item->id }}" {{ $item_in->item_id == $item->id ? 'selected' : '' }}>
                    {{ $item->name }}
                  </option>
                @endforeach
              </select>
              @error('item_id') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
          </div>

          <div class="row mb-4">
            <label class="col-sm-2 col-form-label">Supplier</label>
            <div class="col-sm-10">
              <select name="supplier_id" class="form-control" required>
                @foreach($suppliers as $supplier)
                  <option value="{{ $supplier->id }}" {{ $item_in->supplier_id == $supplier->id ? 'selected' : '' }}>
                    {{ $supplier->name }}
                  </option>
                @endforeach
              </select>
              @error('supplier_id') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
          </div>

          <div class="row mb-4">
            <label class="col-sm-2 col-form-label">Quantity</label>
            <div class="col-sm-10">
              <input type="number" name="quantity" value="{{ $item_in->quantity }}" class="form-control" required>
              @error('quantity') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
          </div>

          <div class="row mb-4">
            <label class="col-sm-2 col-form-label">Expired At</label>
            <div class="col-sm-10">
              <input type="date" name="expired_at" value="{{ $item_in->expired_at?->format('Y-m-d') }}" class="form-control">
              @error('expired_at') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
          </div>

          <div class="row justify-content-end">
            <div class="col-sm-10">
              <button type="submit" class="btn btn-primary btn-sm">Update</button>
              <a href="{{ route('super_admin.item_ins.index') }}" class="btn btn-secondary btn-sm">Kembali</a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
