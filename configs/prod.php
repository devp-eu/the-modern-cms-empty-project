<?php

// These are production server settings, shared between all developers
$config_prod = [
    'db' => [
        'login' => 'github_empty',
        'password' => 'github_empty_project_password',
        'name' => 'github_empty_project_db'
    ],
    'site' => [
        'email' => 'your@email.com',
        'name' => 'Website Name'
    ],
    'cms' => [
        'unique_key' => 'your_unique_key' // Required for updates
    ],
    'http_auth' => [
        'login' => '', // Set if required
        'password' => '',
    ]
];

// Change all your local settings in local.php - file should return array with fields to be overwritten
$config_local = [];
if (file_exists(__DIR__ . '/local.php')) {
    $config_local = include_once __DIR__ . '/local.php';
}

return array_merge($config_prod, $config_local);