<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TalentoIdioma extends Model
{
    protected $table = 'talento_idiomas';

    protected $fillable = ['talento_id', 'nombre_idioma', 'nivel'];

    public function talento(): BelongsTo
    {
        return $this->belongsTo(Talento::class);
    }
}
