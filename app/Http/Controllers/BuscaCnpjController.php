<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CnpjService;

/**
 * @OA\Tag(
 *     name="Consulta Externa",
 *     description="Endpoints para buscar informações públicas de CNPJ usando a BrasilAPI"
 * )
 */
class BuscaCnpjController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/busca-cnpj/{cnpj}",
     *     summary="Buscar dados públicos de um CNPJ na BrasilAPI",
     *     description="Consulta informações públicas de um CNPJ válido utilizando a BrasilAPI.",
     *     operationId="buscarCnpj",
     *     tags={"Consulta Externa"},
     *     @OA\Parameter(
     *         name="cnpj",
     *         in="path",
     *         required=true,
     *         description="Número do CNPJ (apenas números, sem formatação)",
     *         @OA\Schema(type="string", example="19131243000197")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Dados do CNPJ retornados com sucesso",
     *         @OA\JsonContent(
     *             @OA\Property(property="razao_social", type="string", example="EMPRESA EXEMPLO LTDA"),
     *             @OA\Property(property="nome_fantasia", type="string", example="EXEMPLO COMÉRCIO"),
     *             @OA\Property(property="cnpj", type="string", example="19131243000197"),
     *             @OA\Property(property="cep", type="string", example="01001-000"),
     *             @OA\Property(property="municipio", type="string", example="São Paulo"),
     *             @OA\Property(property="uf", type="string", example="SP")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="CNPJ não encontrado ou inválido",
     *         @OA\JsonContent(
     *             @OA\Property(property="erro", type="string", example="CNPJ inválido ou não encontrado")
     *         )
     *     )
     * )
     */
    public function buscar($cnpj, CnpjService $service)
    {
        $dados = $service->buscar($cnpj);

        if (isset($dados['erro'])) {
            return response()->json(['erro' => $dados['erro']], 404);
        }

        return response()->json($dados);
    }
}
