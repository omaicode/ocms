<?php
namespace Omaicode\FormBuilder\Traits;

use Illuminate\Support\Arr;
use Omaicode\FormBuilder\Fields\Display;
use Omaicode\FormBuilder\Fields\Password;
use Omaicode\FormBuilder\Fields\Select;
use Omaicode\FormBuilder\Fields\Text;

/**
 * @method Omaicode\FormBuilder\Fields\Text        text($column, $label = '')
 * @method Omaicode\FormBuilder\Fields\Select      select($column, $label = '')
 * @method Omaicode\FormBuilder\Fields\Password    password($column, $label = '')
 * @method Omaicode\FormBuilder\Fields\Display     display($column, $label = '')
 */
trait HasFields
{
    /**
     * Available fields.
     *
     * @var array
     */
    public static $availableFields = [
        'text'      => Text::class,
        'select'    => Select::class,
        'password'  => Password::class,
        'display'   => Display::class,
    ];

    /**
     * Form field alias.
     *
     * @var array
     */
    public static $fieldAlias = [];

    /**
     * Register custom field.
     *
     * @param string $abstract
     * @param string $class
     *
     * @return void
     */
    public static function extend($abstract, $class)
    {
        static::$availableFields[$abstract] = $class;
    }

    /**
     * Set form field alias.
     *
     * @param string $field
     * @param string $alias
     *
     * @return void
     */
    public static function alias($field, $alias)
    {
        static::$fieldAlias[$alias] = $field;
    }

    /**
     * Remove registered field.
     *
     * @param array|string $abstract
     */
    public static function forget($abstract)
    {
        Arr::forget(static::$availableFields, $abstract);
    }

    /**
     * Find field class.
     *
     * @param string $method
     *
     * @return bool|mixed
     */
    public static function findFieldClass($method)
    {
        // If alias exists.
        if (isset(static::$fieldAlias[$method])) {
            $method = static::$fieldAlias[$method];
        }

        $class = Arr::get(static::$availableFields, $method);

        if (class_exists($class)) {
            return $class;
        }

        return false;
    }

    /**
     * Collect assets required by registered field.
     *
     * @return array
     */
    public static function collectFieldAssets(): array
    {
        if (!empty(static::$collectedAssets)) {
            return static::$collectedAssets;
        }

        $css = collect();
        $js = collect();

        foreach (static::$availableFields as $field) {
            if (!method_exists($field, 'getAssets')) {
                continue;
            }

            $assets = call_user_func([$field, 'getAssets']);

            $css->push(Arr::get($assets, 'css'));
            $js->push(Arr::get($assets, 'js'));
        }

        return static::$collectedAssets = [
            'css' => $css->flatten()->unique()->filter()->toArray(),
            'js'  => $js->flatten()->unique()->filter()->toArray(),
        ];
    }
}