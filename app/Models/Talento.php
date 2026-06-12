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

    public function idiomas(): HasMany
    {
        return $this->hasMany(\App\Models\TalentoIdioma::class, 'talento_id');
    }

    public function porcentajeCompletitud(): int
    {
        $puntos = 0;

        // Datos básicos (30 pts)
        if (!empty($this->user?->name))           $puntos += 5;
        if (!empty($this->user?->email))          $puntos += 5;
        if (!empty($this->edad))                  $puntos += 5;
        if (!empty($this->genero))                $puntos += 5;
        if (!empty($this->telefono))              $puntos += 5;
        if (!empty($this->direccion))             $puntos += 5;

        // Resumen (10 pts)
        if (!empty($this->resumen))               $puntos += 10;

        // Condiciones laborales (15 pts)
        if (($this->renta_desde ?? 0) > 0)        $puntos += 5;
        if (!empty($this->condicion_jornada))     $puntos += 5;
        if (!empty($this->condicion_modalidad))   $puntos += 5;

        // Educación (15 pts)
        if ($this->antecedentesEducacionales()->exists()) $puntos += 15;

        // Experiencia (15 pts)
        if ($this->antecedentesLaborales()->exists())     $puntos += 15;

        // Competencias (10 pts)
        if ($this->competenciasTecnicas()->exists())      $puntos += 10;

        // Documentos (5 pts)
        if ($this->talentoArchivos()->exists())           $puntos += 5;

        return min($puntos, 100);
    }
}
