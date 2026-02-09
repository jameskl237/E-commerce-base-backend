<?php

$defaultOrigins = 'https://maketushop.com,https://www.maketushop.com,http://localhost:5173,http://localhost:3000,http://127.0.0.1:5173,http://127.0.0.1:3000';
$rawOrigins = env('CORS_ALLOWED_ORIGINS');
$originsString = (is_string($rawOrigins) && trim($rawOrigins) !== '') ? $rawOrigins : $defaultOrigins;

$defaultPatterns = '/^https:\\/\\/(.+\\.)?maketushop\\.com$/';
$rawPatterns = env('CORS_ALLOWED_ORIGINS_PATTERNS');
$patternsString = (is_string($rawPatterns) && trim($rawPatterns) !== '') ? $rawPatterns : $defaultPatterns;

return [

    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure your settings for cross-origin resource sharing
    | or "CORS". This determines what cross-origin operations may execute
    | in web browsers. You are free to adjust these settings as needed.
    |
    | To learn more: https://developer.mozilla.org/en-US/docs/Web/HTTP/CORS
    |
    */

    'paths' => ['api/*', 'sanctum/csrf-cookie'],

    'allowed_methods' => ['*'],

    'allowed_origins' => array_filter(array_map('trim', explode(',', $originsString))),
    'allowed_origins_patterns' => array_filter(array_map('trim', explode(',', $patternsString))),

    'allowed_headers' => ['*'],

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => true,

];
