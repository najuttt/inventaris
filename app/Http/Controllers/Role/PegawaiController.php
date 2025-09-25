<?php

namespace App\Http\Controllers\Role;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Item_out;

class PegawaiController extends Controller
{
    /**
     * Dashboard Pegawai
     */
    public function index(Request $request)
    {
        $userId = Auth::id();
        $period = $request->get('period', 'weekly'); // default weekly

        $query = Item_out::whereHas('cart', fn($q) => $q->where('user_id', $userId))
            ->whereNotNull('approved_by'); // hanya barang keluar approved

        switch ($period) {
            case 'daily':
                $barangKeluar = $query
                    ->selectRaw('DATE(created_at) as label, COUNT(*) as total')
                    ->groupBy('label')
                    ->orderBy('label', 'asc')
                    ->pluck('total', 'label');
                break;

            case 'monthly':
                $barangKeluar = $query
                    ->selectRaw('DATE_FORMAT(created_at, "%Y-%m") as label, COUNT(*) as total')
                    ->groupBy('label')
                    ->orderBy('label', 'asc')
                    ->pluck('total', 'label');
                break;

            case 'yearly':
                $barangKeluar = $query
                    ->selectRaw('YEAR(created_at) as label, COUNT(*) as total')
                    ->groupBy('label')
                    ->orderBy('label', 'asc')
                    ->pluck('total', 'label');
                break;

            default: // weekly
                $barangKeluar = $query
                    ->selectRaw('YEARWEEK(created_at, 1) as label, COUNT(*) as total')
                    ->groupBy('label')
                    ->orderBy('label', 'asc')
                    ->pluck('total', 'label');
        }

        // Hitung growth %
        $now = $barangKeluar->last() ?? 0;
        $prev = $barangKeluar->slice(-2, 1)->first() ?? 0;
        $growth = $prev > 0 ? (($now - $prev) / $prev) * 100 : 0;

        // History barang keluar user
        $history = Item_out::whereHas('cart', fn($q) => $q->where('user_id', $userId))
            ->whereNotNull('approved_by')
            ->with(['item', 'approver'])
            ->latest()
            ->paginate(10);

        return view('role.pegawai.dashboard', [
            'labels'  => $barangKeluar->keys(),
            'keluar'  => $barangKeluar->values(),
            'growth'  => $growth,
            'period'  => $period,
            'history' => $history,
        ]);
    }

    public function produk()
    {
        return view('role.pegawai.produk');
    }
}
