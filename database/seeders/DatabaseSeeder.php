<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // $this->call(UserSeeder::class);
        //  $this->call([
        //     MasterDataSeeder::class,
        //     ItemInOutSeeder::class,
        // ]);
        $this->call([
        UserSeeder::class,
        GuestSeeder::class,
        MasterDataSeeder::class,
        ItemInOutSeeder::class,
        CartSeeder::class,
        CartItemSeeder::class,
        SessionSeeder::class,
        GuestCartSeeder::class,
        GuestCartItemSeeder::class,
    ]);
    }
}
