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
            $table->string('no_guests');
            
            //one br, 2br and such
            $table->foreignId('room_types_id')->nullable()
                ->constrained('room_types');
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