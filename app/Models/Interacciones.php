<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Interacciones extends Model
{
    protected $table = 'interacciones';

    protected $fillable = [
        'datos_empresa_id',
        'talento_id',
        'estado',
        'notas',
        'fecha_contacto',
    ];

    protected $casts = [
        'fecha_contacto' => 'datetime',
    ];

    public function datosEmpresa(): BelongsTo
    {
        return $this->belongsTo(DatosEmpresa::class);
    }

    public function talento(): BelongsTo
    {
        return $this->belongsTo(Talento::class);
    }
}
