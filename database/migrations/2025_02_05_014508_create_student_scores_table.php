<?php

use App\Models\Activity;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('student_scores', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained();
            $table->foreignIdFor(Activity::class)->constrained();
            $table->float('score');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_scores');
    }
};
