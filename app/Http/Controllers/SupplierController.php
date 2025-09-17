<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::latest()->get();
        return view('role.super_admin.suppliers.index', compact('suppliers'));
    }

    public function create()
    {
        return view('role.super_admin.suppliers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:255|unique:suppliers,name',
            'contact' => 'nullable|string|max:255',
        ]);

        Supplier::create($validated);

        return redirect()->route('super_admin.suppliers.index')->with('success', 'Supplier berhasil ditambahkan.');
    }

    public function edit(Supplier $supplier)
    {
        return view('role.super_admin.suppliers.edit', compact('supplier'));
    }

    public function update(Request $request, Supplier $supplier)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:255|unique:suppliers,name,' . $supplier->id,
            'contact' => 'nullable|string|max:255',
        ]);

        $supplier->update($validated);

        return redirect()->route('super_admin.suppliers.index')->with('success', 'Supplier berhasil diperbarui.');
    }

    public function destroy(Supplier $supplier)
    {
        $supplier->delete();
        return redirect()->route('super_admin.suppliers.index')->with('success', 'Supplier berhasil dihapus.');
    }
}
