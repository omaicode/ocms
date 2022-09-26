<?php

use Illuminate\Support\Facades\File;

if(!function_exists('adminAsset')) {
    function adminAsset($path = '')
    {
        if(substr($path, 0, 1) == '/') {
            $path = substr($path, 1, strlen($path));
        }
                
        return asset('modules/'.$path);
    }
}

if(!function_exists('uploadPath')) {
    function uploadPath($path = '')
    {
        if(substr($path, 0, 1) == '/') {
            $path = substr($path, 1, strlen($path));
        }

        return asset('uploads/'.$path);
    }
}

if(!function_exists('timezones')) {
    function timezones()
    {
        return json_decode(File::get(module_path('Core', 'timezone.json')), true);
    }
}

if(!function_exists('apiResponse')) {
    function apiResponse($success = true, array $data = [], int $code = -1, $message = 'No message')
    {
        return response()->json([
            'success' => $success,
            'code'    => $success ? 0 : $code,
            'message' => $message,
            'data'    => $data
        ], 200);
    }
}

if(!function_exists('composerPackages')) {
    function composerPackages()
    {
        $composer   = json_decode(file_get_contents(base_path('composer.json')), true);
        $production = collect($composer['require'])->map(fn($version, $name) => [
            'name'    => $name,
            'version' => $version,
            'type'    => 'Production'
        ])->toArray();
        $development = collect($composer['require-dev'])->map(fn($version, $name) => [
            'name'    => $name,
            'version' => $version,
            'type'    => 'Development'
        ])->toArray();

        $packages = array_merge(
            $production,
            $development
        );

        usort($packages, function ($item1, $item2) {
            return $item1['name'] <=> $item2['name'];
        });

        return $packages;
    }
}