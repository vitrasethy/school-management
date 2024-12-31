<?php

use App\Models\Group;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('group_user', function (Blueprint $table) {
            $table->foreignIdFor(Group::class)->constrained();
            $table->foreignId(User::class)->constrained();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_group');
    }
};
