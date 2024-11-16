<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTCmpyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tCmpy', function (Blueprint $table) {
            $table->increments('O'); // Primary key
            $table->string('Nombre')->nullable();
            $table->integer('Rs')->nullable();
            $table->boolean('Ac')->default(0);
            $table->string('Type')->nullable();
            $table->string('Industry')->nullable();
            $table->string('SerPro')->nullable();
            $table->string('Origen')->nullable();
            $table->string('URL')->nullable();
            $table->string('Linkedin')->nullable();
            $table->string('eMail')->nullable();
            $table->integer('Fnd')->nullable();
            $table->float('Emplea')->nullable();
            $table->float('Ventas')->nullable();
            $table->string('Ref')->nullable();
            $table->text('Nota')->nullable();
            $table->string('Company_State')->nullable();
            $table->string('Shared_With')->nullable();
            $table->string('Created_By')->nullable();
            $table->timestamp('Created')->nullable();
            $table->timestamp('Updated')->nullable();
            $table->string('Updated_By')->nullable();
            $table->timestamp('upsize_ts')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tCmpy');
    }
}
