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
        Schema::create('cleaning_assignment_reschedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cleaning_assignment_id')->constrained('cleaning_assignments')->onDelete('cascade');
            $table->date('requested_date');
            $table->time('requested_time');
            $table->text('reason')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->text('manager_response_note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cleaning_assignment_reschedules');
    }
};
