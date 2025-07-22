<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CpfOuCnpj implements Rule
{
    public function passes($attribute, $value)
    {
        $value = preg_replace('/\D/', '', $value);
        if (strlen($value) === 11) {
            return $this->validaCPF($value);
        } elseif (strlen($value) === 14) {
            return $this->validaCNPJ($value);
        }
        return false;
    }

    public function message()
    {
        return 'O campo :attribute não é um CPF ou CNPJ válido.';
    }

    private function validaCPF($cpf)
    {
        if (preg_match('/(\d)\1{10}/', $cpf)) return false;
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) return false;
        }
        return true;
    }

    private function validaCNPJ($cnpj)
    {
        if (preg_match('/(\d)\1{13}/', $cnpj)) return false;
        $t = strlen($cnpj) - 2;
        $n = substr($cnpj, 0, $t);
        $d = substr($cnpj, $t);
        $s = 0;
        $j = 5;
        $k = 6;
        for ($i = 0; $i < $t; $i++) {
            $s += $n[$i] * $j;
            $j--;
            if ($j < 2) $j = 9;
        }
        $r = $s % 11 < 2 ? 0 : 11 - $s % 11;
        if ($r != $d[0]) return false;
        $s = 0;
        for ($i = 0; $i < $t + 1; $i++) {
            $s += $cnpj[$i] * $k;
            $k--;
            if ($k < 2) $k = 9;
        }
        $r = $s % 11 < 2 ? 0 : 11 - $s % 11;
        if ($r != $d[1]) return false;
        return true;
    }
}
