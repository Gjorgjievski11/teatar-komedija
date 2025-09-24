<?php

use App\Models\Contribution;
use App\Models\Employee;
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
        Schema::create('play_employees', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Play::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignIdFor(Employee::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignIdFor(Contribution::class)->nullable()->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('role_name')->nullable();
            $table->unique(['play_id', 'employee_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('play_employees');
    }
};
