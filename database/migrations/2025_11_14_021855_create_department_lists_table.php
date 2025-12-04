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
        Schema::create('department_lists', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable();
            $table->string('name')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();
        });

        // 🧩 Insert initial department data
        DB::table('department_lists')->insert([
            ['code' => '001', 'name' => 'HRAD', 'description' => 'HRAD Department'],
            ['code' => '002', 'name' => 'ACCOUNTING', 'description' => 'Accounting Department'],
            ['code' => '003', 'name' => 'MAINTENANCE', 'description' => 'Maintenance Department'],
            ['code' => '004', 'name' => 'HSES', 'description' => 'HSES Department'],
            ['code' => '005', 'name' => 'ANGAT', 'description' => 'Angat Department'],
            ['code' => '006', 'name' => 'MAGAT', 'description' => 'Magat Department'],
            ['code' => '007', 'name' => 'ISABEL LEYTE', 'description' => 'Isabel Leyte Department'],
            ['code' => '008', 'name' => 'BACMAN', 'description' => 'Bacman Department'],
            ['code' => '009', 'name' => 'MAKBAN', 'description' => 'Makban Department'],
            ['code' => '010', 'name' => 'ORMOC', 'description' => 'Ormoc Department'],
            ['code' => '011', 'name' => 'TIWI', 'description' => 'Tiwi Department'],
            ['code' => '012', 'name' => 'DRILLING', 'description' => 'Drilling Department'],
            ['code' => '013', 'name' => 'ECP', 'description' => 'ECP Department'],
            ['code' => '014', 'name' => 'MCP', 'description' => 'MCP Department'],
            ['code' => '015', 'name' => 'IT', 'description' => 'IT Department'],
            ['code' => '016', 'name' => 'MSVS', 'description' => 'MSVS Department'],
            ['code' => '017', 'name' => 'OFFICE OF THE PRES', 'description' => 'Office of the President'],
            ['code' => '018', 'name' => 'OFFICE OF THE VP', 'description' => 'Office of the Vice President'],
            ['code' => '019', 'name' => 'OPERATIONS', 'description' => 'Operations Department'],
            ['code' => '020', 'name' => 'QA & ENGINEERING', 'description' => 'QA & Engineering Department'],
            ['code' => '021', 'name' => 'SALES AND MARKETING', 'description' => 'Sales and Marketing Department'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('department_lists');
    }
};
