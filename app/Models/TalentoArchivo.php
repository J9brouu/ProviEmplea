<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TalentoArchivo extends Model
{
    use HasFactory;

    protected $table = 'talento_archivo';

    protected $fillable = [
        'talento_id',
        'tipo_archivo',
        'nombre_archivo',
        'url_archivo',
        'estado',
        'motivo_rechazo',
    ];

    public function talento(): BelongsTo
    {
        return $this->belongsTo(Talento::class);
    }
}
