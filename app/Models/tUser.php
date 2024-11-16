<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class tUser extends Authenticatable
{
    use Notifiable;

    protected $table = 't_users';
    // Especificar la clave primaria
    protected $primaryKey = 'ID_Usuario';

    protected $fillable = [
        'Nombre_Usuario',
        'Usuario',
        'Pass',
        'Rol',
        'Admin',
        'TablaEmpresas',
        'Empleados',
        'Permisos',
        'UsuariosData',
        'Mostrar_Cinta_Opciones',
        'Activar_Shift',
        'Correo_Electronico', // Campo de correo electrónico añadido
    ];

    protected $hidden = [
        'Pass',
        'remember_token',
    ];
}
