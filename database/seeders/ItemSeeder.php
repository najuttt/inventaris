<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Item;

class ItemSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            Item::create([
                'name' => 'Item '.$i,
                'code' => 'ITM'.$i,
                'category_id' => 1,  // pastikan category_id ada
                'stock' => rand(10, 100),
                'supplier_id' => 1,  // pastikan supplier_id ada
                'unit_id' => 1,      // pastikan unit_id ada
                'created_by'  => 1,
            ]);
        }
    }
}
