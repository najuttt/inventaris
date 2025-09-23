<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Guest;
use App\Models\User;

class GuestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pastikan minimal ada 1 user
        $user = User::first() ?? User::factory()->create();

        $guests = [
            [
                'name' => 'Budi Santoso',
                'phone' => '081234567890',
                'description' => 'Guest pertama untuk testing',
                'created_by' => $user->id,
            ],
            [
                'name' => 'Siti Aminah',
                'phone' => '082345678901',
                'description' => 'Guest kedua untuk testing',
                'created_by' => $user->id,
            ],
            [
                'name' => 'Agus Setiawan',
                'phone' => '083456789012',
                'description' => 'Guest ketiga untuk testing',
                'created_by' => $user->id,
            ],
        ];

        foreach ($guests as $guest) {
            Guest::updateOrCreate(
                ['phone' => $guest['phone']], // supaya tidak double kalau di-seed ulang
                $guest
            );
        }
    }
}
