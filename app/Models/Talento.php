<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Talento extends Model
{
    use HasFactory;

    protected $table = 'talento';

    protected $fillable = [
        'user_id',
        'edad',
        'genero',
        'telefono',
        'direccion',
        'resumen',
        'renta_desde',
        'renta_hasta',
        'condicion_jornada',
        'condicion_modalidad',
        'discapacidad',
        'validacion',
    ];

    protected $casts = [
        'validacion' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function antecedentesEducacionales(): HasMany
    {
        return $this->hasMany(AntecedentesEducacionales::class, 'talento_id');
    }

    public function antecedentesLaborales(): HasMany
    {
        return $this->hasMany(AntecedentesLaborales::class, 'talento_id');
    }

    public function competenciasTecnicas(): HasMany
    {
        return $this->hasMany(CompetenciasTecnicas::class, 'talento_id');
    }

    public function perfeccionamientos(): HasMany
    {
        return $this->hasMany(Perfeccionamiento::class, 'talento_id');
    }

    public function talentoArchivos(): HasMany
    {
        return $this->hasMany(TalentoArchivo::class, 'talento_id');
    }

    public function interacciones(): HasMany
    {
        return $this->hasMany(Interacciones::class, 'talento_id');
    }

    
}
