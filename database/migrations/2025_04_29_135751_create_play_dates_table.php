<?php

use App\Models\Play;
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
        Schema::create('play_dates', function (Blueprint $table) {
            $table->id();
            $table->string('google_calendar_id');
            $table->foreignIdFor(Play::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->dateTime('played_at');
            $table->unique(['play_id', 'played_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('play_dates');
    }
};
