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
        Schema::create('employment_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->timestamps();
        });

        // 🧩 Insert initial employment statuses
        DB::table('employment_statuses')->insert([
            ['name' => 'REGULAR'],
            ['name' => 'PROBITIONARY'],
            ['name' => 'CONTRACTUAL'],
            ['name' => 'PROJECT-BASED'],
            ['name' => 'CASUAL'],
            ['name' => 'INTERN/OJT'],
            ['name' => 'RESIGNED'],
            ['name' => 'SEPERATED'],
            ['name' => 'TERMINATED'],
            ['name' => 'AWOL'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employment_statuses');
    }
};
