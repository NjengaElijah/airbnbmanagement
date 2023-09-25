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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('name');

            $table->string('price_per_night');
            $table->string('discounted_price');
            $table->string('no_guests');
            $table->text('location')->nullable();
            $table->text('coordinates')->nullable();

            //the whole body
            $table->text('description');

            $table->foreignId('client_id')->nullable()
                ->constrained('clients');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};