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
        Schema::create('flight_segments', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('sequence'); 
            $table->foreignId('flight_id')->constrained()->cascadeOnDelete();
            $table->foreignId('departure_airport_id')->constrained('airports')->cascadeOnDelete();
            $table->foreignId('arrival_airport_id')->constrained('airports')->cascadeOnDelete();
            $table->dateTime('departure_time');
            $table->dateTime('arrival_time');
            $table->softDeletes();
            $table->timestamps();

            $table->unique(['flight_id', 'sequence']); 
            $table->index(['flight_id', 'departure_airport_id', 'arrival_airport_id'], 'flight_segments_flight_airport_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flight_segments');
    }
};
