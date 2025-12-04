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
        Schema::create('compensation', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Manlist::class)->constrained()->cascadeOnDelete();
            $table->string('daily_rate')->nullable();
            $table->string('monthly_rate')->nullable();
            $table->string('meal_subsidy')->nullable();
            $table->string('meal_allowance')->nullable();
            $table->string('rice_subsidy')->nullable();
            $table->string('spa_allowance')->nullable();
            $table->string('transpo_assistance')->nullable();
            $table->string('clothing_allowance')->nullable();
            $table->string('transpo_allowance')->nullable();
            $table->string('communication_allowance')->nullable();
            $table->string('project_allowance')->nullable();
            $table->string('technical_allowance')->nullable();
            $table->string('positional_allowance')->nullable();
            $table->string('professional_allowance')->nullable();
            $table->string('housing_allowance')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compensation');
    }
};
