<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Unit;
use App\Models\Supplier;
use App\Models\Item;

class MasterDataSeeder extends Seeder
{
    public function run(): void
    {
        // Categories
        $category = Category::firstOrCreate(['name' => 'Elektronik']);

        // Units
        $unit = Unit::firstOrCreate(['name' => 'PCS']);

        // Suppliers
        $supplier = Supplier::firstOrCreate([
            'name' => 'PT. Supplier Dummy',
            'contact' => '08123456789',
        ]);

        // Items
        $item = Item::firstOrCreate([
            'name' => 'Laptop Dummy',
            'category_id' => $category->id,
            'unit_id' => $unit->id,
            'created_by' => 1,
        ]);
    }
}
