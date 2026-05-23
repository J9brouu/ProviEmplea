<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CompetenciasTecnicas extends Model
{
    protected $table = 'competencias_tecnicas';

    protected $fillable = [
        'talento_id',
        'nombre_competencia',
    ];

    public function talento(): BelongsTo
    {
        return $this->belongsTo(Talento::class);
    }
}
