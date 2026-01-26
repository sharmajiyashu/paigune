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
        Schema::create('quote_others', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quote_id')
                ->constrained('quotes')
                ->onDelete('cascade');
            $table->string('title')->nullable();
            $table->decimal('price', 12, 2)->default(0);
            $table->text('notes')->nullable();
            $table->date('date')->nullable();
            $table->time('time')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quote_others');
    }
};
