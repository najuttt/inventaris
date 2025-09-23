<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GuestCartSeeder extends Seeder
{
    public function run(): void
    {
        $sessions = DB::table('sessions')->pluck('id');

        if ($sessions->isEmpty()) {
            $this->command->warn("⚠️ Seeder GuestCartSeeder: tabel sessions masih kosong.");
            return;
        }

        // ambil unique session_id saja
        foreach ($sessions as $sessionId) {
            // cek apakah sudah ada guest_cart untuk session ini
            $exists = DB::table('guest_carts')->where('session_id', $sessionId)->exists();
            if ($exists) {
                continue; // skip kalau sudah ada
            }

            DB::table('guest_carts')->insert([
                'session_id' => $sessionId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $this->command->info("✅ Seeder GuestCartSeeder berhasil menambahkan guest_carts untuk setiap session unik.");
    }
}
