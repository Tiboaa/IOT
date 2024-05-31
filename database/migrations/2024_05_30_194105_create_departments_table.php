<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepartmentsTable extends Migration
{

    public function up(): void
    {
        Schema::create('departments', function (Blueprint $table) {
            $table->string('code', 4)->primary();
            $table->string('name');
            $table->timestamps();
        });

      #  DB::table('departments')->insert([
       #     ['name' => 'Department A', 'code' => 'DEPA'],
        #    ['name' => 'Department B', 'code' => 'DEPB'],
        #]);
    }


    public function down(): void
    {
        Schema::dropIfExists('departments');
    }
}
