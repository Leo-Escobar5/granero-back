<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tCmpy extends Model
{
    use HasFactory;

    protected $table = 'tCmpy'; // Nombre de la tabla en minúsculas sin subrayado

    protected $primaryKey = 'O';

    protected $fillable = [
        'Nombre',
        'Rs',
        'Ac',
        'Type',
        'Industry',
        'SerPro',
        'Origen',
        'URL',
        'Linkedin',
        'eMail',
        'Fnd',
        'Emplea',
        'Ventas',
        'Ref',
        'Nota',
        'Company_State',
        'Shared_With',
        'Created_By',
        'Created',
        'Updated',
        'Updated_By',
        'upsize_ts'
    ];

    public $timestamps = false;

    protected $casts = [
        'Ac' => 'boolean',
        'Created' => 'datetime',
        'Updated' => 'datetime',
        'upsize_ts' => 'timestamp',
    ];

    // Definir la relación con tLctn
    public function tLctns()
    {
        return $this->hasMany(tLctn::class, 'O', 'O');
    }
}
