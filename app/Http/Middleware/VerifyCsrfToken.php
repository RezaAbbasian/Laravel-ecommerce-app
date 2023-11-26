<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        'http://babyshik.test/api/v1/*',
        'http://babyshik.test/api/v1/addresses/store',
        'http://babyshik.test/api/v1/orders/store',
        'http://babyshik.test/api/v1/login',
        'http://babyshik.test/api/v1/register'
    ];
}
