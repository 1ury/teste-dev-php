<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use App\Models\Fornecedor;

interface FornecedorRepositoryInterface
{
    public function all(Request $request);
    public function find(Fornecedor $fornecedor);
    public function create(array $data);
    public function update(array $data, Fornecedor $fornecedor);
    public function delete(Fornecedor $fornecedor);
}
