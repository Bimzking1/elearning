<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        // PRESENCES
        Schema::create('presences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('schedule_id')->constrained()->onDelete('cascade');
            $table->string('name'); // e.g. "Week 1 Attendance"
            $table->timestamp('opened_at');
            $table->timestamp('reopened_at')->nullable();
            $table->timestamp('closed_at')->nullable();
            $table->timestamps();
        });

        // PRESENCE SUBMISSIONS
        Schema::create('presence_submissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('presence_id')->constrained()->onDelete('cascade');
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->string('photo_path')->nullable(); // Selfie
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('presence_submissions');
        Schema::dropIfExists('presences');
    }
};
