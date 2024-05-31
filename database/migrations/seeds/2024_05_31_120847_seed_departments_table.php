<?php

use Illuminate\Database\Migrations\Migration;
use Faker\Factory as Faker;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $faker = Faker::create();

        $departmentNames = [
            'Finance',
            'Human Resources',
            'IT',
            'Sales',
            'Customer service',
            'Marketing',
            'Research and development',
            'Business administration',
            'Operations management',
            'Production',
            'Design',
            'Project department',
            'Quality management',
            'Product development',
            'Security',
            'Supply chain management',
            'Purchasing',
            'Accounting'
        ];

        shuffle($departmentNames);

        $cities = DB::table('cities')->get();

        $departments = [];
        $departmentIndex = 1;

        foreach ($cities as $index => $city) {
            $numDepartments = min(max(5, rand(5, 18)), count($departmentNames));

            for ($i = 0; $i < $numDepartments; $i++) {
                $code = 'D' . str_pad(dechex($departmentIndex), 3, '0', STR_PAD_LEFT);

                $departments[] = [
                    'code' => $code,
                    'name' => $departmentNames[$i],
                    'city_zip' => $city->zip_code,
                    'country' => DB::table('countries')->where('id', $city->country_id)->value('name'),
                    'created_at' => now(),
                    'updated_at' => now()
                ];
                
                $departmentIndex++;
            }

            if ($index === 0 && $numDepartments < 18) {
                for ($j = $numDepartments; $j < 18; $j++) {
                    $code = 'D' . str_pad(dechex($departmentIndex), 3, '0', STR_PAD_LEFT);

                    $departments[] = [
                        'code' => $code,
                        'name' => $departmentNames[$j],
                        'city_zip' => $city->zip_code,
                        'country' => DB::table('countries')->where('id', $city->country_id)->value('name'),
                        'created_at' => now(),
                        'updated_at' => now()
                    ];
                    
                    $departmentIndex++;
                }
            }
        }

        DB::table('departments')->insert($departments);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('departments')->truncate();
    }
};
