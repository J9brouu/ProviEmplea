<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AntecedentesLaborales extends Model
{
    use HasFactory;
    protected $table = 'antecedentes_laborales';

    protected $fillable = [
        'talento_id',
        'institucion_o_empresa',
        'ingreso',
        'egreso',
        'cargo',
        'funciones',
        'referencia_nombre',
        'referencia_telefono',
        'referencia_correo',
        'referencia_cargo',
    ];

    public function talento(): BelongsTo
    {
        return $this->belongsTo(Talento::class);
    }
}
