<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Item_in;
use App\Models\Item_out;
use App\Models\Item;
use App\Models\User;
use App\Models\Supplier;
use Carbon\Carbon;

class ItemInOutSeeder extends Seeder
{
    public function run(): void
    {
        Item_in::truncate();
        Item_out::truncate();

        $item = Item::first(); // ambil item dari MasterDataSeeder
        $user = User::first();
        $supplier = Supplier::first();

        $startDate = Carbon::now()->subYear()->startOfMonth();

        for ($i = 0; $i < 12; $i++) {
            $date = (clone $startDate)->addMonths($i)->addDays(rand(0, 25));

            // Barang Masuk
            Item_in::create([
                'item_id'     => $item->id,
                'quantity'    => rand(50, 150),
                'supplier_id' => $supplier->id,
                'expired_at'  => (clone $date)->addMonths(rand(6, 18)),
                'created_by'  => $user?->id ?? 1,
                'created_at'  => $date,
                'updated_at'  => $date,
            ]);

            // Barang Keluar
            Item_out::create([
                'item_id'     => $item->id,
                'quantity'    => rand(20, 120),
                'cart_id'     => null,
                'approved_by' => $user?->id ?? 1,
                'released_at' => $date,
                'created_at'  => $date,
                'updated_at'  => $date,
            ]);
        }
    }
}
