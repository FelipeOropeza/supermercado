<?php

namespace App\Database\Seeders;

class DatabaseSeeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        echo "[INFO] Iniciando DatabaseSeeder principal...\n";

        // Como estas classes não estão no autoloader (pasta database), precisamos incluí-las manualmente
        require_once __DIR__ . '/CategoriaSeeder.php';
        require_once __DIR__ . '/ProdutoSeeder.php';
        require_once __DIR__ . '/AdminSeeder.php';

        // Ordem importa (Categorias -> Produtos)
        (new CategoriaSeeder())->run();
        (new ProdutoSeeder())->run();
        (new AdminSeeder())->run();

        echo "[INFO] DatabaseSeeder finalizado com sucesso.\n";
    }
}
