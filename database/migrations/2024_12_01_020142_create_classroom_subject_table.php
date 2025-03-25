<?php

use App\Models\Classroom;
use App\Models\Subject;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('classroom_subject', function (Blueprint $table) {
            $table->foreignIdFor(Classroom::class)->constrained();
            $table->foreignIdFor(Subject::class)->constrained();
            $table->time('start_time');
            $table->time('end_time');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('classroom_subject');
    }
};
