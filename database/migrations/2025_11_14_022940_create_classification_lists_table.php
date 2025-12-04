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
        Schema::create('classification_lists', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->timestamps();
        });

        // 🧩 Insert initial classification data
        DB::table('classification_lists')->insert([
            ['name' => 'RANK & FILE'],
            ['name' => 'SUPERVISORY'],
            ['name' => 'MANAGERIAL'],
            ['name' => 'EXECUTIVE'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classification_lists');
    }
};
