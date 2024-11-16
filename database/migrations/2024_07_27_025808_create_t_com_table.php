<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTComTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tCom', function (Blueprint $table) {
            $table->increments('L'); // Primary key
            $table->unsignedInteger('P')->nullable(); // Foreign key to tPrsn
            $table->dateTime('Fecha')->nullable();
            $table->string('Ow')->nullable();
            $table->string('ComTy')->nullable();
            $table->text('Contenido')->nullable();
            $table->dateTime('Segui')->nullable();
            $table->string('Created_By')->nullable();
            $table->timestamp('Created')->nullable();
            $table->timestamp('Updated')->nullable();
            $table->string('Updated_By')->nullable();
            $table->timestamp('upsize_ts')->nullable();

            // Definir relación con tPrsn
            $table->foreign('P')->references('P')->on('tPrsn')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tCom');
    }
}
