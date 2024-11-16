<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTPrsnTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tPrsn', function (Blueprint $table) {
            $table->increments('P'); // Primary key
            
            $table->integer('Of')->unsigned()->nullable(); // Definir columna 'Of' para la clave foránea
            
            // Otras columnas
            $table->tinyInteger('Out')->nullable();
            $table->string('Nombre')->nullable();
            $table->string('Segundo')->nullable();
            $table->string('APaterno')->nullable();
            $table->string('AMaterno')->nullable();
            $table->string('Prefijo')->nullable();
            $table->string('Sufijo')->nullable();
            $table->string('Puesto')->nullable();
            $table->string('Ext')->nullable();
            $table->string('Linkedin')->nullable();
            $table->string('TCel1')->nullable();
            $table->string('TSwB')->nullable();
            $table->string('TOf')->nullable();
            $table->string('TOf2')->nullable();
            $table->string('TAssist')->nullable();
            $table->string('TCel2')->nullable();
            $table->string('THome')->nullable();
            $table->string('TFax')->nullable();
            $table->string('eMailw')->nullable();
            $table->string('eMailp')->nullable();
            $table->timestamp('Elec')->nullable();
            $table->timestamp('HCPy')->nullable();
            $table->string('Asistente')->nullable();
            $table->timestamp('When')->nullable();
            $table->string('Where')->nullable();
            $table->boolean('PE')->nullable();
            $table->boolean('BS')->nullable();
            $table->boolean('MS')->nullable();
            $table->boolean('PhD')->nullable();
            $table->text('Notas')->nullable();
            $table->string('Created_By')->nullable();
            $table->timestamp('Created')->nullable();
            $table->timestamp('Updated')->nullable();
            $table->string('Updated_By')->nullable();
            $table->timestamp('upsize_ts')->nullable();

            // Definir relación con tLctn
            $table->foreign('Of')->references('Of')->on('tLctn')->onDelete('cascade');
        });

        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        

        Schema::dropIfExists('tPrsn');
    }
}
