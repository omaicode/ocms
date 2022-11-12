<?php

/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
|
| The first thing we will do is create a new Laravel application instance
| which serves as the "glue" for all the components of Laravel, and is
| the IoC container for the system binding all of the various parts.
|
*/

$app = new Illuminate\Foundation\Application(
    $_ENV['APP_BASE_PATH'] ?? dirname(__DIR__)
);

/*
|--------------------------------------------------------------------------
| Bind Important Interfaces
|--------------------------------------------------------------------------
|
| Next, we need to bind some important interfaces into the container so
| we will be able to resolve them when needed. The kernels serve the
| incoming requests to this application from both the web and CLI.
|
*/

$http_kernel = "Omaicode\\Modules\\Kernels\\HttpKernel";
$console_kernel = "Omaicode\\Modules\\Kernels\\ConsoleKernel";
$exception_handler = "Omaicode\\Modules\\Exceptions\\Handler";

if(class_exists("Modules\\Core\\Http\\Kernel")) {
    $http_kernel = "Modules\\Core\\Http\\Kernel";
}

if(class_exists("Modules\\Core\\Console\\Kernel")) {
    $console_kernel = "Modules\\Core\\Console\\Kernel";
}

if(class_exists("Modules\\Core\\Exceptions\\Handler")) {
    $exception_handler = "Modules\\Core\\Exceptions\\Handler";
}

$app->singleton(
    Illuminate\Contracts\Http\Kernel::class,
    $http_kernel
);

$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    $console_kernel
);

$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    $exception_handler
);

/*
|--------------------------------------------------------------------------
| Return The Application
|--------------------------------------------------------------------------
|
| This script returns the application instance. The instance is given to
| the calling script so we can separate the building of the instances
| from the actual running of the application and sending responses.
|
*/

return $app;
