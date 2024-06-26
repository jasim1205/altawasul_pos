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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id')->index();
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->date('date');
            $table->integer('total_quantity');
            $table->decimal('total_quantity_amount',10,2)->nullable();
            $table->integer('total_tax')->nullable();
            $table->decimal('total_subamount',10,2)->nullable();
            $table->integer('total_discount')->nullable();
            $table->decimal('grand_total_amount',10,2);
            $table->integer('status')->default(1)->comment('1=>Unpaid 2=>Paid');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
