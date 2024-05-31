<?php

use Illuminate\Database\Migrations\Migration;
use App\Models\Departments;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Generate and insert employee data
        $faker = Faker\Factory::create();
        
        // Define the range of departments from D001 to D0c5
        $departmentCount = Departments::count();
        $departmentCodes = range(1, $departmentCount);
        
        // Generate employees for each department
        $num = 1;
        foreach ($departmentCodes as $departmentCode) {
            $numEmployees = rand(2, 3);
        
            for ($i = 0; $i < $numEmployees; $i++) {
                $name = $faker->firstName . ' ' . $faker->lastName;
                $idNumber = $faker->unique()->randomNumber(8);
                $dateOfBirth = $faker->dateTimeBetween('-72 years', '-19 years')->format('Y-m-d');
                $address = $faker->streetAddress;
                $email = 'mail' . ($num) . '@company.com';
                $phone = '06-'. strval($faker->randomNumber(5)) . strval($faker->randomNumber(4));
                $notes = null;
                $num++;
                DB::table('employees')->insert([
                    'name' => $name,
                    'id_number' => $idNumber,
                    'department_code' => 'D' . str_pad(dechex($departmentCode), 3, '0', STR_PAD_LEFT),
                    'date_of_birth' => $dateOfBirth,
                    'address' => $address,
                    'email' => $email,
                    'phone' => $phone,
                    'notes' => $notes,
                ]);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No need to define down() method if we're not creating the table
    }

    /**
     * Generate a realistic-looking phone number.
     *
     * @return string
     */
};
