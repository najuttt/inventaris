<?php

namespace App\Http\Controllers\Role;

use App\Http\Controllers\Controller;
use App\Repositories\Eloquent\SuperAdminRepository;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Item;
use App\Models\Supplier;
use App\Models\User;
use App\Models\Item_in;
use App\Models\Item_out;
use Carbon\Carbon;

class SuperAdminController extends Controller
{

     protected $superAdminRepository;

    /**
     * Display a listing of the resource.
     */
    public function __construct(SuperAdminRepository $superAdminRepository)
    {
        $this->superAdminRepository = $superAdminRepository;
    }

    public function index(Request $request)
    {
        $itemIns = Item_in::with('item')->latest()->take(5)->get();
        $period = $request->get('period', 'weekly');


        $expiredSoon = Item_in::whereNotNull('expired_at')
            ->whereBetween('expired_at', [Carbon::now(), Carbon::now()->addDays(30)])
            ->with('item')
            ->get();

        return view('role.super_admin.dashboard', [
            'categories'  => $this->superAdminRepository->getCategoriesCount(),
            'item'        => $this->superAdminRepository->getItemsCount(),
            'suppliers'   => $this->superAdminRepository->getSuppliersCount(),
            'users'       => $this->superAdminRepository->getUsersCount(),
            'itemIns'     => $this->superAdminRepository->getLatestItemIns(),
            'itemOuts'    => $this->superAdminRepository->getLatestItemOuts(),
            'expiredSoon' => $this->superAdminRepository->getExpiredSoon(),
            'chartData'   => $this->superAdminRepository->getDashboardData($period),
            'period'      => $period,
            'topRequesters'  => $this->superAdminRepository->getTopRequesters(),
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
