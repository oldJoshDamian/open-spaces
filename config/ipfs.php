<?php

return [

    /*
    |--------------------------------------------------------------------------
    | IPFS Credentials
    |--------------------------------------------------------------------------
    |
    | The credentials used to communicate with the IPFS daemon.
    | As default, the credentials for localhost are used.
    |
    | For more information see:
    | * https://docs.ipfs.io/install/
    |
    */
    'ipfs' => [
        'base_url' => env('IPFS_BASE_URL', '172.104.202.55'),
        'port' => env('IPFS_PORT', '5001'),
    ],
    'access_endpoint' => env('IPFS_ACCESS_ENDPOINT', 'https://ipfs.io')
];
