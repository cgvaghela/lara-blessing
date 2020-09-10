<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            'throttle:60,1',
            'bindings',
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth.user' => \App\Http\Middleware\AuthenticateUser::class,
        'guest.user' => \App\Http\Middleware\RedirectIfAuthenticatedUser::class,
        'auth.admin' => \App\Http\Middleware\AuthenticateAdmin::class,
        'guest.admin' => \App\Http\Middleware\RedirectIfAuthenticatedAdmin::class,
        //'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        //'can' => \Illuminate\Foundation\Http\Middleware\Authorize::class,
        //'changePassword' => \App\Http\Middleware\ChangePassword::class,
        //'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
    ];
}
