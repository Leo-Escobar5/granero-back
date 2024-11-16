<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tTodo extends Model
{
    use HasFactory;

    protected $table = 't_todo';

    protected $primaryKey = 'A';

    protected $fillable = [
        'P',
        'Du',
        'Prdd',
        'Tarea',
        'Descripcion',
        'Seguimiento',
        'Creado',
        'Limite',
        'Terminado',
        'Ao',
        'Bo',
        'Co',
        'Do',
        'Eo',
        'Fo',
        'Go',
        'Ho',
        'Io',
        'PCS',
        'Estado',
        'Created_By',
        'Created',
        'Updated_By',
        'Updated',
    ];

    public $timestamps = false;

    // Define la relación con el modelo tPrsn
    public function tPrsn()
    {
        return $this->belongsTo(tPrsn::class, 'P');
    }
}
