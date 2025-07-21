<?php

namespace App\Http\Controllers;


use App\Models\Fornecedor;
use Illuminate\Http\Request;
use App\Http\Requests\StoreFornecedorRequest;
use App\Http\Requests\UpdateFornecedorRequest;
use App\Repositories\FornecedorRepositoryInterface;


/**
 * @OA\Tag(
 *     name="Fornecedores",
 *     description="Operações relacionadas aos fornecedores"
 * )
 */
class FornecedorController extends Controller
{
    protected $repository;

    public function __construct(FornecedorRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @OA\Get(
     *     path="/api/fornecedores",
     *     summary="Listar fornecedores",
     *     tags={"Fornecedores"},
     *     @OA\Parameter(name="nome", in="query", description="Filtrar por nome", @OA\Schema(type="string")),
     *     @OA\Parameter(name="documento", in="query", description="Filtrar por documento", @OA\Schema(type="string")),
     *     @OA\Parameter(name="sort_by", in="query", description="Campo de ordenação", @OA\Schema(type="string", example="nome")),
     *     @OA\Parameter(name="sort_dir", in="query", description="Direção da ordenação", @OA\Schema(type="string", enum={"asc", "desc"})),
     *     @OA\Parameter(name="per_page", in="query", description="Itens por página", @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Lista de fornecedores paginada")
     * )
     */
    public function index(Request $request)
    {
        $fornecedores = $this->repository->all($request);
        return response()->json($fornecedores);
    }
    /**
     * @OA\Post(
     *     path="/api/fornecedores",
     *     summary="Criar fornecedor",
     *     tags={"Fornecedores"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"nome","documento"},
     *             @OA\Property(property="nome", type="string", example="Empresa XYZ"),
     *             @OA\Property(property="documento", type="string", example="04252011000110"),
     *             @OA\Property(property="telefone", type="string", example="11999999999"),
     *             @OA\Property(property="email", type="string", example="contato@empresa.com"),
     *             @OA\Property(property="endereco", type="string", example="Rua A, 123")
     *         )
     *     ),
     *     @OA\Response(response=201, description="Fornecedor criado com sucesso")
     * )
     */
    public function store(StoreFornecedorRequest $request)
    {
        $fornecedor = $this->repository->create($request->validated());
        return response()->json($fornecedor, 201);
    }
    
    /**
     * @OA\Get(
     *     path="/api/fornecedores/{id}",
     *     summary="Exibir fornecedor",
     *     tags={"Fornecedores"},
     *     @OA\Parameter(name="id", in="path", required=true, description="ID do fornecedor", @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Dados do fornecedor"),
     *     @OA\Response(response=404, description="Fornecedor não encontrado")
     * )
     */
    public function show(Fornecedor $fornecedor)
    {
        return response()->json($this->repository->find($fornecedor));
    }
    /**
     * @OA\Put(
     *     path="/api/fornecedores/{id}",
     *     summary="Atualizar fornecedor",
     *     tags={"Fornecedores"},
     *     @OA\Parameter(name="id", in="path", required=true, description="ID do fornecedor", @OA\Schema(type="integer")),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="nome", type="string", example="Nome atualizado"),
     *             @OA\Property(property="telefone", type="string", example="11988888888"),
     *             @OA\Property(property="email", type="string", example="atualizado@email.com"),
     *             @OA\Property(property="endereco", type="string", example="Rua Nova, 456")
     *         )
     *     ),
     *     @OA\Response(response=200, description="Fornecedor atualizado com sucesso"),
     *     @OA\Response(response=404, description="Fornecedor não encontrado")
     * )
     */
    public function update(UpdateFornecedorRequest  $request, Fornecedor $fornecedor)
    {
        $dados = $request->validated();
        $fornecedor = $this->repository->update($dados, $fornecedor);
        return response()->json($fornecedor);
    }
     /**
     * @OA\Delete(
     *     path="/api/fornecedores/{id}",
     *     summary="Remover fornecedor",
     *     tags={"Fornecedores"},
     *     @OA\Parameter(name="id", in="path", required=true, description="ID do fornecedor", @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Fornecedor removido com sucesso"),
     *     @OA\Response(response=404, description="Fornecedor não encontrado")
     * )
     */
    public function destroy(Fornecedor $fornecedor)
    {
        $this->repository->delete($fornecedor);
        return response()->json(['mensagem' => 'Fornecedor removido com sucesso.']);
    }
}
