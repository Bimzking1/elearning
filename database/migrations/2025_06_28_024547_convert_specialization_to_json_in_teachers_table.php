<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        // Step 1: Convert all existing string specializations into JSON arrays
        $teachers = DB::table('teachers')->get();

        foreach ($teachers as $teacher) {
            // Wrap current specialization string into JSON array
            $jsonValue = json_encode([$teacher->specialization]);
            DB::table('teachers')
              ->where('id', $teacher->id)
              ->update(['specialization' => $jsonValue]);
        }

        // Step 2: Change column type to JSON
        Schema::table('teachers', function (Blueprint $table) {
            $table->json('specialization')->change();
        });
    }

    public function down(): void {
        // Revert to string column
        Schema::table('teachers', function (Blueprint $table) {
            $table->string('specialization')->change();
        });
    }
};
