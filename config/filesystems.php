<?php

$s3Bucket = env('AWS_BUCKET');
$s3Configured = is_string($s3Bucket) && $s3Bucket !== '';
$wantS3 = env('FILESYSTEM_PUBLIC_DRIVER', env('FILESYSTEM_DISK', 'local')) === 's3';
$useS3 = $wantS3 && $s3Configured;

$s3Disk = [
    'driver' => 's3',
    'key' => env('AWS_ACCESS_KEY_ID'),
    'secret' => env('AWS_SECRET_ACCESS_KEY'),
    'region' => env('AWS_DEFAULT_REGION', 'eu-north-1'),
    'bucket' => $s3Bucket,
    'url' => env('AWS_URL'),
    'endpoint' => env('AWS_ENDPOINT'),
    'use_path_style_endpoint' => env('AWS_USE_PATH_STYLE_ENDPOINT', true),
    'visibility' => 'public',
    'throw' => false,
];

$localPublicDisk = [
    'driver' => 'local',
    'root' => storage_path('app/public'),
    'url' => rtrim(env('APP_URL', ''), '/').'/storage',
    'visibility' => 'public',
    'throw' => false,
];

$localDisk = [
    'driver' => 'local',
    'root' => storage_path('app'),
    'throw' => false,
];

return [

    'default' => $useS3 ? 's3' : 'public',

    'disks' => [

        'local' => $localDisk,

        'public' => $useS3 ? $s3Disk : $localPublicDisk,

        's3' => $useS3 ? $s3Disk : $localPublicDisk,

    ],

    'links' => [
        public_path('storage') => storage_path('app/public'),
    ],

];
