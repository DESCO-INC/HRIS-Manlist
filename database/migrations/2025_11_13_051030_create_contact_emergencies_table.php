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
        Schema::create('contact_emergencies', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Manlist::class)->constrained()->cascadeOnDelete();
            $table->string('contact_person')->nullable();
            $table->string('relationship')->nullable();
            $table->string('contact_number')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_emergencies');
    }
};
