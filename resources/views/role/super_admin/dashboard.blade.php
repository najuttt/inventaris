@extends('layouts.index')
@section('content')
<div class="row gy-6">
                <!-- Weekly Overview Chart -->
                <div class="col-xl-12 col-md-6">
                  <div class="card">
                    <div class="card-header">
                      <div class="d-flex justify-content-between">
                        <h5 class="mb-1">Weekly Overview</h5>
                        <div class="dropdown">
                          <button
                            class="btn text-body-secondary p-0"
                            type="button"
                            id="weeklyOverviewDropdown"
                            data-bs-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false">
                            <i class="icon-base ri ri-more-2-line icon-24px"></i>
                          </button>
                          <div class="dropdown-menu dropdown-menu-end" aria-labelledby="weeklyOverviewDropdown">
                            <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                            <a class="dropdown-item" href="javascript:void(0);">Share</a>
                            <a class="dropdown-item" href="javascript:void(0);">Update</a>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="card-body pt-lg-2">
                      <div id="weeklyOverviewChart"></div>
                      <div class="mt-1 mt-md-3">
                        <div class="d-flex align-items-center gap-4">
                          <h4 class="mb-0">45%</h4>
                          <p class="mb-0">Your sales performance is 45% 😎 better compared to last month</p>
                        </div>
                        <div class="d-grid mt-3 mt-md-4">
                          <button class="btn btn-primary" type="button">Details</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!--/ Weekly Overview Chart -->
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
                          <h6 class="mb-1">Categories</h6>
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
                          <h6 class="mb-1">Suppliers</h6>
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
                          <h6 class="mb-1">Users</h6>
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
                <!-- Barang Masuk / Barang Keluar -->
                <div class="col-xl-8">
                  <div class="card-group">
                    {{-- Barang Masuk --}}
                    <div class="card mb-0">
                      <div class="card-body card-separator">
                        <div class="d-flex justify-content-between align-items-center flex-wrap mb-4">
                          <h5 class="m-0 me-2">History Barang Masuk</h5>
                          <a class="fw-medium" href="{{ route('super_admin.item_ins.index') }}">View all</a>
                          <a href="{{ route('super_admin.export.barang_masuk.excel') }}" class="btn btn-success btn-sm">Excel</a>
                          <a href="{{ route('super_admin.export.barang_masuk.pdf') }}" class="btn btn-danger btn-sm">PDF</a>
                        </div>
                        <div class="deposit-content pt-2">
                          <ul class="p-0 m-0">
                            @forelse($itemIns as $item)
                              <li class="d-flex mb-4 align-items-center pb-2">
                                <div class="flex-shrink-0 me-4">
                                  <img
                                    src="{{ asset('assets/img/icons/payments/stripes.png') }}"
                                    class="img-fluid"
                                    alt="barang"
                                    height="30"
                                    width="30" />
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                  <div class="me-2">
                                    <h6 class="mb-0">{{ $item->item->name }}</h6>
                                    <p class="mb-0">Jumlah: {{ $item->quantity }}</p>
                                  </div>
                                  <h6 class="text-success mb-0">+{{ $item->quantity }}</h6>
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
                          <a href="{{ route('super_admin.export.barang_keluar.excel') }}" class="btn btn-success btn-sm">Excel</a>
                          <a href="{{ route('super_admin.export.barang_keluar.pdf') }}" class="btn btn-danger btn-sm">PDF</a>
                        </div>
                        <div class="withdraw-content pt-2">
                          <ul class="p-0 m-0">
                              <li class="d-flex mb-4 align-items-center pb-2">
                                <div class="flex-shrink-0 me-4">
                                  <img
                                    src="{{ asset('assets/img/icons/payments/digital-ocean.png') }}"
                                    class="img-fluid"
                                    alt="barang"
                                    height="30"
                                    width="30" />
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                  <div class="me-2">
                                    <h6 class="mb-0"></h6>
                                    <p class="mb-0">Jumlah:</p>
                                  </div>
                                  <h6 class="text-danger mb-0">-</h6>
                                </div>
                              </li>
                              <li class="d-flex align-items-center">
                                <p class="mb-0 text-muted">Belum ada data barang keluar</p>
                              </li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Barang Masuk / Barang Keluar -->

                <!-- Data Tables -->
                <div class="col-12">
                  <div class="card overflow-hidden">
                    <div class="table-responsive">
                      <table class="table table-sm">
                        <thead>
                          <tr>
                            <th class="text-truncate">User</th>
                            <th class="text-truncate">Email</th>
                            <th class="text-truncate">Role</th>
                            <th class="text-truncate">Status</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>
                              <div class="d-flex align-items-center">
                                <div class="avatar avatar-sm me-4">
                                  <img src="{{asset('assets/img/avatars/1.png')}}" alt="Avatar" class="rounded-circle" />
                                </div>
                                <div>
                                  <h6 class="mb-0 text-truncate">Jordan Stevenson</h6>
                                  <small class="text-truncate">@amiccoo</small>
                                </div>
                              </div>
                            </td>
                            <td class="text-truncate">susanna.Lind57@gmail.com</td>
                            <td class="text-truncate">
                              <div class="d-flex align-items-center">
                                <i class="icon-base ri ri-vip-crown-line icon-22px text-primary me-2"></i>
                                <span>Admin</span>
                              </div>
                            </td>
                            <td><span class="badge bg-label-warning rounded-pill">Pending</span></td>
                          </tr>
                          <tr>
                            <td>
                              <div class="d-flex align-items-center">
                                <div class="avatar avatar-sm me-4">
                                  <img src="{{asset('assets/img/avatars/3.png')}}" alt="Avatar" class="rounded-circle" />
                                </div>
                                <div>
                                  <h6 class="mb-0 text-truncate">Benedetto Rossiter</h6>
                                  <small class="text-truncate">@brossiter15</small>
                                </div>
                              </div>
                            </td>
                            <td class="text-truncate">estelle.Bailey10@gmail.com</td>
                            <td class="text-truncate">
                              <div class="d-flex align-items-center">
                                <i class="icon-base ri ri-edit-box-line text-warning icon-22px me-2"></i>
                                <span>Editor</span>
                              </div>
                            </td>
                            <td><span class="badge bg-label-success rounded-pill">Active</span></td>
                          </tr>
                          <tr>
                            <td>
                              <div class="d-flex align-items-center">
                                <div class="avatar avatar-sm me-4">
                                  <img src="{{asset('assets/img/avatars/2.png')}}" alt="Avatar" class="rounded-circle" />
                                </div>
                                <div>
                                  <h6 class="mb-0 text-truncate">Bentlee Emblin</h6>
                                  <small class="text-truncate">@bemblinf</small>
                                </div>
                              </div>
                            </td>
                            <td class="text-truncate">milo86@hotmail.com</td>
                            <td class="text-truncate">
                              <div class="d-flex align-items-center">
                                <i class="icon-base ri ri-computer-line text-danger icon-22px me-2"></i>
                                <span>Author</span>
                              </div>
                            </td>
                            <td><span class="badge bg-label-success rounded-pill">Active</span></td>
                          </tr>
                          <tr>
                            <td>
                              <div class="d-flex align-items-center">
                                <div class="avatar avatar-sm me-4">
                                  <img src="{{asset('assets/img/avatars/5.png')}}" alt="Avatar" class="rounded-circle" />
                                </div>
                                <div>
                                  <h6 class="mb-0 text-truncate">Bertha Biner</h6>
                                  <small class="text-truncate">@bbinerh</small>
                                </div>
                              </div>
                            </td>
                            <td class="text-truncate">lonnie35@hotmail.com</td>
                            <td class="text-truncate">
                              <div class="d-flex align-items-center">
                                <i class="icon-base ri ri-edit-box-line text-warning icon-22px me-2"></i>
                                <span>Editor</span>
                              </div>
                            </td>
                            <td><span class="badge bg-label-warning rounded-pill">Pending</span></td>
                          </tr>
                          <tr>
                            <td>
                              <div class="d-flex align-items-center">
                                <div class="avatar avatar-sm me-4">
                                  <img src="{{asset('assets/img/avatars/4.png')}}" alt="Avatar" class="rounded-circle" />
                                </div>
                                <div>
                                  <h6 class="mb-0 text-truncate">Beverlie Krabbe</h6>
                                  <small class="text-truncate">@bkrabbe1d</small>
                                </div>
                              </div>
                            </td>
                            <td class="text-truncate">ahmad_Collins@yahoo.com</td>
                            <td class="text-truncate">
                              <div class="d-flex align-items-center">
                                <i class="icon-base ri ri-pie-chart-2-line icon-22px text-info me-2"></i>
                                <span>Maintainer</span>
                              </div>
                            </td>
                            <td><span class="badge bg-label-success rounded-pill">Active</span></td>
                          </tr>
                          <tr>
                            <td>
                              <div class="d-flex align-items-center">
                                <div class="avatar avatar-sm me-4">
                                  <img src="{{asset('assets/img/avatars/7.png')}}" alt="Avatar" class="rounded-circle" />
                                </div>
                                <div>
                                  <h6 class="mb-0 text-truncate">Bradan Rosebotham</h6>
                                  <small class="text-truncate">@brosebothamz</small>
                                </div>
                              </div>
                            </td>
                            <td class="text-truncate">tillman.Gleason68@hotmail.com</td>
                            <td class="text-truncate">
                              <div class="d-flex align-items-center">
                                <i class="icon-base ri ri-edit-box-line text-warning icon-22px me-2"></i>
                                <span>Editor</span>
                              </div>
                            </td>
                            <td><span class="badge bg-label-warning rounded-pill">Pending</span></td>
                          </tr>
                          <tr>
                            <td>
                              <div class="d-flex align-items-center">
                                <div class="avatar avatar-sm me-4">
                                  <img src="{{asset('assets/img/avatars/6.png')}}" alt="Avatar" class="rounded-circle" />
                                </div>
                                <div>
                                  <h6 class="mb-0 text-truncate">Bree Kilday</h6>
                                  <small class="text-truncate">@bkildayr</small>
                                </div>
                              </div>
                            </td>
                            <td class="text-truncate">otho21@gmail.com</td>
                            <td class="text-truncate">
                              <div class="d-flex align-items-center">
                                <i class="icon-base ri ri-user-3-line icon-22px text-success me-2"></i>
                                <span>Subscriber</span>
                              </div>
                            </td>
                            <td><span class="badge bg-label-success rounded-pill">Active</span></td>
                          </tr>
                          <tr class="border-transparent">
                            <td>
                              <div class="d-flex align-items-center">
                                <div class="avatar avatar-sm me-4">
                                  <img src="{{asset('assets/img/avatars/1.png')}}" alt="Avatar" class="rounded-circle" />
                                </div>
                                <div>
                                  <h6 class="mb-0 text-truncate">Breena Gallemore</h6>
                                  <small class="text-truncate">@bgallemore6</small>
                                </div>
                              </div>
                            </td>
                            <td class="text-truncate">florencio.Little@hotmail.com</td>
                            <td class="text-truncate">
                              <div class="d-flex align-items-center">
                                <i class="icon-base ri ri-user-3-line icon-22px text-success me-2"></i>
                                <span>Subscriber</span>
                              </div>
                            </td>
                            <td><span class="badge bg-label-secondary rounded-pill">Inactive</span></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                <!--/ Data Tables -->
              </div>
@endsection