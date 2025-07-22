<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fornecedor extends Model
{
    use HasFactory;
    protected $table = 'fornecedors';
    protected $fillable = [
        'nome',
        'documento',
        'telefone',
        'email',
        'endereco',
    ];
}
