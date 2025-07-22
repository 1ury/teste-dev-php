<?php

namespace Tests\Feature;

use App\Models\Fornecedor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FornecedorTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function pode_criar_um_fornecedor()
    {
        $faker = \Faker\Factory::create('pt_BR');
        $faker->addProvider(new \Faker\Provider\pt_BR\Person($faker));
        $faker->addProvider(new \Faker\Provider\pt_BR\Company($faker));

        $data = [
            'nome' => 'Fornecedor Teste',
            'documento' => $faker->cnpj(false),
            'email' => $faker->unique()->safeEmail,
            'telefone' => $faker->phoneNumber,
        ];

        $response = $this->postJson('/api/fornecedores', $data);

        $response->assertStatus(201)
                 ->assertJsonFragment(['nome' => 'Fornecedor Teste']);

        $this->assertDatabaseHas('fornecedors', ['documento' => $data['documento']]);
    }

    /** @test */
    public function pode_listar_fornecedores()
    {
        Fornecedor::factory()->count(3)->create();

        $response = $this->getJson('/api/fornecedores');

        $response->assertStatus(200)
                 ->assertJsonStructure(['data']);
    }

    /** @test */
    public function pode_visualizar_um_fornecedor()
    {
        $fornecedor = Fornecedor::factory()->create();

        $response = $this->getJson("/api/fornecedores/{$fornecedor->id}");

        $response->assertStatus(200)
                 ->assertJsonFragment(['nome' => $fornecedor->nome]);
    }

    /** @test */
    public function pode_atualizar_um_fornecedor()
    {
        $fornecedor = Fornecedor::factory()->create();

        $data = ['nome' => 'Fornecedor Atualizado'];

        $response = $this->putJson("/api/fornecedores/{$fornecedor->id}", $data);

        $response->assertStatus(200)
                 ->assertJsonFragment(['nome' => 'Fornecedor Atualizado']);
    }

    /** @test */
    public function pode_deletar_um_fornecedor()
    {
        $fornecedor = Fornecedor::factory()->create();

        $response = $this->deleteJson("/api/fornecedores/{$fornecedor->id}");

        $response->assertStatus(200);

        $this->assertDatabaseMissing('fornecedors', ['id' => $fornecedor->id]);
    }
}
