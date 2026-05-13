<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            ['name' => 'Seguro Veicular', 'short_description' => 'Proteção completa para o seu automóvel.', 'is_featured' => true],
            ['name' => 'Seguro de Vida', 'short_description' => 'Segurança financeira para você e sua família.', 'is_featured' => true],
            ['name' => 'Consórcio', 'short_description' => 'Planejamento inteligente para novos projetos.', 'is_featured' => true],
            ['name' => 'Aluguel de Veículos Anual', 'short_description' => 'Locação de longo prazo e assinatura com previsibilidade.'],
            ['name' => 'Seguro Residencial', 'short_description' => 'Cobertura sob medida para sua casa ou apartamento.'],
            ['name' => 'Petlove', 'short_description' => 'Tudo de melhor para o seu pet.', 'is_featured' => true],
            ['name' => 'Seguro de Moto', 'short_description' => 'Cobertura essencial para quem vive a rotina sobre duas rodas.'],
            ['name' => 'Seguro Viagem', 'short_description' => 'Mais tranquilidade para viagens nacionais e internacionais.'],
            ['name' => 'Saúde/Odonto', 'short_description' => 'Soluções em saúde e odontologia para pessoas e empresas.', 'is_featured' => true],
            ['name' => 'Responsabilidade Civil', 'short_description' => 'Proteção contra danos a terceiros.', 'is_featured' => true],
            ['name' => 'Outros', 'short_description' => 'Produtos complementares conforme a sua necessidade.'],
        ];

        foreach ($products as $index => $product) {
            Product::query()->updateOrCreate(
                ['slug' => Str::slug($product['name'])],
                [
                    'name' => $product['name'],
                    'short_description' => $product['short_description'],
                    'full_description' => $product['short_description'],
                    'is_active' => true,
                    'is_featured' => $product['is_featured'] ?? false,
                    'sort_order' => $index + 1,
                ],
            );
        }
    }
}
