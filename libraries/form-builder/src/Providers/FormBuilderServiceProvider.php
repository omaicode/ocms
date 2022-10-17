<?php
namespace Omaicode\FormBuilder\Providers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class FormBuilderServiceProvider extends ServiceProvider
{
    public $key = 'form-builder';

    public function boot()
    {
        $this->registerConfig()
             ->registerViews()
             ->registerTranslations()
             ->registerAssets();
    }

    public function registerConfig()
    {
        $local_path   = __DIR__ .'/../../config/config.php';
        $publish_path = config_path('form-builder.php');

        $this->publishes([
            $local_path => $publish_path
        ], 'config');

        $this->mergeConfigFrom($local_path, $this->key);

        return $this;
    }

    public function registerViews()
    {
        $local_path   = __DIR__ .'/../../resources/views';
        $publish_path = resource_path('vendor/form-builder');

        $this->publishes([
            $local_path => $publish_path
        ], 'views');
        
        $this->loadViewsFrom($local_path, $this->key);

        return $this;
    }  

    public function registerTranslations()
    {
        $local_path   = __DIR__ .'/../../resources/lang';
        $publish_path = resource_path('lang/form-builder');

        if (is_dir($publish_path)) {
            $this->loadTranslationsFrom($publish_path, $this->key);
        } else {
            $this->loadTranslationsFrom($local_path, $this->key);
        }

        return $this;
    }

    public function registerAssets()
    {
        $this->publishes([
            __DIR__.'/../../resources/assets' => public_path('vendor/'.$this->key),
        ], ['laravel-assets', $this->key.'-assets']);        
    }    
}