<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RegisterAccount extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cuentasRegistradas', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('account_target');
            $table->foreignId('user_origin_id')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('user_target_id')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cuentasRegistradas');
    }
}
