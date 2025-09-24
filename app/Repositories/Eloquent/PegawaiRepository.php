<?php

namespace App\Repositories\Eloquent;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PegawaiRepository
{
    public function getUserRequestHistory(string $range = 'week')
    {
        switch ($range) {
            case 'week':
                $start = Carbon::now()->startOfWeek();
                break;
            case 'month':
                $start = Carbon::now()->startOfMonth();
                break;
            case 'year':
                $start = Carbon::now()->startOfYear();
                break;
            default:
                $start = Carbon::now()->startOfWeek();
                break;
        }

        $userId = Auth::id();

        $userRequests = DB::table('carts')
            ->join('cart_items', 'carts.id', '=', 'cart_items.cart_id')
            ->where('carts.user_id', $userId) // hanya pegawai yg login
            ->where('carts.created_at', '>=', $start)
            ->select(
                DB::raw('DATE(carts.created_at) as tanggal'),
                DB::raw('SUM(cart_items.quantity) as total_quantity')
            )
            ->groupBy('tanggal')
            ->orderBy('tanggal', 'asc')
            ->get();

        return [
            'labels' => $userRequests->pluck('tanggal'),
            'data'   => $userRequests->pluck('total_quantity'),
        ];
    }
}
