<?php

namespace App\Repositories\Eloquent;

use App\Models\Fornecedor;
use Illuminate\Http\Request;
use App\Repositories\FornecedorRepositoryInterface;

class FornecedorRepository implements FornecedorRepositoryInterface
{
    /**
     * Retorna todos os fornecedores com paginação e filtros.
     *
     * @param Request $request
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function all(Request $request)
    {
        $query = Fornecedor::query();

        if ($request->filled('nome')) {
            $query->where('nome', 'like', '%' . $request->nome . '%');
        }

        if ($request->filled('documento')) {
            $query->where('documento', $request->documento);
        }

        $sortBy = $request->get('sort_by', 'id');
        $sortDir = $request->get('sort_dir', 'desc');
        $query->orderBy($sortBy, $sortDir);

        // Paginação
        $perPage = $request->get('per_page', 10);
        $fornecedores = $query->paginate($perPage);

        return $fornecedores;
    }
    /**
     * Encontra um fornecedor específico.
     *
     * @param Fornecedor $fornecedor
     * @return Fornecedor
     */
    public function find(Fornecedor $fornecedor)
    {
        return $fornecedor;
    }
    /**
     * Cria um novo fornecedor.
     *
     * @param array $data
     * @return Fornecedor
     */
    public function create(array $data)
    {
        return Fornecedor::create($data);
    }
    /**
     * Atualiza um fornecedor existente.
     *
     * @param array $data
     * @param Fornecedor $fornecedor
     * @return Fornecedor
     */
    public function update(array $data, Fornecedor $fornecedor)
    {
        $fornecedor->update($data);
        return $fornecedor;
    }
    /**
     * Exclui um fornecedor.
     *
     * @param Fornecedor $fornecedor
     * @return bool|null
     */
    public function delete(Fornecedor $fornecedor)
    {
        return $fornecedor->delete();
    }
}
