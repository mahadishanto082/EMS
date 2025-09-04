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
        Schema::create('refresh_tokens', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id'); // matches $table->id() in employee table
            $table->string('token'); // hashed refresh token
            $table->timestamp('expires_at');
            $table->timestamps();
        
            // Correct table name (singular)
            $table->foreign('employee_id')->references('id')->on('employee')->onDelete('cascade');
        }); 
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('refresh_tokens');
    }
};
