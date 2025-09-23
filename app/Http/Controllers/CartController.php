<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cart = Cart::where('user_id', Auth::id())
                    ->where('status', 'active')
                    ->with('cartItems.item')
                    ->first();

        return view('role.pegawai.cart', compact('cart'));
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
        $cartItem = CartItem::findOrFail($id);
        $cart = $cartItem->cart;

        if ($cart->user_id !== Auth::id() || $cart->status !== 'active') {
            return redirect()->back()->with('error', 'Akses tidak sah.');
        }

        $cartItem->item->increment('stock', $cartItem->quantity);

        $cartItem->delete();

        if ($cart->cartItems()->count() === 0) {
            $cart->delete();
        }

        return redirect()->back()->with('success', 'Produk dihapus dari keranjang.');
    }
}