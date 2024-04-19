<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\CategoryStatus;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('category_name');
            $table->string('slug')->unique();
            $table->text('short_description')->nullable();
            $table->string('category_image')->nullable();
            $table->boolean('is_parent')->default(true);
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->tinyInteger('status')->default(CategoryStatus::ACTIVE->value);
            $table->foreign('parent_id')->references('id')->on('categories')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
