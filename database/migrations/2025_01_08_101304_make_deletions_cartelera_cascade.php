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
        Schema::table('cartelera', function (Blueprint $table) {
            $table->dropForeign(['play_id']);
            $table->foreign('play_id')->references('id')->on('plays')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cartelera', function (Blueprint $table) {
            //
        });
    }
};
