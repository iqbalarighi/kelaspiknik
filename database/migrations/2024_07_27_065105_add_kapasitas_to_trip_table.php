<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('trip', function (Blueprint $table) {
            $table->string('kapasitas')->nullable()->after('jumlah_bus');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('trip', function (Blueprint $table) {
           $table->dropColumn('kapasitas');
        });
    }
};
