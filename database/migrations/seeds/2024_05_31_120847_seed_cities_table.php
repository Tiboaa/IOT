<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class SeedCitiesTable extends Migration
{

    public function up(): void
    {
        $countries = DB::table('countries')->pluck('id', 'name');

        $cities = [
            ['zip_code' => '10001', 'name' => 'New York', 'country_id' => $countries['USA']],
            ['zip_code' => '94101', 'name' => 'San Francisco', 'country_id' => $countries['USA']],
            ['zip_code' => '90001', 'name' => 'Los Angeles', 'country_id' => $countries['USA']],

            ['zip_code' => 'E1 6AN', 'name' => 'London', 'country_id' => $countries['UK']],
            ['zip_code' => 'G1 2FF', 'name' => 'Glasgow', 'country_id' => $countries['UK']],
            ['zip_code' => 'M1 1AE', 'name' => 'Manchester', 'country_id' => $countries['UK']],

            ['zip_code' => '10115', 'name' => 'Berlin', 'country_id' => $countries['Germany']],
            ['zip_code' => '20095', 'name' => 'Hamburg', 'country_id' => $countries['Germany']],
            ['zip_code' => '80331', 'name' => 'Munich', 'country_id' => $countries['Germany']],

            ['zip_code' => '100-0001', 'name' => 'Tokyo', 'country_id' => $countries['Japan']],
            ['zip_code' => '530-0001', 'name' => 'Osaka', 'country_id' => $countries['Japan']],

            ['zip_code' => '28001', 'name' => 'Madrid', 'country_id' => $countries['Spain']],

            ['zip_code' => '00184', 'name' => 'Rome', 'country_id' => $countries['Italy']],
            ['zip_code' => '50122', 'name' => 'Florence', 'country_id' => $countries['Italy']],
        ];

        DB::table('cities')->insert($cities);
    }

    public function down(): void
    {
        DB::table('cities')->truncate();
    }
}
