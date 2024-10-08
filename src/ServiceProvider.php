<?php

namespace NiftyCo\AdvancedDatabaseSessions;

use Illuminate\{Contracts\Foundation\Application, Support};


class ServiceProvider extends Support\ServiceProvider
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
    public function boot(): void
    {
        Support\Facades\Session::extend('advanced-database', function (Application $app) {
            $table = $app['config']->get('session.table');
            $lifetime = $app['config']->get('session.lifetime');
            $connection = $app['db']->connection($app['config']->get('session.connection'));

            return new SessionHandler($connection, $table, $lifetime, $app);
        });
    }
}
