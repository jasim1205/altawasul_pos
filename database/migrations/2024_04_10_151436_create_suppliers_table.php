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
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('supplier_name');
            $table->string('email')->nullable();
            $table->string('contact_no');
            $table->string('trn_no')->nullable();
            $table->text('address')->nullable();
            // $table->unsignedBigInteger('product_id')->index()->nullable();
            // $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->date('date')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suppliers');
    }
};
