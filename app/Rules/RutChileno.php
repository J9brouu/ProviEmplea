<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class RutChileno implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $rut = preg_replace('/[.\s]/', '', strtoupper(trim($value)));

        if (!preg_match('/^\d{7,8}-[\dK]$/', $rut)) {
            $fail('El RUT ingresado no es válido.');
            return;
        }

        [$cuerpo, $dv] = explode('-', $rut);

        if ($this->calcularDv((int) $cuerpo) !== $dv) {
            $fail('El dígito verificador del RUT no es correcto.');
        }
    }

    private function calcularDv(int $rut): string
    {
        $suma   = 0;
        $factor = 2;

        while ($rut > 0) {
            $suma   += ($rut % 10) * $factor;
            $rut     = (int) ($rut / 10);
            $factor  = $factor === 7 ? 2 : $factor + 1;
        }

        $resultado = 11 - ($suma % 11);

        return match ($resultado) {
            11      => '0',
            10      => 'K',
            default => (string) $resultado,
        };
    }
}
