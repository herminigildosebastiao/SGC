<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CallNumberUsers extends Migration
{
    public function up()
    {
        Schema::create('call_number_users', function (Blueprint $table) {
            $table->id();
            $table->string('user_code', 11);
            $table->bigInteger('call_number_type_id')->unsigned();
            $table->text('description');
            $table->timestamps();

            $table->foreign('user_code')->references('code')->on('users')->onDelete('cascade');
            $table->foreign('call_number_type_id')->references('id')->on('call_number_types')->onDelete('cascade');
        });
    }

    
    public function down()
    {
        Schema::dropIfExists('call_number_users');
    }
}
