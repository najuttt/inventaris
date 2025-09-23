<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('item_outs', function (Blueprint $table) {
            $table->timestamp('picked_up_at')->nullable()->after('quantity');
        });
    }

    public function down(): void
    {
        Schema::table('item_outs', function (Blueprint $table) {
            $table->dropColumn('picked_up_at');
        });
    }
};
