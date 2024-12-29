<?php
namespace App\Http;

use App\Http\Middleware\CheckAuthenticate;
use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [ 
        'web' => CheckAuthenticate::class,
    ];
}
