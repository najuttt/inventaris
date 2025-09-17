<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::with(['category', 'creator'])->latest()->paginate(10);
        return view('role.super_admin.items.index', compact('items'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('role.super_admin.items.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'code'        => 'required|string|max:50|unique:items,code',
            'category_id' => 'required|exists:categories,id',
            'stock'       => 'required|integer|min:0',
        ]);

        Item::create([
            'name'        => $request->name,
            'code'        => $request->code,
            'category_id' => $request->category_id,
            'stock'       => $request->stock,
            'created_by'  => Auth::id(),
        ]);

        return redirect()->route('super_admin.items.index')->with('success', 'Item berhasil ditambahkan');
    }

    public function edit(Item $item)
    {
        $categories = Category::all();
        return view('role.super_admin.items.edit', compact('item', 'categories'));
    }

    public function update(Request $request, Item $item)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'code'        => 'required|string|max:50|unique:items,code,' . $item->id,
            'category_id' => 'required|exists:categories,id',
            'stock'       => 'required|integer|min:0',
        ]);

        $item->update([
            'name'        => $request->name,
            'code'        => $request->code,
            'category_id' => $request->category_id,
            'stock'       => $request->stock,
        ]);

        return redirect()->route('super_admin.items.index')->with('success', 'Item berhasil diperbarui');
    }

    public function destroy(Item $item)
    {
        $item->delete();
        return redirect()->route('super_admin.items.index')->with('success', 'Item berhasil dihapus');
    }
}
