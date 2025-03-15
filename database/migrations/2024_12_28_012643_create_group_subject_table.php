<?php

use App\Models\Group;
use App\Models\Subject;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('group_subject', function (Blueprint $table) {
            $table->foreignIdFor(Group::class)->constrained();
            $table->foreignIdFor(Subject::class)->constrained();
            $table->foreignId('teacher_id')->constrained('users');
            $table->float('pass_score')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('group_subject');
    }
};
