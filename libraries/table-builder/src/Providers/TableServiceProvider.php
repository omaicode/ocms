<?php
namespace Omaicode\TableBuilder\Providers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class TableServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->registerTranslations();
        $this->registerViews();
        $this->registerAssets();
    }

    public function register()
    {
        $this->commands([
            \Omaicode\TableBuilder\Commands\MakeTable::class
        ]);
    }

    /**
     * Register package's namespaces.
     */
    protected function registerNamespaces()
    {
        $configPath = __DIR__ . '/../../config/config.php';

        $this->publishes([
            $configPath => config_path('table_builder.php'),
        ], 'config');
    }    

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/table-builder');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'omc');
        } else {
            $this->loadTranslationsFrom(__DIR__ . '/../../resources/lang', 'omc');
        }
    }    

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/table-builder');
        $sourcePath = __DIR__ . '/../../resources/views';

        $this->publishes([
            $sourcePath => $viewPath
        ], ['views', 'table-builder-view']);

        $this->loadViewsFrom(array_merge($this->getPublishableViewPaths(), [$sourcePath]), 'omc');
    }    
    
    private function getPublishableViewPaths(): array
    {
        $paths = [];
        foreach (Config::get('view.paths') as $path) {
            if (is_dir($path . '/table-builder')) {
                $paths[] = $path . '/table-builder';
            }
        }

        return $paths;
    }    

    public function registerAssets()
    {
        $this->publishes([
            __DIR__.'/../../resources/assets' => public_path('vendor/table-builder'),
        ], ['laravel-assets', 'table-builder-assets']);        
    }
}