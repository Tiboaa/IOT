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
        Schema::table('departments', function (Blueprint $table){
            $table->char('code', 4)->change();
        });
        
        Schema::table('employees', function (Blueprint $table) {
            $table->char('department_code', 4)->change();

            $table->foreign('department_code')->references('code')->on('departments')->onDelete('cascade');
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
