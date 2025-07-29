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
            $table->unsignedBigInteger('company_id')->index();
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->unsignedBigInteger('category_id')->nullable()->index();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->string('product_name');
            $table->string('product_model');
            $table->double('unit_price',8,2)->nullable();
            $table->double('old_price',8,2)->nullable();
            $table->string('product_image');
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
