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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique()->nullable();
            $table->string('image')->nullable();
            $table->text('description')->nullable();
            $table->integer('parent')->nullable()->default(0);
            $table->boolean('status')->default(0);
            $table->enum('seo_status',['Index', 'NoIndex', 'Default'])
                ->default('Default');
            $table->string('seo_title')->nullable();
            $table->string('seo_description')->nullable();
            $table->string('url')->nullable();
            $table->timestamps();
        });
        Schema::create('category_product', function (Blueprint $table) {
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onDelete('cascade');
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->
            references('id')->
            on('products')->
            onDelete('cascade');
            $table->primary(['category_id', 'product_id']);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('category_product');
        Schema::dropIfExists('categories');
    }
};
