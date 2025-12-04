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
        Schema::create('manlists', function (Blueprint $table) {
            $table->id();
            $table->string('emp_number')->unique();
            $table->string('firstname');
            $table->string('middlename');
            $table->string('lastname');
            $table->string('suffix')->nullable();
            $table->string('position');
            $table->string('department');
            $table->string('emp_classification')->nullable();
            $table->string('emp_status')->nullable();
            $table->date('datehired')->nullable();
            $table->string('workbase')->nullable();
            $table->string('temporary_workbase')->nullable();
            $table->string('project_assigned')->nullable();
            $table->date('project_hired')->nullable();
            $table->date('contract_expiration')->nullable();
            $table->date('probitionary_date')->nullable();
            $table->date('regularization_date')->nullable();
            $table->date('seperation_date')->nullable();
            $table->string('seperation_reason')->nullable();
            $table->string('remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('manlists');
    }
};
