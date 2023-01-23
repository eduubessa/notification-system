<?php

namespace App\Notifications;

use App\Models\Person;
use App\Services\TwilioService;
use Bootstrap\Notification;

class BirthdayNotification extends Notification {

    private Person $person;
    private string $message;

    public function __construct($person, $message) {
        $this->person = $person;
        $this->message = $message;
    }

}