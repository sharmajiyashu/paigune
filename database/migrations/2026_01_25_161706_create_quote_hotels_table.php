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
        Schema::create('quote_hotels', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quote_id')
                ->constrained('quotes')
                ->onDelete('cascade');
            $table->string('hotel_name')->nullable();
            $table->string('country')->nullable();
            $table->string('location')->nullable();
            $table->date('checkin_date')->nullable();
            $table->date('checkout_date')->nullable();
            $table->string('room_type')->nullable();
            $table->integer('guests')->nullable();
            $table->string('reference')->nullable();
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
        Schema::dropIfExists('quote_hotels');
    }
};
