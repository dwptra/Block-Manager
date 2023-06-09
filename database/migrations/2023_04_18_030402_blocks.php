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
        Schema::create('blocks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->char('block_name');
            $table->text('description')->nullable();
            $table->char('main_image');
            $table->char('mobile_image');
            $table->char('sample_image_1');
            $table->char('sample_image_2');
            $table->timestamps();
            
            $table->foreign('category_id')->references('id')->on('block_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blocks');
    }
};
