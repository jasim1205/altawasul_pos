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
            // $table->unsignedBigInteger('purchase_id')->index();
            // $table->foreign('purchase_id')->references('id')->on('purchase_details')->onDelete('cascade');
            $table->unsignedBigInteger('supplier_id')->index();
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade');
            $table->date('date');
            $table->string('tm_no')->nullable();
            $table->string('rf_no')->nullable();
            $table->string('explanation')->nullable();
            $table->integer('total_quantity');
            $table->decimal('total_quantity_amount',10,2)->nullable();
            $table->integer('total_tax')->nullable();
            $table->decimal('total_tax_amount',10,2)->nullable();
            $table->decimal('total_subamount',10,2)->nullable();
            $table->decimal('total_discount',10,2)->nullable();
            $table->decimal('grand_total_amount',10,2);
            $table->decimal('pay_amount',10,2);
            $table->integer('status')->default(1)->comment('1=>Unpaid, 2=>Due, 3=>Paid');
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
