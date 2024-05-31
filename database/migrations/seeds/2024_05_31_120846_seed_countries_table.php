<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class SeedCountriesTable extends Migration
{

    public function up(): void
    {
        $countries = [
            ['name' => 'USA'],
            ['name' => 'UK'],
            ['name' => 'Germany'],
            ['name' => 'Japan'],
            ['name' => 'Spain'],
            ['name' => 'Italy'],
        ];

        DB::table('countries')->insert($countries);
    }

    public function down(): void
    {
        DB::table('countries')->truncate();
    }
}
