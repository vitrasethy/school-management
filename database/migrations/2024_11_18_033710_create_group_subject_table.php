<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('group_subject', function (Blueprint $table) {
            $table->foreignId('group_id')->constrained('groups');
            $table->foreignId('subject_id')->constrained('subjects');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('group_subject');
    }
};
