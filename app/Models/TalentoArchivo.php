<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TalentoArchivo extends Model
{
    protected $table = 'talento_archivo';

    protected $fillable = [
        'talento_id',
        'tipo_archivo',
        'url_archivo',
    ];

    public function talento(): BelongsTo
    {
        return $this->belongsTo(Talento::class);
    }
}
