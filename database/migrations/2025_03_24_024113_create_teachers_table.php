<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('nip')->unique();
            $table->date('date_of_birth')->nullable();
            $table->enum('gender', ['male', 'female']);
            $table->string('phone')->nullable();
            $table->text('address')->nullable();
            $table->string('specialization')->nullable();
            $table->date('joined_date')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('teachers');
    }
};
