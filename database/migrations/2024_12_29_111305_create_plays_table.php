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
        Schema::create('plays', function (Blueprint $table) {
            $table->id();
            $table->text('title');
            $table->text('argument');
            $table->text('author');
            $table->text('duration');

            $table->unsignedBigInteger('room_id');
            $table->unsignedBigInteger('company_id');

            $table->foreign('room_id')->references('id')->on('rooms');
            $table->foreign('company_id')->references('id')->on('rooms');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plays');
    }
};
