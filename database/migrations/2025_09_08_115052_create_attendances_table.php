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
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();

            // Foreign key to employees table
            $table->unsignedBigInteger('employee_id');
            $table->foreign('employee_id')
                  ->references('id')
                  ->on('employee') // আপনার employees table
                  ->onDelete('cascade');

            // Slot reference (nullable if optional)
            $table->unsignedBigInteger('slot_id')->nullable();

            $table->string('status')->default('Present'); // Present/Absent/etc
            $table->timestamp('check_in_time')->nullable();
            $table->timestamp('check_out_time')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
