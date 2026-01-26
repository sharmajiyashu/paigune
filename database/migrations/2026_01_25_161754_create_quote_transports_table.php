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
        Schema::create('quote_transports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quote_id')
                ->constrained('quotes')
                ->onDelete('cascade');
            $table->string('car_rental_company')->nullable();
            $table->string('car_type')->nullable();
            $table->string('pickup_location')->nullable();
            $table->dateTime('pickup_datetime')->nullable();
            $table->string('dropoff_location')->nullable();
            $table->dateTime('dropoff_datetime')->nullable();
            $table->text('driver_details')->nullable();
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
        Schema::dropIfExists('quote_transports');
    }
};
