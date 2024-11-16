<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tLctn extends Model
{
    use HasFactory;

    protected $table = 'tLctn'; // Nombre de la tabla en minúsculas sin subrayado

    protected $primaryKey = 'Of';

    protected $fillable = [
        'O',
        'Name',
        'URL',
        'SWB',
        'SWB2',
        'Domicilio',
        'Colonia',
        'City',
        'State',
        'Zip',
        'GPS',
        'Matriz',
        'Pais',
        'MapEP',
        'Nota',
        'Created_By',
        'Created',
        'Updated',
        'Updated_By',
        'upsize_ts'
    ];

    public $timestamps = false;

    protected $casts = [
        'Created' => 'datetime',
        'Updated' => 'datetime',
        'upsize_ts' => 'timestamp',
    ];

    // Definir la relación con tPrsn
    public function tPrsns()
    {
        return $this->hasMany(tPrsn::class, 'Of', 'Of');
    }

    // Definir la relación con tCmpy
    public function tCmpy()
    {
        return $this->belongsTo(tCmpy::class, 'O', 'O');
    }
}
