<?php

namespace App\Http\Controllers;

use App\Models\Item_in;
use App\Models\Item;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Item_inController extends Controller
{
    public function index()
    {
        $items_in = Item_in::with(['item', 'supplier', 'creator'])->latest()->paginate(10);
        return view('role.super_admin.item_ins.index', compact('items_in'));
    }

    public function create()
    {
        $items = Item::all();
        $suppliers = Supplier::all();
        return view('role.super_admin.item_ins.create', compact('items', 'suppliers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'item_id' => 'required|exists:items,id',
            'quantity' => 'required|integer|min:1',
            'supplier_id' => 'required|exists:suppliers,id',
            'expired_at' => 'nullable|date',
        ]);

        Item_in::create([
            'item_id' => $request->item_id,
            'quantity' => $request->quantity,
            'supplier_id' => $request->supplier_id,
            'expired_at' => $request->expired_at,
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('super_admin.item_ins.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit(Item_in $item_in)
    {
        $items = Item::all();
        $suppliers = Supplier::all();
        return view('role.super_admin.item_ins.edit', compact('item_in', 'items', 'suppliers'));
    }

    public function update(Request $request, Item_in $item_in)
    {
        $request->validate([
            'item_id' => 'required|exists:items,id',
            'quantity' => 'required|integer|min:1',
            'supplier_id' => 'required|exists:suppliers,id',
            'expired_at' => 'nullable|date',
        ]);

        $item_in->update([
            'item_id' => $request->item_id,
            'quantity' => $request->quantity,
            'supplier_id' => $request->supplier_id,
            'expired_at' => $request->expired_at,
        ]);

        return redirect()->route('super_admin.item_ins.index')->with('success', 'Data berhasil diupdate');
    }

    public function destroy(Item_in $item_in)
    {
        $item_in->delete();
        return redirect()->route('super_admin.item_ins.index')->with('success', 'Data berhasil dihapus');
    }
}
