<?php

namespace App\Http\Controllers\Role\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Cart;
use App\Models\Notification;

class RequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $requests = DB::table('carts')
            ->join('users', 'carts.user_id', '=', 'users.id')
            ->leftJoin('cart_items', 'carts.id', '=', 'cart_items.cart_id') // pakai left join
            ->select(
                'carts.id as cart_id',
                'users.name',
                'users.email',
                'users.role',
                'carts.status',
                'carts.created_at',
                DB::raw('COALESCE(SUM(cart_items.quantity), 0) as total_quantity')
            )
            ->whereIn('carts.status', ['pending', 'rejected']) // 🔹 tambahkan approved juga biar bisa tampil
            ->groupBy(
                'carts.id',
                'users.name',
                'users.email',
                'users.role',
                'carts.status',
                'carts.created_at'
            )
            ->orderBy('carts.created_at', 'desc')
            ->get();

        return view('role.admin.request', compact('requests'));
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
        DB::table('carts')
            ->where('id', $id)
            ->update([
                'status' => $request->status,
                'updated_at' => now()
            ]);

        // Ambil cart untuk tahu user_id siapa
        $cart = DB::table('carts')->where('id', $id)->first();

        // Tambahkan notifikasi untuk user tersebut
        if ($cart) {
            Notification::create([
                'user_id' => $cart->user_id,
                'title'   => 'Request ' . ucfirst($request->status),
                'message' => 'Permintaan barang kamu telah ' . $request->status,
                'status'  => 'unread',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return redirect()->back()->with('success', 'Status berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
