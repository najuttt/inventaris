@extends('layouts.index')

@section('content')
<div class="row mb-6 gy-6">
  <div class="col-xxl">
    <div class="card">
      <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="mb-0">Edit Barang Masuk</h5>
        <small class="text-body-secondary">Form Ubah Barang Masuk</small>
      </div>
      <div class="card-body">
        <form action="{{ route('super_admin.item_ins.update', $item_in->id) }}" method="POST">
          @csrf
          @method('PUT')

          {{-- Item --}}
          <div class="row mb-4">
            <label class="col-sm-2 col-form-label">Barang</label>
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

          {{-- Supplier --}}
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

          {{-- Quantity --}}
          <div class="row mb-4">
            <label class="col-sm-2 col-form-label">Jumlah</label>
            <div class="col-sm-10">
              <input type="number" name="quantity" value="{{ $item_in->quantity }}" class="form-control" required>
              @error('quantity') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
          </div>

          {{-- Tombol Expired --}}
          <div class="row mb-3 align-items-center">
            <label class="col-sm-2 col-form-label text-muted fw-semibold">Tanggal Kedaluwarsa</label>
            <div class="col-sm-10 d-flex align-items-center gap-3">
              <label class="toggle-switch">
                <input type="checkbox" id="toggle-expired" {{ $item_in->expired_at ? 'checked' : '' }}>
                <span class="slider"></span>
              </label>
              <span id="toggle-label" class="fw-semibold {{ $item_in->expired_at ? 'text-purple' : 'text-secondary' }}">
                {{ $item_in->expired_at ? 'Aktif' : 'Nonaktif' }}
              </span>
            </div>

            <div id="expired-date-container" class="mt-3" style="{{ $item_in->expired_at ? '' : 'display: none;' }}">
              <input 
                  type="date" 
                  name="expired_at" 
                  id="expired_at"
                  min="{{ \Carbon\Carbon::today()->toDateString() }}"
                  value="{{ old('expired_at', $item_in->expired_at ? \Carbon\Carbon::parse($item_in->expired_at)->format('Y-m-d') : '') }}"
                  class="form-control @error('expired_at') is-invalid @enderror"
              >
              @error('expired_at')
                  <div class="text-danger small mt-1">{{ $message }}</div>
              @enderror
            </div>
          </div>

          {{-- Tombol --}}
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

<style>
  .toggle-switch {
      position: relative;
      display: inline-block;
      width: 60px;
      height: 34px;
  }
  .toggle-switch input {
      opacity: 0;
      width: 0;
      height: 0;
  }
  .slider {
      position: absolute;
      cursor: pointer;
      top: 0; left: 0; right: 0; bottom: 0;
      background-color: #adb5bd; 
      border-radius: 34px;
      transition: 0.4s;
  }
  .slider:before {
      position: absolute;
      content: "";
      height: 26px;
      width: 26px;
      border-radius: 50%;
      left: 4px;
      bottom: 4px;
      background-color: white;
      transition: 0.4s;
      box-shadow: 0 2px 4px rgba(0,0,0,0.2);
  }
  input:checked + .slider {
      background-color: #6f42c1; 
  }
  input:checked + .slider:before {
      transform: translateX(26px);
  }
</style>

@push('scripts')
<script>
  const toggleExpired = document.getElementById('toggle-expired');
  const expiredInput = document.getElementById('expired_at');
  const expiredContainer = document.getElementById('expired-date-container');
  const toggleLabel = document.getElementById('toggle-label');

  toggleExpired.addEventListener('change', function () {
      if (this.checked) {
          expiredContainer.style.display = 'block';
          expiredInput.setAttribute('required', 'required');
          toggleLabel.textContent = "Aktif";
          toggleLabel.classList.remove("text-secondary");
          toggleLabel.classList.add("text-purple");
      } else {
          expiredContainer.style.display = 'none';
          expiredInput.removeAttribute('required');
          expiredInput.value = '';
          toggleLabel.textContent = "Nonaktif";
          toggleLabel.classList.remove("text-purple");
          toggleLabel.classList.add("text-secondary");
      }
  });
</script>
@endpush
