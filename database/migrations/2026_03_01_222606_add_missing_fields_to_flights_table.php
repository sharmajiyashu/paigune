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
        Schema::table('flights', function (Blueprint $table) {

            // Booking
            $table->string('type_of_flight')->nullable()->after('type_of_booking');

            // Return Flight Extra Fields
            $table->string('return_flight_number')->nullable()->after('arrival_time');
            $table->string('return_airline_operator')->nullable()->after('return_flight_number');
            $table->string('return_aircraft_type')->nullable()->after('return_airline_operator');
            $table->date('return_departure_date')->nullable()->after('return_aircraft_type');
            $table->string('return_departure_airport')->nullable()->after('return_departure_date');
            $table->string('return_arrival_airport')->nullable()->after('return_departure_airport');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('flights', function (Blueprint $table) {
            //
        });
    }
};
