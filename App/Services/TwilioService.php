<?php

namespace App\Services;

use Twilio\Rest\Client;
class TwilioService {

    public function __constructor(): void
    {
        $this->sid = env('TWILIO_ID');
        $this->token = env('TWILIO_TOKEN');
        $this->from = env('TWILIO_PHONE');

        $this->service = new Client($this->sid, $this->token);
    }

    public function send_message(string $to, string $message): void
    {
        $this->service->messages->create(
            $to,
            [
                'from' => $this->from,
                'body' => $message
            ]
        );
    }

}