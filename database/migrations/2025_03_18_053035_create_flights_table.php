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
        Schema::create('flights', function (Blueprint $table) {
            $table->id();
            $table->string('flight_number');
            $table->foreignId('airline_id')->constrained()->cascadeOnDelete();
            $table->foreignId('departure_airport_id')->nullable()->constrained('airports')->cascadeOnDelete();
            $table->foreignId('arrival_airport_id')->nullable()->constrained('airports')->cascadeOnDelete();
            $table->softDeletes();
            $table->timestamps();

            $table->index(['flight_number','airline_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flights');
        Schema::table('flights', function (Blueprint $table) {
            $table->dropForeign(['departure_airport_id']);
            $table->dropForeign(['arrival_airport_id']);
            $table->dropColumn(['departure_airport_id', 'arrival_airport_id']);
        });
    }
};