<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Perfeccionamiento extends Model
{
    protected $table = 'perfeccionamiento';

    protected $fillable = [
        'talento_id',
        'tipo',
        'institucion',
        'nombre_curso',
        'ingreso',
        'egreso',
    ];

    public function talento(): BelongsTo
    {
        return $this->belongsTo(Talento::class);
    }
}
