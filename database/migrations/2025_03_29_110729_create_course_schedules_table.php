<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('course_schedules', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("selected_course");
            $table->foreign("selected_course")->references("id")->on("courses")->onUpdate("cascade")->onDelete("cascade");

            $table->date("event_date");
            $table->time("event_start");
            $table->time("event_end");
            $table->string("event_theme");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_schedules');
    }
};
