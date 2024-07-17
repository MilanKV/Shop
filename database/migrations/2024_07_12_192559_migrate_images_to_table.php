<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Move image data from products to images table 
        DB::table('products')->whereNotNull('image')->get()->each(function ($product) {
            DB::table('images')->insert([
                'product_id' => $product->id,
                'photo_name' => $product->image,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        });

        // Drop the image column product table
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('image');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Add the image column back to products table
        Schema::table('table', function (Blueprint $table) {
            $table->string('image')->nullable();
        });

        // Move image data back from images to products table
        DB::table('images')->get()->each(function ($image) {
            DB::table('products')->where('id', $image->product_id)->update([
                'image' => $image->photo_name,
            ]);
        });
    }
};
