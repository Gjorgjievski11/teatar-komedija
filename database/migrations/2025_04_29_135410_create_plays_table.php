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
        Schema::create('plays', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->integer(column: 'duration', unsigned: true);
            $table->string('short_description')->nullable();
            $table->text('description')->nullable();
            $table->text('poster');
            $table->text('ticket_url');
            $table->integer(column: 'price', unsigned: true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plays');
    }
};
