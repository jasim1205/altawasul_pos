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
            $table->unsignedBigInteger('company_id')->index()->nullable();
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->unsignedBigInteger('category_id')->nullable()->index();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->string('product_name');
            $table->string('product_model');
            $table->string('size')->nullable();
            $table->string('description')->nullable();
            $table->string('location_rak')->nullable();
            $table->string('cost_code')->nullable();
            $table->string('oem')->nullable();
            $table->string('cross_reference')->nullable();
            $table->string('origin')->nullable();
            $table->double('cost_unit_price',8,2)->nullable();
            $table->double('sale_price_one',8,2)->nullable();
            $table->double('sale_price_two',8,2)->nullable();
            $table->string('product_image')->nullable();
            $table->string('product_image_two')->nullable();
            $table->string('product_image_three')->nullable();
            $table->string('product_image_four')->nullable();
            $table->integer('status')->default(1)->comment('1=>active 2=>inactive');
            $table->timestamps();
            $table->softDeletes();
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
