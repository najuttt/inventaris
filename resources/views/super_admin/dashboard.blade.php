@extends('layouts.components.super_admin.index')
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
                    <!-- Total Profit line chart -->
                    <div class="col-sm-6">
                      <div class="card h-100">
                        <div class="card-header pb-0">
                          <h4 class="mb-0">$86.4k</h4>
                        </div>
                        <div class="card-body">
                          <div id="totalProfitLineChart" class="mb-3"></div>
                          <h6 class="text-center mb-0">Total Profit</h6>
                        </div>
                      </div>
                    </div>
                    <!--/ Total Profit line chart -->
                    <!-- Total Profit Weekly Project -->
                    <div class="col-sm-6">
                      <div class="card h-100">
                        <div class="card-header d-flex align-items-center justify-content-between">
                          <div class="avatar">
                            <div class="avatar-initial bg-secondary rounded-circle shadow-xs">
                              <i class="icon-base ri ri-pie-chart-2-line icon-24px"></i>
                            </div>
                          </div>
                          <div class="dropdown">
                            <button
                              class="btn text-body-secondary p-0"
                              type="button"
                              id="totalProfitID"
                              data-bs-toggle="dropdown"
                              aria-haspopup="true"
                              aria-expanded="false">
                              <i class="icon-base ri ri-more-2-line icon-24px"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="totalProfitID">
                              <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                              <a class="dropdown-item" href="javascript:void(0);">Share</a>
                              <a class="dropdown-item" href="javascript:void(0);">Update</a>
                            </div>
                          </div>
                        </div>
                        <div class="card-body">
                          <h6 class="mb-1">Total Profit</h6>
                          <div class="d-flex flex-wrap mb-1 align-items-center">
                            <h4 class="mb-0 me-2">$25.6k</h4>
                            <p class="text-success mb-0">+42%</p>
                          </div>
                          <small>Weekly Project</small>
                        </div>
                      </div>
                    </div>
                    <!--/ Total Profit Weekly Project -->
                    <!-- New Yearly Project -->
                    <div class="col-sm-6">
                      <div class="card h-100">
                        <div class="card-header d-flex align-items-center justify-content-between">
                          <div class="avatar">
                            <div class="avatar-initial bg-primary rounded-circle shadow-xs">
                              <i class="icon-base ri ri-file-word-2-line icon-24px"></i>
                            </div>
                          </div>
                          <div class="dropdown">
                            <button
                              class="btn text-body-secondary p-0"
                              type="button"
                              id="newProjectID"
                              data-bs-toggle="dropdown"
                              aria-haspopup="true"
                              aria-expanded="false">
                              <i class="icon-base ri ri-more-2-line icon-24px"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="newProjectID">
                              <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                              <a class="dropdown-item" href="javascript:void(0);">Share</a>
                              <a class="dropdown-item" href="javascript:void(0);">Update</a>
                            </div>
                          </div>
                        </div>
                        <div class="card-body">
                          <h6 class="mb-1">New Project</h6>
                          <div class="d-flex flex-wrap mb-1 align-items-center">
                            <h4 class="mb-0 me-2">862</h4>
                            <p class="text-danger mb-0">-18%</p>
                          </div>
                          <small>Yearly Project</small>
                        </div>
                      </div>
                    </div>
                    <!--/ New Yearly Project -->
                    <!-- Sessions chart -->
                    <div class="col-sm-6">
                      <div class="card h-100">
                        <div class="card-header pb-0">
                          <h4 class="mb-0">2,856</h4>
                        </div>
                        <div class="card-body">
                          <div id="sessionsColumnChart" class="mb-3"></div>
                          <h6 class="text-center mb-0">Sessions</h6>
                        </div>
                      </div>
                    </div>
                    <!--/ Sessions chart -->
                  </div>
                </div>
                <!--/ four cards -->
                <!-- Deposit / Withdraw -->
                <div class="col-xl-8">
                  <div class="card-group">
                    <div class="card mb-0">
                      <div class="card-body card-separator">
                        <div class="d-flex justify-content-between align-items-center flex-wrap mb-4">
                          <h5 class="m-0 me-2">Deposit</h5>
                          <a class="fw-medium" href="javascript:void(0);">View all</a>
                        </div>
                        <div class="deposit-content pt-2">
                          <ul class="p-0 m-0">
                            <li class="d-flex mb-4 align-items-center pb-2">
                              <div class="flex-shrink-0 me-4">
                                <img
                                  src="{{asset('assets/img/icons/payments/gumroad.png')}}"
                                  class="img-fluid"
                                  alt="gumroad"
                                  height="30"
                                  width="30" />
                              </div>
                              <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                  <h6 class="mb-0">Gumroad Account</h6>
                                  <p class="mb-0">Sell UI Kit</p>
                                </div>
                                <h6 class="text-success mb-0">+$4,650</h6>
                              </div>
                            </li>
                            <li class="d-flex mb-4 align-items-center pb-2">
                              <div class="flex-shrink-0 me-4">
                                <img
                                  src="{{asset('assets/img/icons/payments/mastercard-2.png')}}"
                                  class="img-fluid"
                                  alt="mastercard"
                                  height="30"
                                  width="30" />
                              </div>
                              <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                  <h6 class="mb-0">Mastercard</h6>
                                  <p class="mb-0">Wallet deposit</p>
                                </div>
                                <h6 class="text-success mb-0">+$92,705</h6>
                              </div>
                            </li>
                            <li class="d-flex mb-4 align-items-center pb-2">
                              <div class="flex-shrink-0 me-4">
                                <img
                                  src="{{asset('assets/img/icons/payments/stripes.png')}}"
                                  class="img-fluid"
                                  alt="stripes"
                                  height="30"
                                  width="30" />
                              </div>
                              <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                  <h6 class="mb-0">Stripe Account</h6>
                                  <p class="mb-0">iOS Application</p>
                                </div>
                                <h6 class="text-success mb-0">+$957</h6>
                              </div>
                            </li>
                            <li class="d-flex mb-4 align-items-center pb-2">
                              <div class="flex-shrink-0 me-4">
                                <img
                                  src="{{asset('assets/img/icons/payments/american-bank.png')}}"
                                  class="img-fluid"
                                  alt="american"
                                  height="30"
                                  width="30" />
                              </div>
                              <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                  <h6 class="mb-0">American Bank</h6>
                                  <p class="mb-0">Bank Transfer</p>
                                </div>
                                <h6 class="text-success mb-0">+$6,837</h6>
                              </div>
                            </li>
                            <li class="d-flex align-items-center">
                              <div class="flex-shrink-0 me-4">
                                <img
                                  src="{{asset('assets/img/icons/payments/citi.png')}}"
                                  class="img-fluid"
                                  alt="citi"
                                  height="30"
                                  width="30" />
                              </div>
                              <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                  <h6 class="mb-0">Bank Account</h6>
                                  <p class="mb-0">Wallet deposit</p>
                                </div>
                                <h6 class="text-success mb-0">+$446</h6>
                              </div>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>
                    <div class="card mb-0">
                      <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center flex-wrap mb-4">
                          <h5 class="m-0 me-2">Withdraw</h5>
                          <a class="fw-medium" href="javascript:void(0);">View all</a>
                        </div>
                        <div class="withdraw-content pt-2">
                          <ul class="p-0 m-0">
                            <li class="d-flex mb-4 align-items-center pb-2">
                              <div class="flex-shrink-0 me-4">
                                <img
                                  src="{{asset('assets/img/icons/brands/google.png')}}"
                                  class="img-fluid"
                                  alt="google"
                                  height="30"
                                  width="30" />
                              </div>
                              <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                  <h6 class="mb-0">Google Adsense</h6>
                                  <p class="mb-0">Paypal deposit</p>
                                </div>
                                <h6 class="text-danger mb-0">-$145</h6>
                              </div>
                            </li>
                            <li class="d-flex mb-4 align-items-center pb-2">
                              <div class="flex-shrink-0 me-4">
                                <img
                                  src="{{asset('assets/img/icons/brands/github.png')}}"
                                  class="img-fluid"
                                  alt="github"
                                  height="30"
                                  width="30" />
                              </div>
                              <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                  <h6 class="mb-0">Github Enterprise</h6>
                                  <p class="mb-0">Security &amp; compliance</p>
                                </div>
                                <h6 class="text-danger mb-0">-$1870</h6>
                              </div>
                            </li>
                            <li class="d-flex mb-4 align-items-center pb-2">
                              <div class="flex-shrink-0 me-4">
                                <img
                                  src="{{asset('assets/img/icons/brands/slack.png')}}"
                                  class="img-fluid"
                                  alt="slack"
                                  height="30"
                                  width="30" />
                              </div>
                              <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                  <h6 class="mb-0">Upgrade Slack Plan</h6>
                                  <p class="mb-0">Debit card deposit</p>
                                </div>
                                <h6 class="text-danger mb-0">$450</h6>
                              </div>
                            </li>
                            <li class="d-flex mb-4 align-items-center pb-2">
                              <div class="flex-shrink-0 me-4">
                                <img
                                  src="{{asset('assets/img/icons/payments/digital-ocean.png')}}"
                                  class="img-fluid"
                                  alt="digital"
                                  height="30"
                                  width="30" />
                              </div>
                              <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                  <h6 class="mb-0">Digital Ocean</h6>
                                  <p class="mb-0">Cloud Hosting</p>
                                </div>
                                <h6 class="text-danger mb-0">-$540</h6>
                              </div>
                            </li>
                            <li class="d-flex align-items-center">
                              <div class="flex-shrink-0 me-4">
                                <img
                                  src="{{asset('assets/img/icons/brands/aws.png')}}"
                                  class="img-fluid"
                                  alt="aws"
                                  height="30"
                                  width="30" />
                              </div>
                              <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                  <h6 class="mb-0">AWS Account</h6>
                                  <p class="mb-0">Choosing a Cloud Platform</p>
                                </div>
                                <h6 class="text-danger mb-0">-$21</h6>
                              </div>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Deposit / Withdraw -->

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