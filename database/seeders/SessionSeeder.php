<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\User;

class SessionSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::pluck('id'); // ambil semua user id

        foreach (range(1, 10) as $i) {
            DB::table('sessions')->insert([
                'id'            => Str::random(40), // session_id unik
                'user_id'       => $users->random(), // boleh null juga kalau mau guest
                'ip_address'    => fake()->ipv4(),
                'user_agent'    => fake()->userAgent(),
                'payload'       => json_encode([
                    'last_page'   => fake()->url(),
                    'last_action' => fake()->word(),
                ]),
                'last_activity' => now()->timestamp,
            ]);
        }
    }
}
