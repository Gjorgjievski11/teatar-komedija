<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('contribution_play_employee', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('play_employee_id');
            $table->unsignedBigInteger('contribution_id');
            $table->timestamps();

            $table->index('play_employee_id');
            $table->index('contribution_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contribution_play_employee');
    }
};
