<?php

use App\Models\Department;
use App\Models\SchoolYear;
use App\Models\Semester;
use App\Models\Year;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Department::class)->constrained();

            $table->string('name');
            $table->foreignIdFor(Year::class)->constrained();
            $table->foreignIdFor(SchoolYear::class)->constrained();
            $table->foreignIdFor(Semester::class)->constrained();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('groups');
    }
};
