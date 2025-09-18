<?php

namespace App\Http\Controllers\Role;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Item;
use App\Models\Supplier;
use App\Models\User;
use App\Models\Item_in;
use App\Models\Item_out;

class SuperAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::count();
        $item      = Item::count();
        $suppliers  = Supplier::count();
        $users      = User::count();

        // Ambil history terbaru barang masuk (limit 5)
        $itemIns = Item_in::with('item')
            ->latest()
            ->take(5)
            ->get();

        return view('role.super_admin.dashboard', compact('categories', 'item', 'suppliers', 'users', 'itemIns'));
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
