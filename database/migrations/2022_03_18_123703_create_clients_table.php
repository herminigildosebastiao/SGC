<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->string('code', 11);
            $table->string('name');
            $table->string('last_name');
            $table->bigInteger('type_doc_id')->nullable()->unsigned();
            $table->string('number_doc')->nullable();
            $table->enum('genre', ['M', 'F']);
            $table->date('birth')->nullable();
            $table->string('email')->nullable()->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->rememberToken();
            $table->timestamps();

            $table->primary('code');

            $table->foreign('type_doc_id')->references('id')->on('type_docs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
