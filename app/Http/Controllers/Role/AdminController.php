<?php

namespace App\Http\Controllers\Role;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Guest;
use App\Models\Item_in;
use App\Models\Item_out;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * Tampilkan dashboard admin.
     */
    public function index()
    {
        // Total barang keluar (jumlah quantity)
        $totalBarangKeluar = Item_out::sum('quantity');

        // Total permintaan barang (jumlah carts)
        $totalRequest = Cart::count();

        // Total guest
        $totalGuest = Guest::count();

        // --- Data for Charts (1 Tahun Terakhir)
        $oneYearAgo = Carbon::now()->subYear()->startOfMonth();
        $now = Carbon::now()->endOfMonth();

        $barangMasuk = Item_in::select(
                DB::raw('MONTH(created_at) as bulan'),
                DB::raw('SUM(quantity) as total')
            )
            ->whereBetween('created_at', [$oneYearAgo, $now])
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->pluck('total', 'bulan');

        $barangKeluar = Item_out::select(
                DB::raw('MONTH(created_at) as bulan'),
                DB::raw('SUM(quantity) as total')
            )
            ->whereBetween('created_at', [$oneYearAgo, $now])
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->pluck('total', 'bulan');

        $labels = [
            'Januari','Februari','Maret','April','Mei','Juni',
            'Juli','Agustus','September','Oktober','November','Desember'
        ];

        $dataMasuk = [];
        $dataKeluar = [];
        for ($i = 1; $i <= 12; $i++) {
            $dataMasuk[] = $barangMasuk[$i] ?? 0;
            $dataKeluar[] = $barangKeluar[$i] ?? 0;
        }

        // --- Latest Data
        $latestBarangKeluar = Item_out::with('item')
            ->latest()
            ->take(5)
            ->get();

        $latestRequest = Cart::with(['user','item'])
            ->latest()
            ->take(5)
            ->get();

        // --- Top 5 Requesters
        $topRequesters = $this->getTopRequesters();

        return view('role.admin.dashboard', compact(
            'totalBarangKeluar',
            'totalRequest',
            'totalGuest',
            'labels',
            'dataMasuk',
            'dataKeluar',
            'latestBarangKeluar',
            'latestRequest',
            'topRequesters'
        ));
    }

    /**
     * Ambil Top 5 pegawai atau guest dengan permintaan terbanyak.
     */
    protected function getTopRequesters()
    {
        // Total permintaan dari user (pegawai/admin)
        $userRequests = DB::table('carts')
            ->join('cart_items', 'carts.id', '=', 'cart_items.cart_id')
            ->select('carts.user_id as requester_id', DB::raw('SUM(cart_items.quantity) as total_quantity'))
            ->groupBy('carts.user_id')
            ->get()
            ->map(function ($item) {
                $item->type = 'user';
                return $item;
            });

        // Total permintaan dari guest (via session)
        $guestRequests = DB::table('guest_cart_items')
            ->join('guest_carts', 'guest_cart_items.guest_cart_id', '=', 'guest_carts.id')
            ->join('sessions', 'guest_carts.session_id', '=', 'sessions.id')
            ->leftJoin('guests', 'guests.created_by', '=', 'sessions.user_id')
            ->select(
                DB::raw('COALESCE(guests.id, sessions.id) as requester_id'),
                DB::raw('COALESCE(guests.name, sessions.ip_address) as name'),
                DB::raw('SUM(guest_cart_items.quantity) as total_quantity')
            )
            ->groupBy('guests.id', 'guests.name', 'sessions.id', 'sessions.ip_address')
            ->get()
            ->map(function ($item) {
                $item->type = 'guest';
                return $item;
            });

        // Gabungkan dan urutkan
        $combinedRequests = $userRequests->concat($guestRequests)
            ->sortByDesc('total_quantity')
            ->take(5);

        // Ambil detail
        $topRequesters = [];
        foreach ($combinedRequests as $requester) {
            if ($requester->type === 'user') {
                $user = User::find($requester->requester_id);
                if ($user) {
                    $topRequesters[] = [
                        'name' => $user->name,
                        'email' => $user->email,
                        'role' => ucfirst($user->role),
                        'total_requests' => $requester->total_quantity,
                    ];
                }
            } else {
                $topRequesters[] = [
                    'name' => $requester->name ?? 'Guest Unknown',
                    'email' => 'N/A',
                    'role' => 'Guest',
                    'total_requests' => $requester->total_quantity,
                ];
            }
        }

        return collect($topRequesters);
    }

    /**
     * Endpoint Ajax Chart (filter mingguan, 1 bulan, 3 bulan, 6 bulan, 1 tahun).
     */
    public function getChartData(Request $request)
    {
        $range = $request->query('range', 'week');

        switch ($range) {
            case 'month':
                $start = Carbon::now()->startOfMonth();
                break;
            case '3month':
                $start = Carbon::now()->subMonths(3);
                break;
            case '6month':
                $start = Carbon::now()->subMonths(6);
                break;
            case 'year':
                $start = Carbon::now()->subYear();
                break;
            default: // week
                $start = Carbon::now()->startOfWeek();
                break;
        }

        // Barang Masuk
        $barangMasuk = Item_in::select(
                DB::raw('DATE(created_at) as tanggal'),
                DB::raw('SUM(quantity) as total')
            )
            ->where('created_at', '>=', $start)
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->pluck('total', 'tanggal');

        // Barang Keluar
        $barangKeluar = Item_out::select(
                DB::raw('DATE(created_at) as tanggal'),
                DB::raw('SUM(quantity) as total')
            )
            ->where('created_at', '>=', $start)
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->pluck('total', 'tanggal');

        // Satukan tanggal (label X)
        $labels = collect($barangMasuk->keys())
            ->merge($barangKeluar->keys())
            ->unique()
            ->sort()
            ->values();

        return response()->json([
            'labels' => $labels,
            'masuk' => $labels->map(fn($d) => $barangMasuk[$d] ?? 0),
            'keluar' => $labels->map(fn($d) => $barangKeluar[$d] ?? 0),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}