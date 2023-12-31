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
        Schema::create('employee_clocks', function (Blueprint $table) {
            $table->id();
            $table->integer('emp_id')->nullable();
            $table->string('clockType')->nullable();
            $table->date('clock_in')->nullable();
            $table->date('clock_out')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_clocks');
    }
};
