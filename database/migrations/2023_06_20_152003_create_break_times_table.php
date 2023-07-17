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
        Schema::create('break_times', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('emp_id');
            $table->string('break_type')->nullable();
            $table->string('break_in')->nullable();
            $table->string('started_date')->nullable();
            $table->string('started_at')->nullable();
            $table->string('start_ip')->nullable();
            $table->string('break_end')->nullable();
            $table->string('ended_date')->nullable();
            $table->string('ends_at')->nullable();
            $table->string('ends_ip')->nullable();
            $table->string('total')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('break_times');
    }
};
