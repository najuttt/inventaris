<?php

namespace App\Http\Controllers\Role\admin;

use App\Http\Controllers\Controller;
use App\Models\Guest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class GuestController extends Controller
{
    public function index()
    {
        $guests = Guest::with('creator')->latest()->paginate(10);
        return view('role.admin.guest', compact('guests'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'phone'       => 'required|string|max:20',
            'description' => 'nullable|string',
        ]);

        Guest::create([
            'name'        => $request->name,
            'phone'       => $request->phone,
            'description' => $request->description,
            'created_by'  => Auth::id(), // pastikan ada kolom created_by di tabel
        ]);

        return redirect()->route('admin.guests.index')
            ->with('success', 'Guest berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'description' => 'nullable|string',
        ]);

        $guest = Guest::findOrFail($id);
        $guest->update($request->only('name', 'phone', 'description'));

        return redirect()->route('admin.guests.index')->with('success', 'Guest berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $guest = Guest::findOrFail($id);
        $guest->delete();

        return redirect()->route('admin.guests.index')->with('success', 'Guest berhasil dihapus.');
    }
}

