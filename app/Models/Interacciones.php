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
    //ESTADO TEXTO
    public function getEstadoTextoAttribute()
    {
        return match ($this->estado) {

            'pendiente' => 'Pendiente',

            'activo' => 'Aprobado',

            'rechazado' => 'Rechazado',

            'en_revision' => 'En revisión',

            'finalizado' => 'Finalizado',

            default => 'Sin estado'
        };
    }

    //COLOR ESTADO
    public function getEstadoColorAttribute()
    {
        return match ($this->estado) {

            'pendiente' => 'bg-yellow-100 text-yellow-700',

            'activo' => 'bg-green-100 text-green-700',

            'rechazado' => 'bg-red-100 text-red-700',

            'en_revision' => 'bg-blue-100 text-blue-700',

            'finalizado' => 'bg-gray-100 text-gray-700',

            default => 'bg-gray-100 text-gray-700'
        };
    }
}
