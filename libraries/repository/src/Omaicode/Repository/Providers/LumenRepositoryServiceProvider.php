<?php
namespace Omaicode\Repository\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Class LumenRepositoryServiceProvider
 * @package Omaicode\Repository\Providers
 * @author Anderson Andrade <contato@andersonandra.de>
 */
class LumenRepositoryServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->commands('Omaicode\Repository\Generators\Commands\RepositoryCommand');
        $this->app->register('Omaicode\Repository\Providers\EventServiceProvider');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
