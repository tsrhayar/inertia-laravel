<?php

namespace App\Providers;

use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use Inertia\Inertia;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(Request $request): void
    {
        //
        Inertia::share(
            [
                'errors' => function () {
                    return session()->get('errors') ? session()->get('errors')->getBag('default')->getMessages() : (object) [];
                },
                'flash' => [
                    'message' => fn() => $request->session()->get('message'),
                    'class' => fn() => $request->session()->get('class')
                ],
            ]
        );
    }
}