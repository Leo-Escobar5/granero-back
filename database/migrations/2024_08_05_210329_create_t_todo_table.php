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
        Schema::create('t_todo', function (Blueprint $table) {
            $table->increments('A'); // Primary key
            $table->unsignedInteger('P')->nullable(); // Foreign key to tPrsn
            $table->string('Du', 255)->nullable();
            $table->string('Prdd', 50)->nullable();
            $table->string('Tarea', 150)->nullable();
            $table->string('Descripcion', 500)->nullable();
            $table->text('Seguimiento')->nullable();
            $table->dateTime('Creado')->nullable();
            $table->dateTime('Limite')->nullable();
            $table->dateTime('Terminado')->nullable();
            $table->boolean('Ao')->nullable();
            $table->boolean('Bo')->nullable();
            $table->boolean('Co')->nullable();
            $table->boolean('Do')->nullable();
            $table->boolean('Eo')->nullable();
            $table->boolean('Fo')->nullable();
            $table->boolean('Go')->nullable();
            $table->boolean('Ho')->nullable();
            $table->boolean('Io')->nullable();
            $table->string('PCS', 255)->nullable();
            $table->string('Estado', 50)->nullable();
            $table->string('Created_By', 255)->nullable();
            $table->dateTime('Created')->nullable();
            $table->string('Updated_By', 255)->nullable();
            $table->dateTime('Updated')->nullable();

            // Definir relación con tPrsn
            $table->foreign('P')->references('P')->on('tPrsn')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_todo');
    }
};
