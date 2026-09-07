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
    Schema::table('produk', function (Blueprint $table) {
        if (Schema::hasColumn('produk', 'jenis')) {
            $table->dropColumn('jenis');
        }
    });
}

public function down(): void
{
    Schema::table('produk', function (Blueprint $table) {
        $table->string('jenis')->nullable();
    });
}
};
