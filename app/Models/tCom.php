<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tCom extends Model
{
    use HasFactory;

    protected $table = 'tCom'; // Nombre de la tabla en minúsculas sin subrayado

    protected $primaryKey = 'L';

    protected $fillable = [
        'P',
        'Fecha',
        'Ow',
        'ComTy',
        'Contenido',
        'Segui',
        'Created_By',
        'Created',
        'Updated',
        'Updated_By',
        'upsize_ts'
    ];

    public $timestamps = false;

    protected $casts = [
        'Fecha' => 'datetime',
        'Segui' => 'datetime',
        'Created' => 'datetime',
        'Updated' => 'datetime',
        'upsize_ts' => 'timestamp',
    ];

    // Definir la relación con tPrsn
    public function tPrsn()
    {
        return $this->belongsTo(tPrsn::class, 'P', 'P');
    }
}
