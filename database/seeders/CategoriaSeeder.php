<?php

namespace App\Database\Seeders;

use App\Models\Categoria;

class CategoriaSeeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categorias = [
            [
                'nome' => 'Hortifruti',
                'descricao' => 'Frutas, legumes e verduras frescas colhidas diariamente.'
            ],
            [
                'nome' => 'Laticínios',
                'descricao' => 'Leite, queijos, iogurtes, manteigas e derivados.'
            ],
            [
                'nome' => 'Açougue',
                'descricao' => 'Carnes bovinas, suínas, aves e cortes especiais.'
            ],
            [
                'nome' => 'Padaria',
                'descricao' => 'Pães, bolos, tortas e salgados artesanais.'
            ],
            [
                'nome' => 'Limpeza',
                'descricao' => 'Produtos para conservação do lar e lavanderia.'
            ],
            [
                'nome' => 'Higiene e Beleza',
                'descricao' => 'Cuidados pessoais, perfumaria e cosméticos.'
            ],
            [
                'nome' => 'Bebidas',
                'descricao' => 'Sucos, refrigerantes, águas, cervejas e vinhos.'
            ],
            [
                'nome' => 'Mercearia',
                'descricao' => 'Arroz, feijão, massas, óleos e grãos essenciais.'
            ],
            [
                'nome' => 'Congelados',
                'descricao' => 'Pratos prontos, sorvetes e vegetais congelados.'
            ],
            [
                'nome' => 'Pet Shop',
                'descricao' => 'Rações, petiscos e acessórios para seu animal de estimação.'
            ]
        ];

        $model = new Categoria();
        
        foreach ($categorias as $data) {
            $model->insert($data);
        }
    }
}
