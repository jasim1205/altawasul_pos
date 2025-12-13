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
        Schema::create('credit_sales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id')->index();
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->date('date');
            $table->string('trn_no')->nullable();
            $table->string('invoice_no')->nullable();
            $table->string('rf_no')->nullable();
            $table->string('explanation')->nullable();
            $table->integer('total_quantity')->nullable();
            $table->decimal('total_before_vat',10,2)->nullable();
            $table->integer('total_tax')->nullable();
            $table->integer('total_discount')->nullable();
            $table->decimal('total_after_vat',10,2)->nullable();
            $table->decimal('pay_amount',10,2)->nullable();
            $table->decimal('due_amount',10,2)->nullable();
            $table->decimal('current_balance',10,2)->nullable();
            $table->string('file')->nullable();
            $table->integer('credit_cash')->nullable()->comment('1=>credit, 2=>cash');
            // $table->integer('status')->default(1)->comment('1=>Unpaid, 2=>Due, 3=>Paid');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('credit_sales');
    }
};
