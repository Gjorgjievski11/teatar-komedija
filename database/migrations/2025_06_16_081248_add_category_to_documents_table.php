<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('documents', function (Blueprint $table) {
            // Removed these lines because the columns already exist:
            // $table->unsignedBigInteger('category_id')->after('id');
            // $table->unsignedBigInteger('sub_category_id')->after('category_id');
            // $table->string('url')->after('image_kit_id');
            // If you need to change the type or position, use a separate migration with ->change()
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('documents', function (Blueprint $table) {
            // $table->dropColumn(['category_id', 'sub_category_id', 'url']);
        });
    }
};
