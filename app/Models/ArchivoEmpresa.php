<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ArchivoEmpresa extends Model
{
    use HasFactory;

    protected $table = 'archivo_empresa';

    protected $fillable = [
        'datos_empresa_id',
        'tipo_archivo',
        'url_archivo',
    ];

    public function datosEmpresa(): BelongsTo
    {
        return $this->belongsTo(DatosEmpresa::class);
    }
}
