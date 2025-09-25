@extends('layouts.index')

@section('content')
<div class="row gy-6 mb-4">
  <!-- Chart -->
  <div class="col-xl-8 col-md-6">
    <div class="card shadow-sm border-0 rounded-3 overflow-hidden">
      <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <div>
          <h6 class="text-muted mb-1">Ringkasan Barang Keluar</h6>
          <h5 class="fw-bold mb-0">Statistik Barang</h5>
        </div>
        <div class="text-end">
          <h4 class="fw-bold {{ $growth >= 0 ? 'text-success' : 'text-danger' }} mb-0">
            {{ number_format($growth, 1) }}%
          </h4>
          <small class="text-muted">dibanding periode sebelumnya</small>
        </div>
      </div>
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
          <span class="text-muted">
            <i class="bi bi-graph-up-arrow me-2 text-primary"></i> Grafik berdasarkan periode
          </span>
          <div class="btn-group" id="chartFilterGroup">
            <a href="{{ request()->fullUrlWithQuery(['period' => 'daily']) }}" 
              class="btn btn-sm btn-outline-primary rounded-pill px-3 {{ $period=='daily' ? 'active' : '' }}">
              Harian
            </a>
            <a href="{{ request()->fullUrlWithQuery(['period' => 'weekly']) }}" 
              class="btn btn-sm btn-outline-primary rounded-pill px-3 {{ $period=='weekly' ? 'active' : '' }}">
              Mingguan
            </a>
            <a href="{{ request()->fullUrlWithQuery(['period' => 'monthly']) }}" 
              class="btn btn-sm btn-outline-primary rounded-pill px-3 {{ $period=='monthly' ? 'active' : '' }}">
              Bulanan
            </a>
            <a href="{{ request()->fullUrlWithQuery(['period' => 'yearly']) }}" 
              class="btn btn-sm btn-outline-primary rounded-pill px-3 {{ $period=='yearly' ? 'active' : '' }}">
              Tahunan
            </a>
          </div>
        </div>
        <div class="chart-container" style="position: relative; height: 400px; width: 100%;">
          <canvas id="barangKeluarChart"></canvas>
        </div>
      </div>
    </div>
  </div>
  <!-- /Chart -->

  <!-- History Barang Keluar -->
  <div class="col-xl-4 col-md-6">
    <div class="card shadow-sm border-0 rounded-3 h-100">
      <div class="card-header bg-white">
        <h6 class="fw-bold mb-0"><i class="ri-logout-box-line text-danger me-1"></i> History Barang Keluar</h6>
      </div>
      <div class="card-body p-0">
        <ul class="list-group list-group-flush">
          @forelse ($history as $out)
            <li class="list-group-item d-flex justify-content-between align-items-start">
              <div class="me-auto">
                <div class="fw-semibold">{{ $out->item->name ?? '-' }}</div>
                <small class="text-muted">
                  Jumlah: {{ $out->quantity }} <br>
                  Disetujui: {{ $out->approver->name ?? 'Admin' }} <br>
                  {{ $out->created_at->format('d M Y') }}
                </small>
              </div>
              <span class="badge bg-danger-subtle text-danger rounded-pill">-{{ $out->quantity }}</span>
            </li>
          @empty
            <li class="list-group-item text-center text-muted fst-italic">Belum ada data</li>
          @endforelse
        </ul>
        <div class="p-3">
          {{ $history->links() }}
        </div>
      </div>
    </div>
  </div>
</div>

<style>
  #chartFilterGroup .btn {
    transition: all 0.2s ease-in-out;
    font-weight: 500;
  }
  #chartFilterGroup .btn:hover {
    background-color: #750dfd;
    color: #fff;
  }
  #chartFilterGroup .btn.active {
    background-color: #7d0dfd;
    color: #fff;
    box-shadow: 0 0 8px rgba(207, 222, 245, 0.4);
  }
</style>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  const ctx = document.getElementById('barangKeluarChart').getContext('2d');
  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: @json($labels),
      datasets: [
        {
          label: 'Barang Keluar',
          data: @json($keluar),
          backgroundColor: 'rgba(255, 99, 132, 0.7)',
          borderRadius: 8,
          borderSkipped: false
        },
        {
          label: 'Trend',
          data: @json($keluar),
          type: 'line',
          borderColor: 'rgba(255, 99, 132, 1)',
          borderWidth: 2,
          fill: false,
          tension: 0.3,
          pointBackgroundColor: 'rgba(255, 99, 132, 1)'
        }
      ]
    },
    options: {
      responsive: true,
      interaction: { mode: 'index', intersect: false },
      plugins: {
        legend: { 
          labels: { color: '#444', font: { size: 13, weight: 'bold' } } 
        },
        tooltip: {
          backgroundColor: '#222',
          titleColor: '#fff',
          bodyColor: '#fff',
          padding: 10,
          cornerRadius: 6
        }
      },
      scales: {
        x: { ticks: { color: '#6f42c1', font: { size: 12 } }, grid: { display: false } },
        y: { beginAtZero: true, ticks: { color: '#6f42c1', font: { size: 12 } }, grid: { color: 'rgba(200,200,200,0.3)', borderDash: [5,5] } }
      }
    }
  });
</script>
@endpush
