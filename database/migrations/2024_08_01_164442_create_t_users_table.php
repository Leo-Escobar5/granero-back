<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_users', function (Blueprint $table) {
            $table->id('ID_Usuario');
            $table->string('Nombre_Usuario');
            $table->string('Usuario', 255)->nullable();
            $table->string('Pass', 255)->nullable();
            $table->char('Rol', 10)->nullable();
            $table->boolean('Admin');
            $table->boolean('TablaEmpresas');
            $table->boolean('Empleados');
            $table->boolean('Permisos');
            $table->boolean('UsuariosData');
            $table->boolean('Mostrar_Cinta_Opciones');
            $table->boolean('Activar_Shift');
            $table->string('Correo_Electronico', 255)->nullable(); // Campo de correo electrónico añadido
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
        Schema::dropIfExists('t_users');
    }
}
