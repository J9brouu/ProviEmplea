<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AntecedentesEducacionales extends Model
{
    use HasFactory;

    protected $table = 'antecedentes_educacionales';

    protected $fillable = [
        'talento_id',
        'nombre_institucion',
        'ingreso',
        'egreso',
        'completo',
        'titulo',
    ];

    protected $casts = [
        'completo' => 'boolean',
    ];

    public function talento(): BelongsTo
    {
        return $this->belongsTo(Talento::class);
    }
}
