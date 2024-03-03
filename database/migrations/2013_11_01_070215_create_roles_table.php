<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;
return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name',30)->unique();
            $table->string('identity',30)->unique();
            $table->timestamps();
        });
        DB::table('roles')->insert(
            [
                'name' => 'Superadmin',
                'identity' => 'superadmin',
            ],
            [
                'name' => 'Client',
                'identity' => 'Client',
            ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
};
