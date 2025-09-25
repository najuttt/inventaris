<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Guest;
use App\Models\Item;
use App\Models\Guest_carts;
use App\Models\Guest_carts_item;

class GuestCartController extends Controller
{

    public function addItem(Request $request, $guestId, $itemId)
    {
        $guest = Guest::findOrFail($guestId);
        $item = Item::findOrFail($itemId);

        // Cari cart aktif (pakai session_id misalnya)
        $cart = Guest_carts::firstOrCreate(
            [
                'guest_id' => $guest->id,
                'session_id' => session()->getId(),
            ]
        );

        // Tambahkan item ke guest_cart_items
        $cartItem = Guest_carts_item::where('guest_cart_id', $cart->id)
            ->where('item_id', $item->id)
            ->first();

        if ($cartItem) {
            // Jika item sudah ada, tambahkan quantity
            $cartItem->increment('quantity');
        } else {
            // Jika belum ada, buat baru
            Guest_carts_item::create([
                'guest_cart_id' => $cart->id,
                'item_id' => $item->id,
                'quantity' => 1,
            ]);
        }

        return back()->with('success', 'Item berhasil ditambahkan ke cart guest!');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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