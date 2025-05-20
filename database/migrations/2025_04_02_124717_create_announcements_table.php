<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('announcements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Admin who created the announcement
            $table->string('title');
            $table->text('content');
            $table->json('roles'); // Store audience as JSON array (["teacher", "student"] or ["all"])
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable(); // Nullable for announcements without expiry
            $table->string('attachment')->nullable(); // Store file path
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('announcements');
    }
};
