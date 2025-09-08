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
        Schema::create('employee_slot', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id');
            $table->unsignedBigInteger('slot_id');
            $table->timestamps();
    
            // Optional: Add foreign keys
            // $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
            // $table->foreign('slot_id')->references('id')->on('slots')->onDelete('cascade');
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_slot');
    }
};
