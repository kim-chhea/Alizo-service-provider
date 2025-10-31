<?php

namespace App\Http\Controllers;

use function Pest\version;
use OpenApi\Attributes as OA;

#[
    OA\Info(version: '1.0.0', title: 'Allizo Service API', description: 'API documentation for Allizo Service platform.'),
    OA\Server(url: 'http://localhost:8000', description: 'Local Development Server'),
    OA\Server(url: 'http://allizo.example.com', description: 'Production Server'),
    OA\Server(url: 'http://alizo.test/', description: 'Production API Server'),
    OA\SecurityScheme(
        securityScheme: 'sanctum',
        type: 'http',
        scheme: 'bearer',
        in : 'header',
        description: 'Authentication using Laravel Sanctum'
    ),
]
abstract class Controller
{
    //
}
