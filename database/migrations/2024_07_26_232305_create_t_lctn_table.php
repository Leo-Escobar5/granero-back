<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTLctnTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tLctn', function (Blueprint $table) {
            $table->increments('Of'); // Primary key
            $table->unsignedInteger('O')->nullable(); // Definir columna 'O' como unsigned integer
            // Otras columnas
            $table->string('Name')->nullable();
            $table->string('URL')->nullable();
            $table->string('SWB')->nullable();
            $table->string('SWB2')->nullable();
            $table->string('Domicilio')->nullable();
            $table->string('Colonia')->nullable();
            $table->string('City')->nullable();
            $table->string('State')->nullable();
            $table->string('Zip')->nullable();
            $table->string('GPS')->nullable();
            $table->integer('Matriz')->nullable();
            $table->string('Pais')->nullable();
            $table->string('MapEP')->nullable();
            $table->text('Nota')->nullable();
            $table->string('Created_By')->nullable();
            $table->timestamp('Created')->nullable();
            $table->timestamp('Updated')->nullable();
            $table->string('Updated_By')->nullable();
            $table->timestamp('upsize_ts')->nullable();

            // Definir relación con tCmpy
            $table->foreign('O')->references('O')->on('tCmpy')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tLctn');
    }
}
