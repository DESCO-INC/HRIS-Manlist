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
        Schema::create('licensure_lists', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->timestamps();
        });

        // 🧩 Insert initial licensure data
        DB::table('licensure_lists')->insert([
            ['name' => 'NON REGISTERED – MECHANICAL ENGINEER'],
            ['name' => 'NON REGISTERED – ELECTRICAL ENGINEER'],
            ['name' => 'NON REGISTERED – CIVIL ENGINEER'],
            ['name' => 'NON REGISTERED – INDUSTRIAL ENGINEER'],
            ['name' => 'NON REGISTERED – PETROLEUM ENGINEER'],
            ['name' => 'NON REGISTERED – ELECTRONICS COMMUNICATION ENGINEERING'],
            ['name' => 'NON REGISTERED – CHEMICAL ENGINEER'],
            ['name' => 'REGISTERED MECHANICAL ENGINEER'],
            ['name' => 'REGISTERED CIVIL ENGINEER'],
            ['name' => 'REGISTERED ELECTRICAL ENGINEER'],
            ['name' => 'REGISTERED CHEMICAL ENGINEER'],
            ['name' => 'REGISTERED ELECTRONICS COMMUNICATION ENGINEERING'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('licensure_lists');
    }
};
