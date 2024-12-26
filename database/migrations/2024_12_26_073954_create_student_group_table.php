<?php

use App\Models\Group;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('student_group', function (Blueprint $table) {
            $table->foreignIdFor(Group::class)->constrained();
            $table->foreignId('student_id')->constrained('users');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_group');
    }
};
