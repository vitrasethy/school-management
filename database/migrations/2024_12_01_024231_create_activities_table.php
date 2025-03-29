<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('subject_id')->constrained('subjects');
            $table->foreignId('group_id')->constrained('groups');
            $table->foreignId('activity_type_id')->constrained('activity_types');
            $table->integer('duration')->nullable();
            $table->dateTime('due_at');
            $table->foreignId('teacher_id')->constrained('users', 'id');
            $table->foreignId('form_id')->constrained('forms', 'id');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('activities');
    }
};
