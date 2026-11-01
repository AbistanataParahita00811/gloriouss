<?php

$storagePath = getenv('APP_STORAGE_PATH') ?: '/tmp/storage';
$directories = [
    $storagePath.'/app/public',
    $storagePath.'/framework/cache/data',
    $storagePath.'/framework/sessions',
    $storagePath.'/framework/views',
    $storagePath.'/logs',
    '/tmp/views',
    '/tmp/bootstrap/cache',
];

foreach ($directories as $directory) {
    if (! is_dir($directory)) {
        mkdir($directory, 0755, true);
    }
}

require __DIR__.'/../public/index.php';
