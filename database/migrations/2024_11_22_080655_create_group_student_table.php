<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('group_student', function (Blueprint $table) {
            $table->foreignId('group_id')->constrained('groups');
            $table->foreignId('student_id')->constrained('users');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('group_student');
    }
};
