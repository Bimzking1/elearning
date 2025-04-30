<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('teacher_id')->constrained()->onDelete('cascade');
            $table->foreignId('subject_id')->constrained()->onDelete('cascade');
            $table->foreignId('classroom_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('attachment_path')->nullable(); // for PDFs, docs, images, etc.
            $table->dateTime('due_date')->nullable();      // change to due_date
            $table->timestamps(); // includes created_at (used as the publish date), updated_at
        });
    }

    public function down(): void {
        Schema::dropIfExists('tasks');
    }
};
