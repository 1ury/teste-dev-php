<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class CnpjService
{
    public function buscar(string $cnpj)
    {
        $cnpj = preg_replace('/\D/', '', $cnpj); // limpa pontos e traços

        if (strlen($cnpj) !== 14) {
            return ['erro' => 'CNPJ inválido'];
        }

        $url = "https://brasilapi.com.br/api/cnpj/v1/{$cnpj}";

        $response = Http::get($url);

        if ($response->successful()) {
            return $response->json();
        }

        return ['erro' => 'CNPJ não encontrado ou serviço indisponível'];
    }
}
