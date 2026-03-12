<?php

return [
    /*
     |--------------------------------------------------------------------------
     | Application Paths
     |--------------------------------------------------------------------------
     |
     | Here you can specify the paths used by the framework to locate files.
     |
     */
    'paths' => [
        'controllers' => __DIR__ . '/../app/Controllers',
        'models'      => __DIR__ . '/../app/Models',
        'middlewares' => __DIR__ . '/../app/Middleware',
        'views'       => __DIR__ . '/../app/Views',
        'migrations'  => __DIR__ . '/../database/migrations',
        'services'    => __DIR__ . '/../app/Services',

        // Caminho físico dos templates usados pelos comandos do Console
        'templates'   => __DIR__ . '/../core/Console/Templates',
    ],

    /*
     |--------------------------------------------------------------------------
     | General Application Configuration
     |--------------------------------------------------------------------------
     |
     | Outras configurações gerais podem ir aqui (ex: nome, fuso horário, etc).
     |
     */
    'app' => [
        'name'          => 'Supermercado Online',
        // Motores suportados: 'php' ou 'twig'
        'view_engine'   => 'php',
        // Rota padrão do redirecionamento raiz, caso configurado
        'default_route' => '/',
    ],

    /*
     |--------------------------------------------------------------------------
     | Service Providers Autoload
     |--------------------------------------------------------------------------
     |
     | Os provedores encarregados por bootar e configurar as fundações da Aplicação.
     | O ciclo de 'Kernel' lê tudo dentro desse array ao ligar o site.
     | Usuários podem adicionar `App\Providers\AppServiceProvider::class` aqui
     | e construir suas lógicas separadas da pasta core/.
     |
     */
    'providers' => [
        \Core\Providers\DatabaseServiceProvider::class,
        \Core\Providers\RoutingServiceProvider::class,
        \Core\Providers\ViewServiceProvider::class,

        \App\Providers\AppServiceProvider::class,
        \App\Providers\MercureServiceProvider::class,
    ]
];
