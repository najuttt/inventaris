<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Category;
use App\Models\Unit;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Milon\Barcode\DNS1D;
use Barryvdh\DomPDF\Facade\Pdf;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::with(['category', 'unit', 'supplier'])->latest()->get();
        return view('role.super_admin.items.index', compact('items'));
    }

    public function create()
    {
        $categories = Category::all();
        $units = Unit::all();
        $suppliers = Supplier::all();
        return view('role.super_admin.items.create', compact('categories', 'units', 'suppliers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'unit_id'     => 'required|exists:units,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'stock'       => 'required|integer|min:0',
            'expired_at'  => 'nullable|date',
        ]);

        $validated['created_by'] = Auth::id();

        Item::create($validated);

        return redirect()->route('super_admin.items.index')->with('success', 'Item berhasil ditambahkan.');
    }

    public function show(Request $request, Item $item)
    {
        $supplierId = $request->get('supplier_id');

        $itemInQuery = $item->itemIn();

        if ($supplierId) {
            $itemInQuery->where('supplier_id', $supplierId);
        }

        $itemIns = $itemInQuery->get();

        $expiredCount = $itemIns->where('expired_at', '<', now())->sum('quantity');
        $nonExpiredCount = $itemIns->where('expired_at', '>=', now())->sum('quantity');

        $suppliers = \App\Models\Supplier::all();

        return view('role.super_admin.items.show', compact(
            'item',
            'suppliers',
            'supplierId',
            'expiredCount',
            'nonExpiredCount'
        ));
    }



    public function edit(Item $item)
    {
        $categories = Category::all();
        $units = Unit::all();
        $suppliers = Supplier::all();
        return view('role.super_admin.items.edit', compact('item', 'categories', 'units', 'suppliers'));
    }

    public function update(Request $request, Item $item)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'unit_id'     => 'required|exists:units,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'stock'       => 'required|integer|min:0',
            'expired_at'  => 'nullable|date',
        ]);

        $item->update($validated);

        return redirect()->route('super_admin.items.index')->with('success', 'Item berhasil diperbarui.');
    }

    public function destroy(Item $item)
    {
        $item->delete();
        return redirect()->route('super_admin.items.index')->with('success', 'Item berhasil dihapus.');
    }

    public function printBarcode(Item $item)
    {
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('role.super_admin.items.barcode-pdf', compact('item'));
        return $pdf->download('barcode-'.$item->code.'.pdf');
    }
}
