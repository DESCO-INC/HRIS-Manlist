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
        Schema::create('projectassigned_lists', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->timestamps();
        });

        // 🧩 Insert initial project assigned data
        DB::table('projectassigned_lists')->insert([
            ['name' => 'ANGAT REHAB'],
            ['name' => 'APRI BINARY'],
            ['name' => 'PIONEER 1'],
            ['name' => 'MAKBAN – INSULATION'],
            ['name' => 'MAKBAN – MECHANICAL'],
            ['name' => 'MAKBAN - CIVIL'],
            ['name' => 'MAKBAN - TVM'],
            ['name' => 'APRI WAREHOUSE'],
            ['name' => 'TIWI – KAP 39'],
            ['name' => 'TIWI – TVM'],
            ['name' => 'TIWI – INSULATION'],
            ['name' => 'TIWI – CIVIL'],
            ['name' => 'TIWI – MECHANICAL'],
            ['name' => 'TIWI – SUPPLY'],
            ['name' => 'BACMAN'],
            ['name' => 'ORMOC'],
            ['name' => 'IASCO'],
            ['name' => 'ALAMINOS'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projectassigned_lists');
    }
};
