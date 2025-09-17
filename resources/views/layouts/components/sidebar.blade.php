<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo">
            <a href="index.html" class="app-brand-link">
              <span class="app-brand-logo demo me-1">
                <span class="text-primary">
                  
                </span>
              </span>
              <span class="app-brand-text demo menu-text fw-semibold ms-2">SIMBA</span>
            </a>
          </div>
          <div class="menu-inner-shadow"></div>
          <ul class="menu-inner py-1">
            <!-- Dashboards -->
            @if (auth()->user()->role === 'super_admin')
            <li class="menu-item {{ Route::is('super_admin.dashboard') ? 'active' : '' }}">
              <a href="{{route('super_admin.dashboard')}}" class="menu-link">
                <div data-i18n="Analytics">Dashboard</div>
              </a>
            </li>
            @endif
            @if (auth()->user()->role === 'admin')
            <li class="menu-item {{ Route::is('admin.dashboard') ? 'active' : '' }}">
              <a href="{{route('admin.dashboard')}}" class="menu-link">
                <div data-i18n="Analytics">Dashboard</div>
              </a>
            </li>
            @endif
            @if (auth()->user()->role === 'pegawai')
            <li class="menu-item {{ Route::is('pegawai.dashboard') ? 'active' : '' }}">
              <a href="{{route('pegawai.dashboard')}}" class="menu-link">
                <div data-i18n="Analytics">Dashboard</div>
              </a>
            </li>
            @endif
            <!-- Super Admin -->
            @if (auth()->user()->role === 'super_admin')
            <li class="menu-header mt-7">
              <span class="menu-header-text">Super Admin</span>
            </li>
            <li class="menu-item">
              <a href="{{route('super_admin.categories.index')}}" class="menu-link">
                <i class="menu-icon icon-base ri ri-stack-line"></i>
                <div data-i18n="Basic">Kategori</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="{{route('super_admin.units.index')}}" class="menu-link">
                <i class="menu-icon icon-base ri ri-price-tag-3-line"></i>
                <div data-i18n="Basic">Satuan Barang</div><div class=""></div>
              </a>
            </li>
            <li class="menu-item">
              <a href="{{route('super_admin.suppliers.index')}}" class="menu-link">
                <i class="menu-icon icon-base ri ri-briefcase-3-line"></i>
                <div data-i18n="Basic">Supplier</div><div class=""></div>
              </a>
            </li>
            <li class="menu-item">
              <a href="{{route('super_admin.items.index')}}" class="menu-link">
                <i class="menu-icon icon-base ri ri-box-3-line"></i>
                <div data-i18n="Basic">Barang</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="{{route('super_admin.item_ins.index')}}" class="menu-link">
                <i class="menu-icon icon-base ri ri-inbox-archive-line"></i>
                <div data-i18n="Basic">Barang Masuk</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="{{route('super_admin.users.index')}}" class="menu-link">
                <i class="menu-icon icon-base ri ri-group-line"></i>
                <div data-i18n="Basic">List Pegawai</div><div class=""></div>
              </a>
            </li>
            @endif
            @if (auth()->user()->role === 'admin')
            <!-- Admin -->
            <li class="menu-header mt-7"><span class="menu-header-text">Admin</span></li>
            <!-- Cards -->
            <li class="menu-item">
              <a href="cards-basic.html" class="menu-link">
                <i class="menu-icon icon-base ri ri-bank-card-2-line"></i>
                <div data-i18n="Basic">Cards</div>
              </a>
            </li>
            <!-- Cards -->
            <li class="menu-item">
              <a href="cards-basic.html" class="menu-link">
                <i class="menu-icon icon-base ri ri-bank-card-2-line"></i>
                <div data-i18n="Basic">Cards</div>
              </a>
            </li>
            <!-- Cards -->
            <li class="menu-item">
              <a href="cards-basic.html" class="menu-link">
                <i class="menu-icon icon-base ri ri-bank-card-2-line"></i>
                <div data-i18n="Basic">Cards</div>
              </a>
            </li>
            <!-- Cards -->
            <li class="menu-item">
              <a href="cards-basic.html" class="menu-link">
                <i class="menu-icon icon-base ri ri-bank-card-2-line"></i>
                <div data-i18n="Basic">Cards</div>
              </a>
            </li>
            @endif
            @if (auth()->user()->role === 'pegawai')
            <!-- Tamu -->
            <li class="menu-header mt-7"><span class="menu-header-text">Tamu</span></li>
            <!-- Cards -->
            <li class="menu-item">
              <a href="cards-basic.html" class="menu-link">
                <i class="menu-icon icon-base ri ri-bank-card-2-line"></i>
                <div data-i18n="Basic">Cards</div>
              </a>
            </li>
            <!-- Cards -->
            <li class="menu-item">
              <a href="cards-basic.html" class="menu-link">
                <i class="menu-icon icon-base ri ri-bank-card-2-line"></i>
                <div data-i18n="Basic">Cards</div>
              </a>
            </li><!-- Cards -->
            <li class="menu-item">
              <a href="cards-basic.html" class="menu-link">
                <i class="menu-icon icon-base ri ri-bank-card-2-line"></i>
                <div data-i18n="Basic">Cards</div>
              </a>
            </li>
            @endif
          </ul>
        </aside>