<?php

namespace App\Database\Seeders;

use App\Models\Produto;
use App\Models\Categoria;

class ProdutoSeeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categoriaModel = new Categoria();
        $categorias = $categoriaModel->all();

        $produtoModel = new Produto();

        $sampleProducts = [
            'Hortifruti' => [
                'Abacaxi Pérola', 'Maçã Fuji (Kg)', 'Banana Nanica (Dúzia)', 'Tomate Italiano', 
                'Cebola Branca', 'Batata Lavada', 'Alface Crespa', 'Limão Siciliano', 
                'Melancia Inteira', 'Mamão Papaia'
            ],
            'Laticínios' => [
                'Leite Integral 1L', 'Queijo Muçarela (Fatiado)', 'Iogurte Natural', 'Manteiga com Sal', 
                'Requeijão Cremoso', 'Creme de Leite', 'Queijo Minas Frescal', 'Leite Condensado', 
                'Iogurte de Morango', 'Leite de Coco'
            ],
            'Açougue' => [
                'Picanha Bovina (Kg)', 'Coxa e Sobrecoxa de Frango', 'Costela Suína', 'Carne Moída Patinho', 
                'Filé de Frango', 'Alcatra com Maminha', 'Lombo Suína', 'ASA de Frango', 
                'Bacon Defumado', 'Linguiça Toscada'
            ],
            'Padaria' => [
                'Pão Francês (Un)', 'Bolo de Cenoura com Cobertura', 'Pão de Queijo Mini', 'Croissant de Presunto', 
                'Rosca Doce', 'Pão de Forma Integral', 'Baguete Italiana', 'Tortinha de Morango', 
                'Sonho de Creme', 'Biscoito de Polvilho'
            ],
            'Limpeza' => [
                'Detergente Neutro', 'Sabão em Pó 1kg', 'Amaciante de Roupas', 'Água Sanitária 2L', 
                'Desinfetante Lavanda', 'Limpador Multiúso', 'Esponja de Aço', 'Saco de Lixo 50L', 
                'Lustra Móveis', 'Inseticida Aerossol'
            ],
            'Higiene e Beleza' => [
                'Sabonete em Barra', 'Shampoo Anticaspa', 'Condicionador Hidratante', 'Creme Dental Branqueador', 
                'Desodorante Roll-on', 'Papel Higiênico (12 rolos)', 'Fio Dental', 'Enxaguante Bucal', 
                'Creme Hidratante Corporal', 'Escova de Dentes Média'
            ],
            'Bebidas' => [
                'Refrigerante Cola 2L', 'Suco de Laranja Natural 1L', 'Água Mineral sem Gás 500ml', 'Cerveja Lata 350ml', 
                'Vinho Tinto Seco', 'Energético Lata', 'Água Tônica', 'Chá Mate Gelado', 
                'Cerveja Artesanal IPA', 'Suco de Uva Integral'
            ],
            'Mercearia' => [
                'Arroz Branco Tipo 1 (5kg)', 'Feijão Carioca (1kg)', 'Macarrão Espaguete', 'Óleo de Soja 900ml', 
                'Açúcar Refinado 1kg', 'Sal Refinado 1kg', 'Café Torrado e Moído', 'Molho de Tomate Sachê', 
                'Azeite de Oliva Extra Virgem', 'Farinha de Trigo Especial'
            ],
            'Congelados' => [
                'Pizza Congelada Calabresa', 'Lasanha à Bolonhesa', 'Hambúrguer de Carne Bovina', 'Nuggets de Frango', 
                'Batata Palito Congelada 1kg', 'Pão de Alho Congelado', 'Sorvete de Chocolate 2L', 'Vegetais Seletos', 
                'Açaí de Pote 500ml', 'Peixe Filé de Tilápia'
            ],
            'Pet Shop' => [
                'Ração Premium Adulto (Cão)', 'Ração Gatos Castrados', 'Petisco para Cães', 'Areia para Gatos', 
                'Brinquedo Mordedor', 'Tapete Higiênico', 'Shampoo para Pets', 'Sachê para Gatos', 
                'Coleira Ajustável', 'Escova para Pelos'
            ]
        ];

        foreach ($categorias as $categoria) {
            $products = $sampleProducts[$categoria->nome] ?? [];
            
            foreach ($products as $i => $nome) {
                $produtoModel->insert([
                    'categoria_id' => $categoria->id,
                    'nome' => $nome,
                    'descricao' => "Descrição detalhada do produto {$nome} que pertence à categoria {$categoria->nome}. Qualidade garantida para o seu lar.",
                    'preco' => rand(5, 100) + (rand(0, 99) / 100),
                    'estoque' => rand(10, 500),
                    'imagem_url' => "https://picsum.photos/seed/" . md5($nome) . "/400/300",
                    'ativo' => true
                ]);
            }
        }
    }
}
