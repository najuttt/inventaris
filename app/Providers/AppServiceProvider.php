<?php

namespace App\Providers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Item_out;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Milon\Barcode\Facades\DNS1DFacade as DNS1D;
use Milon\Barcode\Facades\DNS2DFacade as DNS2D;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Contracts\AdminRepositoryInterface;
use App\Repositories\Eloquent\AdminRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->alias(DNS1D::class, 'DNS1D');
        $this->app->alias(DNS2D::class, 'DNS2D');
        $this->app->bind(AdminRepositoryInterface::class, AdminRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $cartsitems = null;
            $notifications = collect();

            if (Auth::check()) {
                // Ambil keranjang aktif user
                $carts = Cart::where('user_id', Auth::id())
                    ->where('status', 'active')
                    ->with('cartItems.item')
                    ->first();

                if ($carts) {
                    $cartsitems = $carts;
                }

                // Notifikasi hanya untuk role pegawai
                if (Auth::user()->role === 'pegawai') {
                    $notifications = Item_out::with(['item', 'approver'])
                        ->whereHas('cart', fn($q) => $q->where('user_id', Auth::id()))
                        ->whereNotNull('approved_by')
                        ->latest()
                        ->take(5)
                        ->get();
                }
            }

            // Share ke semua view
            $view->with(compact('cartsitems', 'notifications'));
        });
    }
}
