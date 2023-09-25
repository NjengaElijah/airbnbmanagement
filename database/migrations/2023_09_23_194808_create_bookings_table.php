<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('room_id')->nullable()
                ->constrained('rooms');
            $table->foreignId('user_id')->nullable()
                ->constrained('users');
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->float('price_per_night')->nullable();
            $table->float('no_adults')->nullable();
            $table->float('no_children')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};