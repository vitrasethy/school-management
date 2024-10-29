<?php

use App\Models\Role;
use App\Models\School;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('role_assignments', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Role::class)->constrained()->cascadeOnDelete();
            $table->string('role_assignmentable_type');
            $table->integer('role_assignmentable_id');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('role_assignments');
    }
};
