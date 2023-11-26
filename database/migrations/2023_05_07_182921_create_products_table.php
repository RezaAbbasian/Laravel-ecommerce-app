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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('slug')->unique()->nullable();
            $table->unsignedBigInteger('parent')->nullable()->default(0);
            $table->string('product_num')->unique();
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->dateTime('sale_start')->nullable();
            $table->dateTime('sale_end')->nullable();
            $table->unsignedInteger('sale')->nullable();
            $table->unsignedInteger('price')->nullable();
            $table->unsignedBigInteger('inventory')->nullable();
            $table->integer('max_order')->default(null)->nullable();
            $table->integer('view_count')->default(0)->nullable();
            $table->boolean('status')->default(0);
            $table->enum('seo_status',['Index', 'NoIndex', 'Default'])
                ->default('Default');
            $table->string('seo_title')->nullable();
            $table->string('seo_description')->nullable();
            $table->string('url')->nullable();
            $table->json('metadata')->nullable();
            $table->enum('type',['simple','variable','grouped','virtual','downloadable'])->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('brand_id')->nullable();
            $table->foreign('brand_id')
                ->references('id')
                ->on('brands');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
