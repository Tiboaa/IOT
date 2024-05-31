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
        Schema::table('departments', function (Blueprint $table) {
            $table->string('city_zip');
            $table->string('country');
            $table->foreign('city_zip')->references('zip_code')->on('cities');
            $table->foreign('country')->references('name')->on('countries');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('departments', function (Blueprint $table) {
            $table->dropForeign(['city_zip']);
            $table->dropColumn(['city_zip', 'country']);
        });
    }
};
