@auth
  @if(Auth::user()->role === "pegawai")
    <!-- Offcanvas Cart -->
    <div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="offcanvasCart" aria-labelledby="My Cart">
      <div class="offcanvas-header justify-content-center">
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <div class="order-md-last">
          <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-primary">Keranjang</span>
            @if($cartsitems)
              <span class="badge bg-primary rounded-pill">{{ $cartsitems->cartItems->count() }}</span>
            @else
              <span class="badge bg-primary rounded-pill">0</span>
            @endif
          </h4>
          <ul class="list-group mb-3">
            @if($cartsitems)
              @foreach($cartsitems->cartItems as $item)
                <li class="list-group-item d-flex justify-content-between lh-sm">
                  <div>
                    <h6 class="my-0">{{ $item->item->name }}</h6>
                    <small class="text-body-secondary">{{ $item->quantity }}x</small>
                  </div>
                </li>
              @endforeach
            @else
              <li class="list-group-item text-center py-3">
                <p class="mb-0">Keranjang Anda kosong</p>
              </li>
            @endif
          </ul>

          @if($cartsitems)
            <a href="{{ route('pegawai.cart.index') }}" class="w-100 btn btn-primary btn-lg">
              Lihat Detail Pesanan
            </a>
          @else
            <a href="{{ route('pegawai.produk') }}" class="w-100 btn btn-outline-primary btn-lg">
              Lanjutkan Belanja
            </a>
          @endif
        </div>
      </div>
    </div>
  @endif
@endauth

<nav
  class="layout-navbar container-xxl navbar-detached navbar navbar-expand-xl align-items-center bg-navbar-theme"
  id="layout-navbar">
  <div class="layout-menu-toggle navbar-nav align-items-xl-center me-4 me-xl-0 d-xl-none">
    <a class="nav-item nav-link px-0 me-xl-6" href="javascript:void(0)">
      <i class="icon-base ri ri-menu-line icon-md"></i>
    </a>
  </div>

  <div class="navbar-nav-right d-flex align-items-center justify-content-end" id="navbar-collapse">
    <!-- Search -->
    <div class="navbar-nav align-items-center">
      <div class="nav-item d-flex align-items-center">
        <i class="icon-base ri ri-search-line icon-lg lh-0"></i>
        <input
          type="text"
          class="form-control border-0 shadow-none"
          placeholder="Search..."
          aria-label="Search..." />
      </div>
    </div>
    <!-- /Search -->

    <ul class="navbar-nav flex-row align-items-center ms-md-auto">
      
      @auth
        @if(Auth::user()->role === "pegawai")
          <!-- Cart Icon -->
          <li class="nav-item me-3 mt-4">
            <a class="nav-link position-relative" data-bs-toggle="offcanvas" href="#offcanvasCart" role="button"
              aria-controls="offcanvasCart">
              <i class="ri ri-shopping-cart-2-line icon-lg"></i>
              @if($cartsitems && $cartsitems->cartItems->count() > 0)
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                  {{ $cartsitems->cartItems->count() }}
                </span>
              @endif
            </a>
          </li>

          <!-- Notification Icon -->
          <li class="nav-item me-5 dropdown mt-4">
            <a class="nav-link position-relative" href="#" id="notifDropdown" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="ri ri-notification-3-line icon-lg"></i>
              @if($notifications->count() > 0)
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                  {{ $notifications->count() }}
                </span>
              @endif
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="notifDropdown">
              @forelse($notifications as $notif)
                <li>
                  <a class="dropdown-item" href="#">
                    {{ $notif->item->name ?? 'Barang' }} disetujui oleh {{ $notif->approver->name ?? 'Admin' }}
                  </a>
                </li>
              @empty
                <li><span class="dropdown-item-text text-muted">Tidak ada notifikasi</span></li>
              @endforelse
            </ul>
          </li>
        @endif
      @endauth

      <!-- User -->
      <li class="nav-item navbar-dropdown dropdown-user dropdown">
        <a
          class="nav-link dropdown-toggle hide-arrow p-0"
          href="javascript:void(0);"
          data-bs-toggle="dropdown">
          <div class="avatar avatar-online">
            <img src="{{ asset('assets/img/avatars/1.png') }}" alt="alt" class="rounded-circle" />
          </div>
        </a>
        <ul class="dropdown-menu dropdown-menu-end">
          <li>
            <a class="dropdown-item" href="{{ route('profile.edit') }}">
              <div class="d-flex">
                <div class="flex-shrink-0 me-3">
                  <div class="avatar avatar-online">
                    <img src="{{ asset('assets/img/avatars/1.png') }}" 
                        alt="alt" 
                        class="w-px-40 h-auto rounded-circle" />
                  </div>
                </div>
                <div class="flex-grow-1">
                  <h6 class="mb-0">{{ Auth::user()->name }}</h6>
                  <small class="text-body-secondary">{{ Auth::user()->email }}</small>
                </div>
              </div>
            </a>
          </li>
          <li><hr class="dropdown-divider"></li>
          <li>
            <a class="dropdown-item" href="{{ route('logout') }}"
              onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
              @csrf
            </form>
          </li>
        </ul>
      </li>
    </ul>
  </div>
</nav>
