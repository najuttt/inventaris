@extends('layouts.index')

@section('content')
<div class="row mb-6 gy-6">
  <div class="col-xxl">
    <div class="card">
      <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="mb-0">Tambah Barang Masuk</h5>
        <small class="text-body-secondary">Form input barang masuk baru</small>
      </div>
      <div class="card-body">
        <form action="{{ route('super_admin.item_ins.store') }}" method="POST">
          @csrf

          {{-- Item --}}
          <div class="row mb-4">
            <label class="col-sm-2 col-form-label">Item</label>
            <div class="col-sm-10">
              <select name="item_id" class="form-control" required>
                <option value="">-- Pilih Item --</option>
                @foreach($items as $item)
                  <option value="{{ $item->id }}">{{ $item->name }}</option>
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
                <option value="">-- Pilih Supplier --</option>
                @foreach($suppliers as $supplier)
                  <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                @endforeach
              </select>
              @error('supplier_id') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
          </div>

          {{-- Jumlah --}}
          <div class="row mb-4">
            <label class="col-sm-2 col-form-label">Jumlah</label>
            <div class="col-sm-10">
              <input type="number" name="quantity" class="form-control" placeholder="Isi jumlah" required>
              @error('quantity') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
          </div>

          {{-- Kedaluwarsa --}}
          <div class="row mb-3 align-items-center">
            <label class="col-sm-2 col-form-label text-muted fw-semibold">Tanggal Kedaluwarsa</label>
            <div class="col-sm-10">

              {{-- aktif dan non aktif --}}
              <div class="d-flex align-items-center gap-3 mb-3">
                <label class="switch">
                  <input type="checkbox" id="toggleExpired">
                  <span class="slider"></span>
                </label>
                <span id="toggleLabel" class="fw-semibold text-secondary">Nonaktif</span>
              </div>

              {{-- Input date kadaluarsa --}}
              <input 
                  type="date" 
                  name="expired_at" 
                  id="expired_at"
                  min="{{ \Carbon\Carbon::today()->toDateString() }}"
                  value="{{ old('expired_at') }}"
                  class="form-control @error('expired_at') is-invalid @enderror"
                  style="display:none;"
              >
              @error('expired_at')
                  <div class="text-danger small mt-1">{{ $message }}</div>
              @enderror
            </div>
          </div>

          {{-- Tombol simpan --}}
          <div class="row justify-content-end">
            <div class="col-sm-10">
              <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
              <a href="{{ route('super_admin.item_ins.index') }}" class="btn btn-secondary btn-sm">Kembali</a>
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>
@endsection

{{-- CSS --}}
<style>
.switch {
  position: relative;
  display: inline-block;
  width: 50px;
  height: 26px;
}
.switch input {
  opacity: 0;
  width: 0;
  height: 0;
}
.slider {
  position: absolute;
  cursor: pointer;
  top: 0; left: 0; right: 0; bottom: 0;
  background-color: #adb5bd; /* abu default */
  transition: .4s;
  border-radius: 34px;
}
.slider:before {
  position: absolute;
  content: "";
  height: 20px; width: 20px;
  left: 3px;
  bottom: 3px;
  background-color: white;
  transition: .4s;
  border-radius: 50%;
  box-shadow: 0 2px 4px rgba(0,0,0,0.2);
}
input:checked + .slider {
  background-color: #6f42c1; /* ungu aktif */
}
input:checked + .slider:before {
  transform: translateX(24px);
}
</style>

@push('scripts')
<script>
    const toggleExpired = document.getElementById('toggleExpired');
    const expiredInput = document.getElementById('expired_at');
    const toggleLabel = document.getElementById('toggleLabel');

    toggleExpired.addEventListener('change', function () {
        if (this.checked) {
            expiredInput.style.display = 'block';
            expiredInput.setAttribute('required', 'required');
            toggleLabel.textContent = "Aktif";
            toggleLabel.classList.remove("text-secondary");
            toggleLabel.classList.add("text-purple");
        } else {
            expiredInput.style.display = 'none';
            expiredInput.removeAttribute('required');
            expiredInput.value = '';
            toggleLabel.textContent = "Nonaktif";
            toggleLabel.classList.remove("text-purple");
            toggleLabel.classList.add("text-secondary");
        }
    });
</script>
@endpush
