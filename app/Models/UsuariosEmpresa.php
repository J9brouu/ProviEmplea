<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UsuariosEmpresa extends Model
{
    use HasFactory;

    protected $table = 'usuarios_empresa';

    protected $fillable = [
        'datos_empresa_id',
        'user_id',
        'telefono',
        'cargo',
    ];

    public function datosEmpresa(): BelongsTo
    {
        return $this->belongsTo(DatosEmpresa::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
