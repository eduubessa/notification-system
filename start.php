<?php

if(file_exists(__dir__ . '/vendor/autoload.php')) {
    require_once __dir__ . '/vendor/autoload.php';
}

if(file_exists(__dir__ . '/Bootstrap/app.php')) {
    require_once __dir__ . '/Bootstrap/app.php';
}


$birth = new \App\Notifications\BirthdayNotification("eduubessa@gmail.com");



$birth->notify();