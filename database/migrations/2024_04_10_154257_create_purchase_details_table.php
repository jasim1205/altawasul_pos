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
        Schema::create('purchase_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('purchase_id')->index();
            $table->foreign('purchase_id')->references('id')->on('purchases')->onDelete('cascade');
            $table->unsignedBigInteger('company_id')->index();
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->unsignedBigInteger('category_id')->nullable()->index();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->unsignedBigInteger('product_id')->index();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->decimal('unit_price',10,2)->default(0);
            $table->integer('quantity')->default(0);
            $table->decimal('amount',10,2)->default(0);
            $table->integer('tax')->nullable();
            $table->decimal('tax_amount',10,2)->default(0);
            $table->decimal('sub_amount',10,2)->default(0);
            $table->integer('discount_type')->comment('0=>amount, 1=>percent')->default(0)->nullable();
            $table->decimal('discount',10,2)->default(0)->nullable();
            $table->decimal('total_amount',10,2)->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_details');
    }
};
