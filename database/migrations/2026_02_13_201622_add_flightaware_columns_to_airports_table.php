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
        Schema::table('airpots', function (Blueprint $table) {
            $table->string('airport_code')->nullable()->after('code');
            $table->string('alternate_ident')->nullable()->after('airport_code');
            $table->string('code_icao')->nullable()->after('alternate_ident');
            $table->string('code_iata')->nullable()->after('code_icao');
            $table->string('code_lid')->nullable()->after('code_iata');
            $table->string('type')->nullable()->after('code_lid');
            $table->integer('elevation')->nullable()->after('type');
            $table->string('city')->nullable()->after('elevation');
            $table->string('state')->nullable()->after('city');
            $table->decimal('longitude', 10, 7)->nullable()->after('state');
            $table->decimal('latitude', 10, 7)->nullable()->after('longitude');
            $table->string('timezone')->nullable()->after('latitude');
            $table->string('country_code')->nullable()->after('timezone');
            $table->string('wiki_url')->nullable()->after('country_code');
            $table->string('airport_flights_url')->nullable()->after('wiki_url');
            $table->json('alternatives')->nullable()->after('airport_flights_url');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('airpots', function (Blueprint $table) {
            $table->dropColumn([
                'airport_code',
                'alternate_ident',
                'code_icao',
                'code_iata',
                'code_lid',
                'type',
                'elevation',
                'city',
                'state',
                'longitude',
                'latitude',
                'timezone',
                'country_code',
                'wiki_url',
                'airport_flights_url',
                'alternatives'
            ]);
        });
    }
};
