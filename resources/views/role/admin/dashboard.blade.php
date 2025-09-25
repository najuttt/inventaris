@extends('layouts.index')
@section('content')

<!-- Transactions -->
<div class="col-xl-12 mb-5">
  <div class="card h-100">
    <div class="card-header">
      <div class="d-flex align-items-center justify-content-between">
        <h5 class="card-title m-0 me-2">Transactions</h5>
        <div class="dropdown">
          <button
            class="btn text-body-secondary p-0"
            type="button"
            id="transactionID"
            data-bs-toggle="dropdown"
            aria-haspopup="true"
            aria-expanded="false">
            <i class="icon-base ri ri-more-2-line icon-24px"></i>
          </button>
          <div class="dropdown-menu dropdown-menu-end" aria-labelledby="transactionID">
            <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
            <a class="dropdown-item" href="javascript:void(0);">Share</a>
            <a class="dropdown-item" href="javascript:void(0);">Update</a>
          </div>
        </div>
      </div>
    </div>
    <div class="card-body pt-lg-10">
      <div class="row g-6">
        <div class="col-md-3 col-6">
          <div class="d-flex align-items-center">
            <div class="avatar">
              <div class="avatar-initial bg-primary rounded shadow-xs">
                <i class="icon-base ri ri-pie-chart-2-line icon-24px"></i>
              </div>
            </div>
            <div class="ms-3">
              <p class="mb-0">Barang Keluar</p>
              <h5 class="mb-0">{{ $totalBarangKeluar }}</h5>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-6">
          <div class="d-flex align-items-center">
            <div class="avatar">
              <div class="avatar-initial bg-success rounded shadow-xs">
                <i class="icon-base ri ri-group-line icon-24px"></i>
              </div>
            </div>
            <div class="ms-3">
              <p class="mb-0">Guest</p>
              <h5 class="mb-0">{{ $totalGuest }}</h5>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-6">
          <div class="d-flex align-items-center">
            <div class="avatar">
              <div class="avatar-initial bg-warning rounded shadow-xs">
                <i class="icon-base ri ri-macbook-line icon-24px"></i>
              </div>
            </div>
            <div class="ms-3">
              <p class="mb-0">Request</p>
              <h5 class="mb-0">{{ $totalRequest }}</h5>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!--/ Transactions -->


<!-- Weekly Overview Chart -->
<div class="col-xl-12 mb-5">
  <div class="card h-100">
    <div class="card-header">
      <h5 class="card-title">Traffic</h5>
      <p class="small mb-0">Barang Masuk dan Keluar</p>
      <div>
        <button class="btn btn-sm btn-outline-primary me-1" onclick="updateChart('week')">1 Minggu</button>
        <button class="btn btn-sm btn-outline-primary me-1" onclick="updateChart('month')">1 Bulan</button>
        <button class="btn btn-sm btn-outline-primary me-1" onclick="updateChart('3month')">3 Bulan</button>
        <button class="btn btn-sm btn-outline-primary me-1" onclick="updateChart('6month')">6 Bulan</button>
        <button class="btn btn-sm btn-outline-primary" onclick="updateChart('year')">1 Tahun</button>
      </div>
    </div>
    <div class="card-body">
      <!-- wrapper dengan full width -->
      <div style="width: 100%; height: 400px;">
        <canvas id="trafficChart"></canvas>
      </div>
    </div>
  </div>
</div>
<!--/ Weekly Overview Chart -->


<!-- Deposit / Withdraw -->
<div class="col-xl-12 mt-5">
  <div class="card-group">
    <div class="card mb-0">
      <!-- Barang Keluar -->
      <div class="card-body card-separator">
        <div class="d-flex justify-content-between align-items-center flex-wrap mb-4">
          <h5 class="m-0 me-2">Barang Keluar</h5>
          <a class="fw-medium" href="javascript:void(0);">View all</a>
        </div>
        <div class="deposit-content pt-2">
          <ul class="p-0 m-0">
            @forelse($latestBarangKeluar as $bk)
              <li class="d-flex mb-4 align-items-center pb-2">
                <div class="flex-shrink-0 me-4">
                  <img src="{{ asset('assets/img/icons/payments/gumroad.png') }}"
                      class="img-fluid" alt="barang" height="30" width="30" />
                </div>
                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                  <div class="me-2">
                    <h6 class="mb-0">{{ $bk->item->name ?? 'Unknown Item' }}</h6>
                    <p class="mb-0">Qty: {{ $bk->quantity }}</p>
                  </div>
                  <h6 class="text-success mb-0">{{ optional($bk->created_at)->format('d M Y') }}</h6>
                </div>
              </li>
            @empty
              <li class="text-center">Tidak ada barang keluar</li>
            @endforelse
          </ul>
        </div>
      </div>
    </div>
    <!-- Akhir Barang Keluar -->

    <!-- Request -->
    <div class="card mb-0">
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-center flex-wrap mb-4">
          <h5 class="m-0 me-2">Request</h5>
          <a class="fw-medium" href="javascript:void(0);">View all</a>
        </div>
        <div class="withdraw-content pt-2">
          <ul class="p-0 m-0">
            @forelse($latestRequest as $req)
              <li class="d-flex mb-4 align-items-center pb-2">
                <div class="flex-shrink-0 me-4">
                  <img src="{{ asset('assets/img/icons/brands/google.png') }}"
                      class="img-fluid" alt="request" height="30" width="30" />
                </div>
                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                  <div class="me-2">
                    <h6 class="mb-0">{{ $req->user->name ?? 'Guest' }}</h6>
                    <p class="mb-0">{{ $req->item->name ?? 'Unknown Item' }}</p>
                  </div>
                  <h6 class="text-danger mb-0">{{ optional($req->created_at)->format('d M Y') }}</h6>
                </div>
              </li>
            @empty
              <li class="text-center">Tidak ada request</li>
            @endforelse
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Deposit / Withdraw -->

<!-- card table -->
<div class="col-12 mt-5">
  <div class="card overflow-hidden">
    <!-- Card Header -->
    <div class="card-header d-flex justify-content-between align-items-center">
      <h5 class="card-title mb-0">Top 5 Permintaan Paling Banyak</h5>
    </div>

    <!-- Card Body dengan Table -->
    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table table-sm mb-0">
          <thead>
            <tr>
              <th class="text-truncate">No</th>
              <th class="text-truncate">User</th>
              <th class="text-truncate">Email</th>
              <th class="text-truncate">Role</th>
              <th class="text-truncate">Quantity</th>
            </tr>
          </thead>
          <tbody>
            @forelse($topRequesters as $index => $requester)
              <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $requester['name'] }}</td>
                <td>{{ $requester['email'] }}</td>
                <td>{{ $requester['role'] }}</td>
                <td>{{ $requester['total_requests'] }}</td>
              </tr>
            @empty
              <tr>
                <td colspan="5" class="text-center">Tidak ada data permintaan.</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<!-- end Card Table -->


<script>
document.addEventListener("DOMContentLoaded", function () {
  const ctx = document.getElementById('trafficChart').getContext('2d');

  const labels = @json($labels);
  const dataMasuk = @json($dataMasuk);
  const dataKeluar = @json($dataKeluar);

  const chart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: labels,
      datasets: [
        {
          label: 'Barang Keluar',
          data: dataKeluar,
          borderColor: 'rgba(255, 99, 132, 1)',
          backgroundColor: 'rgba(255, 99, 132, 0.2)',
          fill: true,
          tension: 0.4
        }
      ]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: { position: 'top' }
      },
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });

  window.updateChart = function (range) {
    fetch(`/admin/dashboard/data?range=${range}`)
      .then(response => response.json())
      .then(data => {
        chart.data.labels = data.labels;
        chart.data.datasets[0].data = data.masuk;
        chart.data.datasets[1].data = data.keluar;
        chart.update();
      });
  };
});
</script>


@endsection