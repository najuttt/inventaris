@extends('layouts.index')
@section('content')
<div class="row gy-6">
               <!-- Weekly Overview Chart -->
                  <div class="col-xl-8 col-md-6">
                    <div class="card">
                      <div class="card-header d-flex justify-content-between">
                        <h5>Weekly Overview</h5>
                        <form method="GET" action="">
                          <select name="period" onchange="this.form.submit()" class="form-select form-select-sm" style="width:150px;">
                            <option value="weekly" {{ $period == 'weekly' ? 'selected' : '' }}>1 Minggu</option>
                            <option value="monthly" {{ $period == 'monthly' ? 'selected' : '' }}>1 Bulan</option>
                            <option value="yearly" {{ $period == 'yearly' ? 'selected' : '' }}>1 Tahun</option>
                          </select>
                        </form>
                      </div>
                      <div class="card-body">
                        <canvas id="weeklyChart" height="100"></canvas>
                      </div>
                    </div>
                  </div>

                  <script>
                    const ctx = document.getElementById('weeklyChart').getContext('2d');
                    new Chart(ctx, {
                      type: 'line',
                      data: {
                        labels: {!! json_encode($chartData['labels']) !!},
                        datasets: [
                          {
                            label: 'Barang Masuk',
                            data: {!! json_encode($chartData['itemIns']) !!},
                            borderColor: 'blue',
                            backgroundColor: 'rgba(0, 0, 255, 0.1)',
                            pointBackgroundColor: 'blue',
                            pointBorderColor: 'blue',
                            tension: 0.4,   // garis melengkung
                            fill: true      // area di bawah garis terisi
                          },
                          {
                            label: 'Barang Keluar',
                            data: {!! json_encode($chartData['itemOuts']) !!},
                            borderColor: 'red',
                            backgroundColor: 'rgba(255, 0, 0, 0.1)',
                            pointBackgroundColor: 'red',
                            pointBorderColor: 'red',
                            tension: 0.4,
                            fill: true
                          }
                        ]
                      },
                      options: {
                        responsive: true,
                        interaction: { mode: 'index', intersect: false },
                        plugins: {
                          legend: {
                            position: 'bottom'
                          },
                          title: {
                            display: true,
                            text: 'Perbandingan Barang Masuk & Keluar'
                          }
                        },
                        scales: {
                          x: {
                            grid: { display: false }
                          },
                          y: {
                            beginAtZero: true,
                            grid: { color: '#eee' }
                          }
                        }
                      }
                    });
                  </script>




                <!-- Four Cards -->
                <div class="col-xl-4 col-md-6">
                  <div class="row gy-6">

                    <!-- Total Categories -->
                    <div class="col-sm-6">
                      <div class="card h-100">
                        <div class="card-header d-flex align-items-center justify-content-between">
                          <div class="avatar">
                            <div class="avatar-initial bg-info rounded-circle shadow-xs">
                              <i class="icon-base ri ri-folder-2-line icon-24px"></i>
                            </div>
                          </div>
                        </div>
                        <div class="card-body">
                          <h6 class="mb-1">Kategori</h6>
                          <div class="d-flex flex-wrap mb-1 align-items-center">
                            <h4 class="mb-0 me-2">{{ $categories }}</h4>
                            <p class="{{ $categories >= 0 ? 'text-success' : 'text-danger' }} mb-0">
                              {{ $categories >= 0 ? '+' : '' }}{{ $categories }}%
                            </p>
                          </div>
                          <small>Total Categories</small>
                        </div>
                      </div>
                    </div>
                    <!--/ Total Categories -->

                    <!-- Total item -->
                    <div class="col-sm-6">
                      <div class="card h-100">
                        <div class="card-header d-flex align-items-center justify-content-between">
                          <div class="avatar">
                            <div class="avatar-initial bg-secondary rounded-circle shadow-xs">
                              <i class="icon-base ri ri-pie-chart-2-line icon-24px"></i>
                            </div>
                          </div>
                        </div>
                        <div class="card-body">
                          <h6 class="mb-1">Barang</h6>
                          <div class="d-flex flex-wrap mb-1 align-items-center">
                            <h4 class="mb-0 me-2">{{ $item }}</h4>
                            <p class="{{ $item >= 0 ? 'text-success' : 'text-danger' }} mb-0">
                              {{ $item >= 0 ? '+' : '' }}{{ $item }}%
                            </p>
                          </div>
                          <small>Total Barang</small>
                        </div>
                      </div>
                    </div>
                    <!--/ Total item -->

                    <!-- Total Suppliers -->
                    <div class="col-sm-6">
                      <div class="card h-100">
                        <div class="card-header d-flex align-items-center justify-content-between">
                          <div class="avatar">
                            <div class="avatar-initial bg-primary rounded-circle shadow-xs">
                              <i class="icon-base ri ri-truck-line icon-24px"></i>
                            </div>
                          </div>
                        </div>
                        <div class="card-body">
                          <h6 class="mb-1">Supplier</h6>
                          <div class="d-flex flex-wrap mb-1 align-items-center">
                            <h4 class="mb-0 me-2">{{ $suppliers }}</h4>
                            <p class="{{ $suppliers >= 0 ? 'text-success' : 'text-danger' }} mb-0">
                              {{ $suppliers >= 0 ? '+' : '' }}{{ $suppliers }}%
                            </p>
                          </div>
                          <small>Total Suppliers</small>
                        </div>
                      </div>
                    </div>
                    <!--/ Total Suppliers -->

                    <!-- Total Users -->
                    <div class="col-sm-6">
                      <div class="card h-100">
                        <div class="card-header d-flex align-items-center justify-content-between">
                          <div class="avatar">
                            <div class="avatar-initial bg-warning rounded-circle shadow-xs">
                              <i class="icon-base ri ri-user-3-line icon-24px"></i>
                            </div>
                          </div>
                        </div>
                        <div class="card-body">
                          <h6 class="mb-1">User</h6>
                          <div class="d-flex flex-wrap mb-1 align-items-center">
                            <h4 class="mb-0 me-2">{{ $users }}</h4>
                            <p class="{{ $users >= 0 ? 'text-success' : 'text-danger' }} mb-0">
                              {{ $users >= 0 ? '+' : '' }}{{ $users }}%
                            </p>
                          </div>
                          <small>Total Users</small>
                        </div>
                      </div>
                    </div>
                    <!--/ Total Users -->
                  </div>
                </div>
                <!--/ four cards -->

                <!-- Barang Masuk / Barang Keluar / Expired -->
                <div class="col-xl-12">
                  <div class="card-group">

                    {{-- Barang Masuk --}}
                    <div class="card mb-0">
                      <div class="card-body card-separator">
                        <div class="d-flex justify-content-between align-items-center flex-wrap mb-4">
                          <h5 class="m-0 me-2">History Barang Masuk</h5>
                          <a class="fw-medium" href="{{ route('super_admin.item_ins.index') }}">View all</a>
                        </div>
                        <div class="deposit-content pt-2">
                          <ul class="p-0 m-0">
                            @forelse($itemIns as $item)
                              <li class="d-flex mb-4 align-items-center pb-2">
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                  <div class="me-2">
                                    <h6 class="mb-0">{{ $item->item->name }}</h6>
                                    <p class="mb-0">Jumlah: {{ $item->quantity }}</p>
                                  </div>
                                </div>
                              </li>
                            @empty
                              <li class="d-flex align-items-center">
                                <p class="mb-0 text-muted">Belum ada data barang masuk</p>
                              </li>
                            @endforelse
                          </ul>
                        </div>
                      </div>
                    </div>

                    {{-- Barang Keluar --}}
                    <div class="card mb-0">
                      <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center flex-wrap mb-4">
                          <h5 class="m-0 me-2">History Barang Keluar</h5>
                          <a class="fw-medium" href="">View all</a>
                        </div>
                        <div class="withdraw-content pt-2">
                          <ul class="p-0 m-0">
                            @forelse($itemOuts as $item)
                              <li class="d-flex mb-4 align-items-center pb-2">
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                  <div class="me-2">
                                    <h6 class="mb-0">{{ $item->item->name }}</h6>
                                    <p class="mb-0">Jumlah: {{ $item->quantity }}</p>
                                  </div>
                                  <h6 class="text-danger mb-0">-{{ $item->quantity }}</h6>
                                </div>
                              </li>
                            @empty
                              <li class="d-flex align-items-center">
                                <p class="mb-0 text-muted">Belum ada data barang keluar</p>
                              </li>
                            @endforelse
                          </ul>
                        </div>
                      </div>
                    </div>


                    {{-- Barang Mau Expired --}}
                    <div class="card mb-0">
                      <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center flex-wrap mb-4">
                          <h5 class="m-0 me-2">Barang Hampir Expired</h5>
                          <a class="fw-medium" href="{{ route('super_admin.item_ins.index') }}">View all</a>
                        </div>
                        <div class="expired-content pt-2">
                          <ul class="p-0 m-0">
                            @forelse($expiredSoon as $item)
                              <li class="d-flex mb-4 align-items-center pb-2 border-bottom">
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                  <div class="me-2">
                                    <h6 class="mb-0">{{ $item->item->name }}</h6>
                                    <p class="mb-0">
                                      Jumlah: <strong>{{ $item->quantity }}</strong> <br>
                                      Expired:
                                      <span class="badge bg-warning text-dark px-2 py-1">
                                        {{ $item->expired_at->format('d M Y') }}
                                      </span>
                                      @php
                                          $days = now()->startOfDay()->diffInDays($item->expired_at->startOfDay(), false);
                                      @endphp

                                      @if($days < 0)
                                          <span class="badge bg-danger">
                                              Sudah expired {{ abs($days) }} hari lalu
                                          </span>
                                      @else($days <= 30)
                                          <span class="badge bg-warning text-dark">
                                              Hampir expired ({{ $days }} hari lagi)
                                          </span>
                                      @endif
                                    </p>
                                  </div>
                                </div>
                              </li>
                            @empty
                              <li class="d-flex align-items-center">
                                <p class="mb-0 text-muted">Tidak ada barang yang hampir expired</p>
                              </li>
                            @endforelse
                          </ul>
                        </div>
                      </div>
                    </div>

                  </div>
                </div>
                <!-- /Barang Masuk / Barang Keluar / Expired -->

                {{-- Export --}}
                <!-- resources/views/export/index.blade.php -->
                <div class="card shadow p-4">
                    <h5 class="mb-3">Export Data</h5>
                    <form id="exportForm" method="GET" action="">
                        <div class="row g-3">
                            <!-- Jenis Data -->
                            <div class="col-md-4">
                                <label class="form-label">Jenis Data</label>
                                <select class="form-select" name="type" id="type" required>
                                    <option value="" disabled selected>Pilih Jenis</option>
                                    <option value="barang_masuk">Barang Masuk</option>
                                    <option value="barang_keluar">Barang Keluar</option>
                                </select>
                            </div>

                            <!-- Periode -->
                            <div class="col-md-4">
                                <label class="form-label">Periode</label>
                                <select class="form-select" name="period" id="period" required>
                                    <option value="" disabled selected>Pilih Periode</option>
                                    <option value="weekly">Minggu</option>
                                    <option value="monthly">Bulan</option>
                                    <option value="yearly">Tahun</option>
                                </select>
                            </div>

                            <!-- Format -->
                            <div class="col-md-4">
                                <label class="form-label">Format</label>
                                <select class="form-select" name="format" id="format" required>
                                    <option value="" disabled selected>Pilih Format</option>
                                    <option value="pdf">PDF</option>
                                    <option value="excel">Excel</option>
                                </select>
                            </div>
                        </div>

                        <div class="mt-4 text-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-download"></i> Export
                            </button>
                        </div>
                    </form>
                </div>

                <script>
                    document.getElementById('exportForm').addEventListener('submit', function(e) {
                        e.preventDefault();

                        let type = document.getElementById('type').value;
                        let period = document.getElementById('period').value;
                        let format = document.getElementById('format').value;

                        if (!type || !period || !format) {
                            alert("Silakan pilih semua opsi!");
                            return;
                        }

                        let route = "";

                        if (type === "barang_masuk" && format === "pdf") {
                            route = "{{ route('super_admin.export.barang_masuk.pdf') }}";
                        } else if (type === "barang_masuk" && format === "excel") {
                            route = "{{ route('super_admin.export.barang_masuk.excel') }}";
                        } else if (type === "barang_keluar" && format === "pdf") {
                            route = "{{ route('super_admin.export.barang_keluar.pdf') }}";
                        } else if (type === "barang_keluar" && format === "excel") {
                            route = "{{ route('super_admin.export.barang_keluar.excel') }}";
                        }

                        // Tambahkan query ?period=
                        window.location.href = route + "?period=" + period;
                    });
                </script>
                {{-- End Export --}}

                <!-- Data Tables -->
                <div class="col-12">
                  <div class="card overflow-hidden">
                    <div class="table-responsive">
                      <table class="table table-sm">
                        <thead>
                          <tr>
                            <th class="text-truncate">No</th>
                            <th class="text-truncate">User</th>
                            <th class="text-truncate">Email</th>
                            <th class="text-truncate">Role</th>
                            <th class="text-truncate">Status</th>
                          </tr>
                        </thead>
                         <tbody>
                            @foreach($topRequesters as $req)
                            <tr>
                              <td>{{ $loop->iteration }}</td>
                              <td>{{ $req->requester }}</td>
                              <td>{{ $req->contact }}</td>
                              <td><span class="badge bg-info">{{ $req->type }}</span></td>
                              <td><span class="badge bg-primary">{{ $req->total_requests }}</span></td>
                            </tr>
                            @endforeach
                          </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                <!--/ Data Tables -->
</div>
@endsection