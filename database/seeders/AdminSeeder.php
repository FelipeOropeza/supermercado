<?php

namespace App\Database\Seeders;

class AdminSeeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Exemplo usando Model (ORM / Query Builder):
        $usuario = new \App\Models\Usuario();
        $usuario->insert([
            'nome' => 'Admin',
            'email' => 'admin@admin.com',
            'senha' => password_hash('admin', PASSWORD_DEFAULT),
            'role' => 'admin'
        ]);
        
        // Se precisar criar múltiplos:
        // for ($i = 0; $i < 5; $i++) {
        //     $usuario->insert([
        //         'nome' => "Usuario $i",
        //         'email' => "user$i@example.com",
        //         'password' => password_hash('secreta', PASSWORD_DEFAULT)
        //     ]);
        // }
    }
}