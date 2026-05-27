<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DatosEmpresa extends Model
{
    use HasFactory;

    protected $table = 'datos_empresa';

    protected $fillable = [
        'user_id',
        'rut',
        'telefono',
        'rut_empresa',
        'rubro_empresa',
        'tipo_empresa',
        'presentacion_empresa',
        'beneficios_empresa',
        'validacion',
    ];

    protected $casts = [
        'validacion' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function archivosEmpresa(): HasMany
    {
        return $this->hasMany(ArchivoEmpresa::class, 'datos_empresa_id');
    }

    public function usuariosEmpresa(): HasMany
    {
        return $this->hasMany(UsuariosEmpresa::class, 'datos_empresa_id');
    }

    public function interacciones(): HasMany
    {
        return $this->hasMany(Interacciones::class, 'datos_empresa_id');
    }
}
