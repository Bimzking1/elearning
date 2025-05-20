<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('task_submissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('task_id')->constrained()->onDelete('cascade');
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->text('submission_text')->nullable();
            $table->string('submission_file')->nullable(); // path to uploaded file
            $table->integer('score')->nullable(); // score given by teacher
            $table->text('comments')->nullable(); // comments from teacher or admin
            $table->timestamps(); // includes submitted_at and updated_at
        });
    }

    public function down(): void {
        Schema::dropIfExists('task_submissions');
    }
};
