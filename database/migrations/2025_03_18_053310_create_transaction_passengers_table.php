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
        Schema::create('transaction_passengers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaction_id')->constrained()->cascadeOnDelete();
            $table->foreignId('flight_seat_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->date('date_of_birth');
            $table->string('nationality',3);
            $table->softDeletes();
            $table->timestamps();

            $table->index(['transaction_id','flight_seat_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_passangers');
    }
};