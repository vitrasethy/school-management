<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('activity_group', function (Blueprint $table) {
            $table->foreignId('activity_id')->constrained('activities');
            $table->foreignId('group_id')->constrained('groups');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('activity_group');
    }
};
