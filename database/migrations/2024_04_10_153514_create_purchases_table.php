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
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('purchase_id')->index();
            $table->foreign('purchase_id')->references('id')->on('purchase_details')->onDelete('cascade');
            $table->unsignedBigInteger('supplier_id')->index();
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade');
            $table->date('date');
            $table->integer('total_quantity');
            $table->integer('total_tax')->nullable();
            $table->integer('total_subamount')->nullable();
            $table->integer('total_discount')->nullable();
            $table->integer('grand_total_amount');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchases');
    }
};
