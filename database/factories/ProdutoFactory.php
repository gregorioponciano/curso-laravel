<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Produto;
use App\Models\User;
use App\Models\Categoria; // <-- NOVO: Importa o Model Categoria

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Produto>
 */
class ProdutoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Usa um ID de utilizador existente, ou cria um se não existir.
        $userId = User::inRandomOrder()->value('id') ?? User::factory()->create()->id;

        // NOVO: Usa um ID de categoria existente, ou cria uma se não existir.
        $categoriaId = Categoria::inRandomOrder()->value('id') ?? Categoria::factory()->create()->id;


        return [
            // Outros campos do produto
            'nome' => $this->faker->words(3, true),
            'descricao' => $this->faker->paragraph(),
            'preco' => $this->faker->randomFloat(2, 10, 500),
            'slug' => $this->faker->slug(),
            'imagem' =>     'images/logo.png',

            // Chave estrangeira de Utilizador (já corrigida)
            'id_users' => $userId,

            // CHAVE ESTRANGEIRA CORRIGIDA AGORA:
            'id_categorias' => $categoriaId, // <-- Adicionado para resolver o erro 1364

            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}