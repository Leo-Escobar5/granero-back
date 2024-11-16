<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tPrsn extends Model
{
    use HasFactory;

    protected $table = 'tPrsn'; // Nombre de la tabla en minúsculas sin subrayado

    protected $primaryKey = 'P';

    protected $fillable = [
        'Of',
        'Out',
        'Nombre',
        'Segundo',
        'APaterno',
        'AMaterno',
        'Prefijo',
        'Sufijo',
        'Puesto',
        'Ext',
        'Linkedin',
        'TCel1',
        'TSwB',
        'TOf',
        'TOf2',
        'TAssist',
        'TCel2',
        'THome',
        'TFax',
        'eMailw',
        'eMailp',
        'Elec',
        'HCPy',
        'Asistente',
        'When',
        'Where',
        'PE',
        'BS',
        'MS',
        'PhD',
        'Notas',
        'Created_By',
        'Created',
        'Updated',
        'Updated_By',
        'upsize_ts'
    ];

    public $timestamps = false;

    protected $casts = [
        'Elec' => 'datetime',
        'HCPy' => 'datetime',
        'When' => 'datetime',
        'Created' => 'datetime',
        'Updated' => 'datetime',
        'upsize_ts' => 'timestamp',
        'PE' => 'boolean',
        'BS' => 'boolean',
        'MS' => 'boolean',
        'PhD' => 'boolean',
    ];

    // Definir la relación con tLctn
    public function tLctn()
    {
        return $this->belongsTo(tLctn::class, 'Of', 'Of');
    }

    // Definir la relación con tCom
    public function tComs()
    {
        return $this->hasMany(tCom::class, 'P', 'P');
    }
}
