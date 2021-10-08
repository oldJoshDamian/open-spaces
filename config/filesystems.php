<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application. Just store away!
    |
    */

    'default' => env('FILESYSTEM_DRIVER', 'local'),

    'resource_disk' => env('RESOURCE_DISK') ?? env('STORAGE_DISK', 'public'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish, and you
    | may even configure multiple disks of the same driver. Defaults have
    | been setup for each driver as an example of the required options.
    |
    | Supported Drivers: "local", "ftp", "sftp", "s3"
    |
    */

    'folders' => [
        'resources' => env('FOLDER_FOR_RESOURCES', 'resource_files'),
        'cover_pages' => env('FOLDER_FOR_COVER_PAGES', 'resource_cover_pages'),
    ],

    'disks' => [

        'ftp' => [
            'driver' => 'ftp',
            'host' => env('FTP_HOST'),
            'username' => env('FTP_USERNAME'),
            'password' => env('FTP_PASSWORD'),
            'url' => env('FTP_URL'),

            // Optional FTP Settings...
            'port' => env('FTP_PORT'),
            'root' => 'public_html',
            // 'passive' => true,
            // 'ssl' => true,
            // 'timeout' => 30,
        ],


        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL') . '/storage',
            'visibility' => 'public',
        ],

        'google' => [
            'driver' => 'google',
            'clientId' => env('MAIN_GOOGLE_DRIVE_CLIENT_ID'),
            'clientSecret' => env('MAIN_GOOGLE_DRIVE_CLIENT_SECRET'),
            'refreshToken' => env('MAIN_GOOGLE_DRIVE_REFRESH_TOKEN'),
            'folderId' => env('MAIN_GOOGLE_DRIVE_FOLDER_ID'),
            'url' => 'https://drive.google.com/drive/u/3/folders'
        ],

        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'url' => env('AWS_URL'),
            'endpoint' => env('AWS_ENDPOINT'),
            'use_path_style_endpoint' => env('AWS_USE_PATH_STYLE_ENDPOINT', false),
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Symbolic Links
    |--------------------------------------------------------------------------
    |
    | Here you may configure the symbolic links that will be created when the
    | `storage:link` Artisan command is executed. The array keys should be
    | the locations of the links and the values should be their targets.
    |
    */

    'links' => [
        public_path('storage') => storage_path('app/public'),
    ],

];
