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
        Schema::create('leave_incentives', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Manlist::class)->constrained()->cascadeOnDelete();
            $table->string('SIL')->nullable();
            $table->string('SL')->nullable();
            $table->string('VL')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leave_incentives');
    }
};
