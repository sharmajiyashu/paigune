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
        Schema::create('quote_flights', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quote_id')
                ->constrained('quotes')
                ->onDelete('cascade');

            // Outbound Flight
            $table->string('type_of_booking')->nullable(); // One-way or Return
            $table->string('flight_number')->nullable(); // API or internal DB
            $table->string('airline_operator')->nullable();
            $table->string('aircraft_type')->nullable();
            $table->date('departure_date')->nullable();
            $table->string('departure_airport')->nullable(); // dropdown
            $table->string('arrival_airport')->nullable(); // dropdown
            $table->string('departure_time')->nullable(); // API or manual
            $table->string('arrival_time')->nullable(); // API or manual

            // Return Flight (if applicable)
            $table->date('return_arrival_date')->nullable();
            $table->string('return_departure_time')->nullable();
            $table->string('return_arrival_time')->nullable();

            $table->boolean('empty_leg')->default(false);

            $table->text('notes')->nullable();
            $table->decimal('price', 12, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quote_flights');
    }
};
