@extends('layouts.index')
@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Daftar Barang</h5>
        <a href="{{ route('super_admin.items.create') }}" class="btn btn-sm btn-primary">
            <i class="ri ri-add-line me-1"></i> Tambah
        </a>
    </div>
    <div class="table-responsive text-nowrap">
        <table class="table">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Kategori</th>
                    <th>Satuan Barang</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @forelse($items as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->category->name ?? '-' }}</td>
                    <td>{{ $item->unit->name ?? '-' }}</td>
                    <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                    <td>{{ $item->stock }}</td>
                    <td>
                        <div class="dropdown">
                            <button
                                type="button"
                                class="btn p-0 dropdown-toggle hide-arrow shadow-none"
                                data-bs-toggle="dropdown">
                                <i class="ri ri-more-2-line icon-18px"></i>
                            </button>
                            <div class="dropdown-menu">
                                {{-- Detail --}}
                                <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#detailModal{{ $item->id }}">
                                    <i class="ri ri-eye-line icon-18px me-1"></i>
                                    Detail
                                </a>
                                {{-- Show --}}
                                <a class="dropdown-item" href="{{ route('super_admin.items.show', $item->id) }}">
                                  <i class="ri ri-eye-line icon-18px me-1"></i>
                                  Show
                                </a>
                                {{-- Edit --}}
                                <a class="dropdown-item" href="{{ route('super_admin.items.edit', $item->id) }}">
                                    <i class="ri ri-pencil-line icon-18px me-1"></i>
                                    Edit
                                </a>
                                {{-- Delete --}}
                                <form action="{{ route('super_admin.items.destroy', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="dropdown-item" onclick="return confirm('Yakin hapus barang ini?')">
                                        <i class="ri ri-delete-bin-6-line icon-18px me-1"></i>
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </td>
                </tr>

                {{-- Modal Detail --}}
                <div class="modal fade" id="detailModal{{ $item->id }}" tabindex="-1" aria-labelledby="detailModalLabel{{ $item->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header bg-light text-dark">
                                <h5 class="modal-title" id="detailModalLabel{{ $item->id }}">Detail Barang: {{ $item->name }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h6><strong>Kategori:</strong> {{ $item->category->name ?? '-' }}</h6>
                                        <h6><strong>Unit:</strong> {{ $item->unit->name ?? '-' }}</h6>
                                        <h6><strong>Supplier:</strong> {{ $item->supplier->name ?? '-' }}</h6>
                                    </div>
                                </div>
                                <hr>
                                <h6><strong>Barcode:</strong></h6>
                                <div class="text-center">
                                    @if($item->barcode_png_base64)
                                        <img src="{{ $item->barcode_png_base64 }}" alt="barcode"/>
                                        <p>{{ $item->code }}</p>
                                    @else
                                        <p class="text-muted">Barcode tidak tersedia</p>
                                    @endif
                                </div>
                            </div>
                            <div class="modal-footer">
                                <a href="{{ route('super_admin.items.barcode.pdf', $item->id) }}" target="_blank" class="btn btn-secondary">
                                    Download PDF
                                </a>
                                <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- End Modal Detail --}}
                @empty
                <tr>
                    <td colspan="8" class="text-center text-muted py-4">
                        <i class="ri-information-line me-1"></i>
                        Belum Ada Data
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
