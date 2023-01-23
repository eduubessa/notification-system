<?php

use Illuminate\Database\Capsule\Manager;

$capsule = new Manager;

$capsule->addConnection([
        'driver' => env('DB_DRIVER', 'mysql'),
        'host' => env('DB_HOST', '127.0.0.1'),
        'database' => env('DB_DATABASE', 'notificationsystemdev'),
        'username' => env('DB_USERNAME', 'root'),
        'password' => env('DB_PASSWORD', 'Vush@w123')
]);

$capsule->setAsGlobal();
$capsule->bootEloquent();